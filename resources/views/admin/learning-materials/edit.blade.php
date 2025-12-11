@extends('layouts.dashboard')

@section('title', 'Edit Learning Material')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Learning Materials /</span> Edit
            </h4>
            <p class="text-muted">Edit learning material: {{ $material->title }}</p>
        </div>
        <a href="{{ route('admin.learning-materials.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i>
            Back to List
        </a>
    </div>

    <form action="{{ route('admin.learning-materials.update', $material) }}" method="POST" enctype="multipart/form-data">
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
                            <div class="col-md-8 mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $material->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="order" class="form-label">Order <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                       id="order" name="order" value="{{ old('order', $material->order) }}" required min="1">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="pendahuluan" {{ old('type', $material->type) === 'pendahuluan' ? 'selected' : '' }}>
                                        Pendahuluan
                                    </option>
                                    <option value="materi" {{ old('type', $material->type) === 'materi' ? 'selected' : '' }}>
                                        Materi
                                    </option>
                                    <option value="latihan" {{ old('type', $material->type) === 'latihan' ? 'selected' : '' }}>
                                        Latihan
                                    </option>
                                    <option value="evaluasi" {{ old('type', $material->type) === 'evaluasi' ? 'selected' : '' }}>
                                        Evaluasi
                                    </option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="min_score" class="form-label">Minimum Score (%) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('min_score') is-invalid @enderror" 
                                       id="min_score" name="min_score" value="{{ old('min_score', $material->min_score) }}" 
                                       required min="0" max="100">
                                @error('min_score')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $material->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Content <span class="text-danger">*</span></h5>
                        <small class="text-muted">Use MathJax syntax for mathematical equations (e.g., $$x^2 + bx + c = 0$$)</small>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="15" required>{{ old('content', $material->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Math Symbols & References -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Math Symbols & References</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Math Symbols (JSON format)</label>
                            <textarea class="form-control @error('math_symbols') is-invalid @enderror" 
                                      name="math_symbols" rows="3" 
                                      placeholder='{"sqrt": "√", "alpha": "α", "beta": "β", "gamma": "γ"}'>{{ old('math_symbols', $material->math_symbols ? json_encode($material->math_symbols, JSON_PRETTY_PRINT) : '') }}</textarea>
                            @error('math_symbols')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Enter common math symbols as JSON for quick insertion</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">References (JSON format)</label>
                            <textarea class="form-control @error('references') is-invalid @enderror" 
                                      name="references" rows="3" 
                                      placeholder='["Reference 1", "Reference 2", "Reference 3"]'>{{ old('references', $material->references ? json_encode($material->references, JSON_PRETTY_PRINT) : '') }}</textarea>
                            @error('references')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">List of references for this material</small>
                        </div>
                    </div>
                </div>

                <!-- Existing Attachments -->
                @if($material->attachments->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Current Attachments</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($material->attachments as $attachment)
                                <div class="col-md-6 mb-3">
                                    <div class="border rounded p-3 h-100 d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $attachment->original_name }}</h6>
                                            <small class="text-muted">{{ $attachment->file_size_human }} • {{ $attachment->mime_type }}</small>
                                        </div>
                                        <div>
                                            <a href="{{ Storage::url($attachment->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info me-2">
                                                <i class="bx bx-download"></i>
                                            </a>
                                            <form action="{{ route('admin.attachments.destroy', $attachment) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                        onclick="return confirm('Delete this attachment?')">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-4">
                <!-- Publish Settings -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Publish Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_published" 
                                   name="is_published" value="1" {{ old('is_published', $material->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">
                                Publish immediately
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            Published materials will be visible to students
                        </small>
                    </div>
                </div>

                <!-- File Attachments -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Add New Attachments</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="attachments" class="form-label">Upload Files</label>
                            <input type="file" class="form-control @error('attachments.*') is-invalid @enderror" 
                                   id="attachments" name="attachments[]" multiple
                                   accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                            @error('attachments.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Supported formats: JPG, PNG, PDF, DOC, DOCX (Max: 2MB each)
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Statistics</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <h4 class="mb-1">{{ $material->questions->count() }}</h4>
                                <small class="text-muted">Questions</small>
                            </div>
                            <div class="col-6">
                                <h4 class="mb-1">{{ $material->attachments->count() }}</h4>
                                <small class="text-muted">Files</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="bx bx-save me-1"></i>
                            Update Material
                        </button>
                        <a href="{{ route('admin.learning-materials.index') }}" class="btn btn-outline-secondary w-100">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from title
    const titleInput = document.getElementById('title');
    
    titleInput.addEventListener('input', function() {
        // You can add slug preview functionality here if needed
    });
});
</script>
@endpush
@endsection