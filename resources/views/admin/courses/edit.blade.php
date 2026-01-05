{{-- 1. Pastikan extend ke layout ADMIN (sesuaikan nama file layout adminmu) --}}
@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">

    {{-- Header Halaman --}}
    <h1 class="mt-4">Review Kursus</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Manajemen Kursus</a></li>
        <li class="breadcrumb-item active">Review #{{ $course->id }}</li>
    </ol>

    {{-- Form Utama --}}
    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- KOLOM KIRI: Detail Konten Kursus --}}
            <div class="col-lg-8">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <i class="fas fa-book-open me-1"></i> Detail Kursus
                    </div>
                    <div class="card-body">

                        {{-- Thumbnail --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Thumbnail</label>
                            <div class="border rounded p-2 text-center bg-light">
                                @if($course->thumbnail)
                                    <img src="{{ asset('storage/'.$course->thumbnail) }}" alt="Thumbnail" class="img-fluid" style="max-height: 300px;">
                                @else
                                    <p class="text-muted my-4">Tidak ada thumbnail</p>
                                @endif
                            </div>
                        </div>

                        {{-- Judul (Read Only) --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Kursus</label>
                            <input type="text" class="form-control" value="{{ $course->name }}" disabled>
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori</label>
                            <input type="text" class="form-control" value="{{ $course->category->name ?? '-' }}" disabled>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <div class="p-3 border rounded bg-light">
                                {{-- Gunakan {!! !!} jika deskripsi menyimpan format HTML (wysiwyg) --}}
                                {!! $course->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: Info Instruktur & Aksi --}}
            <div class="col-lg-4">

                {{-- Card Info Instruktur --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-user-tie me-1"></i> Info Instruktur
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="small text-muted">Nama Instruktur</label>
                            <div class="fw-bold">{{ $course->instructor->name ?? 'User Tidak Ditemukan' }}</div>
                        </div>
                        <div class="mb-2">
                            <label class="small text-muted">Email</label>
                            <div>{{ $course->instructor->email ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                {{-- Card Status & Harga --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <i class="fas fa-tag me-1"></i> Status & Harga
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="fw-bold d-block">Harga Kursus</label>
                            <h4 class="text-success">
                                {{ $course->price == 0 ? 'GRATIS' : 'Rp ' . number_format($course->price, 0, ',', '.') }}
                            </h4>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold d-block">Status Saat Ini</label>
                            @if($course->status == 'published')
                                <span class="badge bg-success w-100 py-2">PUBLISHED</span>
                            @elseif($course->status == 'rejected')
                                <span class="badge bg-danger w-100 py-2">REJECTED</span>
                            @else
                                <span class="badge bg-secondary w-100 py-2">DRAFT / PENDING</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Card Aksi (Tombol Approval) --}}
                <div class="card mb-4 shadow-sm border-warning">
                    <div class="card-header bg-warning text-dark">
                        <i class="fas fa-gavel me-1"></i> Aksi Admin
                    </div>
                    <div class="card-body">
                        <p class="small text-muted">
                            Silakan tinjau kursus ini. Jika sesuai standar, klik Setujui. Jika tidak, klik Tolak.
                        </p>

                        <div class="d-grid gap-2">
                            {{-- Tombol Approve --}}
                            <button type="submit" name="action" value="approve" class="btn btn-success btn-lg">
                                <i class="fas fa-check-circle"></i> Setujui & Publish
                            </button>

                            {{-- Tombol Reject --}}
                            <button type="submit" name="action" value="reject" class="btn btn-outline-danger">
                                <i class="fas fa-times-circle"></i> Tolak / Reject
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
