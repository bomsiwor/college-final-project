@extends('Template.layouts')

@section('main')
    <div class="pagetitle">
        <h2 class="fw-bold">Data Kunjungan</h2>
        <nav>
            <ol class="breadcrumb bg-primary">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                <li class="breadcrumb-item">Aktivitas</li>
                <li class="breadcrumb-item active">Presensi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <h4>Pilih Data</h4>
    <div class="row">
        {{-- Semua data card --}}
        <div class="col-lg-3">
            <div class="card bg-info">
                <div class="card-body">
                    <h5 class="card-title text-white">Semua data</h5>
                    <p class="text-white">Semua data presensi</p>
                    <a href="{{ route('attendance.total') }}" class="btn btn-sm btn-primary">Lihat data</a>
                </div>
            </div>
        </div>

        {{-- Data sendiri card --}}
        <div class="col-lg-3">
            <div class="card bg-primary">
                <div class="card-body">
                    <h5 class="card-title text-white">Data Sendiri</h5>
                    <p class="text-white">Data presensi akun ini</p>
                    <a href="{{ route('attendance.me') }}" class="btn btn-sm btn-info">Lihat data</a>
                </div>
            </div>
        </div>
    </div>
@endsection
