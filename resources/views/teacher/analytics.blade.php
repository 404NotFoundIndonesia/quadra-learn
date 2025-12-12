@extends('layouts.dashboard')

@section('title', 'Analytics')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Teacher /</span> Analytics
            </h4>
            <p class="text-muted">Detailed insights into your students' performance</p>
        </div>
        <div class="d-flex gap-2">
            <select class="form-select" id="timeRange" style="width: auto;">
                <option value="week">This Week</option>
                <option value="month" selected>This Month</option>
                <option value="quarter">This Quarter</option>
            </select>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text">Total Classes</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">{{ $assignedGrades->count() }}</h4>
                            </div>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="bx bx-group bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text">Total Students</p>
                            <div class="d-flex align-items-end mb-2">
                                @php
                                    $totalStudents = $classStats->sum(function($stat) { return $stat['grade']->students->count(); });
                                @endphp
                                <h4 class="card-title mb-0 me-2">{{ $totalStudents }}</h4>
                            </div>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-success rounded p-2">
                                <i class="bx bx-user bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text">Avg. Class Score</p>
                            <div class="d-flex align-items-end mb-2">
                                @php
                                    $avgClassScore = $classStats->avg('avg_score');
                                @endphp
                                <h4 class="card-title mb-0 me-2">{{ number_format($avgClassScore, 1) }}%</h4>
                            </div>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-info rounded p-2">
                                <i class="bx bx-trending-up bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text">Active Students</p>
                            <div class="d-flex align-items-end mb-2">
                                @php
                                    $activeStudents = $classStats->sum('active_students');
                                @endphp
                                <h4 class="card-title mb-0 me-2">{{ $activeStudents }}</h4>
                                <small class="text-success fw-medium">
                                    {{ $totalStudents > 0 ? number_format(($activeStudents / $totalStudents) * 100, 1) : 0 }}%
                                </small>
                            </div>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-warning rounded p-2">
                                <i class="bx bx-time-five bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Weekly Progress Chart -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Student Activity Trends</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bx bx-calendar me-1"></i> Last 4 Weeks
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="weeklyProgressChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Class Performance Comparison -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Class Performance</h5>
                </div>
                <div class="card-body">
                    @foreach($classStats as $stat)
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-sm me-3">
                                <span class="avatar-initial bg-primary rounded">
                                    {{ substr($stat['grade']->name, 0, 2) }}
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $stat['grade']->name }}</h6>
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" style="width: {{ $stat['avg_score'] }}%"></div>
                                </div>
                                <small class="text-muted">{{ $stat['grade']->students->count() }} students</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-{{ $stat['avg_score'] >= 75 ? 'success' : ($stat['avg_score'] >= 60 ? 'info' : 'warning') }}">
                                    {{ number_format($stat['avg_score'], 1) }}%
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Materials Analytics -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Learning Materials Performance</h5>
            <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="materialFilter" id="allMaterials" autocomplete="off" checked>
                <label class="btn btn-sm btn-outline-primary" for="allMaterials">All</label>

                <input type="radio" class="btn-check" name="materialFilter" id="evaluasiMaterials" autocomplete="off">
                <label class="btn btn-sm btn-outline-primary" for="evaluasiMaterials">Evaluasi</label>

                <input type="radio" class="btn-check" name="materialFilter" id="latihanMaterials" autocomplete="off">
                <label class="btn btn-sm btn-outline-primary" for="latihanMaterials">Latihan</label>

                <input type="radio" class="btn-check" name="materialFilter" id="materiMaterials" autocomplete="off">
                <label class="btn btn-sm btn-outline-primary" for="materiMaterials">Materi</label>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Material</th>
                            <th>Type</th>
                            <th class="text-center">Attempts</th>
                            <th class="text-center">Completed</th>
                            <th class="text-center">Completion Rate</th>
                            <th class="text-center">Performance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materialAnalytics as $material)
                            <tr data-type="{{ $material->type }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3">
                                            <span class="avatar-initial bg-{{ $material->type === 'evaluasi' ? 'danger' : ($material->type === 'latihan' ? 'warning' : 'info') }} rounded">
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
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="progress me-2" style="height: 6px; width: 60px;">
                                            <div class="progress-bar" style="width: {{ $material->completion_rate }}%"></div>
                                        </div>
                                        <span class="fw-medium">{{ number_format($material->completion_rate, 1) }}%</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($material->completion_rate >= 80)
                                        <span class="badge bg-success">Excellent</span>
                                    @elseif($material->completion_rate >= 60)
                                        <span class="badge bg-info">Good</span>
                                    @elseif($material->completion_rate >= 40)
                                        <span class="badge bg-warning">Fair</span>
                                    @else
                                        <span class="badge bg-danger">Needs Attention</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Detailed Class Analytics -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Detailed Class Statistics</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($classStats as $stat)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h6 class="mb-1">{{ $stat['grade']->full_name }}</h6>
                                        <small class="text-muted">{{ $stat['grade']->class_code }}</small>
                                    </div>
                                    <span class="badge bg-primary">{{ $stat['grade']->students->count() }} students</span>
                                </div>

                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="d-flex flex-column">
                                            <small class="text-muted">Avg. Score</small>
                                            <span class="fw-bold text-{{ $stat['avg_score'] >= 75 ? 'success' : ($stat['avg_score'] >= 60 ? 'info' : 'warning') }}">
                                                {{ number_format($stat['avg_score'], 1) }}%
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex flex-column">
                                            <small class="text-muted">Completions</small>
                                            <span class="fw-bold">{{ $stat['completion_count'] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex flex-column">
                                            <small class="text-muted">Active</small>
                                            <span class="fw-bold text-success">{{ $stat['active_students'] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('teacher.class-detail', $stat['grade']) }}" class="btn btn-outline-primary btn-sm w-100">
                                        <i class="bx bx-show me-1"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Weekly Progress Chart
    const ctx = document.getElementById('weeklyProgressChart').getContext('2d');
    const weeklyData = @json($weeklyProgress);

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: weeklyData.map(item => {
                const date = new Date(item.date);
                return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
            }),
            datasets: [{
                label: 'Activities',
                data: weeklyData.map(item => item.activities),
                borderColor: '#696cff',
                backgroundColor: 'rgba(105, 108, 255, 0.1)',
                tension: 0.4,
                yAxisID: 'y'
            }, {
                label: 'Avg Score',
                data: weeklyData.map(item => item.avg_score),
                borderColor: '#71dd37',
                backgroundColor: 'rgba(113, 221, 55, 0.1)',
                tension: 0.4,
                yAxisID: 'y1'
            }]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Activities'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Average Score (%)'
                    },
                    grid: {
                        drawOnChartArea: false,
                    },
                }
            }
        }
    });

    // Material filter functionality
    const filterButtons = document.querySelectorAll('input[name="materialFilter"]');
    const tableRows = document.querySelectorAll('tbody tr[data-type]');

    filterButtons.forEach(button => {
        button.addEventListener('change', function() {
            const filterType = this.id.replace('Materials', '').replace('all', '');

            tableRows.forEach(row => {
                if (filterType === '' || row.dataset.type === filterType) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush
