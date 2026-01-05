<nav class="navbar navbar-expand navbar-glass align-items-center bg-white shadow-sm mb-4 px-4 py-3">
    <div class="container-fluid px-0">

        {{-- Judul Halaman Dinamis --}}
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
            <small class="text-muted">{{ now()->translatedFormat('l, d F Y') }}</small>
        </div>

        <ul class="navbar-nav ms-auto align-items-center gap-3">

            {{-- ========================================================= --}}
            {{-- LOGIKA NOTIFIKASI TUGAS --}}
            {{-- ========================================================= --}}
            @php
                // Kita ambil data langsung di sini agar aman
                $user = Auth::user();
                // Menggunakan Eager Loading sederhana jika relasi ada, atau koleksi kosong
                $unreadTasks = $user->tasks ? $user->tasks->where('is_read', false)->sortByDesc('created_at') : collect([]);
                $count = $unreadTasks->count();
            @endphp

            <li class="nav-item dropdown">
                <a class="nav-link position-relative text-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell fs-5"></i>

                    {{-- Badge Merah (Hanya muncul jika jumlah > 0) --}}
                    @if($count > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">
                            {{ $count }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    @endif
                </a>

                {{-- Dropdown Isi Notifikasi --}}
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 mt-2" style="width: 320px; max-height: 400px; overflow-y: auto;">
                    <li class="dropdown-header fw-bold text-uppercase small text-muted border-bottom mb-2">Notifikasi Tugas Admin</li>

                    @forelse($unreadTasks as $task)
                        <li>
                            <div class="dropdown-item p-3 border-bottom position-relative bg-white hover-bg-light">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="mb-0 text-dark small fw-bold text-truncate" style="max-width: 180px;">{{ $task->title }}</h6>
                                    <small class="text-muted" style="font-size: 10px;">{{ $task->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-2 text-muted small text-truncate">{{ $task->description }}</p>

                                {{-- Tombol Tandai Selesai --}}
                                <form action="{{ route('instructor.tasks.read', $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-primary py-1 px-2 w-100" style="font-size: 0.75rem; border-radius: 6px;">
                                        <i class="fas fa-check-circle me-1"></i> Tandai Sudah Dibaca
                                    </button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <li class="p-4 text-center text-muted">
                            <i class="fas fa-bell-slash fa-2x mb-2 text-secondary opacity-50"></i>
                            <p class="small mb-0">Tidak ada tugas baru.</p>
                        </li>
                    @endforelse
                </ul>
            </li>
            {{-- ========================================================= --}}

            <div class="vr h-100 mx-2 text-secondary opacity-25"></div>

            {{-- Profil User --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 hide-arrow" href="#" data-bs-toggle="dropdown">
                    <div class="text-end d-none d-sm-block line-height-1">
                        <span class="d-block fw-bold text-dark small">{{ Auth::user()->name }}</span>
                        <span class="text-muted small" style="font-size: 0.75rem;">{{ ucfirst(Auth::user()->role) }}</span>
                    </div>

                    <img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=4f46e5&color=fff' }}"
                         alt="User Image"
                         class="rounded-circle shadow-sm border"
                         style="width: 40px; height: 40px; object-fit: cover;">
                </a>

                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3 mt-2">
                    <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2 text-primary"></i> Edit Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger py-2"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
