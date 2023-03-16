@extends('Auth.layout')

@section('main')
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <!-- Logo -->
                            <div class="d-flex justify-content-center py-4">
                                <a href="#" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="" />
                                    <span class="d-none d-lg-block">Insnuk Merdeka</span>
                                </a>
                            </div>
                            <!-- End Logo -->

                            <div class="card mb-3 d-flex flex-row animate__animated animate__fadeInDown">
                                <img src="https://source.unsplash.com/random/?laboratory"
                                    class="img-fluid rounded-end overflow-hidden d-none d-md-block order-1 z-0 mh-50"
                                    alt="" />

                                <div class="card-body flex-grow-1 z-1">
                                    <div class="mt-4">
                                        @if (session()->exists('registerSuccess'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Pendaftaran akun sukses!</strong> Silakan login
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">
                                            Selamat datang! &#129409;
                                        </h5>
                                        <p class="text-center small">Masuk untuk melanjutkan</p>
                                    </div>

                                    <form class="row g-3 needs-validation" method="POST" action="/auth" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="email" class="form-label">Username / Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="email" class="form-control" id="email"
                                                    required />
                                                <div class="invalid-feedback">Tidak valid.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                required />
                                            <div class="invalid-feedback">Masukkan password</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    value="true" id="rememberMe" />
                                                <label class="form-check-label" for="rememberMe">Ingat saya</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">
                                                Masuk
                                            </button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">
                                                Belum punya akun?
                                                <a href="{{ route('register') }}">Daftar!</a>
                                            </p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                Designed by
                                <a href="#">Bomsiwor</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
