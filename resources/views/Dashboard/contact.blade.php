@extends('Template.layouts')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Contact</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Contact</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section contact">

            <div class="row gy-4">

                <div class="col-xl-6">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="info-box card">
                                <i class="mdi mdi-map-marker"></i>
                                <h3>Alamat</h3>
                                <p> <b> Politeknik Teknologi Nuklir Indonesia (Lantai 4)</b><br><br>Jl. Babarsari Kotak POB
                                    6101/YKKB,
                                    Ngentak,
                                    Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281, Indonesia
                                </p>
                                <a href="https://goo.gl/maps/ApLGkXi3HNGe43A79" class="btn btn-primary">Google Maps</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box card">
                                <i class="mdi mdi-phone"></i>
                                <h3>Nomor kami</h3>
                                <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box card">
                                <i class="mdi mdi-email-fast-outline"></i>
                                <h3>Kirim Surel!</h3>
                                <a href="mailto:bomsiwor@gmail.com?subject=Subject%20Line%20Text%20">bomsiwor@gmail.com</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box card">
                                <i class="mdi mdi-clock-outline"></i>
                                <h3>Hari Kerja</h3>
                                <p>Monday - Friday<br>9:00WIB - 16:00WIB</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-6">
                    <div class="card p-4">
                        <div class="card-body mb-0">
                            <p>Kirim kan pesan, pertanyaan, kritik, atau saran untuk pelayanan kami. Untuk jawaban yang
                                lebih cepat, langsung ketuk nomor telepon kami.</p>
                        </div>
                        <form action="/" method="post" class="php-email-form mt-1">
                            <div class="row gy-4">
                                @guest
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" placeholder="Nama Anda"
                                            required>
                                    </div>

                                    <div class="col-md-6 ">
                                        <input type="email" class="form-control" name="email" placeholder="Email anda"
                                            required>
                                    </div>
                                @endguest

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subjek" required>
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Pesan" required></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Kirim Pesan</button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </section>

    </main><!-- End #main -->
@endsection
