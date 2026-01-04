@extends('layouts.instructor.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Kursus</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('instructor.courses.index') }}">Kursus Saya</a></li>
        <li class="breadcrumb-item active">Edit Kursus</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i> Form Edit Kursus
        </div>
        <div class="card-body">
            @if($course->status == 'rejected')
                <div class="alert alert-danger">
                    <strong>Kursus Ditolak!</strong> Silakan perbaiki konten sesuai masukan admin dan simpan kembali. Status akan berubah menjadi Draft.
                </div>
            @endif

            <form action="{{ route('instructor.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $course->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Singkat</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $course->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga (Rp)</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $course->price) }}" min="0" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail (Biarkan kosong jika tidak diganti)</label>
                    @if($course->thumbnail)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Current Thumbnail" style="height: 100px; border-radius: 5px;">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                    <div class="form-text">Format: JPG, PNG, JPEG. Max: 2MB.</div>
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Perbarui Kursus
                </button>
                <a href="{{ route('instructor.courses.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
