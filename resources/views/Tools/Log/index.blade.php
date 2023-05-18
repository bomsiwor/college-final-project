@extends('Template.layouts')

@push('vendorScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('main')
    <div class="pagetitle">
        <h2 class="fw-bold">Semua Catatan Penggunaan Alat</h2>
        <nav>
            <ol class="breadcrumb bg-primary">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                <li class="breadcrumb-item">Aktivitas</li>
                <li class="breadcrumb-item active">Presensi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-content-center mb-2">
                        <h4 class="card-title mb-0">Pilih Alat</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card border border-primary my-1">
                                <div class="card-body">
                                    <div class="d-sm-flex flex-row flex-wrap text-start align-items-center">
                                        <img src="../../../../images/faces/face11.jpg" class="img-lg rounded"
                                            alt="profile image">
                                        <div class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                            <h6 class="mb-0">GM</h6>
                                            <p class="text-muted mb-1">Detektor Geiger Muller</p>
                                            <a href="{{ route('tool.logs.show', ['flag' => 'gm']) }}"
                                                class="btn btn-sm btn-primary">Lihat data <span
                                                    class="mdi mdi-arrow-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card border border-primary my-1">
                                <div class="card-body">
                                    <div class="d-sm-flex flex-row flex-wrap text-start align-items-center">
                                        <img src="../../../../images/faces/face11.jpg" class="img-lg rounded"
                                            alt="profile image">
                                        <div class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                            <h6 class="mb-0">NaI(Tl)</h6>
                                            <p class="text-muted mb-1">Detektor Sintilasi</p>
                                            <a href="{{ route('tool.logs.show', ['flag' => 'naitl']) }}"
                                                class="btn btn-sm btn-primary">Lihat data <span
                                                    class="mdi mdi-arrow-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card border border-primary my-1">
                                <div class="card-body">
                                    <div class="d-sm-flex flex-row flex-wrap text-start align-items-center">
                                        <img src="../../../../images/faces/face11.jpg" class="img-lg rounded"
                                            alt="profile image">
                                        <div class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                            <h6 class="mb-0">Alpha</h6>
                                            <p class="text-muted mb-1">Spektroskopi Alpha</p>
                                            <a href="{{ route('tool.logs.show', ['flag' => 'alpha']) }}"
                                                class="btn btn-sm btn-primary">Lihat data <span
                                                    class="mdi mdi-arrow-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card border border-primary my-1">
                                <div class="card-body">
                                    <div class="d-sm-flex flex-row flex-wrap text-start align-items-center">
                                        <img src="../../../../images/faces/face11.jpg" class="img-lg rounded"
                                            alt="profile image">
                                        <div class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                            <h6 class="mb-0">CdTe</h6>
                                            <p class="text-muted mb-1">Detektor Sintilasi</p>
                                            <a href="{{ route('tool.logs.show', ['flag' => 'cdte']) }}"
                                                class="btn btn-sm btn-primary">Lihat data <span
                                                    class="mdi mdi-arrow-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card border border-primary my-1">
                                <div class="card-body">
                                    <div class="d-sm-flex flex-row flex-wrap text-start align-items-center">
                                        <img src="../../../../images/faces/face11.jpg" class="img-lg rounded"
                                            alt="profile image">
                                        <div class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                            <h6 class="mb-0">XRF</h6>
                                            <p class="text-muted mb-1">Detektor XRF</p>
                                            <a href="{{ route('tool.logs.show', ['flag' => 'xrf']) }}"
                                                class="btn btn-sm btn-primary">Lihat data <span
                                                    class="mdi mdi-arrow-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('vendorStyle')
    <link rel="stylesheet" href="{{ asset('dist/vendor/dataTables/dataTables.bootstrap4.css') }}">
@endpush

@push('vendorScript')
    <script src="{{ asset('dist/vendor/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dist/vendor/dataTables/dataTables.bootstrap4.js') }}"></script>
@endpush

@section('script')
    <script>
        (function($) {
            "use strict";
            $(function() {
                $("#order-listing").DataTable({
                    aLengthMenu: [
                        [5, 10, 15, -1],
                        [5, 10, 15, "All"],
                    ],
                    iDisplayLength: 10,
                    language: {
                        search: "Apply filter _INPUT_ to table",
                        zeroRecords: "Tidak ada data",
                        info: "Menampilkan _PAGE_ dari _PAGES_ halaman",
                        lengthMenu: "Menampilkan _MENU_ data per halaman",
                        infoEmpty: "Tidak ditemukan",
                        infoFiltered: " - dipilah dar _MAX_ data",
                        paginate: {
                            next: "Selanjutnya",
                            previous: "Sebelum",
                        },
                    },
                });
                $("#order-listing").each(function() {
                    var datatable = $(this);
                    // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                    var search_input = datatable
                        .closest(".dataTables_wrapper")
                        .find("div[id$=_filter] input");
                    search_input.attr("placeholder", "Search");
                    search_input.removeClass("form-control-sm");
                    // LENGTH - Inline-Form control
                    var length_sel = datatable
                        .closest(".dataTables_wrapper")
                        .find("div[id$=_length] select");
                    length_sel.removeClass("form-control-sm");
                });
            });
        })(jQuery);
    </script>
@endsection
