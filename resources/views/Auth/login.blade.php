@extends('Auth.layout')

@section('main')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <!-- Kolom Kiri -->
                    <div
                        class="col-lg-6 d-flex align-items-center justify-content-center animate__animated animate__fadeInLeft">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <img src="{{ asset('assets/img/logo-insnuk.png') }}" alt="logo" />
                            </div>
                            <h4>Selamat Datang!</h4>
                            <h6 class="fw-light">Senang bertemu dengan anda.</h6>
                            @if (session()->exists('registerSuccess'))
                                <div class="alert alert-fill-success mb-0" role="alert">
                                    <i class="ti-info-alt"></i>
                                    Sukses mendaftar! Silakan login untuk melanjutkan dan
                                    menikmati fitur lain.
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="pt-1" method="post" action="/auth">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail">Surel</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa-regular fa-user text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="email" name="email"
                                            class="form-control form-control-lg border-left-0" id="exampleInputEmail"
                                            placeholder="Surel" value="{{ old('email') }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword">Kata Sandi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa-solid fa-lock text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg border-left-0"
                                            id="exampleInputPassword" name="password" placeholder="Password" />
                                    </div>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" name="remember" class="form-check-input" />
                                            Ingat saya
                                            <i class="input-helper"></i></label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Lupa kata sandi?</a>
                                </div>
                                <div class="my-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary font-weight-medium auth-form-btn">LOGIN</button>
                                </div>
                            </form>
                            <div class="text-center text-muted mb-1">
                                Atau masuk menggunakan
                            </div>
                            <div class="mb-2 d-flex justify-content-center">
                                <button type="button" class="btn btn-social-icon btn-outline-facebook mx-3">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </button>
                                <button type="button" class="btn btn-social-icon btn-outline-twitter mx-2">
                                    <i class="fa-brands fa-github"></i>
                                </button>
                                <button type="button" class="btn btn-social-icon btn-outline-linkedin mx-2">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </button>
                                <button type="button" class="btn btn-social-icon btn-outline-google mx-2">
                                    <i class="fa-brands fa-google"></i>
                                </button>
                            </div>
                            <div class="text-center mt-4 fw-light">
                                Belum memiliki akun?
                                <a href="{{ route('register') }}" class="text-primary">Daftar</a>
                            </div>
                        </div>
                    </div>

                    <!-- Gambar Login -->
                    <div class="col-lg-6 login-half-bg d-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">
                            Copyright © 2021 All rights reserved. <br />
                            Designed by Bomsiwor © 2023 All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
