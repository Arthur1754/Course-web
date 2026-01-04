<nav class="navbar navbar-expand-lg sticky-top px-4 py-3 glass-header">
    <div class="container-fluid p-0">
        
        <button class="btn btn-light d-lg-none shadow-sm me-3 rounded-circle" type="button">
            <i class="fas fa-bars"></i>
        </button>

        <div class="d-none d-md-block">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0 rounded-end-pill ps-0" placeholder="Cari materi..." style="max-width: 250px;">
            </div>
        </div>

        <div class="ms-auto d-flex align-items-center gap-3">
            
            <a href="#" class="position-relative btn btn-light rounded-circle shadow-sm" style="width: 40px; height: 40px;">
                <i class="fas fa-bell text-secondary mt-1"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-white p-1">
                    <span class="visually-hidden">unread messages</span>
                </span>
            </a>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle hide-arrow" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="text-end me-2 d-none d-sm-block">
                        <span class="d-block fw-bold text-dark small">{{ Auth::user()->name }}</span>
                        <span class="d-block text-muted extra-small">Student</span>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4f46e5&color=fff" alt="user" class="rounded-circle shadow-sm border border-2 border-white" width="40" height="40">
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 mt-2" aria-labelledby="dropdownUser">
                    <li><h6 class="dropdown-header">Akun Saya</h6></li>
                    <li><a class="dropdown-item py-2" href="#"><i class="fas fa-user me-2 text-primary"></i> Profil</a></li>
                    <li><a class="dropdown-item py-2" href="#"><i class="fas fa-cog me-2 text-secondary"></i> Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger fw-bold"><i class="fas fa-power-off me-2"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
    .glass-header {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(0,0,0,0.05);
        z-index: 100;
    }
    .extra-small { font-size: 0.7rem; }
    .dropdown-menu { animation: fadeIn 0.3s ease; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>