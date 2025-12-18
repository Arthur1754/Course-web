<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Halaman Utama - Selamat Datang!</title>

    {{-- Bootstrap 5 CSS dari CDN untuk styling --}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom-style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100..900&family=Playwrite+US+Modern:wght@100..400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    {{-- Bagian Navigasi --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">NamaProyek</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Konten Utama Halaman Home --}}
    <main class="container my-5">

        {{-- Hero Section / Jumbotron --}}
        <div class="p-5 mb-4 bg-light rounded-3 text-center">
            <section class="hero-section">
                <div>
                    <img src="{{ asset('assets/images/test_logo.jpg') }}"
                         alt="download">
                    <h1 class="display-6 mb-2">{{ $username }}</h1>
                    <p class="lead mb-0">{{ $last_login }}</p>
                </div>
            </section>
            <div class="container-fluid py-5">
                <div class="font-custom">
                    <h1 class="display-5 fw-bold">Selamat Datang di Website Kami! 🚀</h1>
                    <p class="fs-4 col-md-8 mx-auto">Ini adalah halaman utama yang dibangun
                        menggunakan Laravel Blade. Template ini responsif, modern,
                        dan siap untuk Anda kembangkan lebih lanjut.</p>
                    <a href="#" class="btn btn-primary btn-lg mt-3">Pelajari Lebih Lanjut</a>
                </div>
                </div>
            </div>

        {{-- Features Section --}}
        <div class="row text-center">
            <h2 class="mb-4">Fitur Unggulan Kami</h2>
            {{-- Fitur 1 --}}
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Latihan Login</h5>
                        <br>
                        <a href="{{ url('/auth') }}">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Fitur 2 --}}
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Submit Form</h5>
                        <form action="{{ route('question.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{old('nama')}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" value="{{old('email')}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pertanyaan</label>
                                <textarea class="form-control" name="pertanyaan" rows="4" value="{{old('pertanyaan')}}"></textarea>
                            </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('info'))
                                    <div class="alert alert-info">
                                        {!! session('info') !!}
                                    </div>
                                @endif

                            <a href="D:\Aflah_2TID\laragon-6.0-minimal\www\laravel-web\resources\views\home-question-respon.blade.php">
                                <button type="submit" class="btn btn-primary">Kirim Pertanyaan</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Fitur 3 --}}
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Tugas Classroom</h5>
                        <br>
                        <a href="{{ url('/pegawai') }}">
                            <button type="submit" class="btn btn-primary">lihat tugas</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>


    {{-- Bagian Footer --}}
    <footer class="bg-light text-center text-lg-start mt-auto">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © {{ date('Y') }} Hak Cipta:
            <a class="text-dark" href="/">NamaPerusahaan.com</a>
        </div>
    </footer>

    {{-- Bootstrap 5 JS Bundle dari CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
