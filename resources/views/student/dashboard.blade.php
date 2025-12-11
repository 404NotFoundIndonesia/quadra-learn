@extends('layouts.dashboard')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="text-white mb-2">Selamat Datang, {{ Auth::user()->name }}!</h4>
                            <p class="text-white-50 mb-0">Siap untuk belajar tentang fungsi kuadrat hari ini?</p>
                        </div>
                        <div class="text-end">
                            <i class="bx bx-book-open" style="font-size: 3rem; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Overview -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-muted">Total Materi</h6>
                            <h4 class="mb-1">{{ $totalMaterials }}</h4>
                            <small class="text-muted">Materi tersedia</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial bg-label-primary rounded">
                                <i class="bx bx-book"></i>
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
                        <div>
                            <h6 class="card-title text-muted">Selesai</h6>
                            <h4 class="mb-1 text-success">{{ $completedMaterials }}</h4>
                            <small class="text-muted">Materi diselesaikan</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial bg-label-success rounded">
                                <i class="bx bx-check-circle"></i>
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
                        <div>
                            <h6 class="card-title text-muted">Berlangsung</h6>
                            <h4 class="mb-1 text-warning">{{ $inProgressMaterials }}</h4>
                            <small class="text-muted">Sedang dipelajari</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial bg-label-warning rounded">
                                <i class="bx bx-time"></i>
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
                        <div>
                            <h6 class="card-title text-muted">Progress Keseluruhan</h6>
                            <h4 class="mb-1">{{ number_format($overallProgress, 0) }}%</h4>
                            <small class="text-muted">Dari semua materi</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial bg-label-info rounded">
                                <i class="bx bx-trending-up"></i>
                            </span>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $overallProgress }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Learning Materials -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Materi Pembelajaran</h5>
            <small class="text-muted">Klik untuk mulai belajar</small>
        </div>
        <div class="card-body">
            @if($learningMaterials->isEmpty())
                <div class="text-center py-5">
                    <i class="bx bx-book-open text-muted" style="font-size: 4rem;"></i>
                    <p class="text-muted mt-3">Belum ada materi pembelajaran tersedia.</p>
                </div>
            @else
                <div class="row">
                    @foreach($learningMaterials as $material)
                        <div class="col-lg-6 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <span class="badge bg-label-{{ $material->type === 'lesson' ? 'primary' : ($material->type === 'practice' ? 'warning' : 'success') }}">
                                                {{ ucfirst($material->type) }}
                                            </span>
                                        </div>
                                        @if($material->progress)
                                            <span class="badge bg-label-{{ $material->progress->progress_bar_color }}">
                                                @if($material->progress->isCompleted())
                                                    <i class="bx bx-check me-1"></i>Selesai
                                                @elseif($material->progress->isInProgress())
                                                    <i class="bx bx-time me-1"></i>Berlangsung
                                                @else
                                                    <i class="bx bx-play me-1"></i>Belum Mulai
                                                @endif
                                            </span>
                                        @else
                                            <span class="badge bg-label-secondary">
                                                <i class="bx bx-play me-1"></i>Belum Mulai
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <h5 class="card-title">{{ $material->title }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($material->description, 100) }}</p>
                                    
                                    @if($material->progress)
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <small class="text-muted">Progress</small>
                                                <small class="text-muted">{{ number_format($material->progress->progress_percentage, 0) }}%</small>
                                            </div>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-{{ $material->progress->progress_bar_color }}" 
                                                     role="progressbar" 
                                                     style="width: {{ $material->progress->progress_percentage }}%"></div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <small class="text-muted">
                                                        <i class="bx bx-question-mark me-1"></i>
                                                        {{ $material->progress->answered_questions }}/{{ $material->progress->total_questions }} soal
                                                    </small>
                                                </div>
                                                @if($material->progress->score)
                                                    <div class="col-6 text-end">
                                                        <small class="text-success">
                                                            <i class="bx bx-trophy me-1"></i>
                                                            {{ number_format($material->progress->score, 0) }} poin
                                                        </small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="mb-3">
                                            <small class="text-muted">
                                                <i class="bx bx-question-mark me-1"></i>
                                                {{ $material->questions_count }} soal tersedia
                                            </small>
                                        </div>
                                    @endif
                                    
                                    <a href="{{ route('student.learning-materials.show', $material) }}" 
                                       class="btn btn-primary w-100">
                                        @if($material->progress && $material->progress->isInProgress())
                                            <i class="bx bx-play-circle me-1"></i>Lanjutkan Belajar
                                        @elseif($material->progress && $material->progress->isCompleted())
                                            <i class="bx bx-refresh me-1"></i>Review Materi
                                        @else
                                            <i class="bx bx-book-reader me-1"></i>Mulai Belajar
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@push('script')
<script>
// Auto refresh progress every 5 minutes
setInterval(function() {
    window.location.reload();
}, 300000);
</script>
@endpush
@endsection