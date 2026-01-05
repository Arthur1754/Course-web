<nav id="sidebar" class="d-none d-lg-block">
    <div class="sidebar-content h-100 d-flex flex-column">

        <div class="sidebar-header p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-icon bg-primary text-white d-flex align-items-center justify-content-center rounded-3 shadow-lg">
                    <i class="fas fa-layer-group fa-lg"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold text-white">LMS Pro</h5>
                    <small class="text-white-50" style="font-size: 0.75rem;">Student Area</small>
                </div>
            </div>
        </div>

        <ul class="list-unstyled components px-3 flex-grow-1">
            <li class="mb-2">
                <small class="text-uppercase fw-bold text-white-50 ms-3" style="font-size: 0.7rem; letter-spacing: 1px;">Menu Utama</small>
            </li>

            <li>
                <a href="{{ route('student.dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home me-3"></i>Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('student.courses') }}"
                   class="sidebar-link {{ request()->routeIs('student.courses') ? 'active' : '' }}">
                    <i class="fas fa-book-open me-3"></i>Kursus Saya
                </a>
            </li>

            <li>
                {{-- <a href="{{ route('student.certificates') }}"
                   class="sidebar-link {{ request()->routeIs('student.certificates') ? 'active' : '' }}">
                    <i class="fas fa-certificate me-3"></i>Sertifikat
                </a> --}}
            </li>

            <li class="mt-4 mb-2">
                <small class="text-uppercase fw-bold text-white-50 ms-3" style="font-size: 0.7rem; letter-spacing: 1px;">Pengaturan</small>
            </li>

            <li>
                <a href="{{ route('profile.edit') }}"
                   class="sidebar-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="fas fa-user-circle me-3"></i>Profil Saya
                </a>
            </li>
        </ul>

        <div class="p-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-logout w-100 d-flex align-items-center justify-content-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </form>
        </div>
    </div>
</nav>

<style>
    #sidebar {
        width: var(--sidebar-width);
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 999;
        /* Gradient Mewah Gelap */
        background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
        color: #fff;
        box-shadow: 4px 0 24px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }

    /* Agar Sidebar tersembunyi otomatis jika masuk mode 'Player' (Opsional, jika ingin full screen saat belajar) */
    body.learning-mode #sidebar {
        margin-left: calc(var(--sidebar-width) * -1);
    }

    .logo-icon { width: 40px; height: 40px; }

    .sidebar-link {
        padding: 12px 20px;
        display: flex;
        align-items: center;
        color: #94a3b8; /* Text abu-abu soft */
        text-decoration: none;
        border-radius: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-bottom: 5px;
    }

    .sidebar-link:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
        transform: translateX(5px);
    }

    /* Active State Styling */
    .sidebar-link.active {
        background: var(--primary-color);
        color: #fff;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4); /* Glow effect */
    }

    .btn-logout {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: #ef4444;
        padding: 10px;
        border-radius: 12px;
        transition: all 0.3s;
    }
    .btn-logout:hover {
        background: #ef4444;
        color: white;
        border-color: #ef4444;
    }
</style>
