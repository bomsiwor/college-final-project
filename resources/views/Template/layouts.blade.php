<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>LIS - {{ $title }}</title>

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
    <link rel="stylesheet" href="{{ asset('dist/css/perfect-scrollbar.css') }}">
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
        <!-- partial:../../partials/_navbar.html -->
        @include('Template.header')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            @include('Template.sidebar')
            <!-- partial -->

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('main')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                @include('Template.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->

    <!-- endinject -->
</body>
{{-- JS BS, Jquery ,Scrollbar --}}


<script src="{{ asset('dist/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('dist/js/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist/js/off-canvas.js') }}"></script>
<script src="{{ asset('dist/js/template.js') }}"></script>
@stack('vendorScript')
@yield('script')

</html>
