<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Grade;
use App\Enum\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = User::student()
            ->with('grade')
            ->when($request->search, function($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('nis', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->grade_id, function($query) use ($request) {
                if ($request->grade_id === 'unassigned') {
                    $query->whereNull('grade_id');
                } else {
                    $query->where('grade_id', $request->grade_id);
                }
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $grades = Grade::active()->orderBy('level')->orderBy('name')->get();

        return view('admin.students.index', compact('students', 'grades'));
    }

    public function create()
    {
        $grades = Grade::active()->orderBy('level')->orderBy('name')->get();
        return view('admin.students.create', compact('grades'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'nullable|string|max:255|unique:users',
            'nis' => 'nullable|string|max:255|unique:users',
            'grade_id' => 'nullable|exists:grades,id',
            'password' => 'nullable|string|min:8',
        ]);

        $validated['role'] = Role::STUDENT->value;
        $validated['password'] = Hash::make($validated['password'] ?? User::DEFAULT_PASSWORD);

        $student = User::create($validated);

        return redirect()->route('admin.students.index')
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Student created successfully!'
                        ]);
    }

    public function show(User $student)
    {
        if (!$student->isStudent()) {
            abort(404);
        }

        $student->load('grade');
        $grades = Grade::active()->orderBy('level')->orderBy('name')->get();

        return view('admin.students.show', compact('student', 'grades'));
    }

    public function edit(User $student)
    {
        if (!$student->isStudent()) {
            abort(404);
        }

        $grades = Grade::active()->orderBy('level')->orderBy('name')->get();
        return view('admin.students.edit', compact('student', 'grades'));
    }

    public function update(Request $request, User $student)
    {
        if (!$student->isStudent()) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($student->id)],
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($student->id)],
            'nis' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($student->id)],
            'grade_id' => 'nullable|exists:grades,id',
            'password' => 'nullable|string|min:8',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $student->update($validated);

        return redirect()->route('admin.students.show', $student)
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Student updated successfully!'
                        ]);
    }

    public function destroy(User $student)
    {
        if (!$student->isStudent()) {
            abort(404);
        }

        $student->delete();

        return redirect()->route('admin.students.index')
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Student deleted successfully!'
                        ]);
    }

    public function resetPassword(User $student)
    {
        if (!$student->isStudent()) {
            abort(404);
        }

        $student->update([
            'password' => Hash::make(User::DEFAULT_PASSWORD)
        ]);

        return redirect()->back()
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => 'Password reset to default successfully!'
                        ]);
    }

    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:delete,reset_password,assign_grade,remove_grade',
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:users,id',
            'grade_id' => 'nullable|exists:grades,id'
        ]);

        $students = User::student()->whereIn('id', $validated['student_ids'])->get();

        switch ($validated['action']) {
            case 'delete':
                $students->each->delete();
                $message = 'Selected students deleted successfully!';
                break;
                
            case 'reset_password':
                $students->each(function($student) {
                    $student->update(['password' => Hash::make(User::DEFAULT_PASSWORD)]);
                });
                $message = 'Passwords reset for selected students!';
                break;
                
            case 'assign_grade':
                if (!$validated['grade_id']) {
                    return redirect()->back()->withErrors(['grade_id' => 'Grade is required for assignment']);
                }
                $students->each(function($student) use ($validated) {
                    $student->update(['grade_id' => $validated['grade_id']]);
                });
                $message = 'Students assigned to grade successfully!';
                break;
                
            case 'remove_grade':
                $students->each(function($student) {
                    $student->update(['grade_id' => null]);
                });
                $message = 'Students removed from grades successfully!';
                break;
        }

        return redirect()->route('admin.students.index')
                        ->with('notification', [
                            'icon' => 'success',
                            'title' => 'Success',
                            'message' => $message
                        ]);
    }
}
