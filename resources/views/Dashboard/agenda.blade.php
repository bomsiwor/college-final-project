@extends('Template.layouts')

@section('main')
    <h2 class="fw-bold">Agenda Laboratorium</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item active">Agenda</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-content-center mb-2">
                        <h4 class="card-title mb-0">Data agenda kegiatan</h4>
                        @role('admin|ka-lab')
                            <a href="{{ route('agenda.create') }}" class="btn btn-sm btn-primary">
                                <i class="mdi mdi-plus-circle"></i> Tambah data
                            </a>
                        @endrole
                    </div>
                    @if (session('success'))
                        <div class="alert alert-danger">
                            Sukses menghapus data.
                        </div>
                    @endif

                    @if (session('created'))
                        <div class="alert alert-success">
                            {{ session('created') }}
                        </div>
                    @endif
                    <p>Menampilkan daftar kegiatan yang dilaksanakan di laboratorium</p>
                    <div class="table-responsive">
                        <table class="table" id="order-listing">
                            <thead>
                                <tr class="bg-primary text-white text-center">
                                    <th>No.</th>
                                    <th>Kegiatan</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="w-50 text-wrap lh-sm">{{ $d->agenda_name }}</td>
                                        <td>@tanggal($d->date)</td>
                                        <td class="text-center">
                                            {{ $d->start_time }} - {{ $d->end_time }}
                                        </td>
                                        <td><a href="{{ route('agenda.show', ['id' => $d->id]) }}"
                                                class="btn btn-primary btn-sm">Detail</a>
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
