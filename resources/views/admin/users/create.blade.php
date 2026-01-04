@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex align-items-center justify-content-between mt-4 mb-4">
        <div>
            <h1 class="mb-1">Tambah User Baru</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}" class="text-decoration-none">User Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                <input type="text" name="name" class="form-control bg-light border-start-0 py-2 ps-1" placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control bg-light border-start-0 py-2 ps-1" placeholder="user@example.com" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-secondary">Password Default</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                    <input type="password" name="password" class="form-control bg-light border-start-0 py-2 ps-1" placeholder="Min. 8 karakter" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-secondary">Hak Akses (Role)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user-tag text-muted"></i></span>
                                    <select name="role" class="form-select bg-light border-start-0 py-2 ps-1" required>
                                        <option value="" disabled selected>-- Pilih Role --</option>
                                        <option value="student">Student (Siswa)</option>
                                        <option value="instructor">Instructor (Guru)</option>
                                        <option value="admin">Administrator</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold py-3 rounded-pill shadow-sm">
                                <i class="fas fa-save me-2"></i> Simpan User Baru
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection