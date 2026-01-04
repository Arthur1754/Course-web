<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Premium</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4f46e5; /* Indigo Modern */
            --secondary-color: #64748b;
            --bg-color: #f8fafc; /* Abu-abu sangat muda/bersih */
            --sidebar-width: 280px;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: 1px solid rgba(255, 255, 255, 0.3);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-color);
            overflow-x: hidden;
        }

        /* Layout Structure */
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        /* Main Content Area */
        #content {
            width: 100%;
            min-height: 100vh;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        /* Scrollbar Halus */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c7c7c7; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }

        @media (min-width: 992px) {
            #content { margin-left: var(--sidebar-width); }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        @include('layouts.student.sidebar')

        <div id="content">
            @include('layouts.student.header')

            <main class="flex-grow-1 py-4">
                @yield('content')
            </main>

            @include('layouts.student.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>