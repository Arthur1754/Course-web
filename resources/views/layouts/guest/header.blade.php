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
                <input type="text" class="form-control border-start-0 rounded-end-pill ps-0" placeholder="Cari kursus..." style="max-width: 250px;">
            </div>
        </div>

        <div class="ms-auto d-flex align-items-center gap-3">
            
            <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4">
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4">
                Register
            </a>

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
