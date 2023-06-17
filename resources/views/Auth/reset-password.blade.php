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
                            <h4>Reset Kata Sandi</h4>
                            <h6 class="fw-light">Kata sandi baru akan dikirim ke email yang dimasukkan</h6>
                            {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif --}}
                            @if (session('success'))
                                <div class="alert alert-success">
                                    Kata sandi telah dirubah, silakan cek Email anda!
                                </div>
                            @endif
                            <form action="{{ route('reset-password.form') }}" method="post">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <label for="email">Surel</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control form-control-sm">
                                        @error('email')
                                            <label class="error text-danger">
                                                {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <hr class="text-muted">
                            <a href="{{ route('login') }}" class="btn btn-primary">Halaman Depan</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection

@push('vendorScript')
    <script src="{{ asset('dist/js/jquery-3.6.4.min.js') }}"></script>
@endpush

@section('script')
    <script>
        console.log('Created by Bomsiwor');
    </script>
@endsection
