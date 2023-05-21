@extends('Template.layouts')

@section('main')
    <div class="pagetitle">
        <h2 class="fw-bold">Semua Data Peminjaman</h2>
        <nav>
            <ol class="breadcrumb bg-primary">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                <li class="breadcrumb-item">Aktivitas</li>
                <li class="breadcrumb-item active">Peminjaman</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        {{-- Sumber --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Peminjaman - Sumber</h4>
                    <div class="row grid-margin mb-1">
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert">
                                Menampilkan <strong>SEMUA</strong> data peminjaman.
                                Data peminjaman akun ini dapat dilihat di
                                <strong>Halaman ini</strong>.
                            </div>
                            <h6>PETUNJUK</h6>
                            <p>Gunakan tombol <span class="btn-sm btn-light d-inline-block"><i
                                        class="mdi mdi-eye text-primary"></i></span>
                                untuk
                                melihat
                                detail peminjaman, <br> @role('admin')
                                    tombol <span class="btn-sm btn-success d-inline-block"><i class="mdi mdi-check"></i></span>
                                    / <span class="btn-sm btn-danger d-inline-block"><i
                                            class="mdi mdi-close-circle-outline"></i></span>
                                    untuk
                                    menyetujui/menolak dengan cepat
                                @endrole
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th>#</th>
                                            <th>Nama Peminjam</th>
                                            <th>Keperluan</th>
                                            <th>Nama Sumber</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($borrows as $borrow)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td class="text-wrap lh-sm" style="width: 40%">{{ $borrow->user->name }}
                                                </td>
                                                <td class="text-center">
                                                    {{ __("activity.$borrow->purpose") }}
                                                </td>
                                                <td class="text-center">{{ $borrow->radioactive->full_name }}</td>
                                                <td class="text-center text-wrap lh-lg">
                                                    {{ $borrow->start_borrow_date->isoFormat('dddd, DD-MM-Y') }} s/d
                                                    {{ $borrow->expected_return_date->isoFormat('dddd, DD-MM-Y') }}</td>
                                                <td><span
                                                        class="badge {{ __("core.$borrow->status.class") }}">{{ __("core.$borrow->status.text") }}</span>
                                                </td>
                                                <td class="text-center text-wrap lh-sm">
                                                    <a href="{{ route('radioactiveBorrow.show', ['borrow' => $borrow->id]) }}"
                                                        class="btn btn-sm btn-light">
                                                        <i class="mdi mdi-eye text-primary me-0"></i>
                                                    </a>
                                                    @role('admin')
                                                        @empty($borrow->verified_at)
                                                            <form action="{{ route('borrow.verify') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $borrow->id }}">
                                                                <input type="hidden" name="unique_id"
                                                                    value="{{ $borrow->inventory_id }}">
                                                                <button type="submit" class="btn btn-sm btn-success" name="status"
                                                                    value="accepted">
                                                                    <i class="mdi mdi-check me-0"></i>
                                                                </button>
                                                                <button type="submit" class="btn btn-sm btn-danger" name="status"
                                                                    value="rejected">
                                                                    <i class="mdi mdi-close-circle-outline me-0"></i>
                                                                </button>
                                                            </form>
                                                        @endempty
                                                    @endrole
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

        $(document).ready(function() {
            if ({{ !auth()->user()->phone }}) {
                console.log('telpon kosong');
            }
        });
    </script>
@endsection
