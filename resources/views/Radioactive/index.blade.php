@extends('Template.layouts')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Aset Zat Radioaktif</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Pagu</a></li>
                    <li class="breadcrumb-item">Aset</li>
                    <li class="breadcrumb-item active">Zat Radioaktif</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Zat RadioAktif</h5>
                            <livewire:presensi-table />
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Data</h5>
                            <p>Tambahkan data zat radioaktif yang dimiliki.</p>
                            <a href="#" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i> Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
