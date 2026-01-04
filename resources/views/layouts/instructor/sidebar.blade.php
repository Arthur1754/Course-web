<aside id="sidebar">
    <div class="sidebar-brand">
        <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
            <i class="fas fa-layer-group fa-sm"></i>
        </div>
        <span>Instructor<span class="fw-light ms-1 opacity-75"></span></span>
    </div>

    <ul class="nav flex-column mt-2">

        <li class="menu-header">Overview</li>

        <li class="menu-item {{ request()->routeIs('instructor.dashboard') ? 'active' : '' }}">
            <a href="{{ route('instructor.dashboard') }}" class="menu-link">
                <i class="menu-icon fas fa-grid-2"></i> <i class="menu-icon fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="menu-header">Content Manager</li>

        <li class="menu-item {{ request()->routeIs('instructor.courses.*') ? 'active' : '' }}">
            <a href="{{ route('instructor.courses.index') }}" class="menu-link">
                <i class="menu-icon fas fa-clapperboard"></i>
                <span>Kursus & Materi</span>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('instructor.students.*') ? 'active' : '' }}">
    <a href="{{ route('instructor.students.index') }}" class="menu-link">
    <div data-i18n="Daftar Siswa">Daftar Siswa</div>
</a>
</li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon fas fa-comments"></i>
                <span>Diskusi</span>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon fas fa-chart-pie"></i>
                <span>Analisis Pendapatan</span>
            </a>
        </li>

        <li class="menu-header">Settings</li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon fas fa-user-gear"></i>
                <span>Profil Instruktur</span>
            </a>
        </li>
    </ul>

    <div class="position-absolute bottom-0 w-100 p-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100 border-0 bg-white bg-opacity-10 text-white d-flex align-items-center justify-content-center gap-2">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </div>
</aside>
