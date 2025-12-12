@extends('layouts.dashboard')

@section('title', 'Student Progress - ' . $student->name)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Teacher / Students /</span> {{ $student->name }}
            </h4>
            <p class="text-muted">{{ $student->grade->full_name ?? 'No Class' }} - NIS: {{ $student->nis }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('teacher.class-detail', $student->grade) }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i>
                Back to Class
            </a>
        </div>
    </div>

    <!-- Student Overview -->
    <div class="row mb-4">
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar avatar-xl mx-auto mb-3">
                        <img src="{{ $student->avatar_url }}" alt="{{ $student->name }}" class="rounded-circle">
                    </div>
                    <h5 class="mb-1">{{ $student->name }}</h5>
                    <p class="text-muted mb-2">{{ $student->email }}</p>
                    <span class="badge bg-primary">{{ $student->nis }}</span>
                    @if($student->grade)
                        <p class="text-muted mt-2 mb-0">{{ $student->grade->full_name }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar avatar-lg mx-auto mb-2">
                                <span class="avatar-initial bg-primary rounded-circle">
                                    <i class="bx bx-book fs-4"></i>
                                </span>
                            </div>
                            <h5 class="mb-1">{{ $stats['completed_materials'] }}</h5>
                            <small class="text-muted">Completed</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar avatar-lg mx-auto mb-2">
                                <span class="avatar-initial bg-warning rounded-circle">
                                    <i class="bx bx-time fs-4"></i>
                                </span>
                            </div>
                            <h5 class="mb-1">{{ $stats['in_progress_materials'] }}</h5>
                            <small class="text-muted">In Progress</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar avatar-lg mx-auto mb-2">
                                <span class="avatar-initial bg-info rounded-circle">
                                    <i class="bx bx-target-lock fs-4"></i>
                                </span>
                            </div>
                            <h5 class="mb-1">{{ number_format($stats['average_score'], 1) }}%</h5>
                            <small class="text-muted">Avg. Score</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar avatar-lg mx-auto mb-2">
                                <span class="avatar-initial bg-success rounded-circle">
                                    <i class="bx bx-check-circle fs-4"></i>
                                </span>
                            </div>
                            @php
                                $completionRate = $stats['total_materials'] > 0 ? ($stats['completed_materials'] / $stats['total_materials']) * 100 : 0;
                            @endphp
                            <h5 class="mb-1">{{ number_format($completionRate, 1) }}%</h5>
                            <small class="text-muted">Overall Progress</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Details -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Learning Materials Progress</h5>
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm" id="statusFilter" style="width: auto;">
                    <option value="all">All Status</option>
                    <option value="completed">Completed</option>
                    <option value="in_progress">In Progress</option>
                    <option value="not_started">Not Started</option>
                </select>
                <select class="form-select form-select-sm" id="typeFilter" style="width: auto;">
                    <option value="all">All Types</option>
                    <option value="pendahuluan">Pendahuluan</option>
                    <option value="materi">Materi</option>
                    <option value="latihan">Latihan</option>
                    <option value="evaluasi">Evaluasi</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            @if($progress->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Material</th>
                                <th>Type</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Progress</th>
                                <th class="text-center">Score</th>
                                <th class="text-center">Started</th>
                                <th class="text-center">Completed</th>
                                <th class="text-center">Duration</th>
                            </tr>
                        </thead>
                        <tbody id="progressTableBody">
                            @foreach($progress as $item)
                                <tr data-status="{{ $item->status }}" data-type="{{ $item->learningMaterial->type }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-3">
                                                <span class="avatar-initial bg-{{ $item->learningMaterial->type === 'evaluasi' ? 'danger' : ($item->learningMaterial->type === 'latihan' ? 'warning' : 'info') }} rounded">
                                                    <i class="bx bx-book"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $item->learningMaterial->title }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $item->learningMaterial->type === 'evaluasi' ? 'danger' : ($item->learningMaterial->type === 'latihan' ? 'warning' : 'info') }}">
                                            {{ ucfirst($item->learningMaterial->type) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $item->progress_bar_color }}">
                                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="progress me-2" style="height: 6px; width: 60px;">
                                                <div class="progress-bar bg-{{ $item->progress_bar_color }}" 
                                                     style="width: {{ $item->progress_percentage }}%"></div>
                                            </div>
                                            <span class="fw-medium">{{ number_format($item->progress_percentage, 1) }}%</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($item->score > 0)
                                            <span class="fw-medium text-{{ $item->score >= 75 ? 'success' : ($item->score >= 60 ? 'info' : ($item->score >= 40 ? 'warning' : 'danger')) }}">
                                                {{ number_format($item->score, 1) }}%
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->started_at)
                                            <small class="text-muted">{{ $item->started_at->format('M j, Y') }}</small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->completed_at)
                                            <small class="text-muted">{{ $item->completed_at->format('M j, Y') }}</small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->started_at && $item->completed_at)
                                            @php
                                                $duration = $item->started_at->diffInHours($item->completed_at);
                                            @endphp
                                            <small class="text-muted">
                                                @if($duration < 24)
                                                    {{ $duration }}h
                                                @else
                                                    {{ round($duration / 24, 1) }}d
                                                @endif
                                            </small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="bx bx-chart text-muted display-4"></i>
                    <p class="text-muted mt-2">No progress data available</p>
                    <small class="text-muted">This student hasn't started any learning materials yet</small>
                </div>
            @endif
        </div>
    </div>

    <!-- Progress Timeline -->
    @if($progress->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Activity Timeline</h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    @foreach($progress->take(10) as $item)
                        <div class="timeline-item">
                            <div class="timeline-indicator">
                                <div class="avatar avatar-sm">
                                    <span class="avatar-initial bg-{{ $item->progress_bar_color }} rounded-circle">
                                        <i class="bx bx-{{ $item->status === 'completed' ? 'check' : ($item->status === 'in_progress' ? 'time' : 'play') }}"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="mb-1">{{ $item->learningMaterial->title }}</h6>
                                        <p class="mb-0 small text-muted">
                                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                            @if($item->score > 0)
                                                - Score: {{ number_format($item->score, 1) }}%
                                            @endif
                                        </p>
                                    </div>
                                    <small class="text-muted">{{ $item->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('style')
<style>
.avatar-xl {
    width: 64px;
    height: 64px;
}
.avatar-lg {
    width: 48px;
    height: 48px;
}
.avatar-sm {
    width: 32px;
    height: 32px;
}
.avatar-xl img, .avatar-lg img, .avatar-sm img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.fs-4 {
    font-size: 1.25rem;
}
.display-4 {
    font-size: 3rem;
}

.timeline {
    position: relative;
    padding-left: 2rem;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 1rem;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 1.5rem;
}

.timeline-indicator {
    position: absolute;
    left: -2rem;
    top: 0.25rem;
}

.timeline-content {
    background: #f8f9fa;
    border-radius: 0.375rem;
    padding: 1rem;
    border: 1px solid #e9ecef;
}
</style>
@endpush

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusFilter = document.getElementById('statusFilter');
    const typeFilter = document.getElementById('typeFilter');
    const tableBody = document.getElementById('progressTableBody');
    const tableRows = tableBody?.querySelectorAll('tr');

    function filterTable() {
        if (!tableRows) return;
        
        const statusValue = statusFilter.value;
        const typeValue = typeFilter.value;

        tableRows.forEach(row => {
            const rowStatus = row.dataset.status;
            const rowType = row.dataset.type;
            
            const statusMatch = statusValue === 'all' || rowStatus === statusValue;
            const typeMatch = typeValue === 'all' || rowType === typeValue;
            
            row.style.display = statusMatch && typeMatch ? '' : 'none';
        });
    }

    statusFilter?.addEventListener('change', filterTable);
    typeFilter?.addEventListener('change', filterTable);
});
</script>
@endpush