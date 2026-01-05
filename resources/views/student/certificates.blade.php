@extends('layouts.student.app')

@section('content')
<div class="container-fluid px-4">

    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);">
                <div class="card-body p-4 p-md-5 text-white">
                    <h2 class="fw-bold mb-2">Sertifikat Saya</h2>
                    <p class="mb-0 opacity-75">Koleksi sertifikat kursus yang telah Anda selesaikan.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        @forelse($completedCourses as $course)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-top">
                <div class="card-body p-4 text-center">
                    <div class="mb-4">
                        <i class="fas fa-certificate fa-4x text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-2">{{ $course->name }}</h5>
                    <p class="text-muted small mb-3">
                        Diselesaikan pada {{ \Carbon\Carbon::parse($course->pivot->updated_at)->format('d M Y') }}
                    </p>
                    <p class="text-muted small mb-4">
                        Oleh: {{ $course->instructor->name ?? 'Admin' }}
                    </p>
                    <button class="btn btn-primary rounded-pill fw-bold px-4" onclick="downloadCertificate({{ $course->id }})">
                        <i class="fas fa-download me-1"></i> Unduh Sertifikat
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-light border-0 shadow-sm text-center py-5 rounded-4">
                <div class="mb-3 text-muted opacity-50">
                    <i class="fas fa-certificate fa-3x"></i>
                </div>
                <h5 class="fw-bold">Belum ada sertifikat</h5>
                <p class="text-muted">Anda belum menyelesaikan kursus manapun saat ini.</p>
                <a href="{{ route('student.courses') }}" class="btn btn-primary rounded-pill px-4">Lihat Kursus Saya</a>
            </div>
        </div>
        @endforelse
    </div>
</div>

<script>
function downloadCertificate(courseId) {
    // Placeholder for certificate download functionality
    alert('Fitur unduh sertifikat akan segera tersedia untuk kursus ID: ' + courseId);
}
</script>
@endsection
