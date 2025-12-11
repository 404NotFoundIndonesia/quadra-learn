@extends('layouts.dashboard')

@section('title', 'Create Grade')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Grades /</span> Create
            </h4>
            <p class="text-muted">Create a new grade/class</p>
        </div>
        <a href="{{ route('admin.grades.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i>
            Back
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Grade Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.grades.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Grade Name *</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       placeholder="e.g., A, B, IPA-1">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="level" class="form-label">Level *</label>
                                <select class="form-select @error('level') is-invalid @enderror" 
                                        id="level" 
                                        name="level">
                                    <option value="">Select Level</option>
                                    <option value="X" {{ old('level') === 'X' ? 'selected' : '' }}>X</option>
                                    <option value="XI" {{ old('level') === 'XI' ? 'selected' : '' }}>XI</option>
                                    <option value="XII" {{ old('level') === 'XII' ? 'selected' : '' }}>XII</option>
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="specialization" class="form-label">Specialization</label>
                                <select class="form-select @error('specialization') is-invalid @enderror" 
                                        id="specialization" 
                                        name="specialization">
                                    <option value="">No Specialization</option>
                                    <option value="IPA" {{ old('specialization') === 'IPA' ? 'selected' : '' }}>IPA</option>
                                    <option value="IPS" {{ old('specialization') === 'IPS' ? 'selected' : '' }}>IPS</option>
                                    <option value="Bahasa" {{ old('specialization') === 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                                </select>
                                @error('specialization')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="class_code" class="form-label">Class Code *</label>
                                <input type="text" 
                                       class="form-control @error('class_code') is-invalid @enderror" 
                                       id="class_code" 
                                       name="class_code" 
                                       value="{{ old('class_code') }}"
                                       placeholder="e.g., X-A, XI-IPA-1">
                                @error('class_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Unique identifier for the class</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="teacher_id" class="form-label">Assign Teacher</label>
                                <select class="form-select @error('teacher_id') is-invalid @enderror" 
                                        id="teacher_id" 
                                        name="teacher_id">
                                    <option value="">No Teacher Assigned</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }} ({{ $teacher->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="capacity" class="form-label">Capacity *</label>
                                <input type="number" 
                                       class="form-control @error('capacity') is-invalid @enderror" 
                                       id="capacity" 
                                       name="capacity" 
                                       value="{{ old('capacity', 30) }}"
                                       min="1" 
                                       max="50">
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3"
                                      placeholder="Optional description for the grade">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i>
                                Create Grade
                            </button>
                            <a href="{{ route('admin.grades.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Guidelines</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6 class="alert-heading">Grade Creation Tips</h6>
                        <ul class="mb-0">
                            <li><strong>Name:</strong> Short identifier (A, B, IPA-1)</li>
                            <li><strong>Level:</strong> Academic year (X, XI, XII)</li>
                            <li><strong>Class Code:</strong> Must be unique across all grades</li>
                            <li><strong>Capacity:</strong> Maximum students allowed</li>
                            <li><strong>Teacher:</strong> Can be assigned later</li>
                        </ul>
                    </div>

                    <div class="mt-3">
                        <h6>Example Configurations</h6>
                        <div class="small">
                            <div class="mb-2">
                                <strong>Regular Class:</strong><br>
                                Name: A, Level: X, Code: X-A
                            </div>
                            <div class="mb-2">
                                <strong>Science Class:</strong><br>
                                Name: IPA-1, Level: XI, Code: XI-IPA-1
                            </div>
                            <div>
                                <strong>Social Class:</strong><br>
                                Name: IPS-2, Level: XII, Code: XII-IPS-2
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameField = document.getElementById('name');
    const levelField = document.getElementById('level');
    const specializationField = document.getElementById('specialization');
    const classCodeField = document.getElementById('class_code');

    function updateClassCode() {
        const name = nameField.value;
        const level = levelField.value;
        const specialization = specializationField.value;

        if (name && level) {
            let code = level;
            if (specialization) {
                code += '-' + specialization;
            }
            code += '-' + name;
            classCodeField.value = code;
        }
    }

    nameField.addEventListener('input', updateClassCode);
    levelField.addEventListener('change', updateClassCode);
    specializationField.addEventListener('change', updateClassCode);
});
</script>
@endpush