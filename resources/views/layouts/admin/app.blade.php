<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets-admin/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Dashboard - LMS Admin</title>
    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('assets-admin/img/favicon/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets-admin/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets-admin/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets-admin/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets-admin/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets-admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-admin/vendor/libs/apex-charts/apex-charts.css') }}" />

    <script src="{{ asset('assets-admin/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets-admin/js/config.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('layouts.admin.sidebar')

            <div class="layout-page">

                @include('layouts.admin.header')

                <div class="content-wrapper">

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                    @include('layouts.admin.footer')

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="{{ asset('assets-admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/js/menu.js') }}"></script>

    <script src="{{ asset('assets-admin/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <script src="{{ asset('assets-admin/js/main.js') }}"></script>
    <script src="{{ asset('assets-admin/js/dashboards-analytics.js') }}"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
