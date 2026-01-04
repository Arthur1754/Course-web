<nav class="navbar navbar-expand navbar-glass align-items-center">
    <div class="container-fluid px-0">

        <div class="d-none d-md-block">
            <h5 class="mb-0 fw-bold text-dark">
                @if(request()->routeIs('instructor.dashboard'))
                    Dashboard Overview
                @elseif(request()->routeIs('instructor.courses.*'))
                    Manajemen Kursus
                @else
                    Instructor Area
                @endif
            </h5>
            <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
        </div>

        <ul class="navbar-nav ms-auto align-items-center gap-3">

            <li class="nav-item">
                <a class="nav-link position-relative text-secondary" href="#">
                    <i class="fas fa-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                </a>
            </li>

            <div class="vr h-100 mx-2 text-secondary"></div>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 hide-arrow" href="#" data-bs-toggle="dropdown">
                    <div class="text-end d-none d-sm-block line-height-1">
                        <span class="d-block fw-bold text-dark small">{{ Auth::user()->name }}</span>
                        <span class="text-muted small" style="font-size: 0.75rem;">Senior Instructor</span>
                    </div>
                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea, #764ba2);">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </a>
                </li>
        </ul>
    </div>
</nav>
