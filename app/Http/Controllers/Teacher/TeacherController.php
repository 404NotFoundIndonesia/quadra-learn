<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\LearningMaterial;
use App\Models\StudentProgress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $teacher = Auth::user();
        
        // Get teacher's assigned grades/classes
        $assignedGrades = Grade::where('teacher_id', $teacher->id)
            ->with(['students' => function($query) {
                $query->orderBy('name');
            }])
            ->withCount('students')
            ->get();
        
        // Get total students across all assigned classes
        $totalStudents = $assignedGrades->sum('students_count');
        
        // Get recent student activity from assigned classes
        $studentIds = $assignedGrades->pluck('students.*.id')->flatten();
        
        $recentProgress = StudentProgress::whereIn('user_id', $studentIds)
            ->with(['user', 'learningMaterial'])
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();
        
        // Get learning materials progress summary
        $learningMaterials = LearningMaterial::published()
            ->withCount([
                'studentProgress as total_attempts' => function($query) use ($studentIds) {
                    $query->whereIn('user_id', $studentIds);
                },
                'studentProgress as completed_attempts' => function($query) use ($studentIds) {
                    $query->whereIn('user_id', $studentIds)
                          ->where('status', 'completed');
                }
            ])
            ->get();
        
        // Calculate overall statistics
        $stats = [
            'total_classes' => $assignedGrades->count(),
            'total_students' => $totalStudents,
            'active_students' => StudentProgress::whereIn('user_id', $studentIds)
                ->where('updated_at', '>=', now()->subDays(7))
                ->distinct('user_id')
                ->count(),
            'avg_completion_rate' => $this->calculateAverageCompletionRate($studentIds)
        ];

        return view('teacher.dashboard', compact(
            'assignedGrades',
            'recentProgress', 
            'learningMaterials',
            'stats'
        ));
    }

    public function classes()
    {
        $teacher = Auth::user();
        
        $assignedGrades = Grade::where('teacher_id', $teacher->id)
            ->with(['students' => function($query) {
                $query->orderBy('name');
            }])
            ->withCount('students')
            ->get();

        return view('teacher.classes', compact('assignedGrades'));
    }

    public function classDetail(Grade $grade)
    {
        // Ensure this grade belongs to the authenticated teacher
        if ($grade->teacher_id !== Auth::id()) {
            abort(403, 'You do not have permission to view this class.');
        }

        $students = $grade->students()
            ->with(['studentProgress.learningMaterial'])
            ->get();

        // Get learning materials with progress for this class
        $learningMaterials = LearningMaterial::published()
            ->withCount([
                'studentProgress as total_attempts' => function($query) use ($students) {
                    $query->whereIn('user_id', $students->pluck('id'));
                },
                'studentProgress as completed_attempts' => function($query) use ($students) {
                    $query->whereIn('user_id', $students->pluck('id'))
                          ->where('status', 'completed');
                }
            ])
            ->get();

        return view('teacher.class-detail', compact('grade', 'students', 'learningMaterials'));
    }

    public function studentProgress(User $student)
    {
        $teacher = Auth::user();
        
        // Verify student belongs to teacher's class
        $studentGrade = $student->grade;
        if (!$studentGrade || $studentGrade->teacher_id !== $teacher->id) {
            abort(403, 'You do not have permission to view this student\'s progress.');
        }

        $progress = StudentProgress::where('user_id', $student->id)
            ->with('learningMaterial')
            ->orderBy('started_at', 'desc')
            ->get();

        $stats = [
            'total_materials' => LearningMaterial::published()->count(),
            'completed_materials' => $progress->where('status', 'completed')->count(),
            'in_progress_materials' => $progress->where('status', 'in_progress')->count(),
            'average_score' => $progress->where('score', '>', 0)->avg('score') ?? 0
        ];

        return view('teacher.student-progress', compact('student', 'progress', 'stats'));
    }

    public function analytics()
    {
        $teacher = Auth::user();
        
        // Get all assigned grades and their students
        $assignedGrades = Grade::where('teacher_id', $teacher->id)
            ->with('students')
            ->get();
        $studentIds = $assignedGrades->pluck('students')->flatten()->pluck('id');

        // Material completion analytics
        $materialAnalytics = LearningMaterial::published()
            ->select('id', 'title', 'type')
            ->withCount([
                'studentProgress as total_attempts' => function($query) use ($studentIds) {
                    $query->whereIn('user_id', $studentIds);
                },
                'studentProgress as completed_attempts' => function($query) use ($studentIds) {
                    $query->whereIn('user_id', $studentIds)->where('status', 'completed');
                }
            ])
            ->get()
            ->map(function($material) {
                $material->completion_rate = $material->total_attempts > 0 
                    ? round(($material->completed_attempts / $material->total_attempts) * 100, 1)
                    : 0;
                return $material;
            });

        // Weekly progress data for charts
        $weeklyProgress = StudentProgress::whereIn('user_id', $studentIds)
            ->where('updated_at', '>=', now()->subWeeks(4))
            ->selectRaw('DATE(updated_at) as date, COUNT(*) as activities, AVG(score) as avg_score')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Class performance comparison
        $classStats = $assignedGrades->map(function($grade) {
            $studentIds = $grade->students->pluck('id');
            $completedProgress = StudentProgress::whereIn('user_id', $studentIds)
                ->where('status', 'completed');

            return [
                'grade' => $grade,
                'avg_score' => $completedProgress->avg('score') ?? 0,
                'completion_count' => $completedProgress->count(),
                'active_students' => StudentProgress::whereIn('user_id', $studentIds)
                    ->where('updated_at', '>=', now()->subDays(7))
                    ->distinct('user_id')
                    ->count()
            ];
        });

        return view('teacher.analytics', compact(
            'materialAnalytics', 
            'weeklyProgress', 
            'classStats',
            'assignedGrades'
        ));
    }

    private function calculateAverageCompletionRate($studentIds)
    {
        if ($studentIds->isEmpty()) {
            return 0;
        }

        $totalMaterials = LearningMaterial::published()->count();
        $completedProgress = StudentProgress::whereIn('user_id', $studentIds)
            ->where('status', 'completed')
            ->count();
        
        $totalPossibleCompletions = $studentIds->count() * $totalMaterials;
        
        return $totalPossibleCompletions > 0 
            ? round(($completedProgress / $totalPossibleCompletions) * 100, 1)
            : 0;
    }
}