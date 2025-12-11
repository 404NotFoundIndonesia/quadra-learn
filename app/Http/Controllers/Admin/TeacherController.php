<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Grade;
use App\Enum\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $teachers = User::teacher()
            ->with('teachingGrades')
            ->when($request->search, function($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('username', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->has_grade !== null, function($query) use ($request) {
                if ($request->has_grade === '1') {
                    $query->whereHas('teachingGrades');
                } elseif ($request->has_grade === '0') {
                    $query->whereDoesntHave('teachingGrades');
                }
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'nullable|string|max:255|unique:users',
            'password' => 'nullable|string|min:8',
        ]);

        $validated['role'] = Role::TEACHER->value;
        $validated['password'] = Hash::make($validated['password'] ?? User::DEFAULT_PASSWORD);

        $teacher = User::create($validated);

        return redirect()->route('admin.teachers.index')
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Teacher created successfully!'
                        ]);
    }

    public function show(User $teacher)
    {
        if (!$teacher->isTeacher()) {
            abort(404);
        }

        $teacher->load('teachingGrades.students');
        
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(User $teacher)
    {
        if (!$teacher->isTeacher()) {
            abort(404);
        }

        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, User $teacher)
    {
        if (!$teacher->isTeacher()) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($teacher->id)],
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($teacher->id)],
            'password' => 'nullable|string|min:8',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $teacher->update($validated);

        return redirect()->route('admin.teachers.show', $teacher)
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Teacher updated successfully!'
                        ]);
    }

    public function destroy(User $teacher)
    {
        if (!$teacher->isTeacher()) {
            abort(404);
        }

        // Check if teacher is assigned to any grade
        if ($teacher->teachingGrades()->count() > 0) {
            return redirect()->route('admin.teachers.index')
                            ->with('notification', [
                                'icon' => 'error',
                                'title' => 'Error',
                                'message' => 'Cannot delete teacher who is assigned to grades!'
                            ]);
        }

        $teacher->delete();

        return redirect()->route('admin.teachers.index')
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Teacher deleted successfully!'
                        ]);
    }

    public function resetPassword(User $teacher)
    {
        if (!$teacher->isTeacher()) {
            abort(404);
        }

        $teacher->update([
            'password' => Hash::make(User::DEFAULT_PASSWORD)
        ]);

        return redirect()->back()
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Password reset to default successfully!'
                        ]);
    }

    public function assignGrade(Request $request, User $teacher)
    {
        if (!$teacher->isTeacher()) {
            abort(404);
        }

        $validated = $request->validate([
            'grade_id' => 'required|exists:grades,id'
        ]);

        $grade = Grade::findOrFail($validated['grade_id']);

        // Check if grade already has a teacher
        if ($grade->teacher_id && $grade->teacher_id !== $teacher->id) {
            return redirect()->back()
                            ->with('notification', [
                                'icon' => 'error',
                                'title' => 'Error',
                                'message' => 'Grade already has an assigned teacher!'
                            ]);
        }

        // Check if teacher is already assigned to another grade
        if ($teacher->teachingGrades()->where('id', '!=', $grade->id)->count() > 0) {
            return redirect()->back()
                            ->with('notification', [
                                'icon' => 'error',
                                'title' => 'Error',
                                'message' => 'Teacher is already assigned to another grade!'
                            ]);
        }

        $grade->update(['teacher_id' => $teacher->id]);

        return redirect()->back()
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Teacher assigned to grade successfully!'
                        ]);
    }

    public function removeGrade(User $teacher, Grade $grade)
    {
        if (!$teacher->isTeacher()) {
            abort(404);
        }

        if ($grade->teacher_id !== $teacher->id) {
            return redirect()->back()
                            ->with('notification', [
                                'icon' => 'error',
                                'title' => 'Error',
                                'message' => 'Teacher is not assigned to this grade!'
                            ]);
        }

        $grade->update(['teacher_id' => null]);

        return redirect()->back()
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Teacher removed from grade successfully!'
                        ]);
    }

    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:delete,reset_password',
            'teacher_ids' => 'required|array',
            'teacher_ids.*' => 'exists:users,id'
        ]);

        $teachers = User::teacher()->whereIn('id', $validated['teacher_ids'])->get();

        switch ($validated['action']) {
            case 'delete':
                // Check if any teacher has assigned grades
                $teachersWithGrades = $teachers->filter(function($teacher) {
                    return $teacher->teachingGrades()->count() > 0;
                });

                if ($teachersWithGrades->count() > 0) {
                    return redirect()->back()
                                    ->with('notification', [
                                        'icon' => 'error',
                                        'title' => 'Error',
                                        'message' => 'Cannot delete teachers who are assigned to grades!'
                                    ]);
                }

                $teachers->each->delete();
                $message = 'Selected teachers deleted successfully!';
                break;
                
            case 'reset_password':
                $teachers->each(function($teacher) {
                    $teacher->update(['password' => Hash::make(User::DEFAULT_PASSWORD)]);
                });
                $message = 'Passwords reset for selected teachers!';
                break;
        }

        return redirect()->route('admin.teachers.index')
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => $message
                        ]);
    }
}
