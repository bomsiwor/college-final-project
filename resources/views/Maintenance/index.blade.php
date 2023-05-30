@extends('Template.layouts')

@section('main')
    <h2>
        Data Perawatan Alat</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item">Aset</li>
            <li class="breadcrumb-item active">Perawatan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-content-center mb-2">
                        <h4 class="card-title mb-0">Data operasi dan perawatan laboratorium</h4>
                        @role('admin')
                            <a href="{{ route('maintenance.create') }}" class="btn btn-sm btn-primary">
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
                    <p>Menampilkan data kegiatan operasi dan perawatan terhadap aset yang dimiliki oleh laboratorium
                        instrumentasi nuklir.</p>
                    <div class="table-responsive">
                        <table class="table" id="order-listing">
                            <thead>
                                <tr class="bg-primary text-white text-center">
                                    <th>No.</th>
                                    <th>Kegiatan</th>
                                    <th>Bulan</th>
                                    <th>Status</th>
                                    <th>Pelaksana</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="w-50 text-wrap lh-sm">{{ $d->activity_name }}</td>
                                        <td>{{ $d->month->isoFormat('MMMM Y') }}</td>
                                        <td class="text-center">
                                            @if ($d->is_done)
                                                <span class="text-success mdi mdi-check-decagram">Sudah</span>
                                            @else
                                                <span class="text-danger mdi mdi-close-octagon">Belum</span>
                                            @endif
                                        </td>
                                        <td>{{ $d->in_charge }}</td>
                                        <td><a href="{{ route('maintenance.detail', ['maintenance' => $d->id]) }}"
                                                class="btn btn-primary btn-sm">Detail</a></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle toggle-dark btn-sm mb-0 me-0"
                                                    type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"> Aksi </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                    <a class="dropdown-item"
                                                        href="{{ route('maintenance.detail', ['maintenance' => $d->id]) }}">Detail</a>

                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('user.delete', ['user' => $da->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="dropdown-item text-danger">Hapus
                                                            user</button>
                                                    </form>
                                                </div>
                                            </div>
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
