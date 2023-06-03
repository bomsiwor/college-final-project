@extends('Template.layouts')

@section('main')
    <h2 class="fw-bold">Dokumen</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item active">Admin</li>
            <li class="breadcrumb-item active">Dokumen</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-content-center mb-2">
                        <h4 class="card-title mb-0">Dokumen laboratorium</h4>
                        @role('admin')
                            <a href="{{ route('document.admin.create') }}" class="btn btn-sm btn-primary">
                                <i class="mdi mdi-plus-circle"></i> Tambah data
                            </a>
                        @endrole
                    </div>
                    @if (session('deleted'))
                        <div class="alert alert-danger">
                            Sukses menghapus data.
                        </div>
                    @endif

                    @if (session('created'))
                        <div class="alert alert-success">
                            {{ session('created') }}
                        </div>
                    @endif
                    <p>Menampilkan dokumen yang dapat diakses oleh pengguna aplikasi melalui halaman <a
                            href="#">ini</a></p>
                    <div class="table-responsive">
                        <table class="table" id="order-listing">
                            <thead>
                                <tr class="bg-primary text-white text-center">
                                    <th style="width: 20px">No.</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th style="max-width: 100px">Topik</th>
                                    <th style="max-width: 100px">Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($docs as $doc)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="lh-base">{{ $doc->title }}
                                            <br> Diupload pada : @tanggal($doc->created_at)
                                            <br>Terakhir di-update : @tanggal($doc->updated_at)
                                        </td>
                                        <td>{{ $doc->category }}</td>
                                        <td>{{ $doc->topic }}</td>
                                        <td>{{ $doc->status }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle toggle-dark mb-0 me-0"
                                                    type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"> Aksi </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                    <a class="dropdown-item"
                                                        href="{{ route('document.show', ['document' => $doc->id]) }}">Detail</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('document.admin.edit', ['document' => $doc->id]) }}">Edit
                                                        data</a>
                                                    <form action="{{ route('document.admin.updateStatus') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $doc->id }}">
                                                        @if ($doc->status == 'published')
                                                            <button type="submit" name="status" value="archived"
                                                                class="dropdown-item">Arsipkan</button>
                                                        @else
                                                            <button class="dropdown-item" name="status"
                                                                value="published">Publikasikan</button>
                                                        @endif
                                                    </form>
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('document.admin.delete') }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{ $doc->id }}">
                                                        <button type="submit"
                                                            class="dropdown-item text-danger">Hapus</button>
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
