@extends('layouts.dashboard')

@section('title', 'Class Detail - ' . $grade->full_name)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Teacher / Classes /</span> {{ $grade->name }}
            </h4>
            <p class="text-muted">{{ $grade->level }} {{ $grade->specialization }} - {{ $grade->class_code }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('teacher.analytics') }}" class="btn btn-primary">
                <i class="bx bx-bar-chart-alt me-1"></i>
                Analytics
            </a>
            <a href="{{ route('teacher.classes') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i>
                Back to Classes
            </a>
        </div>
    </div>

    <!-- Class Overview -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar avatar-lg mx-auto mb-2">
                        <span class="avatar-initial bg-primary rounded-circle">
                            <i class="bx bx-group fs-2"></i>
                        </span>
                    </div>
                    <h5 class="mb-1">{{ $students->count() }}</h5>
                    <small class="text-muted">Total Students</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar avatar-lg mx-auto mb-2">
                        <span class="avatar-initial bg-success rounded-circle">
                            <i class="bx bx-check fs-2"></i>
                        </span>
                    </div>
                    @php
                        $activeStudents = $students->filter(function($student) {
                            return $student->studentProgress->where('updated_at', '>=', now()->subDays(7))->count() > 0;
                        })->count();
                    @endphp
                    <h5 class="mb-1">{{ $activeStudents }}</h5>
                    <small class="text-muted">Active This Week</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar avatar-lg mx-auto mb-2">
                        <span class="avatar-initial bg-info rounded-circle">
                            <i class="bx bx-book fs-2"></i>
                        </span>
                    </div>
                    <h5 class="mb-1">{{ $learningMaterials->count() }}</h5>
                    <small class="text-muted">Materials Available</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar avatar-lg mx-auto mb-2">
                        <span class="avatar-initial bg-warning rounded-circle">
                            <i class="bx bx-trending-up fs-2"></i>
                        </span>
                    </div>
                    @php
                        $avgScore = $students->map(function($student) {
                            return $student->studentProgress->where('status', 'completed')->avg('score') ?: 0;
                        })->filter()->avg() ?: 0;
                    @endphp
                    <h5 class="mb-1">{{ number_format($avgScore, 1) }}%</h5>
                    <small class="text-muted">Class Average</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Students List -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Students ({{ $students->count() }})</h5>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control form-control-sm" placeholder="Search students..." id="searchStudents" style="width: 200px;">
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($students->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Student</th>
                                        <th class="text-center">NIS</th>
                                        <th class="text-center">Progress</th>
                                        <th class="text-center">Avg. Score</th>
                                        <th class="text-center">Last Activity</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="studentsTableBody">
                                    @foreach($students as $student)
                                        @php
                                            $completedMaterials = $student->studentProgress->where('status', 'completed')->count();
                                            $totalMaterials = $learningMaterials->count();
                                            $progressPercent = $totalMaterials > 0 ? ($completedMaterials / $totalMaterials) * 100 : 0;
                                            $avgScore = $student->studentProgress->where('status', 'completed')->avg('score') ?: 0;
                                            $lastActivity = $student->studentProgress->sortByDesc('updated_at')->first();
                                        @endphp
                                        <tr class="student-row" data-student-name="{{ strtolower($student->name) }}" data-nis="{{ $student->nis }}">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-3">
                                                        <img src="{{ $student->avatar_url }}" alt="{{ $student->name }}" class="rounded-circle">
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $student->name }}</h6>
                                                        <small class="text-muted">{{ $student->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary">{{ $student->nis }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="progress mx-auto" style="width: 80px; height: 6px;">
                                                    <div class="progress-bar bg-{{ $progressPercent >= 75 ? 'success' : ($progressPercent >= 50 ? 'info' : ($progressPercent >= 25 ? 'warning' : 'secondary')) }}" 
                                                         style="width: {{ $progressPercent }}%"></div>
                                                </div>
                                                <small class="text-muted">{{ $completedMaterials }}/{{ $totalMaterials }}</small>
                                            </td>
                                            <td class="text-center">
                                                <span class="fw-medium text-{{ $avgScore >= 75 ? 'success' : ($avgScore >= 60 ? 'info' : ($avgScore >= 40 ? 'warning' : 'danger')) }}">
                                                    {{ number_format($avgScore, 1) }}%
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if($lastActivity)
                                                    <small class="text-muted">{{ $lastActivity->updated_at->diffForHumans() }}</small>
                                                @else
                                                    <small class="text-muted">No activity</small>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('teacher.student-progress', $student) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bx bx-user text-muted display-4"></i>
                            <p class="text-muted mt-2">No students in this class yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Learning Materials Progress -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Materials Progress</h5>
                </div>
                <div class="card-body">
                    @if($learningMaterials->count() > 0)
                        @foreach($learningMaterials as $material)
                            @php
                                $completionRate = $material->total_attempts > 0 
                                    ? ($material->completed_attempts / $material->total_attempts) * 100 
                                    : 0;
                            @endphp
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar avatar-sm me-3">
                                    <span class="avatar-initial bg-{{ $material->type === 'evaluasi' ? 'danger' : ($material->type === 'latihan' ? 'warning' : 'info') }} rounded">
                                        <i class="bx bx-book"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fs-7">{{ Str::limit($material->title, 20) }}</h6>
                                    <div class="progress mt-1" style="height: 4px;">
                                        <div class="progress-bar" style="width: {{ $completionRate }}%"></div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">{{ $material->completed_attempts }}/{{ $material->total_attempts }}</small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-3">
                            <i class="bx bx-book text-muted display-6"></i>
                            <p class="text-muted mt-2 mb-0">No materials available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Class Information -->
    @if($grade->description)
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Class Description</h5>
            </div>
            <div class="card-body">
                <p class="mb-0">{{ $grade->description }}</p>
            </div>
        </div>
    @endif
</div>
@endsection

@push('style')
<style>
.avatar-lg {
    width: 48px;
    height: 48px;
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
.fs-2 {
    font-size: 1.5rem;
}
.fs-7 {
    font-size: 0.875rem;
}
.display-6 {
    font-size: 2rem;
}
</style>
@endpush

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchStudents');
    const tableBody = document.getElementById('studentsTableBody');
    const studentRows = tableBody.querySelectorAll('.student-row');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        studentRows.forEach(row => {
            const studentName = row.dataset.studentName;
            const nis = row.dataset.nis;
            const matches = studentName.includes(searchTerm) || nis.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });
});
</script>
@endpush