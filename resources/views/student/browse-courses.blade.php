@extends('layouts.student.app')

@section('content')
<div class="container-fluid px-4">

    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);">
                <div class="card-body p-4 p-md-5 text-white">
                    <h2 class="fw-bold mb-2">Cari Kursus</h2>
                    <p class="mb-0 opacity-75">Temukan kursus yang ingin Anda ikuti.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        @forelse($courses as $course)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-top">

                <div class="position-relative">
                    <img src="{{ $course->image ? asset('storage/'.$course->image) : 'https://source.unsplash.com/random/400x300?education' }}" class="card-img-top object-fit-cover" alt="Course" style="height: 180px;">
                    <span class="position-absolute top-0 end-0 m-3 badge bg-white text-dark shadow-sm">
                        {{ $course->category->name ?? 'Umum' }}
                    </span>
                </div>

                <div class="card-body p-4 d-flex flex-column">
                    <h5 class="fw-bold mb-1 text-truncate">{{ $course->name }}</h5>
                    <p class="text-muted small mb-3">
                        Oleh: {{ $course->instructor->name ?? 'Admin' }}
                    </p>

                    <div class="mt-auto">
                        <p class="text-muted small mb-3">{{ Str::limit($course->description, 100) }}</p>

                        <form action="{{ route('student.enroll', $course->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">
                                <i class="fas fa-plus me-1"></i> Daftar Kursus
                            </button>
                        </form>
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
                <h5 class="fw-bold">Belum ada kursus tersedia</h5>
                <p class="text-muted">Saat ini belum ada kursus yang dipublikasikan.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
