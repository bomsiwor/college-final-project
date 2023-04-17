<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>LIS - INSNUK</title>

    {{-- CSS PLUGIN --}}
    <!-- {{-- MDI --}} -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" />
    <!-- {{-- FontAwesom --}} -->
    <script src="https://kit.fontawesome.com/21c1c2d6a2.js" crossorigin="anonymous"></script>

    {{-- Themify --}}
    <link rel="stylesheet" href="{{ asset('dist/vendor/ti-icons/css/themify-icons.css') }}" />

    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    {{-- Vendor base --}}
    <link rel="stylesheet" href="{{ asset('dist/vendor/css/vendor.bundle.base.css') }}" />

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('dist/css/style/style.css') }}" />
    <!-- endinject -->

    <!-- Favicons -->
    <link href="{{ asset('assets/icons/favicon-16x16.png') }}" rel="icon" />
    <link href="{{ asset('assets/icons/apple-touch-icon.png') }}" rel="apple-touch-icon" />

</head>

<body>
    @yield('main')
    <!-- plugins:js -->
    <script src="{{ asset('dist/js/vendor.bundle.base.js') }}"></script>

    <!-- endinject -->
</body>

</html>
