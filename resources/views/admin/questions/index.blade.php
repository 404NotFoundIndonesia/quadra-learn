@extends('layouts.dashboard')

@section('title', 'Questions')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin /</span> Questions
            </h4>
            <p class="text-muted">Manage multiple choice and free text questions</p>
        </div>
        <a href="{{ route('admin.questions.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>
            Add Question
        </a>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search questions..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Material</label>
                    <select name="material_id" class="form-select">
                        <option value="">All Materials</option>
                        @foreach($materials as $material)
                            <option value="{{ $material->id }}" 
                                    {{ request('material_id') == $material->id ? 'selected' : '' }}>
                                {{ $material->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select">
                        <option value="">All Types</option>
                        <option value="multiple_choice" {{ request('type') === 'multiple_choice' ? 'selected' : '' }}>
                            Multiple Choice
                        </option>
                        <option value="free_text" {{ request('type') === 'free_text' ? 'selected' : '' }}>
                            Free Text
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bx bx-search me-1"></i>Filter
                        </button>
                        <a href="{{ route('admin.questions.index') }}" class="btn btn-outline-secondary">
                            Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Questions List -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Questions ({{ $questions->total() }})</h5>
        </div>
        <div class="card-body p-0">
            @if($questions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Question</th>
                                <th>Material</th>
                                <th>Type</th>
                                <th>Points</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td>
                                        <span class="badge bg-info">{{ $question->order }}</span>
                                    </td>
                                    <td>
                                        <div style="max-width: 300px;">
                                            <h6 class="mb-1">{{ Str::limit($question->question_text, 80) }}</h6>
                                            @if($question->type === 'multiple_choice')
                                                <small class="text-muted">
                                                    {{ $question->options->count() }} options
                                                </small>
                                            @elseif($question->correct_answer)
                                                <small class="text-muted">
                                                    Answer: {{ Str::limit($question->correct_answer, 30) }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $question->learningMaterial->title }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($question->type === 'multiple_choice')
                                            <span class="badge bg-success">Multiple Choice</span>
                                        @else
                                            <span class="badge bg-info">Free Text</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">{{ $question->points }}pt</span>
                                    </td>
                                    <td>
                                        @if($question->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" 
                                                    data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.questions.show', $question) }}">
                                                    <i class="bx bx-show me-1"></i> View
                                                </a>
                                                <a class="dropdown-item" href="{{ route('admin.questions.edit', $question) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('admin.questions.destroy', $question) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this question?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer">
                    {{ $questions->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bx bx-help-circle" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3 mb-0">No questions found</p>
                    <a href="{{ route('admin.questions.create') }}" class="btn btn-primary mt-3">
                        Create First Question
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection