<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>SILAB - Insnuk</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="{{ asset('assets/icons/favicon-16x16.png') }}" rel="icon" />
    <link href="{{ asset('assets/icons/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap/bootstrap.css') }}">
    <!-- Vendor JS Files -->
    <script src="{{ asset('dist/js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- Template Main CSS File -->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" />

    {{-- MDI --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css">
    {{-- FontAwesom --}}
    <script src="https://kit.fontawesome.com/21c1c2d6a2.js" crossorigin="anonymous"></script>

    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @livewireStyles
</head>

<body>
    @include('Template.header')
    @include('Template.sidebar')

    @yield('main')

    @include('Template.footer')


</body>
<!-- Template Main JS File -->
<script src="{{ asset('dist/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@livewireScripts

@yield('script')


</html>
