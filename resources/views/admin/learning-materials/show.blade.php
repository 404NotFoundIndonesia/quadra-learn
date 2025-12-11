@extends('layouts.dashboard')

@section('title', $material->title)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Learning Materials /</span> 
                {{ $material->title }}
            </h4>
            <p class="text-muted">View learning material details</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.learning-materials.edit', $material) }}" class="btn btn-primary">
                <i class="bx bx-edit-alt me-1"></i>
                Edit
            </a>
            <a href="{{ route('admin.learning-materials.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i>
                Back
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Material Info -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Material Information</h5>
                    <div class="d-flex gap-2">
                        @if($material->is_published)
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                        <span class="badge bg-primary">{{ ucfirst($material->type) }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Title:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $material->title }}
                        </div>
                    </div>
                    @if($material->description)
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Description:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $material->description }}
                        </div>
                    </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Order:</strong>
                        </div>
                        <div class="col-sm-9">
                            <span class="badge bg-info">{{ $material->order }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Min Score:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $material->min_score }}%
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Created:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $material->created_at->format('d M Y H:i') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Last Updated:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $material->updated_at->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            @if($material->content)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Content</h5>
                </div>
                <div class="card-body">
                    <div class="content-preview">
                        {!! $material->content !!}
                    </div>
                </div>
            </div>
            @endif

            <!-- Questions -->
            @if($material->questions->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Questions ({{ $material->questions->count() }})</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Question</th>
                                    <th>Type</th>
                                    <th>Points</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($material->questions->sortBy('order') as $question)
                                    <tr>
                                        <td>
                                            <span class="badge bg-info">{{ $question->order }}</span>
                                        </td>
                                        <td>
                                            <div>
                                                {{ Str::limit(strip_tags($question->question), 80) }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $question->type === 'multiple_choice' ? 'success' : 'warning' }}">
                                                {{ $question->type === 'multiple_choice' ? 'Multiple Choice' : 'Free Text' }}
                                            </span>
                                        </td>
                                        <td>{{ $question->points }}</td>
                                        <td>
                                            <a href="{{ route('admin.questions.show', $question) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bx bx-show"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
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
                        <span>Total Questions:</span>
                        <span class="badge bg-success">{{ $material->questions->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Multiple Choice:</span>
                        <span class="badge bg-info">{{ $material->questions->where('type', 'multiple_choice')->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Free Text:</span>
                        <span class="badge bg-warning">{{ $material->questions->where('type', 'free_text')->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Total Points:</span>
                        <span class="badge bg-primary">{{ $material->questions->sum('points') }}</span>
                    </div>
                </div>
            </div>

            <!-- Attachments -->
            @if($material->attachments->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Attachments ({{ $material->attachments->count() }})</h5>
                </div>
                <div class="card-body">
                    @foreach($material->attachments as $attachment)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <i class="bx bx-file me-2"></i>
                                {{ $attachment->file_name }}
                            </div>
                            <a href="{{ Storage::url($attachment->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="bx bx-download"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.learning-materials.edit', $material) }}" class="btn btn-primary">
                            <i class="bx bx-edit-alt me-1"></i>
                            Edit Material
                        </a>
                        @if($material->type === 'latihan' || $material->type === 'evaluasi')
                        <a href="{{ route('admin.questions.create', ['learning_material_id' => $material->id]) }}" class="btn btn-success">
                            <i class="bx bx-plus me-1"></i>
                            Add Question
                        </a>
                        @endif
                        <form action="{{ route('admin.learning-materials.destroy', $material) }}" 
                              method="POST" 
                              onsubmit="return confirmSubmit(event, this)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bx bx-trash me-1"></i>
                                Delete Material
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
.content-preview {
    line-height: 1.6;
}

.content-preview h1, 
.content-preview h2, 
.content-preview h3 {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

.content-preview p {
    margin-bottom: 1rem;
}

.content-preview .math {
    display: inline-block;
    margin: 0 0.2rem;
}
</style>
@endpush

@push('script')
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script>
window.MathJax = {
    tex: {
        inlineMath: [['$', '$'], ['\\(', '\\)']],
        displayMath: [['$$', '$$'], ['\\[', '\\]']]
    },
    svg: {
        fontCache: 'global'
    }
};
</script>
@endpush