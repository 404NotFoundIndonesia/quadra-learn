@extends('layouts.dashboard')

@section('title', $grade->full_name)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Grades /</span> 
                {{ $grade->full_name }}
            </h4>
            <p class="text-muted">Grade details and student management</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.grades.edit', $grade) }}" class="btn btn-primary">
                <i class="bx bx-edit-alt me-1"></i>
                Edit
            </a>
            <a href="{{ route('admin.grades.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i>
                Back
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Grade Information -->
        <div class="col-md-8">
            <!-- Grade Details Card -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Grade Information</h5>
                    <div class="d-flex gap-2">
                        @if($grade->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                        <span class="badge bg-info">{{ $grade->class_code }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong>Grade Name:</strong>
                                <p class="mb-0">{{ $grade->name }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Level:</strong>
                                <p class="mb-0">{{ $grade->level }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Specialization:</strong>
                                <p class="mb-0">{{ $grade->specialization ?? 'None' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong>Class Code:</strong>
                                <p class="mb-0">{{ $grade->class_code }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Capacity:</strong>
                                <p class="mb-0">{{ $grade->capacity }} students</p>
                            </div>
                            <div class="mb-3">
                                <strong>Available Slots:</strong>
                                <p class="mb-0">{{ $grade->available_slots }} slots</p>
                            </div>
                        </div>
                    </div>
                    @if($grade->description)
                    <div class="mt-3">
                        <strong>Description:</strong>
                        <p class="mb-0">{{ $grade->description }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Teacher Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Assigned Teacher</h5>
                </div>
                <div class="card-body">
                    @if($grade->teacher)
                        <div class="d-flex align-items-center">
                            <img src="{{ $grade->teacher->avatar_url }}" 
                                 class="rounded-circle me-3" 
                                 width="64" height="64" 
                                 alt="Teacher Avatar">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $grade->teacher->name }}</h6>
                                <p class="text-muted mb-1">{{ $grade->teacher->email }}</p>
                                <span class="badge bg-success">Teacher</span>
                            </div>
                            <div>
                                <button type="button" class="btn btn-outline-primary btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#changeTeacherModal">
                                    <i class="bx bx-edit-alt me-1"></i>Change
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="bx bx-user-x text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2 mb-3">No teacher assigned to this grade</p>
                            <button type="button" class="btn btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#assignTeacherModal">
                                <i class="bx bx-plus me-1"></i>Assign Teacher
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Students List -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Students ({{ $grade->students->count() }})</h5>
                    @if($grade->available_slots > 0)
                    <button type="button" class="btn btn-success btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#addStudentModal">
                        <i class="bx bx-plus me-1"></i>Add Student
                    </button>
                    @endif
                </div>
                <div class="card-body p-0">
                    @if($grade->students->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>NIS</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grade->students as $student)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $student->avatar_url }}" 
                                                         class="rounded-circle me-2" 
                                                         width="32" height="32" 
                                                         alt="Student Avatar">
                                                    <div>
                                                        <h6 class="mb-0">{{ $student->name }}</h6>
                                                        <small class="text-muted">Student</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $student->nis ?? '-' }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>
                                                <form action="{{ route('admin.grades.remove-student', [$grade, $student]) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirmSubmit(event, this)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bx bx-user-plus text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3 mb-0">No students assigned yet</p>
                            <button type="button" class="btn btn-primary mt-3" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#addStudentModal">
                                Add First Student
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Statistics -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Total Students:</span>
                        <span class="badge bg-success">{{ $grade->student_count }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Capacity:</span>
                        <span class="badge bg-primary">{{ $grade->capacity }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Available Slots:</span>
                        <span class="badge bg-info">{{ $grade->available_slots }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Utilization:</span>
                        <span class="badge bg-warning">{{ round(($grade->student_count / $grade->capacity) * 100) }}%</span>
                    </div>
                    
                    <div class="mt-3">
                        <div class="progress">
                            <div class="progress-bar" 
                                 style="width: {{ ($grade->student_count / $grade->capacity) * 100 }}%"
                                 aria-valuenow="{{ $grade->student_count }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="{{ $grade->capacity }}"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.grades.edit', $grade) }}" class="btn btn-primary">
                            <i class="bx bx-edit-alt me-1"></i>
                            Edit Grade
                        </a>
                        @if($grade->available_slots > 0)
                        <button type="button" class="btn btn-success" 
                                data-bs-toggle="modal" 
                                data-bs-target="#addStudentModal">
                            <i class="bx bx-plus me-1"></i>
                            Add Student
                        </button>
                        @endif
                        <form action="{{ route('admin.grades.destroy', $grade) }}" 
                              method="POST" 
                              onsubmit="return confirmSubmit(event, this)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bx bx-trash me-1"></i>
                                Delete Grade
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Student to {{ $grade->full_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.grades.assign-student', $grade) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Select Student</label>
                        <select class="form-select" id="student_id" name="student_id" required>
                            <option value="">Choose a student...</option>
                            @foreach(\App\Models\User::student()->withoutGrade()->get() as $student)
                                <option value="{{ $student->id }}">
                                    {{ $student->name }} ({{ $student->email }})
                                    @if($student->nis) - NIS: {{ $student->nis }} @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Student</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection