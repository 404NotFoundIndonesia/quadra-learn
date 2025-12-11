@extends('layouts.dashboard')

@section('title', $learningMaterial->title)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $learningMaterial->title }}</li>
                </ol>
            </nav>
            <h4 class="fw-bold mb-2">{{ $learningMaterial->title }}</h4>
            <p class="text-muted mb-0">{{ $learningMaterial->description }}</p>
        </div>
        <div class="text-end">
            <span class="badge bg-label-{{ $learningMaterial->type === 'lesson' ? 'primary' : ($learningMaterial->type === 'practice' ? 'warning' : 'success') }} mb-2">
                {{ ucfirst($learningMaterial->type) }}
            </span>
            <br>
            @if($progress->isCompleted())
                <span class="badge bg-label-success">
                    <i class="bx bx-check me-1"></i>Selesai
                </span>
            @elseif($progress->isInProgress())
                <span class="badge bg-label-warning">
                    <i class="bx bx-time me-1"></i>Berlangsung
                </span>
            @else
                <span class="badge bg-label-secondary">
                    <i class="bx bx-play me-1"></i>Belum Mulai
                </span>
            @endif
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Progress Pembelajaran</h6>
                <span class="text-muted">{{ number_format($progress->progress_percentage, 0) }}%</span>
            </div>
            <div class="progress mb-3" style="height: 8px;">
                <div class="progress-bar bg-{{ $progress->progress_bar_color }}"
                     role="progressbar"
                     style="width: {{ $progress->progress_percentage }}%"></div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <small class="text-muted">
                        <i class="bx bx-question-mark me-1"></i>
                        {{ $progress->answered_questions }}/{{ $progress->total_questions }} soal dijawab
                    </small>
                </div>
                <div class="col-md-3">
                    <small class="text-success">
                        <i class="bx bx-check-circle me-1"></i>
                        {{ $progress->correct_answers }} jawaban benar
                    </small>
                </div>
                @if($progress->score)
                    <div class="col-md-3">
                        <small class="text-primary">
                            <i class="bx bx-trophy me-1"></i>
                            {{ number_format($progress->score, 0) }} poin
                        </small>
                    </div>
                @endif
                @if($progress->completed_at)
                    <div class="col-md-3">
                        <small class="text-muted">
                            <i class="bx bx-time me-1"></i>
                            Selesai {{ $progress->completed_at->diffForHumans() }}
                        </small>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <!-- Material Content -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Konten Materi</h5>
                </div>
                <div class="card-body">
                    <div class="material-content">
                        {!! $learningMaterial->content !!}
                    </div>
                </div>
            </div>

            <!-- Questions -->
            @if($questions->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Latihan Soal</h5>
                        <small class="text-muted">Jawab semua soal untuk menyelesaikan materi ini</small>
                    </div>
                    <div class="card-body">
                        @foreach($questions as $index => $question)
                            <div class="question-item mb-4 @if(!$loop->last) border-bottom pb-4 @endif" id="question-{{ $question->id }}">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-label-primary me-2">Soal {{ $index + 1 }}</span>
                                        <span class="badge bg-label-secondary">{{ $question->points }} Poin</span>
                                    </div>
                                    @if($question->user_answer)
                                        <span class="badge bg-label-{{ $question->user_answer->is_correct ? 'success' : 'danger' }}">
                                            <i class="bx bx-{{ $question->user_answer->is_correct ? 'check' : 'x' }} me-1"></i>
                                            {{ $question->user_answer->is_correct ? 'Benar' : 'Salah' }}
                                        </span>
                                    @else
                                        <span class="badge bg-label-warning">
                                            <i class="bx bx-clock me-1"></i>Belum Dijawab
                                        </span>
                                    @endif
                                </div>

                                <div class="question-content mb-3">
                                    <h6 class="mb-2">{{ $question->question_text }}</h6>
                                </div>

                                @if($question->user_answer)
                                    <!-- Show user's answer -->
                                    <div class="answer-review">
                                        @if($question->type === 'multiple_choice')
                                            <div class="options-review">
                                                @foreach($question->options as $option)
                                                    <div class="option-item p-2 mb-2 rounded border
                                                        @if($option->option_letter === $question->user_answer->selected_option_letter)
                                                            {{ $option->is_correct ? 'bg-success-subtle border-success' : 'bg-danger-subtle border-danger' }}
                                                        @elseif($option->is_correct)
                                                            bg-success-subtle border-success
                                                        @endif">
                                                        <div class="d-flex align-items-center">
                                                            <span class="fw-bold me-2">{{ $option->option_letter }}.</span>
                                                            <span>{{ $option->option_text }}</span>
                                                            @if($option->option_letter === $question->user_answer->selected_option_letter)
                                                                <i class="bx bx-{{ $option->is_correct ? 'check' : 'x' }} ms-auto text-{{ $option->is_correct ? 'success' : 'danger' }}"></i>
                                                            @elseif($option->is_correct)
                                                                <i class="bx bx-check ms-auto text-success"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="free-text-review">
                                                <strong>Jawaban Anda:</strong>
                                                <div class="p-3 bg-light rounded mt-2">
                                                    {{ $question->user_answer->answer }}
                                                </div>
                                            </div>
                                        @endif

                                        @if($question->explanation)
                                            <div class="explanation mt-3">
                                                <strong>Penjelasan:</strong>
                                                <div class="p-3 bg-info-subtle rounded mt-2">
                                                    {{ $question->explanation }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <!-- Answer form -->
                                    <form action="{{ route('student.learning-materials.submit-answer', [$learningMaterial, $question]) }}"
                                          method="POST" class="answer-form">
                                        @csrf

                                        @if($question->type === 'multiple_choice')
                                            <div class="options-container">
                                                @foreach($question->options as $option)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio"
                                                               name="selected_option" value="{{ $option->option_letter }}"
                                                               id="option_{{ $question->id }}_{{ $option->option_letter }}"
                                                               required>
                                                        <label class="form-check-label w-100"
                                                               for="option_{{ $question->id }}_{{ $option->option_letter }}">
                                                            <span class="fw-bold">{{ $option->option_letter }}.</span> {{ $option->option_text }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                                <input type="hidden" name="answer" id="answer_{{ $question->id }}">
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <textarea class="form-control" name="answer" rows="4"
                                                          placeholder="Tulis jawaban Anda di sini..." required></textarea>
                                            </div>
                                        @endif

                                        <div class="text-end mt-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bx bx-check me-1"></i>Simpan Jawaban
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- References -->
            @if($learningMaterial->references)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Referensi</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @foreach($learningMaterial->references as $reference)
                                <li class="mb-2">
                                    <i class="bx bx-link-external me-2"></i>
                                    <a href="{{ $reference['url'] ?? '#' }}" target="_blank" class="text-decoration-none">
                                        {{ $reference['title'] ?? $reference }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Math Symbols Helper -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Simbol Matematika</h5>
                </div>
                <div class="card-body">
                    <small class="text-muted mb-3 d-block">Gunakan simbol berikut untuk menulis rumus matematika:</small>
                    <div class="row g-2">
                        <div class="col-6">
                            <code>x^2</code> → x²
                        </div>
                        <div class="col-6">
                            <code>sqrt(x)</code> → √x
                        </div>
                        <div class="col-6">
                            <code>+-</code> → ±
                        </div>
                        <div class="col-6">
                            <code>>=</code> → ≥
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('student.dashboard') }}" class="btn btn-outline-secondary w-100">
                        <i class="bx bx-arrow-back me-1"></i>Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="{{ asset('js/quadratic-graph.js') }}"></script>
<script>
// Auto-fill answer field for multiple choice questions
document.querySelectorAll('input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const questionId = this.name.includes('selected_option') ?
            this.closest('.question-item').id.replace('question-', '') : null;

        if (questionId) {
            const answerField = document.getElementById('answer_' + questionId);
            const selectedLabel = document.querySelector(`label[for="${this.id}"]`);
            if (answerField && selectedLabel) {
                answerField.value = this.value + '. ' + selectedLabel.textContent.substring(2).trim();
            }
        }
    });
});

// Smooth scroll to questions
document.addEventListener('DOMContentLoaded', function() {
    const hash = window.location.hash;
    if (hash) {
        const element = document.querySelector(hash);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }
});

// Auto-save progress (optional feature)
setInterval(function() {
    // Could implement auto-save functionality here
}, 60000); // Every minute
</script>

@if(config('app.mathjax', true))
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script>
window.MathJax = {
    tex: {
        inlineMath: [['$', '$'], ['\\(', '\\)']],
        displayMath: [['$$', '$$'], ['\\[', '\\]']]
    },
    options: {
        skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre']
    }
};
</script>
@endif
@endpush

@push('style')
<style>
.material-content {
    line-height: 1.8;
}

.material-content h1,
.material-content h2,
.material-content h3,
.material-content h4,
.material-content h5,
.material-content h6 {
    color: #435971;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

.material-content p {
    margin-bottom: 1rem;
}

.material-content ul,
.material-content ol {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
}

.question-item {
    scroll-margin-top: 100px;
}

.option-item {
    transition: all 0.3s ease;
    cursor: pointer;
}

.option-item:hover {
    background-color: var(--bs-light) !important;
}

.form-check-input:checked + .form-check-label {
    font-weight: 500;
}

.explanation {
    border-left: 4px solid #0d6efd;
}

.answer-review .option-item {
    cursor: default;
}
</style>
@endpush
@endsection
