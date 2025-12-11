@extends('layouts.dashboard')

@section('title', 'Edit Teacher')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Teachers /</span> Edit {{ $teacher->name }}
            </h4>
            <p class="text-muted">Update teacher information</p>
        </div>
        <a href="{{ route('admin.teachers.show', $teacher) }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i>
            Back
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Teacher Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $teacher->name) }}"
                                       placeholder="Enter teacher's full name"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $teacher->email) }}"
                                       placeholder="teacher@example.com"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       id="username" 
                                       name="username" 
                                       value="{{ old('username', $teacher->username) }}"
                                       placeholder="Optional username">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Leave empty to use email as login</div>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Leave empty to keep current password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Only fill if you want to change the password</div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i>
                                Update Teacher
                            </button>
                            <a href="{{ route('admin.teachers.show', $teacher) }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Current Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Current Information</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $teacher->avatar_url }}" 
                             class="rounded-circle me-3" 
                             width="50" height="50" 
                             alt="Teacher Avatar">
                        <div>
                            <h6 class="mb-0">{{ $teacher->name }}</h6>
                            <small class="text-muted">{{ $teacher->email }}</small>
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <strong>Assigned Grades:</strong> 
                        @if($teacher->teachingGrades->count() > 0)
                            @foreach($teacher->teachingGrades as $grade)
                                <span class="badge bg-primary">{{ $grade->full_name }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">None</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <strong>Total Students:</strong> 
                        @php
                            $totalStudents = $teacher->teachingGrades->sum(function($grade) {
                                return $grade->students->count();
                            });
                        @endphp
                        {{ $totalStudents }}
                    </div>
                    <div class="mb-2">
                        <strong>Username:</strong> {{ $teacher->username ?? 'Not set' }}
                    </div>
                    <div class="mb-2">
                        <strong>Created:</strong> {{ $teacher->created_at->format('d M Y') }}
                    </div>
                </div>
            </div>

            <!-- Grade Assignments -->
            @if($teacher->teachingGrades->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Current Grade Assignments</h5>
                </div>
                <div class="card-body">
                    @foreach($teacher->teachingGrades as $grade)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="mb-0">{{ $grade->full_name }}</h6>
                                <small class="text-muted">
                                    {{ $grade->student_count }}/{{ $grade->capacity }} students
                                </small>
                            </div>
                            <a href="{{ route('admin.grades.show', $grade) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bx bx-show"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Important Notes -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Important Notes</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        <h6 class="alert-heading">Editing Guidelines</h6>
                        <ul class="mb-0">
                            <li>Email and username must be unique</li>
                            <li>Changing email affects login credentials</li>
                            <li>Leave password empty to keep current one</li>
                            <li>Grade assignments managed separately</li>
                        </ul>
                    </div>

                    <div class="mt-3">
                        <h6>Quick Actions</h6>
                        <div class="d-grid gap-2">
                            <form action="{{ route('admin.teachers.reset-password', $teacher) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-warning btn-sm w-100"
                                        onclick="return confirm('Reset password to default?')">
                                    <i class="bx bx-reset me-1"></i>Reset Password
                                </button>
                            </form>
                            
                            @if($teacher->teachingGrades->count() == 0)
                            <button type="button" class="btn btn-outline-success btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#assignGradeModal">
                                <i class="bx bx-plus me-1"></i>Assign Grade
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Assign Grade Modal -->
@if($teacher->teachingGrades->count() == 0)
<div class="modal fade" id="assignGradeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Grade to {{ $teacher->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.teachers.assign-grade', $teacher) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="grade_id" class="form-label">Select Grade</label>
                        <select class="form-select" id="grade_id" name="grade_id" required>
                            <option value="">Choose a grade...</option>
                            @foreach(\App\Models\Grade::whereNull('teacher_id')->active()->orderBy('level')->orderBy('name')->get() as $grade)
                                <option value="{{ $grade->id }}">
                                    {{ $grade->full_name }} ({{ $grade->student_count }} students)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="alert alert-info">
                        <strong>Note:</strong> Each teacher can only be assigned to one grade at a time.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Assign Grade</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection