@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Review Kursus</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Kursus</a></li>
        <li class="breadcrumb-item active">Review</li>
    </ol>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-file-alt me-1"></i> Detail Materi
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Judul Kursus</label>
                        <input type="text" class="form-control" value="{{ $course->name }}" readonly disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Deskripsi Singkat</label>
                        <textarea class="form-control" rows="5" readonly disabled>{{ $course->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Konten Lengkap</label>
                        <textarea class="form-control" rows="5" readonly disabled>{{ Str::limit($course->content, 200) }} (Konten lengkap disembunyikan dalam preview ini)</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3 text-center">
                        @if($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" class="img-fluid rounded border" style="max-height: 200px;">
                        @else
                            <div class="alert alert-secondary">Tidak ada Thumbnail</div>
                        @endif
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Harga</span>
                            <strong>Rp {{ number_format($course->price) }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Kategori</span>
                            <span>{{ $course->category->name }}</span>
                        </li>
                        <li class="list-group-item">
                            <span>Instruktur:</span><br>
                            <strong>{{ $course->instructor->name }}</strong>
                            <br><small class="text-muted">{{ $course->instructor->email }}</small>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-gavel me-1"></i> Keputusan Admin
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Status Saat Ini:</h5>

                    <div class="mb-3">
                        @if($course->status == 'published')
                            <span class="badge bg-success fs-5">PUBLISHED (PUBLISH)</span>
                        @elseif($course->status == 'rejected')
                            <span class="badge bg-danger fs-5">REJECTED (DITOLAK)</span>
                        @elseif($course->status == 'pending')
                            <span class="badge bg-warning text-dark fs-5">PENDING (BUTUH REVIEW)</span>
                        @else
                            <span class="badge bg-secondary fs-5">DRAFT</span>
                        @endif
                    </div>

                    <hr>

                    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="d-grid gap-2">
                            <button type="submit" name="action" value="approve" class="btn btn-success btn-lg" {{ $course->status == 'published' ? 'disabled' : '' }}>
                                <i class="fas fa-check-circle me-1"></i>
                                {{ $course->status == 'published' ? 'Sudah Publish' : 'SETUJUI (Publish)' }}
                            </button>

                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-lg" {{ $course->status == 'rejected' ? 'disabled' : '' }}>
                                <i class="fas fa-times-circle me-1"></i>
                                {{ $course->status == 'rejected' ? 'Sudah Ditolak' : 'TOLAK (Reject)' }}
                            </button>
                        </div>

                        <div class="mt-3 text-muted small">
                            *Kursus yang ditolak tidak akan muncul di halaman depan.
                        </div>

                        <div class="mt-3 pt-2 border-top">
                             <a href="#" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus permanen?')) document.getElementById('delete-form').submit();" class="text-danger small text-decoration-none">
                                <i class="fas fa-trash"></i> Hapus Kursus Secara Permanen
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="delete-form" action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endsection
