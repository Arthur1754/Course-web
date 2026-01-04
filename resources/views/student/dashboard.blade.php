@extends('layouts.student.app')

@section('content')
<div class="container-fluid px-4">

    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);">
                <div class="card-body p-4 p-md-5 text-white">
                    <h2 class="fw-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h2>
                    <p class="mb-0 opacity-75">Lanjutkan progres belajarmu hari ini.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;"><i class="fas fa-play-circle fa-lg"></i></div>
                    <div>
                        <h6 class="text-muted mb-0 small fw-bold">SEDANG DIPELAJARI</h6>
                        <h4 class="fw-bold mb-0">{{ $inProgressCourses }} Kursus</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;"><i class="fas fa-check-circle fa-lg"></i></div>
                    <div>
                        <h6 class="text-muted mb-0 small fw-bold">SELESAI</h6>
                        <h4 class="fw-bold mb-0">{{ $completedCourses }} Kursus</h4>
                    </div>
                </div>
            </div>
        </div>
         </div>

    <div class="d-flex align-items-center justify-content-between mt-5 mb-3">
        <h4 class="fw-bold text-dark">Kursus Saya</h4>
    </div>

    <div class="row g-4 mb-5">
        @forelse($myCourses as $course)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-top">

                <div class="position-relative">
                    <img src="{{ $course->image ? asset('storage/'.$course->image) : 'https://source.unsplash.com/random/400x300?education' }}" class="card-img-top object-fit-cover" alt="Course" style="height: 180px;">
                    <span class="position-absolute top-0 end-0 m-3 badge bg-white text-dark shadow-sm">
                        {{ $course->category->name ?? 'Umum' }}
                    </span>
                </div>

                <div class="card-body p-4 d-flex flex-column">
                    <h5 class="fw-bold mb-1 text-truncate">{{ $course->name }}</h5> <p class="text-muted small mb-3">
                        Oleh: {{ $course->instructor->name ?? 'Admin' }}
                    </p>

                    <div class="mt-auto">
                        @php
                            $progress = $course->pivot->progress ?? 0;
                        @endphp


                        <div class="d-flex justify-content-between small fw-bold mb-1">
                            <span class="{{ $progress == 100 ? 'text-success' : 'text-primary' }}">
                                {{ $progress == 100 ? 'Selesai' : 'Progres' }}
                            </span>
                            <span>{{ $progress }}%</span>
                        </div>
                        <div class="progress rounded-pill" style="height: 8px;">
                            <div class="progress-bar rounded-pill {{ $progress == 100 ? 'bg-success' : 'bg-primary' }}"
                                 role="progressbar"
                                 style="width: {{ $progress }}%">
                            </div>
                        </div>

                        <div class="mt-4">
                            @if($progress == 100)
                                <button class="btn btn-outline-success w-100 rounded-pill fw-bold">
                                    <i class="fas fa-download me-1"></i> Sertifikat
                                </button>
                            @else
                                <a href="{{ route('student.course.learn', $course->id) }}" class="btn btn-primary w-100 rounded-pill fw-bold">
                                    <i class="fas fa-play me-1"></i> Lanjut Belajar
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-light border-0 shadow-sm text-center py-5 rounded-4">
                <div class="mb-3 text-muted opacity-50">
                    <i class="fas fa-folder-open fa-3x"></i>
                </div>
                <h5 class="fw-bold">Belum ada kursus</h5>
                <p class="text-muted">Anda belum mendaftar ke kursus manapun saat ini.</p>
                <a href="#" class="btn btn-primary rounded-pill px-4">Cari Kursus</a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
