@extends('layouts.student.app')

@section('content')
<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden"
                 style="background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);">
                <div class="card-body p-4 p-md-5 text-white">
                    <h2 class="fw-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h2>
                    <p class="mb-0 opacity-75">Lanjutkan progres belajarmu hari ini.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- LIST KURSUS --}}
    <div class="d-flex align-items-center justify-content-between mt-5 mb-3">
        <h4 class="fw-bold text-dark">Kursus Saya</h4>
    </div>

    <div class="row g-4 mb-5">
        @forelse($myCourses as $course)

        @php
            $progress = $course->pivot->progress ?? 0;
        @endphp

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">

                {{-- IMAGE --}}
                <img
                    src="{{ $course->image
                        ? asset('storage/'.$course->image)
                        : 'https://source.unsplash.com/400x300?education' }}"
                    class="card-img-top"
                    style="height:180px;object-fit:cover"
                >

                <div class="card-body p-4 d-flex flex-column">

                    {{-- CATEGORY --}}
                    <span class="badge bg-light text-dark mb-2">
                        {{ $course->category->name ?? 'Umum' }}
                    </span>

                    {{-- TITLE --}}
                    <h5 class="fw-bold mb-1 text-truncate">
                        {{ $course->name }}
                    </h5>

                    {{-- INSTRUCTOR --}}
                    <p class="text-muted small mb-3">
                        Oleh: {{ $course->instructor->name ?? 'Admin' }}
                    </p>

                    {{-- PROGRESS --}}
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between small fw-bold mb-1">
                            <span class="{{ $progress == 100 ? 'text-success' : 'text-primary' }}">
                                {{ $progress == 100 ? 'Selesai' : 'Progres' }}
                            </span>
                            <span>{{ $progress }}%</span>
                        </div>

                        <div class="progress rounded-pill" style="height: 8px;">
                            <div class="progress-bar rounded-pill {{ $progress == 100 ? 'bg-success' : 'bg-primary' }}"
                                 style="width: {{ $progress }}%">
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="mt-4">
                            @if($progress == 100)
                                <button class="btn btn-outline-success w-100 rounded-pill fw-bold">
                                    <i class="fas fa-download me-1"></i> Sertifikat
                                </button>
                            @else
                                <a href="{{ route('student.course.learn', $course->id) }}"
                                   class="btn btn-primary w-100 rounded-pill fw-bold">
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
            <div class="alert alert-light text-center py-5 rounded-4 shadow-sm">
                <h5 class="fw-bold">Belum ada kursus</h5>
                <p class="text-muted">Anda belum terdaftar di kursus manapun.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
