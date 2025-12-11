<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\User;
use App\Enum\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $grades = Grade::with(['teacher', 'students'])
            ->when($request->search, function($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('level', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('class_code', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->level, function($query) use ($request) {
                $query->where('level', $request->level);
            })
            ->when($request->has_teacher !== null, function($query) use ($request) {
                if ($request->has_teacher === '1') {
                    $query->whereNotNull('teacher_id');
                } elseif ($request->has_teacher === '0') {
                    $query->whereNull('teacher_id');
                }
            })
            ->orderBy('level')
            ->orderBy('specialization')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.grades.index', compact('grades'));
    }

    public function create()
    {
        $teachers = User::where('role', Role::TEACHER->value)
                       ->whereDoesntHave('teachingGrades')
                       ->get();
        
        return view('admin.grades.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:10',
            'specialization' => 'nullable|string|max:255',
            'class_code' => 'required|string|max:255|unique:grades,class_code',
            'teacher_id' => 'nullable|exists:users,id',
            'capacity' => 'required|integer|min:1|max:50',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        Grade::create($validated);

        return redirect()->route('admin.grades.index')
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Grade created successfully!'
                        ]);
    }

    public function show(Grade $grade)
    {
        $grade->load(['teacher', 'students']);
        $availableTeachers = User::where('role', Role::TEACHER->value)
                                ->where(function($query) use ($grade) {
                                    $query->whereDoesntHave('teachingGrades')
                                          ->orWhere('id', $grade->teacher_id);
                                })
                                ->get();

        return view('admin.grades.show', compact('grade', 'availableTeachers'));
    }

    public function edit(Grade $grade)
    {
        $teachers = User::where('role', Role::TEACHER->value)
                       ->where(function($query) use ($grade) {
                           $query->whereDoesntHave('teachingGrades')
                                 ->orWhere('id', $grade->teacher_id);
                       })
                       ->get();

        return view('admin.grades.edit', compact('grade', 'teachers'));
    }

    public function update(Request $request, Grade $grade)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:10',
            'specialization' => 'nullable|string|max:255',
            'class_code' => ['required', 'string', 'max:255', Rule::unique('grades', 'class_code')->ignore($grade->id)],
            'teacher_id' => 'nullable|exists:users,id',
            'capacity' => 'required|integer|min:1|max:50',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $grade->update($validated);

        return redirect()->route('admin.grades.index')
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Grade updated successfully!'
                        ]);
    }

    public function destroy(Grade $grade)
    {
        if ($grade->students()->count() > 0) {
            return redirect()->route('admin.grades.index')
                            ->with('notification', [
                                'icon' => 'error',
                                'title' => 'Error',
                                'message' => 'Cannot delete grade with students assigned!'
                            ]);
        }

        $grade->delete();

        return redirect()->route('admin.grades.index')
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Grade deleted successfully!'
                        ]);
    }

    public function assignStudent(Request $request, Grade $grade)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id'
        ]);

        $student = User::findOrFail($validated['student_id']);
        
        if (!$student->isStudent()) {
            return redirect()->back()
                            ->with('notification', [
                                'icon' => 'error',
                                'title' => 'Error',
                                'message' => 'User is not a student!'
                            ]);
        }

        if ($grade->student_count >= $grade->capacity) {
            return redirect()->back()
                            ->with('notification', [
                                'icon' => 'error',
                                'title' => 'Error',
                                'message' => 'Grade is at full capacity!'
                            ]);
        }

        $student->update(['grade_id' => $grade->id]);

        return redirect()->back()
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Student assigned to grade successfully!'
                        ]);
    }

    public function removeStudent(Grade $grade, User $student)
    {
        if (!$student->isStudent() || $student->grade_id !== $grade->id) {
            return redirect()->back()
                            ->with('notification', [
                                'icon' => 'error',
                                'title' => 'Error',
                                'message' => 'Student is not assigned to this grade!'
                            ]);
        }

        $student->update(['grade_id' => null]);

        return redirect()->back()
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Student removed from grade successfully!'
                        ]);
    }
}
