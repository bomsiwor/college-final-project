@extends('Template.layouts')

@push('vendorScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('main')
    <h2 class="fw-bold">Catatan Penerimaan Radiasi</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Aktivitas</a></li>
            <li class="breadcrumb-item active">Penerimaan Radiasi</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-content-center mb-2">
                        <h4 class="card-title mb-0">Catatan Penerimaan Radiasi</h4>
                    </div>
                    <p>
                        Data penerimaan radiasi pengguna laboratorium Insnuk.
                    </p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr class="bg-primary text-white text-center">
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Keperluan</th>
                                            <th>Tanggal</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Dosis</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $da)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $da->user->name }}</td>
                                                <td>{{ __('activity.' . $da->purpose) }}</td>
                                                <td>@tanggal($da->log_date)
                                                </td>
                                                <td>{{ $da->start_time->isoFormat('HH:mm:ss') }} WIB
                                                </td>
                                                <td>{{ $da->end_time->isoFormat('HH:mm:ss') }} WIB
                                                </td>
                                                <td>{{ $da->doses }} &micro;Sv</td>
                                                <td>{{ $da->description }}</td>
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
