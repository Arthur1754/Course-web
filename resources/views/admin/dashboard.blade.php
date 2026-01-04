@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex align-items-center justify-content-between mt-4 mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Dashboard</h1>
            <span class="text-muted small">Overview & Statistik LMS</span>
        </div>
        <div class="text-muted small">
            {{ now()->format('d M Y') }}
        </div>
    </div>

    <div class="row g-4">

        <div class="col-xl-8 col-lg-12">
            <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-sm-8">
                            <h4 class="fw-bold text-primary mb-2">
                                Selamat Datang, Administrator! 🎉
                            </h4>
                            <p class="mb-4 text-secondary">
                                Kamu memiliki <span class="fw-bold text-danger">{{ $pendingCourses }} kursus baru</span>
                                yang menunggu review hari ini. Cek badge profilmu atau kelola kursus sekarang.
                            </p>
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-primary fw-bold shadow-sm px-4">
                                Review Sekarang
                            </a>
                        </div>
                        <div class="col-sm-4 text-center d-none d-sm-block">
                            <i class="fas fa-laptop-code fa-8x text-primary" style="opacity: 0.1; transform: scale(1.2);"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-12">
            <div class="row g-3">
                <div class="col-sm-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="avatar-md bg-label-success rounded p-2 text-success bg-opacity-10" style="background-color: #e8fadf;">
                                    <i class="fas fa-users fa-lg"></i>
                                </div>
                                <div class="dropdown">
                                    <i class="fas fa-ellipsis-v text-muted" style="cursor: pointer; opacity: 0.5;"></i>
                                </div>
                            </div>
                            <span class="d-block mb-1 text-muted small fw-bold">TOTAL SISWA</span>
                            <h4 class="mb-0 fw-bold">{{ $totalStudents }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="avatar-md rounded p-2 text-info" style="background-color: #d7f5fc;">
                                    <i class="fas fa-chalkboard-teacher fa-lg"></i>
                                </div>
                            </div>
                            <span class="d-block mb-1 text-muted small fw-bold">INSTRUKTUR</span>
                            <h4 class="mb-0 fw-bold">{{ $totalInstructors }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="avatar-md rounded p-2 text-warning" style="background-color: #fff2d6;">
                                    <i class="fas fa-book-open fa-lg"></i>
                                </div>
                            </div>
                            <span class="d-block mb-1 text-muted small fw-bold">TOTAL KURSUS</span>
                            <h4 class="mb-0 fw-bold">{{ $totalCourses }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="avatar-md rounded p-2 text-danger" style="background-color: #ffe0db;">
                                    <i class="fas fa-tags fa-lg"></i>
                                </div>
                            </div>
                            <span class="d-block mb-1 text-muted small fw-bold">KATEGORI</span>
                            <h4 class="mb-0 fw-bold">{{ $totalCategories }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h5 class="m-0 fw-bold text-dark">Permintaan Review</h5>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-light text-primary fw-bold">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-hover mb-0">
                        <thead class="bg-light text-secondary small">
                            <tr>
                                <th class="ps-4 py-3">KURSUS</th>
                                <th class="py-3">INSTRUKTUR</th>
                                <th class="py-3">STATUS</th>
                                <th class="text-end pe-4 py-3">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPendingCourses as $course)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded p-2 bg-light text-primary me-3">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold text-dark">{{ Str::limit($course->name, 25) }}</h6>
                                            <small class="text-muted">{{ $course->category->name }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <small class="fw-bold">{{ $course->instructor->name }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-label-warning text-warning bg-opacity-10" style="background-color: #fff2d6; color: #ffab00;">Pending</span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-sm btn-primary">
                                        Check
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <div class="mb-2"><i class="fas fa-check-circle fa-2x text-success opacity-50"></i></div>
                                    <span class="small">Tidak ada request baru</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="m-0 fw-bold text-dark">Panduan Admin</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-0 px-0 d-flex align-items-start pb-4">
                            <div class="avatar-sm bg-label-primary rounded me-3 text-center p-2 text-primary" style="background-color: #e7e7ff;">
                                1
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Review Kursus</h6>
                                <small class="text-muted">Cek konten, video, dan deskripsi sebelum menyetujui kursus.</small>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 d-flex align-items-start pb-4">
                            <div class="avatar-sm bg-label-primary rounded me-3 text-center p-2 text-primary" style="background-color: #e7e7ff;">
                                2
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Manajemen User</h6>
                                <small class="text-muted">Pantau user yang mendaftar dan blokir jika mencurigakan.</small>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 d-flex align-items-start">
                            <div class="avatar-sm bg-label-primary rounded me-3 text-center p-2 text-primary" style="background-color: #e7e7ff;">
                                3
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Kategori</h6>
                                <small class="text-muted">Rapikan kategori agar siswa mudah mencari materi.</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
