@extends('layouts.dashboard')

@section('title', 'Edit Student')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Students /</span> Edit {{ $student->name }}
            </h4>
            <p class="text-muted">Update student information</p>
        </div>
        <a href="{{ route('admin.students.show', $student) }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i>
            Back
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Student Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.students.update', $student) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $student->name) }}"
                                       placeholder="Enter student's full name"
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
                                       value="{{ old('email', $student->email) }}"
                                       placeholder="student@example.com"
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
                                       value="{{ old('username', $student->username) }}"
                                       placeholder="Optional username">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Leave empty to use email as login</div>
                            </div>
                            <div class="col-md-6">
                                <label for="nis" class="form-label">NIS (Student ID)</label>
                                <input type="text" 
                                       class="form-control @error('nis') is-invalid @enderror" 
                                       id="nis" 
                                       name="nis" 
                                       value="{{ old('nis', $student->nis) }}"
                                       placeholder="Student identification number">
                                @error('nis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="grade_id" class="form-label">Assign to Grade</label>
                                <select class="form-select @error('grade_id') is-invalid @enderror" 
                                        id="grade_id" 
                                        name="grade_id">
                                    <option value="">No Grade Assignment</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}" 
                                                {{ old('grade_id', $student->grade_id) == $grade->id ? 'selected' : '' }}>
                                            {{ $grade->full_name }} 
                                            ({{ $grade->available_slots + ($student->grade_id == $grade->id ? 1 : 0) }} slots available)
                                        </option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                Update Student
                            </button>
                            <a href="{{ route('admin.students.show', $student) }}" class="btn btn-outline-secondary">
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
                        <img src="{{ $student->avatar_url }}" 
                             class="rounded-circle me-3" 
                             width="50" height="50" 
                             alt="Student Avatar">
                        <div>
                            <h6 class="mb-0">{{ $student->name }}</h6>
                            <small class="text-muted">{{ $student->email }}</small>
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <strong>Current Grade:</strong> 
                        @if($student->grade)
                            {{ $student->grade->full_name }}
                        @else
                            <span class="text-muted">Not assigned</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <strong>NIS:</strong> {{ $student->nis ?? 'Not set' }}
                    </div>
                    <div class="mb-2">
                        <strong>Username:</strong> {{ $student->username ?? 'Not set' }}
                    </div>
                    <div class="mb-2">
                        <strong>Created:</strong> {{ $student->created_at->format('d M Y') }}
                    </div>
                </div>
            </div>

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
                            <li>Changing grade affects class enrollment</li>
                            <li>Leave password empty to keep current one</li>
                            <li>NIS should be unique if provided</li>
                        </ul>
                    </div>

                    <div class="mt-3">
                        <h6>Quick Actions</h6>
                        <div class="d-grid gap-2">
                            <form action="{{ route('admin.students.reset-password', $student) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-warning btn-sm w-100"
                                        onclick="return confirm('Reset password to default?')">
                                    <i class="bx bx-reset me-1"></i>Reset Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection