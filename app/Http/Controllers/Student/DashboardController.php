<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use App\Models\StudentProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get learning materials with progress
        $learningMaterials = LearningMaterial::published()
            ->ordered()
            ->with(['questions' => function($query) {
                $query->active()->orderBy('order');
            }])
            ->get()
            ->map(function($material) use ($user) {
                $progress = StudentProgress::where('user_id', $user->id)
                    ->where('learning_material_id', $material->id)
                    ->first();
                
                $material->progress = $progress;
                $material->questions_count = $material->questions->count();
                
                return $material;
            });

        // Get overall statistics
        $totalMaterials = $learningMaterials->count();
        $completedMaterials = $learningMaterials->filter(function($material) {
            return $material->progress && $material->progress->isCompleted();
        })->count();
        
        $inProgressMaterials = $learningMaterials->filter(function($material) {
            return $material->progress && $material->progress->isInProgress();
        })->count();

        $overallProgress = $totalMaterials > 0 ? ($completedMaterials / $totalMaterials) * 100 : 0;

        return view('student.dashboard', compact(
            'learningMaterials', 
            'totalMaterials', 
            'completedMaterials', 
            'inProgressMaterials',
            'overallProgress'
        ));
    }
}