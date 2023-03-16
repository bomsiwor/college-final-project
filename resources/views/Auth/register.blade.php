@extends('Auth.layout')

@section('main')
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="" />
                                <span class="d-none d-lg-block">Smart Lab</span>
                            </a>
                        </div>
                        <!-- End Logo -->

                        @livewire('register-component')

                        <div class="credits">
                            <!-- All the links in the footer should remain intact. -->
                            <!-- You can delete the links only if you purchased the pro version. -->
                            <!-- Licensing information: https://bootstrapmade.com/license/ -->
                            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                            Designed by
                            <a href="https://bootstrapmade.com/">Bomsiwor</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </main>
@endsection

@section('addScript')
    <script>
        console.log('Created by Bomsiwor');
    </script>
@endsection
