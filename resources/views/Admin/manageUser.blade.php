@extends('Template.layouts')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kelola User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Pagu</a></li>
                    <li class="breadcrumb-item">Aset</li>
                    <li class="breadcrumb-item active">Alat</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar User</h5>
                            <p>Kelola dan telusuri akun pengguna disini</p>

                            @livewire('admin.user-list')
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
