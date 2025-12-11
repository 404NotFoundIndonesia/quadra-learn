@extends('layouts.dashboard')

@section('title', 'Grades Management')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin /</span> Grades Management
            </h4>
            <p class="text-muted">Manage classes and assign teachers</p>
        </div>
        <a href="{{ route('admin.grades.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>
            Add Grade
        </a>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search grades..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Level</label>
                    <select name="level" class="form-select">
                        <option value="">All Levels</option>
                        <option value="X" {{ request('level') === 'X' ? 'selected' : '' }}>X</option>
                        <option value="XI" {{ request('level') === 'XI' ? 'selected' : '' }}>XI</option>
                        <option value="XII" {{ request('level') === 'XII' ? 'selected' : '' }}>XII</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Teacher Status</label>
                    <select name="has_teacher" class="form-select">
                        <option value="">All</option>
                        <option value="1" {{ request('has_teacher') === '1' ? 'selected' : '' }}>With Teacher</option>
                        <option value="0" {{ request('has_teacher') === '0' ? 'selected' : '' }}>Without Teacher</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bx bx-search me-1"></i>Filter
                        </button>
                        <a href="{{ route('admin.grades.index') }}" class="btn btn-outline-secondary">
                            Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Grades List -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Grades ({{ $grades->total() }})</h5>
        </div>
        <div class="card-body p-0">
            @if($grades->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Grade</th>
                                <th>Class Code</th>
                                <th>Teacher</th>
                                <th>Students</th>
                                <th>Capacity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grades as $grade)
                                <tr>
                                    <td>
                                        <div>
                                            <h6 class="mb-0">{{ $grade->name }}</h6>
                                            <small class="text-muted">
                                                {{ $grade->level }}
                                                @if($grade->specialization)
                                                    - {{ $grade->specialization }}
                                                @endif
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $grade->class_code }}</span>
                                    </td>
                                    <td>
                                        @if($grade->teacher)
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $grade->teacher->avatar_url }}" 
                                                     class="rounded-circle me-2" 
                                                     width="32" height="32" alt="Teacher">
                                                <div>
                                                    <h6 class="mb-0">{{ $grade->teacher->name }}</h6>
                                                    <small class="text-muted">{{ $grade->teacher->email }}</small>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">Not assigned</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{ $grade->student_count }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">{{ $grade->capacity }}</span>
                                            <div class="progress" style="width: 100px; height: 6px;">
                                                <div class="progress-bar" 
                                                     style="width: {{ ($grade->student_count / $grade->capacity) * 100 }}%"
                                                     aria-valuenow="{{ $grade->student_count }}" 
                                                     aria-valuemin="0" 
                                                     aria-valuemax="{{ $grade->capacity }}"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($grade->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" 
                                                    data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.grades.show', $grade) }}">
                                                    <i class="bx bx-show me-1"></i> View
                                                </a>
                                                <a class="dropdown-item" href="{{ route('admin.grades.edit', $grade) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('admin.grades.destroy', $grade) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirmSubmit(event, this)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer">
                    {{ $grades->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bx bx-chalkboard" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3 mb-0">No grades found</p>
                    <a href="{{ route('admin.grades.create') }}" class="btn btn-primary mt-3">
                        Create First Grade
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection