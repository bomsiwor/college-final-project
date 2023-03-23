@extends('Template.layouts')

@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Pagu</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Pagu</a></li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Menu Cepat</h6>
                            <div class="row">
                                {{-- Absen --}}
                                <div class="col-md-4">
                                    <div class="card text-bg-dark mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title text-white"><i class="mdi mdi-pin"></i>Presensi cepat</h5>
                                            <p class="card-text small">Tekan tombol untuk presensi segera.</p>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                                data-bs-target="#presensiModal">
                                                CATAT
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Log Alat --}}
                                <div class="col-md-4">
                                    <div class="card text-bg-dark mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title text-white"><i class="mdi mdi-tools"></i>Logging Alat</h5>
                                            <p class="card-text small">Tekan tombol untuk mencatat penggunaan alat.</p>
                                            <button class="btn btn-light">CATAT</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Log Radiasi --}}
                                <div class="col-md-4">
                                    <div class="card text-bg-dark mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title text-white"><i class="mdi mdi-radioactive"></i>Logging
                                                Radiasi</h5>
                                            <p class="card-text small">Tekan tombol untuk mencatat dosis diterima.</p>
                                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                                data-bs-target="#radiationLogModal">
                                                CATAT
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-primary" role="alert">
                                <h4 class="alert-heading"><i class="mdi mdi-information-slab-box-outline"></i> Informasi!
                                </h4>
                                <p class="small">Kamu bisa menemukan menu layanan lain dengan menekan 3 garis di pojok kiri
                                    atas.</p>
                                <hr>
                                <p class="mb-0 small">Kamu juga bisa mengkustomisasi <b>Profil</b> kamu &amp; menuju
                                    <b>Halaman Bantuan</b>
                                    dengan menekan foto profil di pojok kanan atas. <br><b>Selamat menikmati layanan
                                        kami!</b>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Daftar peminjaman --}}
                    <div class="dashboard">
                        <div class="card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="mdi mdi-dots-horizontal-circle-outline"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                                    <li><a class="dropdown-item" href="#">3 hari</a></li>
                                    <li><a class="dropdown-item" href="#">Minggu ini</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Aktivitas Peminjaman <span>| Hari ini</span></h5>
                                <p>Menampilkan maksimum 10 peminjaman terakhir.</p>
                                <!-- Table with hoverable rows -->
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama Peminjam</th>
                                                <th scope="col">Keperluan</th>
                                                <th scope="col">Tanggal peminjaman</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Brandon Jacob</td>
                                                <td>Praktikum</td>
                                                <td>Senin, 28 Februari 2023</td>
                                                <td><span class="badge border-primary border text-primary">Disetujui</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jono Kusman</td>
                                                <td>Pelatihan</td>
                                                <td>Senin, 28 Februari 2023</td>
                                                <td><span class="badge border-warning border text-warning">Pending</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>David</td>
                                                <td>Main</td>
                                                <td>Senin, 28 Februari 2023</td>
                                                <td><span class="badge border-danger border text-danger">Ditolak</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- End Table with hoverable rows -->
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Daftar alat random --}}
                    <div class="dashboard">
                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body pb-0">
                                    <h5 class="card-title">Top Selling <span>| Today</span></h5>

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Preview</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Sold</th>
                                                <th scope="col">Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <a href="#"><img src="{{ asset('assets/img/no-image.png') }}"
                                                            alt="" /></a>
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary fw-bold">Ut inventore ipsa
                                                        voluptas
                                                        nulla</a>
                                                </td>
                                                <td>$64</td>
                                                <td class="fw-bold">124</td>
                                                <td>$5,828</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <a href="#"><img src="{{ asset('assets/img/no-image.png') }}"
                                                            alt="" /></a>
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary fw-bold">Exercitationem
                                                        similique
                                                        doloremque</a>
                                                </td>
                                                <td>$46</td>
                                                <td class="fw-bold">98</td>
                                                <td>$4,508</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <a href="#"><img src="{{ asset('assets/img/no-image.png') }}"
                                                            alt="" /></a>
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary fw-bold">Doloribus nisi
                                                        exercitationem</a>
                                                </td>
                                                <td>$59</td>
                                                <td class="fw-bold">74</td>
                                                <td>$4,366</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <a href="#"><img src="{{ asset('assets/img/no-image.png') }}"
                                                            alt="" /></a>
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary fw-bold">Officiis quaerat sint
                                                        rerum
                                                        error</a>
                                                </td>
                                                <td>$32</td>
                                                <td class="fw-bold">63</td>
                                                <td>$2,016</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <a href="#"><img src="{{ asset('assets/img/no-image.png') }}"
                                                            alt="" /></a>
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary fw-bold">Sit unde debitis
                                                        delectus
                                                        repellendus</a>
                                                </td>
                                                <td>$79</td>
                                                <td class="fw-bold">41</td>
                                                <td>$3,239</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- End Top Selling -->
                    </div>
                </div>

                {{-- Kolom kanan --}}
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Pengunjung Terakhir</h5>
                            <p>Menampilkan 10 pengunjung terbaru Laboratorium Instrumentasi Nuklir</p>

                            @livewire('attendance-table')

                        </div>
                    </div>

                    <!-- Website Traffic -->
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body pb-0">
                            <h5 class="card-title">Website Traffic <span>| Today</span></h5>

                            <div id="trafficChart" style="min-height: 350px;" class="echart text-center"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    echarts.init(document.querySelector("#trafficChart")).setOption({
                                        tooltip: {
                                            trigger: 'item'
                                        },
                                        legend: {
                                            top: '5%',
                                            left: 'center'
                                        },
                                        series: [{
                                            name: 'Keperluan',
                                            type: 'pie',
                                            radius: ['50%', '70%'],
                                            avoidLabelOverlap: false,
                                            label: {
                                                show: false,
                                                position: 'center'
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                            labelLine: {
                                                show: false
                                            },
                                            data: {{ Js::from($stats) }}
                                        }]
                                    });
                                });
                            </script>

                        </div>
                    </div><!-- End Website Traffic -->

                    <!-- News & Updates Traffic -->
                    <div class="dashboard">
                        <div class="card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body pb-0">
                                <h5 class="card-title">
                                    Posting &amp; Berita <span>| Hari ini</span>
                                </h5>

                                <div class="news">
                                    <div class="post-item clearfix">
                                        <img src="{{ asset('assets/img/no-image.png') }}" alt="" />
                                        <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                                        <p>
                                            Sit recusandae non aspernatur laboriosam. Quia enim
                                            eligendi sed ut harum...
                                        </p>
                                    </div>

                                    <div class="post-item clearfix">
                                        <img src="{{ asset('assets/img/no-image.png') }}" alt="" />
                                        <h4><a href="#">Quidem autem et impedit</a></h4>
                                        <p>
                                            Illo nemo neque maiores vitae officiis cum eum turos elan
                                            dries werona nande...
                                        </p>
                                    </div>

                                    <div class="post-item clearfix">
                                        <img src="{{ asset('assets/img/no-image.png') }}" alt="" />
                                        <h4>
                                            <a href="#">Id quia et et ut maxime similique occaecati ut</a>
                                        </h4>
                                        <p>
                                            Fugiat voluptas vero eaque accusantium eos. Consequuntur
                                            sed ipsam et totam...
                                        </p>
                                    </div>

                                    <div class="post-item clearfix">
                                        <img src="{{ asset('assets/img/no-image.png') }}" alt="" />
                                        <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                                        <p>
                                            Qui enim quia optio. Eligendi aut asperiores enim
                                            repellendusvel rerum cuder...
                                        </p>
                                    </div>

                                    <div class="post-item clearfix">
                                        <img src="{{ asset('assets/img/no-image.png') }}" alt="" />
                                        <h4>
                                            <a href="#">Et dolores corrupti quae illo quod dolor</a>
                                        </h4>
                                        <p>
                                            Odit ut eveniet modi reiciendis. Atque cupiditate libero
                                            beatae dignissimos eius...
                                        </p>
                                    </div>
                                </div>
                                <!-- End sidebar recent posts-->
                            </div>
                        </div>
                    </div>
                    <!-- End News & Updates -->
                </div>
            </div>
        </section>
    </main>
    {{-- Modal Presensi --}}
    @livewire('attendance-component')

    {{-- Modal Radiasi --}}
    @livewire('radiation-log-component')


    <!-- End #main -->
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.1/echarts.min.js"
        integrity="sha512-OTbGFYPLe3jhy4bUwbB8nls0TFgz10kn0TLkmyA+l3FyivDs31zsXCjOis7YGDtE2Jsy0+fzW+3/OVoPVujPmQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $("#presensi").submit(function(e) {
            e.preventDefault();
            Swal.fire(
                'Sukses',
                'Menyimpan data kunjungan',
                'success'
            );
            Livewire.emit('isiPresensi');
            $('#presensiModal').modal('hide');
        });
    </script>

    <script>
        $("#radiationLog").submit(function(e) {
            e.preventDefault();
            Swal.fire('Any fool can use a computer');
            $('#radiationLogModal').modal('hide');
        });
    </script>
@endsection

@push('vendorScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
