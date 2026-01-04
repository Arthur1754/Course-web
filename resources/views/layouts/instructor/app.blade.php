<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instructor Studio | Premium LMS</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --sidebar-width: 280px;
            --bg-body: #f3f4f6;
            --glass-border: 1px solid rgba(255, 255, 255, 0.2);
            --card-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: #4b5563;
            overflow-x: hidden;
        }

        /* LAYOUT */
        .layout-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR - LUXURY DARK STYLE */
        #sidebar {
            width: var(--sidebar-width);
            background: #1e1e2f; /* Dark Base */
            background-image: linear-gradient(to bottom, #1e1e2f, #2d2d44);
            color: #fff;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 5px 0 25px rgba(0,0,0,0.05);
        }

        .sidebar-brand {
            padding: 2rem 1.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .menu-header {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1.2px;
            color: rgba(255,255,255,0.4);
            padding: 0 1.5rem;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
            font-weight: 600;
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 0.85rem 1.5rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
            border-left: 3px solid transparent;
        }

        .menu-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.05);
        }

        .menu-item.active .menu-link {
            color: #fff;
            background: linear-gradient(90deg, rgba(118, 75, 162, 0.2) 0%, rgba(118, 75, 162, 0) 100%);
            border-left-color: #a78bfa; /* Accent Purple */
        }

        .menu-icon {
            width: 24px;
            margin-right: 12px;
            text-align: center;
        }

        /* MAIN CONTENT */
        .layout-page {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            width: calc(100% - var(--sidebar-width));
        }

        /* GLASS HEADER */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.5);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        /* CARDS & COMPONENTS */
        .card-premium {
            background: white;
            border: none;
            border-radius: 1rem;
            box-shadow: var(--card-shadow);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-premium:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.1);
        }

        .btn-luxury {
            background: var(--primary-gradient);
            border: none;
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.4);
            transition: all 0.3s;
        }

        .btn-luxury:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(118, 75, 162, 0.5);
            color: white;
        }

        /* Welcome Banner Gradient */
        .welcome-banner {
            background: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
            border-radius: 1rem;
            position: relative;
            overflow: hidden;
        }
    </style>
</head>
<body>

    <div class="layout-wrapper">
        @include('layouts.instructor.sidebar')

        <div class="layout-page">
            @include('layouts.instructor.header')

            <div class="content-wrapper p-4 p-md-5">
                @yield('content')
            </div>

            @include('layouts.instructor.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
