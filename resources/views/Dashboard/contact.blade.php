@extends('Template.layouts')

@section('main')
    <h2 class="fw-bold">Hubungi Kami</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item active">Kontak</li>
        </ol>
    </nav>

    <section id="contact">
        <div class="row gy-4">
            <div class="col-xl-6 animate__animated animate__fadeIn animate__delay-1s">
                <div class="row">
                    {{-- Alamat --}}
                    <div class="col-lg-6 my-2">
                        <div class="card">
                            <div class="card-body">
                                <h3><span class="mdi mdi-map-marker"></span> Alamat</h3>
                                <p> <b> Politeknik Teknologi Nuklir Indonesia (Lantai 4)</b><br><br>Jl. Babarsari Kotak
                                    POB
                                    6101/YKKB,
                                    Ngentak,
                                    Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281,
                                    Indonesia
                                </p>
                                <a href="https://goo.gl/maps/ApLGkXi3HNGe43A79" class="btn btn-primary">Google Maps</a>
                            </div>
                        </div>
                    </div>
                    {{-- Kontak --}}
                    <div class="col-lg-6 my-2">
                        <div class="card">
                            <div class="card-body">
                                <h3><span class="mdi mdi-whatsapp"></span> Nomor kami</h3>
                                <p>Hubungi pengelola via Whatsapp</p>
                                <a href="https://wa.link/mfq5u5" class="btn btn-success"><span
                                        class="mdi mdi-whatsapp">Tekan untuk WA</span></a>
                            </div>
                        </div>
                    </div>
                    {{-- Surel --}}
                    <div class="col-lg-6 my-2">
                        <div class="card">
                            <div class="card-body">
                                <h3><span class="mdi mdi-email-fast-outline"></span> Kirim Surel!</h3>
                                <a href="mailto:bomsiwor@gmail.com?subject=Subject%20Line%20Text%20">bomsiwor@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    {{-- Jam Kerja --}}
                    <div class="col-lg-6 my-2">
                        <div class="card">
                            <div class="card-body">
                                <h3><span class="mdi mdi-clock-outline"></span> Hari Kerja</h3>
                                <p>Monday - Friday<br>9:00WIB - 16:00WIB</p>
                            </div>
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
                                    <input type="text" name="name" class="form-control" placeholder="Nama Anda" required>
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Email anda" required>
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
                                <div class="sent-message">Pesan anda sudah terkirim!</div>

                                <button type="submit" class="btn btn-outline-primary">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </section>
@endsection
