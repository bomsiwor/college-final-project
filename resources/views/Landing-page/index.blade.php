<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>LIS - Insnuk. Selamat datang!</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/icons/favicon-16x16.png') }}" rel="icon" />
    <link href="{{ asset('assets/icons/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('dist/landing-page/vendor/aos/aos.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" />
    {{-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('dist/landing-page/vendor/glightbox/css/glightbox.min.css') }}">
    <link href="{{ asset('dist/landing-page/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('dist/landing-page/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Bootslander
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <h1><a href="index.html"><span class="text-success">LIS</span>-<span>Insnuk</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Utama</a></li>
                    <li><a class="nav-link scrollto" href="#about">Agenda</a></li>
                    <li><a class="nav-link scrollto" href="#features">Fitur</a></li>
                    <li><a class="nav-link scrollto" href="#team">Organisasi</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
                </ul>
                <i class="mdi mdi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">

        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
                    <div data-aos="zoom-out">
                        <h1>Selamat Datang di <span>Laboratorium Instrumentasi Nuklir</span></h1>
                        <h2>Terintegrasi dengan data radioisotop IAEA. Login untuk mendapatkan layanan yang lebih
                            lengkap!</h2>
                        <div class="text-center text-lg-start">
                            <a href="{{ route('dashboard.index') }}" class="btn-get-started scrollto">Login</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
                    <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
            </g>
        </svg>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container-fluid">

                <div class="row">
                    <!-- <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch" data-aos="fade-right">
            <a href="https://www.youtube.com/watch?v=StpBR2W8G5A" class="glightbox play-btn mb-4"></a>
          </div> -->

                    <div class="col-lg-5 icon-boxes py-5 px-lg-5">
                        <h3>Agenda hari ini</h3>
                        @if ($agendas->isNotEmpty())
                            <p>Kegiatan yang berlangsung pada laboratorium instrumentasi nuklir hari ini :</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kegiatan</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($agendas as $agenda)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $agenda->agenda_name }}</td>
                                            <td>{{ $agenda->start_time }} -
                                                {{ $agenda->end_time }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p>Anda dapat melihat detail kegiatan setelah login!</p>
                        @else
                            <p>Tidak ada agenda!</p>
                        @endif
                    </div>

                    <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5"
                        data-aos="fade-left">
                        <h3>Tentang Laboratorium</h3>
                        <p>Laboratorium instrumentasi nuklir berperan sebagai tempat praktik, penerapan teori,
                            penelitian, dan pengembangan keilmuan di Poltek Nuklir. Melalui peran ini, laboratorium ini
                            menjadi elemen penting dalam pendidikan dan penelitian, khususnya dalam bidang pembelajaran.
                        </p>

                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon"><i class="mdi mdi-school"></i></div>
                            <h4 class="title"><a href="">Pusat praktik, latihan, dan sumber pembelajaran</a>
                            </h4>
                            <p class="description">Menyediakan tempat untuk praktik, latihan, dan sumber pembelajaran
                                terkait materi instrumentasi nuklir bagi dosen dan mahasiswa di Poltek Nuklir.</p>
                        </div>

                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
                            <div class="icon"><i class="mdi mdi-chemical-weapon"></i></div>
                            <h4 class="title"><a href="">Pusat penelitian, pengembangan, dan pengabdian
                                    masyarakat</a></h4>
                            <p class="description">Menjadi pusat penelitian, pengembangan, dan pengabdian masyarakat
                                terkait materi instrumentasi nuklir bagi dosen dan mahasiswa di Poltek Nuklir.</p>
                        </div>

                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
                            <div class="icon"><i class="mdi mdi-atom"></i></div>
                            <h4 class="title"><a href="">Pusat pengembangan keilmuan nuklir bidang
                                    instrumentasi</a></h4>
                            <p class="description">Fokus pada pengembangan keilmuan nuklir dalam bidang instrumentasi
                                seperti Instrumentasi Nuklir, Elektronika Nuklir, Proteksi Radiasi, Alat Ukur Radiasi,
                                dan Spektroskopi Radiasi Nuklir.</p>
                        </div>

                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Features Section ======= -->
        <section id="features" class="features">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Fitur Layanan</h2>
                    <p>Layanan yang tersedia</p>
                </div>

                <div class="row" data-aos="fade-left">
                    <div class="col-lg-3 col-md-4">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
                            <i class="mdi mdi-location-enter" style="color: #ffbb2c;"></i>
                            <h3><a href="">Daftar kunjungan</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                            <i class="mdi mdi-smoke-detector-alert" style="color: #5578ff;"></i>
                            <h3><a href="">Pencatatan penggunaan detektor</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="150">
                            <i class="mdi mdi-swap-horizontal" style="color: #e80368;"></i>
                            <h3><a href="">Peminjaman & Pengembalian aset</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
                            <i class="mdi mdi-zip-box" style="color: #e361ff;"></i>
                            <h3><a href="">Data aset dan sumber radioisotop</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="250">
                            <i class="mdi mdi-document" style="color: #47aeff;"></i>
                            <h3><a href="">Akses dokumen terkait Lab</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
                            <i class="mdi mdi-calendar" style="color: #ffa76e;"></i>
                            <h3><a href="">Cek agenda Lab</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="350">
                            <i class="mdi mdi-atom" style="color: #11dbcf;"></i>
                            <h3><a href="">Pencatatan dosis radiasi</a></h3>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Features Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container">

                <div class="row justify-content-center" data-aos="fade-up">

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="mdi mdi-counter"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $count }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Pengunjung</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->


        <!-- ======= Team Section ======= -->
        <section id="team" class="team">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Organisasi</h2>
                    <p>Pengelolaan Laboratorium</p>
                </div>

                <div class="row justify-content-center" data-aos="fade-left">

                    <div class="col-lg-3 col-md-6">
                        <div class="member" data-aos="zoom-in" data-aos-delay="100">
                            <div class="pic"><img src="assets/img/team/team-1.jpg" class="img-fluid"
                                    alt=""></div>
                            <div class="member-info">
                                <h4>Toto Trikasjono, M.Kes</h4>
                                <span>Kepala Laboratorium</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                        <div class="member" data-aos="zoom-in" data-aos-delay="200">
                            <div class="pic"><img src="assets/img/team/team-2.jpg" class="img-fluid"
                                    alt=""></div>
                            <div class="member-info">
                                <h4>Risky Nurseila Karthika, SST</h4>
                                <span>Pelaksana Fungsi Laboratorium</span>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </section><!-- End Team Section -->



        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Kontak</h2>
                    <p>Hubungi kami</p>
                </div>

                <div class="row">

                    <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
                        <div class="info">
                            <div class="address">
                                <i class="mdi mdi-pin"></i>
                                <h4>Alamat</h4>
                                <p>Politeknik Teknologi Nuklir Indonesia - Lantai 4</p>
                                <p>Jl. Babarsari POB 6101 YKBB Yogyakarta Indonesia 55281 </p>
                            </div>

                            <div class="email">
                                <i class="mdi mdi-mail"></i>
                                <h4>Email:</h4>
                                <p>info@example.com</p>
                            </div>

                            <div class="phone">
                                <i class="mdi mdi-phone"></i>
                                <h4>Call:</h4>
                                <p>+1 5589 55488 55s</p>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
                        @if (session('success'))
                            <div class="alert alert-success">
                                Pesan sukses dikirimkan!
                            </div>
                        @endif
                        <form action="{{ route('dashboard.message.store') }}" method="post" role="form"
                            class="php-email-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Nama anda" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Email anda" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subjek" required>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message_text" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="text-center"><button type="submit">Kirim Pesan</button></div>
                        </form>

                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row d-flex justify-content-between">

                    <div class="col-lg-4">
                        <h3 class="text-white fw-bold">Politeknik Teknologi Nuklir Indonesia</h3>
                        <h3><small>Badan Riset & Inovasi Nasional</small></h3>
                        <p>Jl. Babarsari POB 6101 YKBB Yogyakarta Indonesia 55281 </p>
                    </div>

                    <div class="col-lg-4 d-flex align-items-center gap-2">

                        <div class="bg-white p-3 rounded">
                            <img src="{{ asset('assets/img/dashboard/poltek-logo.png') }}" alt="Logo poltek"
                                style="max-width: 80px">
                        </div>

                        <div class="bg-white p-2 rounded">
                            <img src="{{ asset('assets/img/dashboard/logo-brin.png') }}" alt="Logo poltek"
                                style="max-height: 80px">
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Designed by <strong><span>Bootslander</span></strong>. Orchestrated by Bomsiwor
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="mdi mdi-arrow-up"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('dist/landing-page/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('dist/landing-page/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/landing-page/vendor/glightbox/js/glightbox.js') }}"></script>

    <script src="{{ asset('dist/landing-page/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('dist/landing-page/js/main.js') }}"></script>

</body>

</html>
