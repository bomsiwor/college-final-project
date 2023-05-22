@extends('Template.layouts')

@push('vendorStyle')
    @livewireStyles
@endpush

@section('main')
    <div class="pagetitle">
        <h2 class="fw-bold">Tambah Data</h2>
        <nav>
            <ol class="breadcrumb bg-primary">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                <li class="breadcrumb-item">Aset</li>
                <li class="breadcrumb-item active">Tambah data</li>
            </ol>
        </nav>
        <a href="{{ route('tool.index') }}" class="btn btn-primary mb-2"><span class="mdi mdi-arrow-left"></span> Kembali</a>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Alat</h5>
                    @livewire('tool.create-form')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('vendorScript')
    @livewireScripts
@endpush
