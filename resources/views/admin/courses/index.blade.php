@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Kursus</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Kursus</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div><i class="fas fa-book-open me-1"></i> Daftar Request Kursus</div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Thumbnail</th>
                            <th>Info Kursus</th>
                            <th>Instruktur</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $index => $course)
                            <tr>
                                <td>{{ $courses->firstItem() + $index }}</td>
                                <td>
                                    @if ($course->thumbnail)
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumb"
                                            class="img-thumbnail" style="height: 50px;">
                                    @else
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $course->name }}</strong><br>
                                    <small class="text-muted">Kategori: {{ $course->category->name }}</small>
                                </td>
                                <td>
                                    <i class="fas fa-user-tie me-1"></i> {{ $course->instructor->name }}
                                </td>
                                <td>
                                    @if ($course->price == 0)
                                        <span class="badge bg-primary">Gratis</span>
                                    @else
                                        Rp {{ number_format($course->price, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($course->status == 'published')
                                        <span class="badge bg-success">Publish</span>
                                    @elseif($course->status == 'pending')
                                        <span class="badge bg-warning text-dark">Menunggu Review</span>
                                    @elseif($course->status == 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.courses.edit', $course->id) }}"
                                        class="btn btn-info btn-sm text-white w-100">
                                        <i class="fas fa-eye me-1"></i> Review
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data kursus.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
