@extends('Template.layouts')

@push('vendorStyle')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('dist/vendor/lightgallery/css/lightgallery.css') }}">
@endpush

@push('vendorScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('dist/vendor/lightgallery/js/lightgallery-all.min.js') }}"></script>
@endpush

@section('main')
    <h2 class="fw-bold">Detail Alat <small class="text-muted">- {{ $tool->name }}</small></h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tool.index') }}">Alat</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
    <a href="{{ route('tool.index') }}" class="btn btn-primary"><span class="mdi mdi-arrow-left"></span> Kembali</a>

    <div class="row my-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        @if (session('success'))
                            <div class="alert alert-success">
                                Data alat berhasil diperbarui.
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- Kolom kiri --}}
                        <div class="col-lg-4">
                            <div class="border-bottom text-center pb-4">

                                <div class="mb-2">
                                    <h3>{{ $tool->name }}</h3>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h5 class="mb-0 me-2 text-muted">{{ $tool->merk . '-' . $tool->series }}</h5>
                                    </div>
                                </div>

                                <div class="mx-auto">
                                    <span class="mdi {{ __("core.$tool->status.symbol") }}"></span>
                                    {{ __("core.$tool->status.text") }}
                                </div>
                                <div class="mx-auto">
                                    <span
                                        class="badge {{ __("core.$tool->condition.class") }}">{{ __("core.$tool->condition.text") }}</span>
                                </div>
                            </div>
                            <div class="border-bottom py-4">
                                <p>Deskripsi</p>
                                <div>
                                    @if ($tool->description)
                                        {{ $tool->description }}
                                    @else
                                        <span class="text-muted">Belum ada deskripsi</span>
                                    @endif
                                </div>
                                <div class="py-2">
                                    <p class="clearfix">
                                        <span class="float-left"> Diupload pada </span>
                                        <span
                                            class="float-right text-muted">{{ $tool->created_at->isoFormat('DD-MMMM-Y') }}</span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left"> Diperbarui pada </span>
                                        <span class="float-right text-muted">
                                            {{ $tool->updated_at->isoFormat('DD-MMMM-Y') }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="my-3 d-flex justify-content-around">
                                <button class="btn btn-primary btn-sm mb-2" type="button" data-bs-toggle="modal"
                                    data-bs-target="#borrowModal">
                                    Pinjam
                                </button>
                                @role('admin')
                                    <button class="btn btn-danger btn-sm mb-2" onclick="deleteButton()">
                                        Hapus Data
                                    </button>
                                @endrole
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active ps-0" id="detail-tab" data-bs-toggle="tab"
                                                href="#detail" role="tab" aria-controls="detail"
                                                aria-selected="true">Detail</a>
                                        </li>
                                        @role('admin')
                                            <li class="nav-item">
                                                <a class="nav-link" id="edit-tab" data-bs-toggle="tab" href="#edit"
                                                    role="tab" aria-selected="false">Edit Detail</a>
                                            </li>
                                        @endrole

                                        <li class="nav-item">
                                            <a class="nav-link" id="borrowing-tab" data-bs-toggle="tab" href="#borrowing"
                                                role="tab" aria-selected="false">Peminjaman</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content tab-content-basic">

                                    {{-- Detail --}}
                                    <div class="tab-pane fade show active" id="detail" role="tabpanel"
                                        aria-labelledby="detail-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <address>
                                                    <p class="fw-bold">Nama alat</p>
                                                    <p>{{ $tool->name }}</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Nomor Inventaris</p>
                                                    <p>{{ $tool->inventory_number }}</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Merk - Seri</p>
                                                    <p>{{ $tool->merk . ' - ' . $tool->series }}</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Status Penggunaan</p>
                                                    <p>{{ $tool->used_status }}</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Tanggal pengadaan</p>
                                                    <p>@tanggal($tool->purchase_date)</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Harga pengadaan</p>
                                                    <p>
                                                        @if ($tool->price)
                                                            @uang($tool->price)
                                                        @else
                                                            Tidak ada data
                                                        @endif
                                                    </p>
                                                </address>
                                            </div>
                                            <div class="col-md-6">
                                                <address>
                                                    <p class="fw-bold">Manual & Spesifikasi</p>
                                                    @if ($tool->manual)
                                                        <form action="#" method="post">
                                                            <input type="hidden" name="inventory_unique"
                                                                value="{{ $tool->inventory_unique }}">
                                                            <button type="submit" class="btn btn-sm btn-outline-info">Unduh
                                                                dokumen</button>
                                                        </form>
                                                    @else
                                                        <p>Tidak ada</p>
                                                    @endif
                                                </address>

                                                <p class="fw-bold">Foto Alat</p>
                                                <div id="lightgallery-without-thumb" class="row lightGallery">
                                                    @if ($tool->tool_image)
                                                        @foreach ($tool->tool_image as $key => $value)
                                                            <a href="{{ asset('storage/inventory-images/' . $value['name']) }}"
                                                                class="image-tile"><img
                                                                    src="{{ asset('storage/inventory-images/' . $value['name']) }}"
                                                                    alt="{{ $value['description'] }}"></a>
                                                        @endforeach
                                                    @else
                                                        <p>Tidak ada gambar</p>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    {{-- Edit --}}
                                    @role('admin')
                                        <div class="tab-pane fade" id="edit" role="tabpanel"
                                            aria-labelledby="edit-tab">
                                            <h4>Form ubah data</h4>
                                            <form action="{{ route('tool.update') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="unique" value="{{ $tool->inventory_unique }}">
                                                {{-- Nama alat --}}
                                                <div class="form-group row align-content-center mb-1">
                                                    <label for="name" class="col-sm-3 col-form-label-sm">Nama alat</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="name" id="name"
                                                            class="form-control form-control-sm"
                                                            value="{{ $tool->name }}" />
                                                    </div>
                                                </div>

                                                {{-- No inv --}}
                                                <div class="form-group row align-content-center mb-1">
                                                    <label for="inventory_number" class="col-sm-3 col-form-label-sm">Nomor
                                                        Inventaris</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="inventory_number" id="inventory_number"
                                                            class="form-control form-control-sm"
                                                            value="{{ $tool->inventory_number }}" />
                                                    </div>
                                                </div>

                                                {{-- Merk --}}
                                                <div class="form-group row align-content-center mb-1">
                                                    <label for="merk" class="col-sm-3 col-form-label-sm">Merk</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="merk" id="merk"
                                                            class="form-control form-control-sm"
                                                            value="{{ $tool->merk }}" />
                                                    </div>
                                                </div>

                                                {{-- Seri --}}
                                                <div class="form-group row align-content-center mb-1">
                                                    <label for="series" class="col-sm-3 col-form-label-sm">Seri</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="series" id="series"
                                                            class="form-control form-control-sm"
                                                            value="{{ $tool->series }}" />
                                                    </div>
                                                </div>

                                                {{-- Tanggal pengadaan --}}
                                                <div class="form-group row align-content-center mb-1">
                                                    <label for="purchase_date" class="col-sm-3 col-form-label-sm">Tanggal
                                                        pengadaan</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" name="purchase_date" id="purchase_date"
                                                            class="form-control form-control-sm"
                                                            value="{{ $tool->purchase_date->isoFormat('Y-MM-DD') }}" />
                                                    </div>
                                                </div>

                                                {{-- Harga --}}
                                                <div class="form-group row align-content-center mb-1">
                                                    <label for="price" class="col-sm-3 col-form-label-sm">Harga</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-primary text-white">Rp</span>
                                                            </div>
                                                            <input type="text" class="form-control" name="price"
                                                                id="price" value="{{ $tool->price }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Status dan kondisi --}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="condition" class="col-sm-3 col-form-label-sm">Kondisi
                                                                alat</label>
                                                            <div class="col-sm-9">
                                                                <div class="form-group">
                                                                    <div class="form-check form-check-success">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="condition" id="condition1"
                                                                                value="good" @checked($tool->condition == 'good' ? true : false)>
                                                                            Baik
                                                                            <i class="input-helper"></i></label>
                                                                    </div>
                                                                    <div class="form-check form-check-warning">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="condition" id="condition2"
                                                                                value="minor" @checked($tool->condition == 'minor' ? true : false)>
                                                                            Rusak Ringan
                                                                            <i class="input-helper"></i></label>
                                                                    </div>
                                                                    <div class="form-check form-check-danger">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="condition" id="condition3"
                                                                                value="severe" @checked($tool->condition == 'severe' ? true : false)>
                                                                            Rusak berat
                                                                            <i class="input-helper"></i></label>
                                                                    </div>
                                                                    <div class="form-check form-check-dark">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="condition" id="condition4"
                                                                                value="unknown" @checked($tool->condition == 'unknown' ? true : false)>
                                                                            Tidak diketahui
                                                                            <i class="input-helper"></i></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="used_status"
                                                                class="col-sm-3 col-form-label-sm">Status</label>
                                                            <div class="col-sm-9">
                                                                <div class="form-group">
                                                                    <div class="form-check form-check-success">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="used_status" id="condition1"
                                                                                value="used" @checked($tool->used_status == 'used' ? true : false)>
                                                                            Dapat digunakan
                                                                            <i class="input-helper"></i></label>
                                                                    </div>
                                                                    <div class="form-check form-check-warning">
                                                                        <label class="form-check-label ">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="used_status" id="condition2"
                                                                                value="unused" @checked($tool->used_status == 'unused' ? true : false)>
                                                                            Tidak dapat digunakan
                                                                            <i class="input-helper"></i></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Gambar --}}
                                                <div class="form-group row align-content-center mb-1">
                                                    <label for="image" class="col-sm-3 col-form-label-sm">Foto Alat</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="images[]" multiple id="image">
                                                    </div>
                                                </div>

                                                {{-- Manual --}}
                                                <div class="form-group row align-content-center mb-1">
                                                    <label for="manual"
                                                        class="col-sm-3 col-form-label-sm">Spesifikasi/Manual</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="manual" id="manual">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary text-white">Simpan</button>
                                            </form>
                                        </div>
                                    @endrole

                                    {{-- Peminjaman --}}
                                    <div class="tab-pane fade" id="borrowing" role="tabpanel"
                                        aria-labelledby="borrowing-tab">
                                        <h4>Contact us </h4>
                                        <p>
                                            Feel free to contact us if you have any questions!
                                        </p>
                                        <p>
                                            <i class="ti-headphone-alt text-info"></i>
                                            +123456789
                                        </p>
                                        <p>
                                            <i class="ti-email text-success"></i>
                                            contactus@example.com
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts

    @livewire('tool.borrow-form', ['tool' => $tool])
@endsection

@section('script')
    <script>
        window.addEventListener('added-borrow', event => {
            $('#borrowModal').modal('hide');
            Swal.fire({
                title: '<strong>Sukses!</strong>',
                icon: 'success',
                html: 'Catatan peminjaman anda dapat dilihat pada , ' +
                    '<a href="{{ route('borrow.index') }}">halaman ini</a> ',
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: true,
                confirmButtonText: 'Oke!',
            })
        })

        function deleteButton() {
            Swal.fire({
                title: 'Apa anda yakin?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yakin!',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
                customClass: {
                    confirmButton: 'btn btn-sm btn-primary',
                    cancelButton: 'btn btn-sm btn-danger'
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    var dataToSend = {
                        _token: "{{ csrf_token() }}"
                    };

                    $.ajax({
                        url: '{{ route('tool.delete', ['tool' => $tool->inventory_unique]) }}',
                        data: dataToSend,
                        type: 'DELETE',
                        beforeSend: function(response) {
                            Swal.fire({
                                title: 'Tunggu...',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            })
                        },
                        success: function(result) {
                            console.log(result.data);
                            let timerInterval
                            Swal.fire({
                                title: 'Terhapus!',
                                icon: 'success',
                                text: 'Data sudah dihapus.',
                                html: 'Anda akan diarahkan ke halaman data alat dalam <b></b> milliseconds.',
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                $(location).attr('href', "{{ route('tool.index') }}");
                            })
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            Swal.fire(
                                'Gagal',
                                'Operasi gagal dilakukan',
                                'error'
                            )
                        }
                    });
                }
            })
        }

        (function($) {
            'use strict';

            if ($("#lightgallery-without-thumb").length) {
                $("#lightgallery-without-thumb").lightGallery({
                    thumbnail: true,
                    animateThumb: false,
                    showThumbByDefault: false
                });
            }
        })(jQuery);
    </script>
@endsection
