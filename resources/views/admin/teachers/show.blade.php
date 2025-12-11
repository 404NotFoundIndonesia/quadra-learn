@extends('layouts.dashboard')

@section('title', $teacher->name)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Teachers /</span> 
                {{ $teacher->name }}
            </h4>
            <p class="text-muted">Teacher details and grade assignments</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-primary">
                <i class="bx bx-edit-alt me-1"></i>
                Edit
            </a>
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i>
                Back
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Teacher Profile -->
        <div class="col-md-8">
            <!-- Basic Information -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Teacher Information</h5>
                    <span class="badge bg-warning">Teacher</span>
                </div>
                <div class="card-body">
                    <div class="row align-items-center mb-4">
                        <div class="col-auto">
                            <img src="{{ $teacher->avatar_url }}" 
                                 class="rounded-circle" 
                                 width="80" height="80" 
                                 alt="Teacher Avatar">
                        </div>
                        <div class="col">
                            <h4 class="mb-1">{{ $teacher->name }}</h4>
                            <p class="text-muted mb-1">{{ $teacher->email }}</p>
                            @if($teacher->username)
                                <p class="text-muted mb-0">@{{ $teacher->username }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong>Full Name:</strong>
                                <p class="mb-0">{{ $teacher->name }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Email:</strong>
                                <p class="mb-0">{{ $teacher->email }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Username:</strong>
                                <p class="mb-0">{{ $teacher->username ?? 'Not set' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong>Account Created:</strong>
                                <p class="mb-0">{{ $teacher->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Last Updated:</strong>
                                <p class="mb-0">{{ $teacher->updated_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Total Students:</strong>
                                <p class="mb-0">
                                    @php
                                        $totalStudents = $teacher->teachingGrades->sum(function($grade) {
                                            return $grade->students->count();
                                        });
                                    @endphp
                                    <span class="badge bg-success">{{ $totalStudents }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grade Assignments -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Grade Assignments</h5>
                    @if($teacher->teachingGrades->count() == 0)
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#assignGradeModal">
                        <i class="bx bx-plus me-1"></i>Assign Grade
                    </button>
                    @endif
                </div>
                <div class="card-body">
                    @if($teacher->teachingGrades->count() > 0)
                        @foreach($teacher->teachingGrades as $grade)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-2">{{ $grade->full_name }}</h6>
                                            <p class="text-muted mb-2">Class Code: {{ $grade->class_code }}</p>
                                            <div class="d-flex gap-2 mb-3">
                                                <span class="badge bg-primary">{{ $grade->level }}</span>
                                                @if($grade->specialization)
                                                    <span class="badge bg-info">{{ $grade->specialization }}</span>
                                                @endif
                                                <span class="badge bg-{{ $grade->is_active ? 'success' : 'secondary' }}">
                                                    {{ $grade->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </div>
                                            
                                            <!-- Students in this grade -->
                                            <div class="mb-3">
                                                <strong>Students ({{ $grade->students->count() }}/{{ $grade->capacity }}):</strong>
                                                <div class="progress mt-1" style="height: 6px;">
                                                    <div class="progress-bar" 
                                                         style="width: {{ ($grade->students->count() / $grade->capacity) * 100 }}%"></div>
                                                </div>
                                            </div>

                                            @if($grade->students->count() > 0)
                                                <div class="row">
                                                    @foreach($grade->students->take(6) as $student)
                                                        <div class="col-md-6 mb-1">
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{ $student->avatar_url }}" 
                                                                     class="rounded-circle me-2" 
                                                                     width="24" height="24" 
                                                                     alt="Student">
                                                                <small>{{ $student->name }}</small>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if($grade->students->count() > 6)
                                                    <small class="text-muted">
                                                        and {{ $grade->students->count() - 6 }} more students...
                                                    </small>
                                                @endif
                                            @else
                                                <p class="text-muted mb-0">No students assigned yet</p>
                                            @endif
                                        </div>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" 
                                                    data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.grades.show', $grade) }}">
                                                    <i class="bx bx-show me-1"></i> View Grade
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('admin.teachers.remove-grade', [$teacher, $grade]) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Remove teacher from this grade?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bx bx-x me-1"></i> Remove Assignment
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="bx bx-chalkboard text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3 mb-3">Teacher is not assigned to any grade</p>
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
                        <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-primary">
                            <i class="bx bx-edit-alt me-1"></i>
                            Edit Teacher
                        </a>
                        
                        @if($teacher->teachingGrades->count() == 0)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#assignGradeModal">
                                <i class="bx bx-plus me-1"></i>
                                Assign Grade
                            </button>
                        @endif

                        <form action="{{ route('admin.teachers.reset-password', $teacher) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-warning w-100"
                                    onclick="return confirm('Reset password to default?')">
                                <i class="bx bx-reset me-1"></i>
                                Reset Password
                            </button>
                        </form>

                        <div class="dropdown-divider"></div>
                        
                        <form action="{{ route('admin.teachers.destroy', $teacher) }}" 
                              method="POST" 
                              onsubmit="return confirmSubmit(event, this)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bx bx-trash me-1"></i>
                                Delete Teacher
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Teacher Statistics -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Assigned Grades:</span>
                        <span class="badge bg-primary">{{ $teacher->teachingGrades->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Total Students:</span>
                        <span class="badge bg-success">
                            @php
                                $totalStudents = $teacher->teachingGrades->sum(function($grade) {
                                    return $grade->students->count();
                                });
                            @endphp
                            {{ $totalStudents }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Account Age:</span>
                        <span class="badge bg-info">{{ $teacher->created_at->diffForHumans() }}</span>
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