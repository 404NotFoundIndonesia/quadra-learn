@extends('layouts.dashboard')

@section('title', 'Kelola Siswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin /</span> Kelola Siswa
            </h4>
            <p class="text-muted">Kelola akun siswa dan penugasan kelas</p>
        </div>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>
            Tambah Siswa
        </a>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Pencarian</label>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Cari berdasarkan nama, email, atau NIS..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Kelas</label>
                    <select name="grade_id" class="form-select">
                        <option value="">Semua Kelas</option>
                        <option value="unassigned" {{ request('grade_id') === 'unassigned' ? 'selected' : '' }}>
                            Belum Ditugaskan
                        </option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ request('grade_id') == $grade->id ? 'selected' : '' }}>
                                {{ $grade->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bx bx-search me-1"></i>Filter
                        </button>
                        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">
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

    <!-- Students List -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Daftar Siswa ({{ $students->total() }})</h5>
        </div>
        <div class="card-body p-0">
            @if($students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="40">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th>Siswa</th>
                                <th>NIS</th>
                                <th>Email</th>
                                <th>Kelas</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input student-checkbox" 
                                                   type="checkbox" 
                                                   value="{{ $student->id }}" 
                                                   name="selected_students[]">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $student->avatar_url }}" 
                                                 class="rounded-circle me-3" 
                                                 width="40" height="40" 
                                                 alt="Student Avatar">
                                            <div>
                                                <h6 class="mb-0">{{ $student->name }}</h6>
                                                <small class="text-muted">{{ $student->username ?? 'Tanpa username' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($student->nis)
                                            <span class="badge bg-info">{{ $student->nis }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $student->email }}</td>
                                    <td>
                                        @if($student->grade)
                                            <span class="badge bg-primary">{{ $student->grade->full_name }}</span>
                                        @else
                                            <span class="badge bg-secondary">Belum Ditugaskan</span>
                                        @endif
                                    </td>
                                    <td>{{ $student->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" 
                                                    data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.students.show', $student) }}">
                                                    <i class="bx bx-show me-1"></i> Lihat
                                                </a>
                                                <a class="dropdown-item" href="{{ route('admin.students.edit', $student) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('admin.students.reset-password', $student) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Reset password ke default?')">
                                                        <i class="bx bx-reset me-1"></i> Reset Password
                                                    </button>
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('admin.students.destroy', $student) }}" 
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
                    {{ $students->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bx bx-user-plus" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3 mb-0">Tidak ada siswa ditemukan</p>
                    <a href="{{ route('admin.students.create') }}" class="btn btn-primary mt-3">
                        Tambah Siswa Pertama
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
            <form id="bulkActionForm" action="{{ route('admin.students.bulk-action') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="bulkAction" class="form-label">Pilih Aksi</label>
                        <select class="form-select" id="bulkAction" name="action" required>
                            <option value="">Pilih aksi...</option>
                            <option value="assign_grade">Tugaskan ke Kelas</option>
                            <option value="remove_grade">Hapus dari Kelas</option>
                            <option value="reset_password">Reset Password</option>
                            <option value="delete">Hapus Siswa</option>
                        </select>
                    </div>

                    <div id="gradeSelection" class="mb-3" style="display: none;">
                        <label for="bulkGrade" class="form-label">Pilih Kelas</label>
                        <select class="form-select" id="bulkGrade" name="grade_id">
                            <option value="">Pilih kelas...</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="alert alert-warning">
                        <strong>Catatan:</strong> Aksi ini akan diterapkan ke semua siswa yang dipilih.
                    </div>

                    <div id="selectedCount" class="text-muted">
                        Tidak ada siswa dipilih
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
    const studentCheckboxes = document.querySelectorAll('.student-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const bulkActionSelect = document.getElementById('bulkAction');
    const gradeSelection = document.getElementById('gradeSelection');
    const bulkSubmit = document.getElementById('bulkSubmit');
    const bulkActionForm = document.getElementById('bulkActionForm');

    // Select All functionality
    selectAllCheckbox.addEventListener('change', function() {
        studentCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateSelectedCount();
    });

    // Individual checkbox change
    studentCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectedCount();
            
            // Update select all checkbox state
            const checkedCount = document.querySelectorAll('.student-checkbox:checked').length;
            selectAllCheckbox.checked = checkedCount === studentCheckboxes.length;
            selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < studentCheckboxes.length;
        });
    });

    // Bulk action change
    bulkActionSelect.addEventListener('change', function() {
        if (this.value === 'assign_grade') {
            gradeSelection.style.display = 'block';
        } else {
            gradeSelection.style.display = 'none';
        }
        updateBulkSubmitButton();
    });

    // Update selected count
    function updateSelectedCount() {
        const checkedCount = document.querySelectorAll('.student-checkbox:checked').length;
        selectedCount.textContent = `${checkedCount} siswa dipilih`;
        updateBulkSubmitButton();
    }

    // Update bulk submit button
    function updateBulkSubmitButton() {
        const checkedCount = document.querySelectorAll('.student-checkbox:checked').length;
        const actionSelected = bulkActionSelect.value !== '';
        bulkSubmit.disabled = checkedCount === 0 || !actionSelected;
    }

    // Form submission
    bulkActionForm.addEventListener('submit', function(e) {
        const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
        const action = bulkActionSelect.value;
        
        if (checkedBoxes.length === 0) {
            e.preventDefault();
            alert('Harap pilih setidaknya satu siswa.');
            return;
        }

        // Add selected student IDs to form
        checkedBoxes.forEach((checkbox, index) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `student_ids[${index}]`;
            input.value = checkbox.value;
            this.appendChild(input);
        });

        // Confirmation for destructive actions
        if (action === 'delete') {
            if (!confirm(`Apakah Anda yakin ingin menghapus ${checkedBoxes.length} siswa?`)) {
                e.preventDefault();
            }
        } else if (action === 'reset_password') {
            if (!confirm(`Apakah Anda yakin ingin reset password untuk ${checkedBoxes.length} siswa?`)) {
                e.preventDefault();
            }
        }
    });

    // Initialize
    updateSelectedCount();
});
</script>
@endpush