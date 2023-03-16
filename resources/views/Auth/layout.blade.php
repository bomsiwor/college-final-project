<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Smart Lab - Insnuk</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/icons/favicon-16x16.png') }}" rel="icon" />
    <link href="{{ asset('assets/icons/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap/bootstrap.min.css') }}">
    <!-- Vendor JS Files -->
    <script src="{{ asset('dist/js/bootstrap/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('dist/js/jquery-3.6.4.min.js') }}"></script>

    <!-- Template Main CSS File -->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" />

    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css" />
    @livewireStyles
    <main>
</head>

<body>
    @yield('main')
    <!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>



    <!-- Template Main JS File -->
    <script src="{{ asset('dist/js/main.js') }}"></script>
    @livewireScripts

    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    @yield('addScript')

</body>

</html>
