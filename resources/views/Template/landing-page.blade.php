<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>LIS - Selamat datang!</title>

    <!-- {{-- MDI --}} -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" />


    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    {{-- Vendor base --}}
    <link rel="stylesheet" href="{{ asset('dist/vendor/css/vendor.bundle.base.css') }}" />

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('dist/css/style/style.css') }}" />
    <script src="{{ asset('dist/js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- endinject -->

    <!-- Favicons -->
    <link href="{{ asset('assets/icons/favicon-16x16.png') }}" rel="icon" />
    <link href="{{ asset('assets/icons/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    @stack('vendorStyle')
    <!-- Latest BS-Select compiled and minified CSS/JS -->


</head>

<body>

    <div class="container-scroller">
        @yield('main')
    </div>

</body>
@stack('vendorScript')
@yield('script')

</html>
