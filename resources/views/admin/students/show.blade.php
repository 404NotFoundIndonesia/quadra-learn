@extends('layouts.dashboard')

@section('title', $student->name)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Students /</span> 
                {{ $student->name }}
            </h4>
            <p class="text-muted">Student details and information</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-primary">
                <i class="bx bx-edit-alt me-1"></i>
                Edit
            </a>
            <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i>
                Back
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Student Profile -->
        <div class="col-md-8">
            <!-- Basic Information -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Student Information</h5>
                    <span class="badge bg-success">Student</span>
                </div>
                <div class="card-body">
                    <div class="row align-items-center mb-4">
                        <div class="col-auto">
                            <img src="{{ $student->avatar_url }}" 
                                 class="rounded-circle" 
                                 width="80" height="80" 
                                 alt="Student Avatar">
                        </div>
                        <div class="col">
                            <h4 class="mb-1">{{ $student->name }}</h4>
                            <p class="text-muted mb-1">{{ $student->email }}</p>
                            @if($student->username)
                                <p class="text-muted mb-0">@{{ $student->username }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong>Full Name:</strong>
                                <p class="mb-0">{{ $student->name }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Email:</strong>
                                <p class="mb-0">{{ $student->email }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Username:</strong>
                                <p class="mb-0">{{ $student->username ?? 'Not set' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong>NIS:</strong>
                                <p class="mb-0">
                                    @if($student->nis)
                                        <span class="badge bg-info">{{ $student->nis }}</span>
                                    @else
                                        <span class="text-muted">Not assigned</span>
                                    @endif
                                </p>
                            </div>
                            <div class="mb-3">
                                <strong>Account Created:</strong>
                                <p class="mb-0">{{ $student->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Last Updated:</strong>
                                <p class="mb-0">{{ $student->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grade Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Grade Assignment</h5>
                </div>
                <div class="card-body">
                    @if($student->grade)
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bx bx-chalkboard me-3 text-primary" style="font-size: 2rem;"></i>
                                <div>
                                    <h6 class="mb-1">{{ $student->grade->full_name }}</h6>
                                    <p class="text-muted mb-0">
                                        Class Code: {{ $student->grade->class_code }}
                                    </p>
                                    @if($student->grade->teacher)
                                        <p class="text-muted mb-0">
                                            Teacher: {{ $student->grade->teacher->name }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary">{{ $student->grade->level }}</span>
                                @if($student->grade->specialization)
                                    <span class="badge bg-info">{{ $student->grade->specialization }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-3">
                            <small class="text-muted">
                                <strong>Capacity:</strong> {{ $student->grade->student_count }}/{{ $student->grade->capacity }} students
                            </small>
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="bx bx-user-x text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3 mb-3">Student is not assigned to any grade</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignGradeModal">
                                <i class="bx bx-plus me-1"></i>Assign to Grade
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-primary">
                            <i class="bx bx-edit-alt me-1"></i>
                            Edit Student
                        </a>
                        
                        @if($student->grade)
                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#changeGradeModal">
                                <i class="bx bx-transfer-alt me-1"></i>
                                Change Grade
                            </button>
                        @else
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#assignGradeModal">
                                <i class="bx bx-plus me-1"></i>
                                Assign Grade
                            </button>
                        @endif

                        <form action="{{ route('admin.students.reset-password', $student) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-warning w-100"
                                    onclick="return confirm('Reset password to default?')">
                                <i class="bx bx-reset me-1"></i>
                                Reset Password
                            </button>
                        </form>

                        <div class="dropdown-divider"></div>
                        
                        <form action="{{ route('admin.students.destroy', $student) }}" 
                              method="POST" 
                              onsubmit="return confirmSubmit(event, this)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bx bx-trash me-1"></i>
                                Delete Student
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Grade Statistics -->
            @if($student->grade)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Grade Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Total Students:</span>
                        <span class="badge bg-success">{{ $student->grade->student_count }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Capacity:</span>
                        <span class="badge bg-primary">{{ $student->grade->capacity }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Available Slots:</span>
                        <span class="badge bg-info">{{ $student->grade->available_slots }}</span>
                    </div>
                    
                    <div class="mt-3">
                        <div class="progress">
                            <div class="progress-bar" 
                                 style="width: {{ ($student->grade->student_count / $student->grade->capacity) * 100 }}%"
                                 aria-valuenow="{{ $student->grade->student_count }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="{{ $student->grade->capacity }}"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Assign/Change Grade Modal -->
<div class="modal fade" id="{{ $student->grade ? 'changeGradeModal' : 'assignGradeModal' }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $student->grade ? 'Change' : 'Assign' }} Grade for {{ $student->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.students.update', $student) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="name" value="{{ $student->name }}">
                <input type="hidden" name="email" value="{{ $student->email }}">
                <input type="hidden" name="username" value="{{ $student->username }}">
                <input type="hidden" name="nis" value="{{ $student->nis }}">
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="grade_id" class="form-label">Select Grade</label>
                        <select class="form-select" id="grade_id" name="grade_id">
                            <option value="">Remove from current grade</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}" 
                                        {{ $student->grade_id == $grade->id ? 'selected' : '' }}>
                                    {{ $grade->full_name }} 
                                    ({{ $grade->available_slots + ($student->grade_id == $grade->id ? 1 : 0) }} slots available)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    @if($student->grade)
                    <div class="alert alert-info">
                        <strong>Current Grade:</strong> {{ $student->grade->full_name }}
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">{{ $student->grade ? 'Change' : 'Assign' }} Grade</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection