@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex align-items-center justify-content-between mt-4 mb-4">
        <div>
            <h1 class="mb-1">User Management</h1>
            <p class="text-muted mb-0">Kelola akses pengguna sistem.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-lg rounded-pill shadow-sm">
            <i class="fas fa-plus me-2"></i>Tambah User
        </a>
    </div>


    <div class="row g-4">
        @forelse($users as $user)
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-4 position-relative overflow-hidden group-hover-effect">

                {{-- Garis warna status di atas --}}
                <div class="position-absolute top-0 start-0 w-100" style="height: 5px; background: {{ $user->role == 'admin' ? '#dc3545' : ($user->role == 'instructor' ? '#ffc107' : '#198754') }};"></div>

                {{-- ========================================================= --}}
                {{-- [BARU] TOMBOL BERI TUGAS (POJOK KANAN ATAS) --}}
                {{-- ========================================================= --}}
                @if($user->role == 'instructor')
                    <div class="position-absolute top-0 end-0 p-3 mt-1">
                        {{-- Tombol ini mengarah ke route admin.tasks.create yang sudah kita buat --}}
                        <a href="{{ route('admin.tasks.create', $user->id) }}"
                           class="btn btn-light btn-sm shadow-sm rounded-circle text-primary border"
                           data-bs-toggle="tooltip"
                           title="Beri Tugas Instruktur">
                            <i class="fas fa-paper-plane"></i>
                        </a>
                    </div>
                @endif
                {{-- ========================================================= --}}

                <div class="card-body text-center p-4">
                    <div class="mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                         style="width: 70px; height: 70px; background-color: #f8f9fa; border: 3px solid white;">
                        <span class="fs-3 fw-bold text-secondary">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </span>
                    </div>

                    <h5 class="fw-bold text-dark mb-1 text-truncate">{{ $user->name }}</h5>
                    <p class="text-muted small mb-3 text-truncate">{{ $user->email }}</p>

                    <div class="mb-4">
                        @if($user->role == 'admin')
                            <span class="badge bg-danger rounded-pill px-4 py-2 shadow-sm">
                                ADMIN
                            </span>
                        @elseif($user->role == 'instructor')
                            <span class="badge bg-warning text-dark rounded-pill px-4 py-2 shadow-sm">
                                INSTRUCTOR
                            </span>
                        @else
                            <span class="badge bg-success rounded-pill px-4 py-2 shadow-sm">
                                STUDENT
                            </span>
                        @endif
                    </div>

                    @if($user->id != auth()->id())
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                              onsubmit="return confirm('Hapus user {{ $user->name }} secara permanen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100 rounded-pill">
                                <i class="fas fa-trash-alt me-1"></i> Hapus
                            </button>
                        </form>
                    @else
                        <button class="btn btn-light btn-sm w-100 rounded-pill text-muted" disabled>
                            <i class="fas fa-lock me-1"></i> Akun Anda
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-light text-center border-0 shadow-sm py-5">
                <i class="fas fa-users-slash fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada data pengguna.</p>
            </div>
        </div>
        @endforelse
    </div>

    <div class="mt-4 mb-5 d-flex justify-content-end">
        {{ $users->links() }}
    </div>
</div>
@endsection
