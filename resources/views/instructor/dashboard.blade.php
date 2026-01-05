{{-- PENTING: Gunakan Layout Instructor --}}
@extends('layouts.instructor.app')

@section('content')

<style>
    .dashboard-header {
        position: relative;
        z-index: 1;
    }

    .stat-card-icon {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 22px;
    }
</style>

<div class="container-fluid px-4">

    {{-- HEADER INSTRUKTUR --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 dashboard-header"
                 style="background: linear-gradient(135deg, #0f172a 0%, #334155 100%);">
                <div class="card-body p-4 p-md-5 text-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h2 class="fw-bold mb-2">Dashboard Instruktur 👨‍🏫</h2>
                            <p class="mb-0 opacity-75">
                                Halo <strong>{{ Auth::user()->name }}</strong>,
                                kelola materi dan pantau siswa Anda di sini.
                            </p>
                        </div>
                        <i class="fas fa-chalkboard-teacher fa-4x opacity-25 d-none d-md-block"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-4 mt-3">

        {{-- TOTAL KURSUS --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stat-card-icon bg-primary bg-opacity-10 text-primary me-3">
                            <i class="fas fa-book"></i>
                        </div>
                        <h6 class="fw-semibold text-muted mb-0">Total Kursus</h6>
                    </div>
                    <h2 class="fw-bold mb-0">{{ $totalCourses }}</h2>
                    <small class="text-muted">Kursus yang Anda buat</small>
                </div>
            </div>
        </div>

        {{-- TOTAL SISWA --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stat-card-icon bg-success bg-opacity-10 text-success me-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <h6 class="fw-semibold text-muted mb-0">Total Siswa</h6>
                    </div>
                    <h2 class="fw-bold mb-0">{{ $totalStudents }}</h2>
                    <small class="text-muted">Siswa terdaftar di kursus Anda</small>
                </div>
            </div>
        </div>

        {{-- RATING --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stat-card-icon bg-warning bg-opacity-10 text-warning me-3">
                            <i class="fas fa-star"></i>
                        </div>
                        <h6 class="fw-semibold text-muted mb-0">Rating Rata-rata</h6>
                    </div>
                    <h2 class="fw-bold mb-0">4.8</h2>
                    <small class="text-muted">Berdasarkan ulasan siswa</small>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
