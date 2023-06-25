@extends('Template.layouts')

@section('main')
    <div class="pagetitle">
        <h2 class="fw-bold">Data Peminjaman</h2>
        <nav>
            <ol class="breadcrumb bg-primary">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                <li class="breadcrumb-item">Aktivitas</li>
                <li class="breadcrumb-item active">Peminjaman</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="d-flex gap-3 align-items-center mb-3">
        <h4>Pilih Data</h4>
        <button class="badge badge-primary" data-bs-target="#borrowHelpModal" data-bs-toggle="modal"><i
                class="mdi mdi-help-circle"></i> Petunjuk peminjaman</button>
    </div>
    <div class="row">
        {{-- Semua data card --}}
        <div class="col-lg-3 mb-2">
            <div class="card bg-info">
                <div class="card-body">
                    <h5 class="card-title text-white">Peminjaman Alat</h5>
                    <a href="{{ route('borrow.tool.index') }}" class="btn btn-sm btn-primary">Lihat data</a>
                </div>
            </div>
        </div>

        {{-- Data sendiri card --}}
        <div class="col-lg-3">
            <div class="card bg-primary">
                <div class="card-body">
                    <h5 class="card-title text-white">Peminjaman Sumber</h5>
                    <a href="{{ route('borrow.radioactive.index') }}" class="btn btn-sm btn-info">Lihat data</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal petunjuk --}}
    <div class="modal fade" id="borrowHelpModal" tabindex="-1" aria-labelledby="borrowHelpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="borrowHelpModalLabel">Petunjuk Peminjaman</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="fw-bold">
                        PERHATIAN
                    </h6>
                    <p>
                        Halaman ini hanya digunakan untuk memantau kemajuan permohonan pinjaman aset yang dilakukan melalui
                        aplikasi ini.
                        <br>
                        <span class="text-danger fw-bold">Halaman ini tidak digunakan untuk mengajukan pinjaman</span>
                    </p>
                    <hr class="text-muted">
                    <p>
                        Untuk mengajukan pinjaman aset, baik aset <b>Barang</b> atau <b>Sumber Radioaktif</b>, silakan
                        kunjungi halaman aset barang <a href="{{ route('tool.index') }}">di sini</a> atau halaman sumber
                        radioaktif <a href="{{ route('radioactive.index') }}"> di sini</a>
                    </p>
                    <p>
                        Silakan buka terlebih dahulu <b>detail aset</b> dengan menekan tombol <b>Detail</b>. Menu pinjam
                        dapat anda temukan di dalam halaman detail, apabila aset tersebut tersedia (tidak rusak dan tidak
                        sedang dipinjamkan).
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
