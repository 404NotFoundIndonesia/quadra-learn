@extends('layouts.dashboard')

@section('title', 'Create Student')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Students /</span> Create
            </h4>
            <p class="text-muted">Add a new student to the system</p>
        </div>
        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">
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
                    <form action="{{ route('admin.students.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
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
                                       value="{{ old('email') }}"
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
                                       value="{{ old('username') }}"
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
                                       value="{{ old('nis') }}"
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
                                        <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                                            {{ $grade->full_name }} ({{ $grade->available_slots }} slots available)
                                        </option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Leave empty for default password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Default: "{{ \App\Models\User::DEFAULT_PASSWORD }}"</div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i>
                                Create Student
                            </button>
                            <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Guidelines</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6 class="alert-heading">Creating Students</h6>
                        <ul class="mb-0">
                            <li><strong>Email:</strong> Must be unique and valid</li>
                            <li><strong>Username:</strong> Optional, leave empty to use email</li>
                            <li><strong>NIS:</strong> Student ID number, should be unique</li>
                            <li><strong>Password:</strong> Leave empty for default password</li>
                            <li><strong>Grade:</strong> Can be assigned later if needed</li>
                        </ul>
                    </div>

                    <div class="mt-3">
                        <h6>Default Credentials</h6>
                        <div class="small">
                            <div class="mb-2">
                                <strong>Login:</strong> Email address or username
                            </div>
                            <div class="mb-2">
                                <strong>Default Password:</strong> {{ \App\Models\User::DEFAULT_PASSWORD }}
                            </div>
                            <div class="text-muted">
                                Students should change their password on first login.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Grades -->
            @if($grades->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Available Grades</h5>
                </div>
                <div class="card-body">
                    @foreach($grades as $grade)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>{{ $grade->full_name }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ $grade->student_count }}/{{ $grade->capacity }} students
                                </small>
                            </div>
                            <span class="badge bg-{{ $grade->available_slots > 0 ? 'success' : 'danger' }}">
                                {{ $grade->available_slots }} slots
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameField = document.getElementById('name');
    const emailField = document.getElementById('email');
    const usernameField = document.getElementById('username');

    // Auto-generate email from name
    nameField.addEventListener('input', function() {
        if (!emailField.value) {
            const name = this.value.toLowerCase()
                          .replace(/\s+/g, '.')
                          .replace(/[^a-z0-9.]/g, '');
            if (name) {
                emailField.value = name + '@student.quadralearn.com';
            }
        }
    });

    // Auto-generate username from email
    emailField.addEventListener('input', function() {
        if (!usernameField.value) {
            const email = this.value;
            const username = email.split('@')[0];
            if (username) {
                usernameField.value = username;
            }
        }
    });
});
</script>
@endpush