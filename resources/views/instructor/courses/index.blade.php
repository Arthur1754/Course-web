@extends('layouts.instructor.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex align-items-center justify-content-between mt-4 mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">Kursus Saya</h1>
        <a href="{{ route('instructor.courses.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Kursus Baru
        </a>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="ps-4">Info Kursus</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    @if($course->thumbnail)
                                        <img src="{{ asset('storage/'.$course->thumbnail) }}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded me-3 d-flex align-items-center justify-content-center text-white" style="width: 50px; height: 50px;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $course->name }}</h6>
                                        <small class="text-muted">{{ $course->category->name ?? 'Uncategorized' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>Rp {{ number_format($course->price) }}</td>
                            <td>
                                @if($course->status == 'published')
                                    <span class="badge bg-success">Publish</span>
                                @elseif($course->status == 'pending')
                                    <span class="badge bg-warning text-dark">Review Admin</span>
                                @elseif($course->status == 'rejected')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>{{ $course->created_at->format('d M Y') }}</td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('instructor.courses.edit', $course->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit Konten">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    @if($course->status == 'draft' || $course->status == 'rejected')
                                    <form action="{{ route('instructor.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Hapus kursus ini?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <img src="https://img.icons8.com/ios/100/cccccc/empty-box.png" alt="Empty" style="width: 60px; opacity: 0.5;" class="mb-3">
                                <p class="mb-0">Anda belum membuat kursus apapun.</p>
                                <a href="{{ route('instructor.courses.create') }}" class="btn btn-sm btn-link">Buat sekarang</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
