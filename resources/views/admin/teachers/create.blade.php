@extends('layouts.dashboard')

@section('title', 'Tambah Guru')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Guru /</span> Tambah
            </h4>
            <p class="text-muted">Tambahkan guru baru ke sistem</p>
        </div>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i>
            Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informasi Guru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.teachers.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama Lengkap *</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       placeholder="Masukkan nama lengkap guru"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Alamat Email *</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       placeholder="guru@example.com"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       id="username" 
                                       name="username" 
                                       value="{{ old('username') }}"
                                       placeholder="Username opsional">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Kosongkan untuk menggunakan email sebagai login</div>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Kosongkan untuk password default">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Default: "{{ \App\Models\User::DEFAULT_PASSWORD }}"</div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i>
                                Tambah Guru
                            </button>
                            <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Panduan</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6 class="alert-heading">Menambah Guru</h6>
                        <ul class="mb-0">
                            <li><strong>Email:</strong> Harus unik dan valid</li>
                            <li><strong>Username:</strong> Opsional, kosongkan untuk menggunakan email</li>
                            <li><strong>Password:</strong> Kosongkan untuk password default</li>
                            <li><strong>Penugasan Kelas:</strong> Dapat dilakukan setelah pembuatan</li>
                            <li><strong>Peran:</strong> Otomatis diatur sebagai guru</li>
                        </ul>
                    </div>

                    <div class="mt-3">
                        <h6>Kredensial Default</h6>
                        <div class="small">
                            <div class="mb-2">
                                <strong>Login:</strong> Alamat email atau username
                            </div>
                            <div class="mb-2">
                                <strong>Password Default:</strong> {{ \App\Models\User::DEFAULT_PASSWORD }}
                            </div>
                            <div class="text-muted">
                                Guru sebaiknya mengubah password mereka saat login pertama.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teacher Permissions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Hak Akses Guru</h5>
                </div>
                <div class="card-body">
                    <div class="small">
                        <div class="mb-2">
                            <i class="bx bx-check text-success me-1"></i>
                            Melihat dan mengelola siswa yang ditugaskan
                        </div>
                        <div class="mb-2">
                            <i class="bx bx-check text-success me-1"></i>
                            Mengakses materi pembelajaran
                        </div>
                        <div class="mb-2">
                            <i class="bx bx-check text-success me-1"></i>
                            Melihat kemajuan dan nilai siswa
                        </div>
                        <div class="mb-2">
                            <i class="bx bx-x text-danger me-1"></i>
                            Tidak dapat mengelola guru lain
                        </div>
                        <div class="mb-2">
                            <i class="bx bx-x text-danger me-1"></i>
                            Tidak dapat mengakses panel admin
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Statistics -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statistik Sistem</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Total Guru:</span>
                        <span class="badge bg-warning">{{ \App\Models\User::teacher()->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Guru Sudah Ditugaskan:</span>
                        <span class="badge bg-success">{{ \App\Models\User::teacher()->whereHas('teachingGrades')->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Kelas Tersedia:</span>
                        <span class="badge bg-info">{{ \App\Models\Grade::whereNull('teacher_id')->count() }}</span>
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
    const emailField = document.getElementById('email');
    const usernameField = document.getElementById('username');

    // Auto-generate email from name
    nameField.addEventListener('input', function() {
        if (!emailField.value) {
            const name = this.value.toLowerCase()
                          .replace(/\s+/g, '.')
                          .replace(/[^a-z0-9.]/g, '');
            if (name) {
                emailField.value = name + '@teacher.quadralearn.com';
            }
        }
    });

    // Auto-generate username from email
    emailField.addEventListener('input', function() {
        if (!usernameField.value) {
            const email = this.value;
            const username = email.split('@')[0];
            if (username) {
                usernameField.value = username;
            }
        }
    });
});
</script>
@endpush