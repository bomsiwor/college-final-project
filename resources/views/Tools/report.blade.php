@extends('Template.layouts')

@section('main')
    <h2>Laporkan Kerusakan</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item">Aset</li>
            <li class="breadcrumb-item active">Laporan Masalah</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Laporan Masalah inventaris
                    </h5>
                    {{-- Card --}}
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card bg-info">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Ajukan Kerusakan</h5>
                                    <a href="{{ route('report.create') }}" class="btn btn-sm btn-primary">Ajukan</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tabel --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr class="bg-primary text-white text-center">
                                            <th>No.</th>
                                            <th>Nama Pelapor</th>
                                            <th>Alat</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $report)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $report->user->name }}</td>
                                                <td>{{ $report->tool->name }} <br> {{ $report->tool->inventory_number }}
                                                </td>
                                                <td>{{ $report->created_at->isoFormat('dddd, DD-MM-Y') }}</td>
                                                <td>{{ __("core.$report->status") }}</td>
                                                <td><a href="{{ route('report.show', ['report' => $report->id]) }}"
                                                        class="btn btn-sm btn-primary">Detail</a></td>
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
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('dist/vendor/dataTables/dataTables.bootstrap4.css') }}">
@endpush

@push('vendorScript')
    @livewireScripts
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
