@extends('layouts.dashboard')

@section('title', 'Kelola Guru')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin /</span> Kelola Guru
            </h4>
            <p class="text-muted">Kelola akun guru dan penugasan kelas</p>
        </div>
        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>
            Tambah Guru
        </a>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Pencarian</label>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Cari berdasarkan nama, email, atau username..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Penugasan Kelas</label>
                    <select name="has_grade" class="form-select">
                        <option value="">Semua Guru</option>
                        <option value="1" {{ request('has_grade') === '1' ? 'selected' : '' }}>
                            Sudah Ditugaskan
                        </option>
                        <option value="0" {{ request('has_grade') === '0' ? 'selected' : '' }}>
                            Belum Ditugaskan
                        </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bx bx-search me-1"></i>Filter
                        </button>
                        <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary">
                            Bersihkan
                        </a>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="button" class="btn btn-outline-info w-100" data-bs-toggle="modal" data-bs-target="#bulkActionModal">
                        <i class="bx bx-list-check me-1"></i>Aksi Massal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Teachers List -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Daftar Guru ({{ $teachers->total() }})</h5>
        </div>
        <div class="card-body p-0">
            @if($teachers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="40">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th>Guru</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Kelas Ditugaskan</th>
                                <th>Siswa</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input teacher-checkbox" 
                                                   type="checkbox" 
                                                   value="{{ $teacher->id }}" 
                                                   name="selected_teachers[]">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $teacher->avatar_url }}" 
                                                 class="rounded-circle me-3" 
                                                 width="40" height="40" 
                                                 alt="Teacher Avatar">
                                            <div>
                                                <h6 class="mb-0">{{ $teacher->name }}</h6>
                                                <span class="badge bg-warning">Guru</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>
                                        @if($teacher->username)
                                            <code>{{ $teacher->username }}</code>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($teacher->teachingGrades->count() > 0)
                                            @foreach($teacher->teachingGrades as $grade)
                                                <span class="badge bg-primary">{{ $grade->full_name }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge bg-secondary">Belum Ditugaskan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($teacher->teachingGrades->count() > 0)
                                            @php
                                                $totalStudents = $teacher->teachingGrades->sum(function($grade) {
                                                    return $grade->students->count();
                                                });
                                            @endphp
                                            <span class="badge bg-success">{{ $totalStudents }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $teacher->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" 
                                                    data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.teachers.show', $teacher) }}">
                                                    <i class="bx bx-show me-1"></i> Lihat
                                                </a>
                                                <a class="dropdown-item" href="{{ route('admin.teachers.edit', $teacher) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('admin.teachers.reset-password', $teacher) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Reset password ke default?')">
                                                        <i class="bx bx-reset me-1"></i> Reset Password
                                                    </button>
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('admin.teachers.destroy', $teacher) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirmSubmit(event, this)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bx bx-trash me-1"></i> Hapus
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
                    {{ $teachers->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bx bx-user-check" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3 mb-0">Tidak ada guru ditemukan</p>
                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary mt-3">
                        Tambah Guru Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Bulk Action Modal -->
<div class="modal fade" id="bulkActionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aksi Massal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="bulkActionForm" action="{{ route('admin.teachers.bulk-action') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="bulkAction" class="form-label">Pilih Aksi</label>
                        <select class="form-select" id="bulkAction" name="action" required>
                            <option value="">Pilih aksi...</option>
                            <option value="reset_password">Reset Password</option>
                            <option value="delete">Hapus Guru</option>
                        </select>
                    </div>

                    <div class="alert alert-warning">
                        <strong>Catatan:</strong> Aksi ini akan diterapkan ke semua guru yang dipilih.
                        <br><small>Guru yang sudah ditugaskan ke kelas tidak dapat dihapus.</small>
                    </div>

                    <div id="selectedCount" class="text-muted">
                        Tidak ada guru dipilih
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="bulkSubmit" disabled>Terapkan Aksi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const teacherCheckboxes = document.querySelectorAll('.teacher-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const bulkActionSelect = document.getElementById('bulkAction');
    const bulkSubmit = document.getElementById('bulkSubmit');
    const bulkActionForm = document.getElementById('bulkActionForm');

    // Select All functionality
    selectAllCheckbox.addEventListener('change', function() {
        teacherCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateSelectedCount();
    });

    // Individual checkbox change
    teacherCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectedCount();
            
            // Update select all checkbox state
            const checkedCount = document.querySelectorAll('.teacher-checkbox:checked').length;
            selectAllCheckbox.checked = checkedCount === teacherCheckboxes.length;
            selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < teacherCheckboxes.length;
        });
    });

    // Bulk action change
    bulkActionSelect.addEventListener('change', function() {
        updateBulkSubmitButton();
    });

    // Update selected count
    function updateSelectedCount() {
        const checkedCount = document.querySelectorAll('.teacher-checkbox:checked').length;
        selectedCount.textContent = `${checkedCount} guru dipilih`;
        updateBulkSubmitButton();
    }

    // Update bulk submit button
    function updateBulkSubmitButton() {
        const checkedCount = document.querySelectorAll('.teacher-checkbox:checked').length;
        const actionSelected = bulkActionSelect.value !== '';
        bulkSubmit.disabled = checkedCount === 0 || !actionSelected;
    }

    // Form submission
    bulkActionForm.addEventListener('submit', function(e) {
        const checkedBoxes = document.querySelectorAll('.teacher-checkbox:checked');
        const action = bulkActionSelect.value;
        
        if (checkedBoxes.length === 0) {
            e.preventDefault();
            alert('Harap pilih setidaknya satu guru.');
            return;
        }

        // Add selected teacher IDs to form
        checkedBoxes.forEach((checkbox, index) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `teacher_ids[${index}]`;
            input.value = checkbox.value;
            this.appendChild(input);
        });

        // Confirmation for destructive actions
        if (action === 'delete') {
            if (!confirm(`Apakah Anda yakin ingin menghapus ${checkedBoxes.length} guru? Guru yang sudah ditugaskan ke kelas tidak akan dihapus.`)) {
                e.preventDefault();
            }
        } else if (action === 'reset_password') {
            if (!confirm(`Apakah Anda yakin ingin reset password untuk ${checkedBoxes.length} guru?`)) {
                e.preventDefault();
            }
        }
    });

    // Initialize
    updateSelectedCount();
});
</script>
@endpush