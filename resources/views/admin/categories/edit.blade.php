@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Kategori</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Kategori</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i> Form Edit Kategori
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name', $category->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Ganti Gambar (Opsional)</label>
                    <input type="file"
                           class="form-control @error('image') is-invalid @enderror"
                           id="image"
                           name="image"
                           accept="image/*">
                    <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar.</div>

                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if($category->image)
                        <div class="mt-3">
                            <label class="form-label d-block">Gambar Saat Ini:</label>
                            <img src="{{ asset('storage/' . $category->image) }}"
                                 alt="Gambar Lama"
                                 class="img-thumbnail"
                                 width="150">
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
