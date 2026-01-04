@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Kategori Bahasa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Kategori</li>
    </ol>

    {{-- Pesan alert sudah dihandle oleh Layout Utama, jadi bagian ini dikomentari agar tidak duplikat --}}
    {{-- @if(session('success')) ... @endif --}}

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div><i class="fas fa-table me-1"></i> Data Kategori</div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Baru
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 15%">Gambar</th> <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th style="width: 20%">Aksi</th> </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $index }}</td>

                        <td>
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="Img" width="50" class="rounded">
                            @else
                                <span class="text-muted small">No Image</span>
                            @endif
                        </td>

                        <td>{{ $category->name }}</td>
                        <td><span class="badge bg-secondary">{{ $category->slug }}</span></td>

                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm text-white">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                  action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
