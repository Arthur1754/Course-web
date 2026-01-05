{{-- PENTING: Gunakan Layout Instructor, BUKAN student --}}
@extends('layouts.instructor.app')

@section('content')
<div class="container-fluid px-4">

    {{-- HEADER INSTRUKTUR --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden"
                 style="background: linear-gradient(135deg, #0f172a 0%, #334155 100%);">
                <div class="card-body p-4 p-md-5 text-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h2 class="fw-bold mb-2">Dashboard Instruktur 👨‍🏫</h2>
                            <p class="mb-0 opacity-75">Halo <strong>{{ Auth::user()->name }}</strong>, kelola materi dan pantau siswa Anda di sini.</p>
                        </div>
                        <div class="d-none d-md-block">
                            <i class="fas fa-chalkboard-teacher fa-4x opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- STATISTIK (Contoh Tampilan) --}}
    <div class="row g-4 mt-2">
        {{-- Total Kursus --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary me-3">
                            <i class="fas fa-book-open fa-2x"></i>
                        </div>
                        <h6 class="text-muted mb-0 fw-bold">Total Kursus</h6>
                    </div>
                    <h2 class="fw-bold mb-0">3</h2> {{-- Nanti bisa diganti dynamic variable --}}
                </div>
            </div>
        </div>

        {{-- Total Siswa --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success me-3">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <h6 class="text-muted mb-0 fw-bold">Total Siswa</h6>
                    </div>
                    <h2 class="fw-bold mb-0">120</h2>
                </div>
            </div>
        </div>

        {{-- Pendapatan/Rating --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning me-3">
                            <i class="fas fa-star fa-2x"></i>
                        </div>
                        <h6 class="text-muted mb-0 fw-bold">Rating Rata-rata</h6>
                    </div>
                    <h2 class="fw-bold mb-0">4.8</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- DAFTAR KURSUS ANDA (Table) --}}
    <div class="row mt-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark">Kursus yang Anda Ajar</h4>
                <a href="#" class="btn btn-dark rounded-pill">
                    <i class="fas fa-plus me-1"></i> Buat Baru
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="p-3 border-0">Nama Kursus</th>
                                    <th class="p-3 border-0">Kategori</th>
                                    <th class="p-3 border-0">Siswa</th>
                                    <th class="p-3 border-0 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Contoh Data Dummy --}}
                                <tr>
                                    <td class="p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded p-2 me-3">📚</div>
                                            <strong>Belajar Laravel Dasar</strong>
                                        </div>
                                    </td>
                                    <td class="p-3"><span class="badge bg-info bg-opacity-10 text-info">Programming</span></td>
                                    <td class="p-3">45 Siswa</td>
                                    <td class="p-3 text-end">
                                        <button class="btn btn-sm btn-outline-primary rounded-pill">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
