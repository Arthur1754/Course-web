    @extends('layouts.student.app')

    @section('content')
    <style>
        /* --- CSS Styles --- */
        .bg-gradient-primary-to-secondary { background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%); }

        /* Dekorasi Background */
        .decoration-circle { position: absolute; border-radius: 50%; background: rgba(255, 255, 255, 0.1); z-index: 0; }

        /* Efek Hover Kartu */
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }

        /* Agar kursor jadi tangan saat hover */
        .cursor-pointer { cursor: pointer; }

        .badge-blur { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(4px); }
    </style>

    <div class="container-fluid px-4 py-4">

        {{-- 1. HEADER UTAMA --}}
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 rounded-4 overflow-hidden shadow-sm bg-gradient-primary-to-secondary position-relative text-white">
                    <div class="decoration-circle" style="width: 200px; height: 200px; top: -50px; right: -50px;"></div>
                    <div class="decoration-circle" style="width: 100px; height: 100px; bottom: 20px; left: 50px;"></div>
                    <div class="card-body p-4 p-md-5 position-relative z-1">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                            <div>
                                <h2 class="fw-bold mb-2 display-6">Dashboard Belajar</h2>
                                <p class="mb-0 opacity-75 fs-5">Selamat datang! Lanjutkan progres kursus atau cari materi baru.</p>
                            </div>
                            <div class="mt-3 mt-md-0 text-md-end opacity-75">
                                <i class="fas fa-graduation-cap fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <hr class="border-secondary opacity-10 my-5">

        {{-- 3. SECTION BARU: REKOMENDASI / KURSUS LAINNYA (Dari Database Admin) --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="fw-bold text-dark mb-0"><i class="fas fa-fire text-danger me-2"></i>Rekomendasi Kursus Terbaru</h4>
            <a href="#" class="btn btn-sm btn-light rounded-pill px-3">Lihat Semua</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            {{-- Loop Data dari Controller ($otherCourses) --}}
            @forelse($otherCourses as $course)

                @php
                    // Logika Warna Random untuk Icon biar cantik
                    $colors = ['warning', 'success', 'danger', 'info', 'primary'];
                    $randomColor = $colors[$loop->index % 5];
                @endphp

                <div class="col">
                    {{-- Gunakan ID Unik untuk Target Modal: #courseModal-{{ $course->id }} --}}
                    <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift cursor-pointer"
                        data-bs-toggle="modal"
                        data-bs-target="#courseModal-{{ $course->id }}">

                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between mb-3">
                                {{-- Icon Kategori --}}
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-{{ $randomColor }}" style="width: 50px; height: 50px;">
                                    <i class="fas fa-laptop-code fa-lg"></i>
                                </div>
                                <span class="badge bg-light text-dark align-self-start">{{ $course->category->name ?? 'Umum' }}</span>
                            </div>

                            {{-- Judul Kursus --}}
                            <h5 class="fw-bold mb-2 text-truncate">{{ $course->name }}</h5>

                            {{-- Deskripsi Singkat (Strip HTML tags) --}}
                            <p class="text-muted small mb-4" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ strip_tags($course->description) }}
                            </p>

                            <div class="d-flex align-items-center justify-content-between text-muted small">
                                {{-- Tampilkan Harga --}}
                                <span class="fw-bold text-{{ $randomColor }}">
                                    {{ $course->price == 0 ? 'GRATIS' : 'Rp ' . number_format($course->price, 0, ',', '.') }}
                                </span>
                                <span><i class="fas fa-user-circle me-1"></i> {{ $course->instructor->name ?? 'Admin' }}</span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 p-4 pt-0">
                            <button class="btn btn-outline-dark w-100 rounded-pill fw-bold btn-sm">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>

                {{-- 4. MODAL: PREVIEW KURSUS (Ditaruh dalam loop agar datanya dinamis sesuai kursus) --}}
                <div class="modal fade" id="courseModal-{{ $course->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-0 rounded-4 overflow-hidden">
                            {{-- Header Modal dengan Gambar Thumbnail --}}
                            <div class="position-relative" style="height: 200px;">
                                <img src="{{ $course->thumbnail ? asset('storage/'.$course->thumbnail) : 'https://source.unsplash.com/random/800x400?tech' }}" class="w-100 h-100 object-fit-cover" alt="Cover">
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
                                <div class="position-absolute bottom-0 start-0 p-4 text-white">
                                    <span class="badge bg-{{ $randomColor }} mb-2">{{ $course->category->name ?? 'Umum' }}</span>
                                    <h3 class="fw-bold mb-0">{{ $course->name }}</h3>
                                </div>
                                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-4 p-md-5">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="fw-bold text-dark mb-3">Tentang Kursus</h5>
                                        <div class="text-muted lh-lg">
                                            {{-- Render HTML description --}}
                                            {!! $course->description !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-light border-0 rounded-4 p-3">
                                            <div class="mb-3">
                                                <label class="small text-muted fw-bold">INSTRUKTUR</label>
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm me-2" style="width: 35px; height: 35px;">
                                                        <i class="fas fa-user text-secondary"></i>
                                                    </div>
                                                    <span class="fw-bold">{{ $course->instructor->name ?? 'Admin' }}</span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small text-muted fw-bold">HARGA</label>
                                                <h4 class="text-primary fw-bold mt-1">
                                                    {{ $course->price == 0 ? 'GRATIS' : 'Rp ' . number_format($course->price, 0, ',', '.') }}
                                                </h4>
                                            </div>
                                            <div class="d-grid">
                                                {{-- Button Enroll / Beli --}}
                                                <form action="#" method="POST">
                                                    @csrf
                                                    {{-- Ganti action="#" dengan route ke proses checkout --}}
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                    <button type="button" class="btn btn-primary w-100 rounded-pill fw-bold py-2">
                                                        Daftar Sekarang <i class="fas fa-arrow-right ms-1"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Akhir Modal --}}

            @empty
                <div class="col-12">
                    <div class="alert alert-light text-center">Belum ada kursus baru yang tersedia.</div>
                </div>
            @endforelse
        </div>

    </div>

    {{-- Script Bootstrap Wajib --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @endsection
