@extends('layouts.instructor.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Buat Kursus Baru</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('instructor.courses.index') }}">Kursus Saya</a></li>
        <li class="breadcrumb-item active">Buat Kursus</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plus me-1"></i> Form Kursus Baru
        </div>
        <div class="card-body">
            <form action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Singkat</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga (Rp)</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', 0) }}" min="0" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                    <div class="form-text">Format: JPG, PNG, JPEG. Max: 2MB.</div>
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Draft
                </button>
                <a href="{{ route('instructor.courses.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
