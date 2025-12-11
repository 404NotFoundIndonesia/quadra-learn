@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin /</span> Dashboard
    </h4>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-book-content"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Materials</span>
                    <h3 class="card-title mb-2">{{ $stats['total_materials'] }}</h3>
                    <small class="text-success fw-semibold">
                        {{ $stats['published_materials'] }} Published
                    </small>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-help-circle"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Questions</span>
                    <h3 class="card-title mb-2">{{ $stats['total_questions'] }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-user"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Students</span>
                    <h3 class="card-title mb-2">{{ $stats['total_students'] }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-user-check"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Teachers</span>
                    <h3 class="card-title mb-2">{{ $stats['total_teachers'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.learning-materials.create') }}" class="btn btn-primary w-100">
                                <i class="bx bx-plus me-1"></i>
                                Add Learning Material
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.questions.create') }}" class="btn btn-info w-100">
                                <i class="bx bx-plus me-1"></i>
                                Add Question
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.learning-materials.index') }}" class="btn btn-outline-primary w-100">
                                <i class="bx bx-list-ul me-1"></i>
                                Manage Materials
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.questions.index') }}" class="btn btn-outline-info w-100">
                                <i class="bx bx-list-ul me-1"></i>
                                Manage Questions
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Recent Materials</h5>
                    <a href="{{ route('admin.learning-materials.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($recent_materials->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recent_materials as $material)
                                <div class="list-group-item d-flex justify-content-between align-items-start px-0">
                                    <div>
                                        <h6 class="mb-1">{{ $material->title }}</h6>
                                        <small class="text-muted">
                                            {{ ucfirst($material->type) }} • 
                                            {{ $material->is_published ? 'Published' : 'Draft' }}
                                        </small>
                                    </div>
                                    <span class="badge bg-{{ $material->is_published ? 'success' : 'secondary' }} rounded-pill">
                                        {{ $material->questions_count ?? 0 }} Q
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No materials created yet.</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Recent Questions</h5>
                    <a href="{{ route('admin.questions.index') }}" class="btn btn-sm btn-outline-info">View All</a>
                </div>
                <div class="card-body">
                    @if($recent_questions->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recent_questions as $question)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">
                                                {{ Str::limit($question->question_text, 50) }}
                                            </h6>
                                            <small class="text-muted">
                                                {{ $question->learningMaterial->title }} • 
                                                {{ ucfirst(str_replace('_', ' ', $question->type)) }}
                                            </small>
                                        </div>
                                        <span class="badge bg-{{ $question->is_active ? 'success' : 'secondary' }} rounded-pill">
                                            {{ $question->points }}pt
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No questions created yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection