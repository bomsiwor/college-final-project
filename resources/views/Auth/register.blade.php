@extends('Auth.layout')

@section('main')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">

            <div class="content-wrapper d-flex align-items-center auth px-0">

                <div class="row w-100 mx-0">
                    <div class="col-lg-6 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="{{ asset('assets/img/logo-insnuk.png') }}" alt="logo">
                            </div>
                            <h4>Registrasi</h4>
                            <h6 class="fw-light">Isi data-data yang diperlukan</h6>
                            @livewire('register-component')
                            <hr class="text-muted">
                            <p>Sudah mendaftar ? <a href="{{ route('login') }}"> Login disini</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection

@push('vendorStyle')
    <link rel="stylesheet" href="{{ asset('dist/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endpush

@push('vendorScript')
    <script src="{{ asset('dist/js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/select2/select2.min.js') }}"></script>
@endpush

@section('script')
    <script>
        console.log('Created by Bomsiwor');
    </script>
@endsection
