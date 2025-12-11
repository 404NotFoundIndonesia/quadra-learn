@extends('layouts.dashboard')

@section('title', 'Edit Question')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Questions /</span> Edit
            </h4>
            <p class="text-muted">Edit question: {{ Str::limit($question->question_text, 50) }}</p>
        </div>
        <a href="{{ route('admin.questions.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i>
            Back to List
        </a>
    </div>

    <form action="{{ route('admin.questions.update', $question) }}" method="POST" id="questionForm">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8 mb-4">
                <!-- Basic Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="learning_material_id" class="form-label">Learning Material <span class="text-danger">*</span></label>
                                <select class="form-select @error('learning_material_id') is-invalid @enderror" 
                                        id="learning_material_id" name="learning_material_id" required>
                                    <option value="">Select Material</option>
                                    @foreach($materials as $material)
                                        <option value="{{ $material->id }}" 
                                                {{ old('learning_material_id', $question->learning_material_id) == $material->id ? 'selected' : '' }}>
                                            {{ $material->title }} ({{ ucfirst($material->type) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('learning_material_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="type" class="form-label">Question Type <span class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" 
                                        id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="multiple_choice" {{ old('type', $question->type) === 'multiple_choice' ? 'selected' : '' }}>
                                        Multiple Choice
                                    </option>
                                    <option value="free_text" {{ old('type', $question->type) === 'free_text' ? 'selected' : '' }}>
                                        Free Text
                                    </option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="order" class="form-label">Order <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                       id="order" name="order" value="{{ old('order', $question->order) }}" required min="1">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="points" class="form-label">Points <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('points') is-invalid @enderror" 
                                       id="points" name="points" value="{{ old('points', $question->points) }}" required min="1">
                                @error('points')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" 
                                           name="is_active" value="1" {{ old('is_active', $question->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question Content -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Question Content <span class="text-danger">*</span></h5>
                        <small class="text-muted">Use MathJax syntax for mathematical equations (e.g., $$x^2 + bx + c = 0$$)</small>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control @error('question_text') is-invalid @enderror" 
                                  id="question_text" name="question_text" rows="6" required>{{ old('question_text', $question->question_text) }}</textarea>
                        @error('question_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Multiple Choice Options -->
                <div class="card mb-4" id="multipleChoiceSection" style="display: none;">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Answer Options <span class="text-danger">*</span></h5>
                    </div>
                    <div class="card-body">
                        <div id="optionsContainer">
                            @php
                                $correctOption = null;
                                $existingOptions = [];
                                
                                if($question->type === 'multiple_choice') {
                                    foreach($question->options as $option) {
                                        $existingOptions[$option->option_letter] = $option->option_text;
                                        if($option->is_correct) {
                                            $correctOption = $option->option_letter;
                                        }
                                    }
                                }
                            @endphp
                            
                            @for($i = 0; $i < 5; $i++)
                                @php $letter = chr(65 + $i); @endphp
                                <div class="mb-3 option-group">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="correct_option" 
                                                       value="{{ $letter }}" id="correct_{{ $letter }}"
                                                       {{ old('correct_option', $correctOption) === $letter ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold" for="correct_{{ $letter }}">
                                                    {{ $letter }}.
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control @error('options.'.$letter) is-invalid @enderror" 
                                                   name="options[{{ $letter }}]" placeholder="Option {{ $letter }}"
                                                   value="{{ old('options.'.$letter, $existingOptions[$letter] ?? '') }}">
                                            @error('options.'.$letter)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        @error('correct_option')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Select the correct answer by clicking the radio button</small>
                    </div>
                </div>

                <!-- Free Text Answer -->
                <div class="card mb-4" id="freeTextSection" style="display: none;">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Expected Answer <span class="text-danger">*</span></h5>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control @error('correct_answer') is-invalid @enderror" 
                                  id="correct_answer" name="correct_answer" rows="4" 
                                  placeholder="Enter the expected answer for this question">{{ old('correct_answer', $question->correct_answer) }}</textarea>
                        @error('correct_answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">This will be used as reference for grading free text answers</small>
                    </div>
                </div>

                <!-- Explanation -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Explanation</h5>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control @error('explanation') is-invalid @enderror" 
                                  id="explanation" name="explanation" rows="4" 
                                  placeholder="Optional explanation for the answer">{{ old('explanation', $question->explanation) }}</textarea>
                        @error('explanation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">This explanation will be shown to students after they answer</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Quick Reference -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Math Symbols Reference</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-secondary btn-sm w-100 math-symbol" data-symbol="$$x^2$$">x²</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-secondary btn-sm w-100 math-symbol" data-symbol="$$\sqrt{x}$$">√x</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-secondary btn-sm w-100 math-symbol" data-symbol="$$\frac{a}{b}$$">a/b</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-secondary btn-sm w-100 math-symbol" data-symbol="$$\pm$$">±</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-secondary btn-sm w-100 math-symbol" data-symbol="$$\geq$$">≥</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-secondary btn-sm w-100 math-symbol" data-symbol="$$\leq$$">≤</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-secondary btn-sm w-100 math-symbol" data-symbol="$$\alpha$$">α</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-secondary btn-sm w-100 math-symbol" data-symbol="$$\beta$$">β</button>
                            </div>
                        </div>
                        <small class="form-text text-muted mt-2">Click to insert math symbols into question or answer fields</small>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="bx bx-save me-1"></i>
                            Update Question
                        </button>
                        <a href="{{ route('admin.questions.index') }}" class="btn btn-outline-secondary w-100">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const multipleChoiceSection = document.getElementById('multipleChoiceSection');
    const freeTextSection = document.getElementById('freeTextSection');
    
    function toggleSections() {
        const selectedType = typeSelect.value;
        
        if (selectedType === 'multiple_choice') {
            multipleChoiceSection.style.display = 'block';
            freeTextSection.style.display = 'none';
            
            // Make options required
            document.querySelectorAll('input[name^="options["]').forEach(input => {
                input.setAttribute('required', 'required');
            });
            document.querySelector('input[name="correct_option"]').setAttribute('required', 'required');
            
            // Remove required from correct_answer
            document.getElementById('correct_answer').removeAttribute('required');
            
        } else if (selectedType === 'free_text') {
            multipleChoiceSection.style.display = 'none';
            freeTextSection.style.display = 'block';
            
            // Remove required from options
            document.querySelectorAll('input[name^="options["]').forEach(input => {
                input.removeAttribute('required');
            });
            document.querySelector('input[name="correct_option"]').removeAttribute('required');
            
            // Make correct_answer required
            document.getElementById('correct_answer').setAttribute('required', 'required');
            
        } else {
            multipleChoiceSection.style.display = 'none';
            freeTextSection.style.display = 'none';
            
            // Remove all requirements
            document.querySelectorAll('input[name^="options["]').forEach(input => {
                input.removeAttribute('required');
            });
            document.querySelector('input[name="correct_option"]').removeAttribute('required');
            document.getElementById('correct_answer').removeAttribute('required');
        }
    }
    
    // Initialize on page load
    toggleSections();
    
    // Toggle sections when type changes
    typeSelect.addEventListener('change', toggleSections);
    
    // Math symbol insertion
    let lastFocusedTextarea = document.getElementById('question_text'); // Default to question text
    
    // Track the last focused textarea
    document.querySelectorAll('textarea').forEach(textarea => {
        textarea.addEventListener('focus', function() {
            lastFocusedTextarea = this;
        });
    });
    
    document.querySelectorAll('.math-symbol').forEach(button => {
        button.addEventListener('click', function() {
            const symbol = this.dataset.symbol;
            let targetElement = lastFocusedTextarea;
            
            // If no textarea has been focused, try to find the currently active element
            if (!targetElement && document.activeElement && document.activeElement.tagName === 'TEXTAREA') {
                targetElement = document.activeElement;
            }
            
            // If still no target, default to question_text
            if (!targetElement) {
                targetElement = document.getElementById('question_text');
            }
            
            if (targetElement) {
                const start = targetElement.selectionStart || targetElement.value.length;
                const end = targetElement.selectionEnd || targetElement.value.length;
                const text = targetElement.value;
                
                targetElement.value = text.substring(0, start) + symbol + text.substring(end);
                targetElement.selectionStart = targetElement.selectionEnd = start + symbol.length;
                targetElement.focus();
                
                // Show visual feedback
                button.classList.add('btn-success');
                button.classList.remove('btn-outline-secondary');
                setTimeout(() => {
                    button.classList.remove('btn-success');
                    button.classList.add('btn-outline-secondary');
                }, 200);
            }
        });
    });
    
    // Form validation
    document.getElementById('questionForm').addEventListener('submit', function(e) {
        const type = typeSelect.value;
        
        if (type === 'multiple_choice') {
            const hasCorrectOption = document.querySelector('input[name="correct_option"]:checked');
            if (!hasCorrectOption) {
                e.preventDefault();
                alert('Please select the correct answer option.');
                return;
            }
            
            // Check if at least 2 options are filled
            const filledOptions = Array.from(document.querySelectorAll('input[name^="options["]')).filter(input => input.value.trim() !== '');
            if (filledOptions.length < 2) {
                e.preventDefault();
                alert('Please provide at least 2 answer options.');
                return;
            }
        }
    });
});
</script>
@endpush
@endsection