@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">
    <div class="mt-4">
        <h1>Beri Tugas Instruktur</h1>
        <ol class="breadcrumb mb-4">
            {{-- PERBAIKAN DI SINI: --}}
            {{-- Dulu: route('admin.users') -> Salah --}}
            {{-- Sekarang: route('admin.users.index') -> Benar --}}
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">User Management</a></li>
            <li class="breadcrumb-item active">Beri Tugas</li>
        </ol>
    </div>

    <div class="card shadow-sm col-md-8 mx-auto border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold"><i class="fas fa-paper-plane me-2 text-primary"></i>Tugas untuk: {{ $instructor->name }}</h5>
        </div>
        <div class="card-body">
            {{-- Pastikan route ini sesuai dengan web.php --}}
            <form action="{{ route('admin.tasks.store', $instructor->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Tugas / Notifikasi</label>
                    <input type="text" name="title" class="form-control" placeholder="Contoh: Upload Silabus Baru" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Detail Instruksi</label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Jelaskan detail tugas yang harus dilakukan instruktur..." required></textarea>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    {{-- PERBAIKAN DI SINI JUGA: --}}
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light border">Batal</a>

                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-paper-plane me-1"></i> Kirim Tugas</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
