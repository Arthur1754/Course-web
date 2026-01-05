<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instructor Dashboard | LMS Pro</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* MENGADOPSI STYLE DARI STUDENT LAYOUT */
        :root {
            --primary-color: #4f46e5; /* Indigo Modern (Sama seperti Student) */
            --bg-body: #f8fafc; /* Abu-abu muda bersih */
            --sidebar-width: 260px; /* Lebar disesuaikan dengan sidebar baru */
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: #334155;
            overflow-x: hidden;
        }

        /* WRAPPER: Menggunakan Flexbox agar Sidebar dan Content berdampingan */
        .layout-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            align-items: stretch;
        }

        /* SIDEBAR STYLE OVERRIDE */
        /* Kita memastikan tidak ada CSS aneh yang menimpa sidebar Bootstrap kita */
        aside {
            box-shadow: 4px 0 24px rgba(0,0,0,0.05);
            z-index: 1000;
        }

        /* MAIN CONTENT */
        .layout-page {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            width: 100%;
            transition: all 0.3s;
            /* Jika di layar besar, dan sidebar fix, kita bisa atur margin disini.
               Tapi karena kita pakai flexbox murni, ini otomatis mengisi sisa ruang. */
        }

        /* STYLE TAMBAHAN UNTUK KOMPONEN LAMA (Agar tidak error) */
        .card-premium {
            background: white;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .navbar-glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>

    <div class="layout-wrapper">

        {{-- INCLUDE SIDEBAR --}}
        {{-- Pastikan ini memanggil file sidebar yang BARU kita edit --}}
        @include('layouts.instructor.sidebar')

        <div class="layout-page">

            {{-- INCLUDE HEADER --}}
            @include('layouts.instructor.header')

            <div class="content-wrapper p-4">
                @yield('content')
            </div>

            {{-- INCLUDE FOOTER (Opsional jika ada) --}}
            {{-- @include('layouts.instructor.footer') --}}

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script untuk Preview Image (Dari request sebelumnya) --}}
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('imagePreview');
                if(output) output.src = reader.result;
            };
            if(event.target.files[0]){
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</body>
</html>
