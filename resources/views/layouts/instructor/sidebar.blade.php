<aside class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 260px; min-height: 100vh;">

    {{-- 1. HEADER / LOGO --}}
    <a href="{{ route('instructor.dashboard') }}" class="d-flex align-items-center mb-4 mb-md-0 me-md-auto text-white text-decoration-none px-2">
        <div class="bg-primary rounded p-1 me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
            <i class="fas fa-layer-group fa-sm text-white"></i>
        </div>
        <span class="fs-5 fw-bold">LMS Instructor</span>
    </a>

    <hr class="border-secondary opacity-50 my-4">

    {{-- 2. MENU UTAMA --}}
    <div class="text-uppercase text-muted fw-bold mb-2 px-2" style="font-size: 0.75rem; letter-spacing: 1px;">
        Overview
    </div>

    <ul class="nav nav-pills flex-column mb-auto gap-1">

        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ route('instructor.dashboard') }}"
               class="nav-link d-flex align-items-center gap-3 {{ request()->routeIs('instructor.dashboard') ? 'active bg-primary' : 'text-white opacity-75' }}">
                <i class="fas fa-th-large" style="width: 20px;"></i>
                Dashboard
            </a>
        </li>

        <div class="text-uppercase text-muted fw-bold mt-4 mb-2 px-2" style="font-size: 0.75rem; letter-spacing: 1px;">
            Content Manager
        </div>

        {{-- Kursus & Materi --}}
        <li class="nav-item">
            <a href="{{ route('instructor.courses.index') }}"
               class="nav-link d-flex align-items-center gap-3 {{ request()->routeIs('instructor.courses.*') ? 'active bg-primary' : 'text-white opacity-75' }}">
                <i class="fas fa-clapperboard" style="width: 20px;"></i>
                Kursus & Materi
            </a>
        </li>

        {{-- Daftar Siswa --}}
        <li class="nav-item">
            <a href="{{ route('instructor.students.index') }}"
               class="nav-link d-flex align-items-center gap-3 {{ request()->routeIs('instructor.students.*') ? 'active bg-primary' : 'text-white opacity-75' }}">
                <i class="fas fa-users" style="width: 20px;"></i>
                Daftar Siswa
            </a>
        </li>

        {{-- Diskusi
        <li class="nav-item">
            <a href="#"
               class="nav-link d-flex align-items-center gap-3 text-white opacity-75">
                <i class="fas fa-comments" style="width: 20px;"></i>
                Diskusi
            </a>
        </li> --}}

        {{-- Analisis Pendapatan
        <li class="nav-item">
            <a href="#"
               class="nav-link d-flex align-items-center gap-3 text-white opacity-75">
                <i class="fas fa-chart-pie" style="width: 20px;"></i>
                Analisis Pendapatan
            </a>
        </li> --}}

        <div class="text-uppercase text-muted fw-bold mt-4 mb-2 px-2" style="font-size: 0.75rem; letter-spacing: 1px;">
            Settings
        </div>

        {{-- Profil Instruktur --}}
        <li class="nav-item">
            <a href="{{ route('profile.edit') }}"
               class="nav-link d-flex align-items-center gap-3 {{ request()->routeIs('profile.*') ? 'active bg-primary' : 'text-white opacity-75' }}">
                <i class="fas fa-user-gear" style="width: 20px;"></i>
                Profil Instruktur
            </a>
        </li>
    </ul>

    {{-- 3. TOMBOL LOGOUT --}}
    <div class="mt-5 pt-4 border-top border-secondary border-opacity-25">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </div>

</aside>
