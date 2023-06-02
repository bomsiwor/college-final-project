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

    <h4>Pilih Data</h4>
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
@endsection
