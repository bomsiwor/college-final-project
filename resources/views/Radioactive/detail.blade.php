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
    <h2 class="fw-bold">Detail Sumber <small class="text-muted">- {{ $radioactive->element_name }} -
            {{ $radioactive->isotope_number }}</small></h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item"><a href="{{ route('radioactive.index') }}">Sumber RA</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
    <a href="{{ route('radioactive.index') }}" class="btn btn-primary"><span class="mdi mdi-arrow-left"></span> Kembali</a>

    <div class="row my-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        @if (session('success'))
                            <div class="alert alert-success">
                                Data sumber berhasil diperbarui.
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
                                    <h3>{{ $radioactive->element_name }}</h3>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h5 class="mb-0 me-2 text-muted">
                                            {{ $radioactive->element_symbol . '-' . $radioactive->isotope_number }}</h5>
                                    </div>
                                </div>

                                <div class="mx-auto">
                                    <span class="mdi {{ __("core.$radioactive->status.symbol") }}"></span>
                                    {{ __("core.$radioactive->status.text") }}
                                </div>
                                <div class="mx-auto">
                                    <span
                                        class="badge border-dark border text-dark">{{ __("core.$radioactive->condition") }}</span>
                                </div>
                            </div>
                            <div class="border-bottom py-4">
                                <p>Deskripsi</p>
                                <div>
                                    @if ($radioactive->description)
                                        {{ $radioactive->description }}
                                    @else
                                        <span class="text-muted">Belum ada deskripsi</span>
                                    @endif
                                </div>
                                <div class="py-2">
                                    <p class="clearfix">
                                        <span class="float-left"> Diupload pada </span>
                                        <span
                                            class="float-right text-muted">{{ $radioactive->created_at->isoFormat('DD-MMMM-Y') }}</span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left"> Diperbarui pada </span>
                                        <span class="float-right text-muted">
                                            {{ $radioactive->updated_at->isoFormat('DD-MMMM-Y') }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="my-3 d-flex justify-content-around">
                                <button class="btn btn-primary btn-sm mb-2">
                                    Pinjam
                                </button>
                                @role('admin')
                                    <button class="btn btn-danger btn-sm mb-2">
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
                                        <li class="nav-item">
                                            <a class="nav-link" id="edit-tab" data-bs-toggle="tab" href="#edit"
                                                role="tab" aria-selected="false">Edit Detail</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="borrowing-tab" data-bs-toggle="tab" href="#borrowing"
                                                role="tab" aria-selected="false">Peminjaman</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="detail" role="tabpanel"
                                        aria-labelledby="detail-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <address>
                                                    <p class="fw-bold">Nama Sumber</p>
                                                    <p>{{ $radioactive->element_name }} -
                                                        {{ $radioactive->isotope_number }}</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Nomor Inventaris</p>
                                                    <p>{{ $radioactive->inventory_number }}</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Aktivitas Awal</p>
                                                    <p>{{ $radioactive->initial_activity }} &micro;Ci</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Dibuat pada</p>
                                                    <p>@tanggal($radioactive->manufacturing_date)</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Sifat</p>
                                                    <p>{{ $radioactive->properties }}</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Bentuk wadah</p>
                                                    <p>{{ $radioactive->packaging_type }}</p>
                                                </address>
                                                @if ($radioactive->purchase_date)
                                                    <address>
                                                        <p class="fw-bold">Kuantitas</p>
                                                        <p>{{ $radioactive->quantity }}</p>
                                                    </address>
                                                    <address>
                                                        <p class="fw-bold">Tanggal pengadaan</p>
                                                        <p>@tanggal($radioactive->purchase_date)</p>
                                                    </address>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                                        <h4>Form ubah data</h4>
                                    </div>
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
@endsection
