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

                                <div class="card-body">
                                    <h5 class="card-title">Kunjungan Kamu <span>| Total</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="mdi mdi-counter"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>145</h6>
                                            <span class="text-success small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

                                        </div>
                                    </div>
                                </div>

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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Keperluan</th>
                                        <th scope="col">Hari</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Waktu</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Brandon Jacob</td>
                                        <td>2016-05-25</td>
                                        <td>Jumat</td>
                                        <td>09.00 WIB</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora molestias
                                            nostrum assumenda, dignissimos quod architecto!</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <p class="card-text placeholder-glow">
                            <span class="placeholder bg-info col-7"></span>
                            <span class="placeholder bg-info col-4"></span>
                            <span class="placeholder bg-info col-4"></span>
                            <span class="placeholder bg-info col-6"></span>
                            <span class="placeholder bg-info col-8"></span>
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </main><!-- End #main -->

    <!-- Modal -->
    <div class="modal fade" id="presensiModal" tabindex="-1" aria-labelledby="presensiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="presensiModalLabel">Catat Kunjungan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="presensi">
                        <div class="row mb-3">
                            <label for="occupation" class="col-md-4 col-lg-3 col-form-label">Keperluan</label>
                            <div class="col-md-8 col-lg-9">
                                <select class="form-select" aria-label="Default select example" name="occupation">
                                    <option selected value="null">Pilih opsi</option>
                                    @foreach (App\Enums\PresensiEnum::cases() as $tipe)
                                        <option value="{{ $tipe }}">{{ __('activity.' . $tipe->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-lg-3 col-form-label">Keterangan</label>
                            <div class="col-md-8 col-lg-9">
                                <textarea name="description" class="form-control" id="description" style="height: 100px" maxlength="255"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="presensi">Simpan</button>
                </div>
            </div>
        </div>
    </div>
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

            $('#presensiModal').modal('hide');
        });
    </script>
@endsection
