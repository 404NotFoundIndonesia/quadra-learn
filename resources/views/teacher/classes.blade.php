@extends('layouts.dashboard')

@section('title', 'My Classes')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Teacher /</span> My Classes
            </h4>
            <p class="text-muted">Manage and view your assigned classes</p>
        </div>
        <div class="d-flex gap-2"></div>
    </div>

    @if($assignedGrades->count() > 0)
        <div class="row">
            @foreach($assignedGrades as $grade)
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-0">{{ $grade->name }}</h5>
                                <small class="text-muted">{{ $grade->level }} {{ $grade->specialization }}</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="classActions{{ $grade->id }}" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('teacher.class-detail', $grade) }}">
                                        <i class="bx bx-show me-2"></i>View Details</a></li>
                                    <li><a class="dropdown-item" href="{{ route('teacher.analytics') }}">
                                        <i class="bx bx-bar-chart-alt me-2"></i>View Analytics</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Class Info -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted small">Class Code:</span>
                                    <span class="badge bg-primary">{{ $grade->class_code }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted small">Students:</span>
                                    <span class="fw-medium">{{ $grade->students_count }}/{{ $grade->capacity }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted small">Status:</span>
                                    <span class="badge bg-{{ $grade->is_active ? 'success' : 'secondary' }}">
                                        {{ $grade->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Capacity Progress -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <small class="text-muted">Class Capacity</small>
                                    @php
                                        $occupancy = $grade->capacity > 0 ? ($grade->students_count / $grade->capacity) * 100 : 0;
                                    @endphp
                                    <small class="text-muted">{{ number_format($occupancy, 1) }}%</small>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-{{ $occupancy > 90 ? 'danger' : ($occupancy > 75 ? 'warning' : 'primary') }}"
                                         style="width: {{ $occupancy }}%"></div>
                                </div>
                            </div>

                            <!-- Recent Students -->
                            @if($grade->students->count() > 0)
                                <div class="mb-3">
                                    <h6 class="small text-muted mb-2">Recent Students</h6>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($grade->students->take(6) as $student)
                                            <div class="avatar avatar-xs" title="{{ $student->name }}">
                                                <img src="{{ $student->avatar_url }}" alt="{{ $student->name }}" class="rounded-circle">
                                            </div>
                                        @endforeach
                                        @if($grade->students->count() > 6)
                                            <div class="avatar avatar-xs">
                                                <span class="avatar-initial bg-light text-muted rounded-circle small">
                                                    +{{ $grade->students->count() - 6 }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Description -->
                            @if($grade->description)
                                <div class="mb-3">
                                    <h6 class="small text-muted mb-1">Description</h6>
                                    <p class="small mb-0">{{ Str::limit($grade->description, 80) }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer d-grid">
                            <a href="{{ route('teacher.class-detail', $grade) }}" class="btn btn-primary">
                                <i class="bx bx-group me-1"></i>
                                Manage Class
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="card">
            <div class="card-body text-center py-5">
                <div class="mb-3">
                    <i class="bx bx-group text-muted" style="font-size: 4rem;"></i>
                </div>
                <h5 class="mb-2">No Classes Assigned</h5>
                <p class="text-muted mb-4">You don't have any classes assigned to you yet.</p>
                <div class="alert alert-info" role="alert">
                    <i class="bx bx-info-circle me-2"></i>
                    Contact your administrator to get class assignments. Once assigned, you'll be able to manage students and track their progress here.
                </div>
                <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline-primary">
                    <i class="bx bx-arrow-back me-1"></i>
                    Back to Dashboard
                </a>
            </div>
        </div>
    @endif
</div>
@endsection

@push('style')
<style>
.avatar-xs {
    width: 24px;
    height: 24px;
    font-size: 0.75rem;
}
.avatar-xs img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
@endpush
