@extends('layouts.instructor.app')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Siswa</h1>

        <form class="d-none d-sm-inline-block form-inline ml-auto my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-white border-0 small shadow-sm" placeholder="Cari siswa..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        @forelse($courses as $course)
            @if($course->students->count() > 0)
                <div class="col-12 mb-4">
                    <h4 class="text-primary">{{ $course->name }}</h4>
                    <div class="row">
                        @foreach($course->students as $student)
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100 py-3">
                                <div class="card-body text-center">

                                    <div class="mb-3">
                                        @if($student->avatar)
                                            <img src="{{ asset('storage/' . $student->avatar) }}"
                                                 class="rounded-circle img-thumbnail"
                                                 style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=4e73df&color=ffffff&size=100"
                                                 class="rounded-circle img-thumbnail shadow-sm"
                                                 alt="{{ $student->name }}">
                                        @endif
                                    </div>

                                    <h5 class="font-weight-bold text-dark mb-1">{{ $student->name }}</h5>
                                    <p class="text-muted small mb-3">{{ $student->email }}</p>

                                    <div class="d-flex justify-content-center mb-3">
                                        <span class="badge badge-light text-primary px-3 py-2 border">
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            Join: {{ $student->pivot->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                    <div class="mt-2">
                                        <a href="#" class="btn btn-sm btn-outline-primary btn-block rounded-pill">
                                            <i class="fas fa-user mb-1"></i> Lihat Profil
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @empty
        <div class="col-12 text-center py-5">
            <div class="text-gray-500 mb-3">
                <i class="fas fa-users-slash fa-3x"></i>
            </div>
            <h5>Belum ada kursus atau siswa yang mendaftar.</h5>
        </div>
        @endforelse
    </div>

</div>
@endsection
