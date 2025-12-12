@extends('layouts.dashboard')

@section('title', 'Teacher Dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Teacher /</span> Dashboard
            </h4>
            <p class="text-muted">Welcome back, {{ auth()->user()->name }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('teacher.analytics') }}" class="btn btn-primary">
                <i class="bx bx-bar-chart-alt me-1"></i>
                View Analytics
            </a>
            <a href="{{ route('teacher.classes') }}" class="btn btn-outline-secondary">
                <i class="bx bx-group me-1"></i>
                Manage Classes
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">{{ $stats['total_classes'] }}</h5>
                            <small class="text-muted">Assigned Classes</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial bg-primary rounded">
                                <i class="bx bx-group"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">{{ $stats['total_students'] }}</h5>
                            <small class="text-muted">Total Students</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial bg-success rounded">
                                <i class="bx bx-user"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">{{ $stats['active_students'] }}</h5>
                            <small class="text-muted">Active This Week</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial bg-info rounded">
                                <i class="bx bx-trending-up"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">{{ number_format($stats['avg_completion_rate'], 1) }}%</h5>
                            <small class="text-muted">Avg. Completion Rate</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial bg-warning rounded">
                                <i class="bx bx-chart"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Assigned Classes -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">My Classes</h5>
                    <a href="{{ route('teacher.classes') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($assignedGrades->count() > 0)
                        <div class="row">
                            @foreach($assignedGrades as $grade)
                                <div class="col-md-6 mb-3">
                                    <div class="card border">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <h6 class="mb-1">{{ $grade->full_name }}</h6>
                                                    <small class="text-muted">{{ $grade->class_code }}</small>
                                                </div>
                                                <span class="badge bg-primary">{{ $grade->students_count }} Students</span>
                                            </div>
                                            <div class="progress mb-2" style="height: 6px;">
                                                @php
                                                    $occupancy = $grade->capacity > 0 ? ($grade->students_count / $grade->capacity) * 100 : 0;
                                                @endphp
                                                <div class="progress-bar" style="width: {{ $occupancy }}%"></div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">{{ $grade->students_count }}/{{ $grade->capacity }} capacity</small>
                                                <a href="{{ route('teacher.class-detail', $grade) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bx bx-show me-1"></i>View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bx bx-group text-muted display-4"></i>
                            <p class="text-muted mt-2">No classes assigned yet</p>
                            <small class="text-muted">Contact your administrator to get class assignments</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Student Activity</h5>
                </div>
                <div class="card-body">
                    @if($recentProgress->count() > 0)
                        @foreach($recentProgress->take(8) as $progress)
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar avatar-sm me-3">
                                    <img src="{{ $progress->user->avatar_url }}" alt="{{ $progress->user->name }}" class="rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fs-7">{{ $progress->user->name }}</h6>
                                    <small class="text-muted">{{ Str::limit($progress->learningMaterial->title, 25) }}</small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-{{ $progress->progress_bar_color }} fs-8">
                                        {{ $progress->status === 'completed' ? 'Done' : number_format($progress->progress_percentage, 0) . '%' }}
                                    </span>
                                    <div class="small text-muted">{{ $progress->updated_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        @endforeach
                        
                        @if($recentProgress->count() > 8)
                            <div class="text-center">
                                <a href="{{ route('teacher.analytics') }}" class="btn btn-sm btn-outline-secondary">
                                    View All Activity
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-3">
                            <i class="bx bx-time-five text-muted display-6"></i>
                            <p class="text-muted mt-2 mb-0">No recent activity</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Learning Materials Progress Overview -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Learning Materials Progress</h5>
        </div>
        <div class="card-body">
            @if($learningMaterials->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Material</th>
                                <th>Type</th>
                                <th class="text-center">Total Attempts</th>
                                <th class="text-center">Completed</th>
                                <th class="text-center">Completion Rate</th>
                                <th class="text-center">Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($learningMaterials as $material)
                                @php
                                    $completionRate = $material->total_attempts > 0 
                                        ? ($material->completed_attempts / $material->total_attempts) * 100 
                                        : 0;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">
                                                <span class="avatar-initial bg-label-primary rounded">
                                                    <i class="bx bx-book"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $material->title }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $material->type === 'evaluasi' ? 'danger' : ($material->type === 'latihan' ? 'warning' : 'info') }}">
                                            {{ ucfirst($material->type) }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $material->total_attempts }}</td>
                                    <td class="text-center">{{ $material->completed_attempts }}</td>
                                    <td class="text-center">{{ number_format($completionRate, 1) }}%</td>
                                    <td class="text-center">
                                        <div class="progress" style="height: 6px; width: 100px;">
                                            <div class="progress-bar" style="width: {{ $completionRate }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="bx bx-book text-muted display-4"></i>
                    <p class="text-muted mt-2">No learning materials available</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
.fs-7 {
    font-size: 0.875rem;
}
.fs-8 {
    font-size: 0.75rem;
}
.display-6 {
    font-size: 2rem;
}
.avatar-sm {
    width: 32px;
    height: 32px;
}
.avatar-sm img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
@endpush