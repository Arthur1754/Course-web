@extends('layouts.guest.app')

@section('content')
<div class="container-fluid px-4">
    
    <!-- Hero Section / Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 1rem; background: linear-gradient(135deg, #4f46e5 0%, #766df4 100%);">
                <div class="card-body p-5 text-white">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-5 fw-bold mb-3">Selamat Datang di LMS Pro! 🚀</h1>
                            <p class="lead mb-4">Platform pembelajaran masa depan yang siap membantu Anda mengembangkan keahlian baru dengan materi berkualitas tinggi.</p>
                            <div class="d-flex gap-3">
                                <a href="{{ route('register') }}" class="btn btn-light text-primary fw-bold px-4 py-2 rounded-pill shadow-sm">
                                    Mulai Belajar
                                </a>
                                <a href="#courses" class="btn btn-outline-light fw-bold px-4 py-2 rounded-pill">
                                    Lihat Kursus
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center d-none d-lg-block">
                             <!-- Placeholder for illustration if needed -->
                             <i class="fas fa-rocket fa-10x" style="opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features / Roles Section -->
    <div class="row justify-content-center mb-4">
        <div class="col-12 text-center mb-4">
            <h3 class="fw-bold text-dark">Pilih Peran Anda</h3>
            <p class="text-muted">Masuk sesuai dengan akses yang Anda miliki</p>
        </div>
        
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100 border-0 shadow-sm hover-card transition-all">
                <div class="card-body p-4 text-center">
                    <div class="icon-box bg-danger-subtle text-danger rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-user-shield fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Admin</h5>
                    <p class="text-muted small mb-4">Kelola seluruh sistem, pengguna, dan konten kursus secara penuh.</p>
                    <a href="{{ route('login') }}" class="btn btn-danger w-100 rounded-pill">Login Admin</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100 border-0 shadow-sm hover-card transition-all">
                <div class="card-body p-4 text-center">
                    <div class="icon-box bg-success-subtle text-success rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-chalkboard-teacher fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Staff / Guru</h5>
                    <p class="text-muted small mb-4">Kelola materi kursus, siswa, dan penilaian pembelajaran.</p>
                    <a href="{{ route('login') }}" class="btn btn-success w-100 rounded-pill">Login Staff</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100 border-0 shadow-sm hover-card transition-all">
                <div class="card-body p-4 text-center">
                    <div class="icon-box bg-primary-subtle text-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-user-graduate fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Student</h5>
                    <p class="text-muted small mb-4">Akses ribuan materi pembelajaran dan kembangkan skill Anda.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary w-100 rounded-pill">Login Student</a>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
</style>
@endsection
