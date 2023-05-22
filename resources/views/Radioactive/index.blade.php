@extends('Template.layouts')

@section('main')
    <div class="pagetitle">
        <h2 class="fw-bold">Aset Alat</h2>
        <nav>
            <ol class="breadcrumb bg-primary">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                <li class="breadcrumb-item">Aset</li>
                <li class="breadcrumb-item active">Sumber RA</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-content-center mb-2">
                        <h4 class="card-title mb-0">Data Sumber RadioAktif </h4>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="mdi mdi-plus-circle"></i> Tambah data
                        </button>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    <p>
                        Menampilkan semua data sumber radioaktif yang disimpan
                        laboratorium instrumentasi Nuklir Poltek Nuklir
                    </p>
                    <div class="alert alert-warning">
                        <h6 class="fw-bold">
                            <i class="mdi mdi-information"></i> PETUNJUK!
                        </h6>
                        <ul class="mb-0">
                            <li>
                                Gunakan <strong> kolom pencarian</strong> di atas
                                tabel untuk mencari sumber.
                            </li>
                            <li>
                                Tekan <strong>header tabel</strong> untuk mengurutkan
                                ulang tabel berdasarkan nama kolom yang ditekan
                            </li>
                            <li>
                                Gunakan <strong>tombol</strong> detail untuk mengakses
                                detail sumber dan meminjam sumber
                            </li>
                            <li class="d-lg-none">
                                Geser tabel ke kanan untuk kolom yang lebih lengkap
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr class="bg-primary text-white text-center">
                                            <th>No Sumber</th>
                                            <th>Nama Sumber</th>
                                            <th>Aktivitas awal</th>
                                            <th>Tanggal pembuatan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                            <tr>
                                                <td>{{ $d->entry_number }}</td>
                                                <td>{{ $d->element_name . '-' . $d->isotope_number }}</td>
                                                <td>{{ $d->initial_activity }} &micro;Ci</td>
                                                <td>{{ $d->manufacturing_date->isoFormat('DD-MM-Y') }}</td>
                                                <td><span class="mdi {{ __("core.$d->status.symbol") }}"></span>
                                                    {{ __("core.$d->status.text") }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('radioactive.detail', ['radioactive' => $d->inventory_unique]) }}"
                                                        class="btn btn-light">
                                                        <i class="ti-eye text-primary"></i>View
                                                    </a>
                                                    <button class="btn btn-light">
                                                        <i class="ti-close text-danger"></i>Remove
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal tambah --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih mode</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <p>Pilih mode untuk menambah data.</p>
                    <ul>
                        <li>Tambah manual : untuk menambah satu data</li>
                        <li>
                            Upload file : upload file excel untuk menambah data secara
                            massal
                        </li>
                    </ul>
                    <div>
                        <a href="{{ route('radioactive.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-hand-cycle"></i> Tambah Manual
                        </a>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#uploadModal">
                            <i class="mdi mdi-upload"></i> Upload File
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal upload file --}}
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <div class="alert alert-info">
                        <strong>PERHATIAN!</strong> <br />
                        File yang dapat diterima hanya file yang memiliki format
                        .XLSX, .XLS, .CSV saja.
                    </div>
                    <form method="post" action="{{ route('tool.create.bulk') }}" id="uploadExcel"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">File upload</label>
                            <input type="file" name="toolFile" id="toolFile" class="form-control" />
                            <p class="text-danger">
                                Format yang diberikan tidak valid
                            </p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="uploadExcel">Unggah</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Tutup
                    </button>
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
