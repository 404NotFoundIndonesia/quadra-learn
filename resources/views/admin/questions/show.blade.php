@extends('layouts.dashboard')

@section('title', 'Question Details')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Questions /</span>
                Question #{{ $question->order }}
            </h4>
            <p class="text-muted">View question details</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.questions.edit', $question) }}" class="btn btn-primary">
                <i class="bx bx-edit-alt me-1"></i>
                Edit
            </a>
            <a href="{{ route('admin.questions.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i>
                Back
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Question Details -->
        <div class="col-md-8">
            <!-- Question Info -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Question Information</h5>
                    <div class="d-flex gap-2">
                        <span class="badge bg-{{ $question->type === 'multiple_choice' ? 'success' : 'warning' }}">
                            {{ $question->type === 'multiple_choice' ? 'Multiple Choice' : 'Free Text' }}
                        </span>
                        <span class="badge bg-info">Order: {{ $question->order }}</span>
                        <span class="badge bg-primary">{{ $question->points }} Points</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Learning Material:</strong>
                        </div>
                        <div class="col-sm-9">
                            <a href="{{ route('admin.learning-materials.show', $question->learningMaterial) }}" class="text-decoration-none">
                                {{ $question->learningMaterial->title }}
                                <span class="badge bg-primary ms-1">{{ ucfirst($question->learningMaterial->type) }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Question Type:</strong>
                        </div>
                        <div class="col-sm-9">
                            <span class="badge bg-{{ $question->type === 'multiple_choice' ? 'success' : 'warning' }}">
                                {{ $question->type === 'multiple_choice' ? 'Multiple Choice' : 'Free Text' }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Points:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $question->points }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Created:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $question->created_at->format('d M Y H:i') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Last Updated:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $question->updated_at->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question Content -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Question</h5>
                </div>
                <div class="card-body">
                    <div class="question-content">
                        {!! $question->question_text !!}
                    </div>
                </div>
            </div>

            <!-- Answer Options (for multiple choice) -->
            @if($question->type === 'multiple_choice' && $question->options)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Answer Options</h5>
                </div>
                <div class="card-body">
                    @foreach($question->options as $key => $option)
                        <div class="d-flex align-items-center mb-3 p-3 border rounded {{ $question->answer === $key ? 'border-success bg-light-success' : 'border-light' }}">
                            <div class="me-3">
                                <span class="badge bg-{{ $question->answer === $key ? 'success' : 'secondary' }}">
                                    {{ strtoupper($key) }}
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                {!! $option?->option_text ?? $option !!}
                            </div>
                            @if($question->answer === $key)
                                <div class="ms-2">
                                    <i class="bx bx-check-circle text-success" title="Correct Answer"></i>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Correct Answer (for free text) -->
            @if($question->type === 'free_text' && $question->answer)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Expected Answer</h5>
                </div>
                <div class="card-body">
                    <div class="answer-content">
                        {!! $question->answer !!}
                    </div>
                </div>
            </div>
            @endif

            <!-- Explanation -->
            @if($question->explanation)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Explanation</h5>
                </div>
                <div class="card-body">
                    <div class="explanation-content">
                        {!! $question->explanation !!}
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Quick Stats -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Stats</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Question Order:</span>
                        <span class="badge bg-info">{{ $question->order }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Points Worth:</span>
                        <span class="badge bg-primary">{{ $question->points }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Question Type:</span>
                        <span class="badge bg-{{ $question->type === 'multiple_choice' ? 'success' : 'warning' }}">
                            {{ $question->type === 'multiple_choice' ? 'MC' : 'FT' }}
                        </span>
                    </div>
                    @if($question->type === 'multiple_choice' && $question->options)
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Options Count:</span>
                        <span class="badge bg-secondary">{{ count($question->options) }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Related Material -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Related Material</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bx bx-book-content me-2 text-primary"></i>
                        <div>
                            <h6 class="mb-0">{{ $question->learningMaterial->title }}</h6>
                            <small class="text-muted">{{ ucfirst($question->learningMaterial->type) }}</small>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.learning-materials.show', $question->learningMaterial) }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="bx bx-show me-1"></i>
                            View Material
                        </a>
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
                        <a href="{{ route('admin.questions.edit', $question) }}" class="btn btn-primary">
                            <i class="bx bx-edit-alt me-1"></i>
                            Edit Question
                        </a>
                        <a href="{{ route('admin.questions.create', ['learning_material_id' => $question->learning_material_id]) }}" class="btn btn-success">
                            <i class="bx bx-plus me-1"></i>
                            Add Similar Question
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('admin.questions.destroy', $question) }}"
                              method="POST"
                              onsubmit="return confirmSubmit(event, this)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bx bx-trash me-1"></i>
                                Delete Question
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
.question-content,
.answer-content,
.explanation-content {
    line-height: 1.6;
}

.question-content h1,
.question-content h2,
.question-content h3,
.answer-content h1,
.answer-content h2,
.answer-content h3,
.explanation-content h1,
.explanation-content h2,
.explanation-content h3 {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

.question-content p,
.answer-content p,
.explanation-content p {
    margin-bottom: 1rem;
}

.math {
    display: inline-block;
    margin: 0 0.2rem;
}

.bg-light-success {
    background-color: rgba(40, 199, 111, 0.1) !important;
}

.border-success {
    border-color: #28c76f !important;
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
