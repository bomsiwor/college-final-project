@extends('Template.layouts')

@push('vendorStyle')
    <style>
        trix-toolbar [data-trix-button-group='file-tools'] {
            display: none;
        }
    </style>
@endpush

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Data alat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Pagu</a></li>
                    <li class="breadcrumb-item">Alat</li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
            <a href="{{ route('tool.index') }}" class="btn btn-primary"><span class="mdi mdi-arrow-left"></span> Kembali</a>
        </div><!-- End Page Title -->

        <section>
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
        </section>

    </main><!-- End #main -->
@endsection
