@extends('layouts.dashboard')

@section('title', 'Learning Materials')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin /</span> Learning Materials
            </h4>
            <p class="text-muted">Manage quadratic function learning materials</p>
        </div>
        <a href="{{ route('admin.learning-materials.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>
            Add Material
        </a>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search materials..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select">
                        <option value="">All Types</option>
                        <option value="pendahuluan" {{ request('type') === 'pendahuluan' ? 'selected' : '' }}>
                            Pendahuluan
                        </option>
                        <option value="materi" {{ request('type') === 'materi' ? 'selected' : '' }}>
                            Materi
                        </option>
                        <option value="latihan" {{ request('type') === 'latihan' ? 'selected' : '' }}>
                            Latihan
                        </option>
                        <option value="evaluasi" {{ request('type') === 'evaluasi' ? 'selected' : '' }}>
                            Evaluasi
                        </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bx bx-search me-1"></i>Filter
                        </button>
                        <a href="{{ route('admin.learning-materials.index') }}" class="btn btn-outline-secondary">
                            Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Materials List -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Materials ({{ $materials->total() }})</h5>
        </div>
        <div class="card-body p-0">
            @if($materials->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Questions</th>
                                <th>Attachments</th>
                                <th>Status</th>
                                <th>Min Score</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materials as $material)
                                <tr>
                                    <td>
                                        <span class="badge bg-info">{{ $material->order }}</span>
                                    </td>
                                    <td>
                                        <div>
                                            <h6 class="mb-0">{{ $material->title }}</h6>
                                            @if($material->description)
                                                <small class="text-muted">
                                                    {{ Str::limit($material->description, 60) }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ ucfirst($material->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            {{ $material->questions->count() }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $material->attachments->count() }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($material->is_published)
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td>{{ $material->min_score }}%</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" 
                                                    data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.learning-materials.show', $material) }}">
                                                    <i class="bx bx-show me-1"></i> View
                                                </a>
                                                <a class="dropdown-item" href="{{ route('admin.learning-materials.edit', $material) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('admin.learning-materials.destroy', $material) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this material?')">
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
                    {{ $materials->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bx bx-book-content" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3 mb-0">No learning materials found</p>
                    <a href="{{ route('admin.learning-materials.create') }}" class="btn btn-primary mt-3">
                        Create First Material
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection