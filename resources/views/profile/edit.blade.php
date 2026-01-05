@php
    // LOGIKA PENENTUAN LAYOUT & RUTE KEMBALI
    $role = Auth::user()->role;
    $layout = 'layouts.student.app'; // Default untuk student
    $backRoute = route('student.dashboard');

    if ($role === 'instructor') {
        $layout = 'layouts.instructor.app';
        $backRoute = route('instructor.dashboard');
    } elseif ($role === 'admin') {
        $layout = 'layouts.admin.app';
        $backRoute = route('admin.dashboard');
    }
@endphp

@extends($layout)

@section('content')
<div class="container-fluid px-4">

    <h3 class="mt-4 fw-bold">Edit Profil</h3>
    <p class="text-muted mb-4">Perbarui informasi akun dan foto profil Anda.</p>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <label class="form-label fw-bold text-muted">Foto Saat Ini</label>
                        <div class="mt-2">
                            {{-- LOGIKA: Jika ada avatar di DB, tampilkan. Jika tidak, pakai UI Avatars --}}
                            <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=4f46e5&color=fff&size=150' }}"
                                 alt="Profile"
                                 id="imagePreview"
                                 class="rounded-circle shadow-sm border"
                                 style="width: 180px; height: 180px; object-fit: cover;">
                        </div>
                        <div class="mt-3">
                            <h5 class="fw-bold text-dark">{{ $user->name }}</h5>
                            <span class="badge bg-primary rounded-pill px-3">{{ ucfirst($user->role) }}</span>
                        </div>
                    </div>

                    <div class="col-md-8">

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control bg-light" value="{{ old('name', $user->name) }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">Email</label>
                            <input type="email" name="email" class="form-control bg-light" value="{{ old('email', $user->email) }}" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">Foto Profil</label>

                            <input type="file" name="avatar" class="form-control bg-light" accept="image/*" onchange="previewImage(event)">

                            <div class="form-text text-muted">
                                Format: JPG, PNG, JPEG. Maksimal 2MB. (Biarkan kosong jika tidak ingin mengubah foto).
                            </div>
                            @error('avatar') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">Password Baru <span class="fw-normal">(Opsional)</span></label>
                            <input type="password" name="password" class="form-control bg-light" placeholder="Isi hanya jika ingin mengganti password">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control bg-light" placeholder="Ulangi password baru">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success px-4 fw-bold">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                            {{-- BUTTON KEMBALI DINAMIS (Sesuai Role) --}}
                            <a href="{{ $backRoute }}" class="btn btn-secondary px-4 fw-bold">Kembali</a>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
