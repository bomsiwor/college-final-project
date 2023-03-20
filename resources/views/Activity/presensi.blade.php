@extends('Template.layouts')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Blank Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Blank</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        {{-- Counter --}}
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="mdi mdi-dots-horizontal-circle-outline"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Minggu ini</a></li>
                                        <li><a class="dropdown-item" href="#">Bulan ini</a></li>
                                    </ul>
                                </div>

                                @livewire('attendance-count')

                            </div>
                        </div>
                        {{-- End Counter --}}

                        {{-- Presensi Button --}}
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Presensi</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="mdi mdi-crosshairs-gps"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span class="text-muted">Tekan untuk presensi</span>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#presensiModal">
                                                CATAT
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- End Button --}}
                    </div>
                </div>



            </div>
        </section>
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Riwayat Kunjungan</h5>
                        <p>Menampilkan riwayat kunjungan kamu ke laboratorium instrumentasi nuklir
                        </p>
                        @livewire('attendance-table', ['idUser' => auth()->user()->id])
                    </div>
                </div>

            </div>
        </div>

    </main><!-- End #main -->

    <!-- Modal -->
    @livewire('attendance-component')
@endsection

@section('script')
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
@endsection
