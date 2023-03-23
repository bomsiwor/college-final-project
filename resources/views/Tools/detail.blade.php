@extends('Template.layouts')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Alat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tool.index') }}">Alat</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
            <a href="{{ route('tool.index') }}" class="btn btn-primary"><span class="mdi mdi-arrow-left"></span> Kembali</a>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">

                {{-- Kiri - Profil --}}
                <div class="col-xl-4">

                    <div class="card bg-light-subtle border border-light-subtle">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            @if (!$tool->tool_image)
                                <img src="{{ asset('assets/img/no-image.png') }}" alt="photo" class="rounded-circle">
                            @else
                                ada..
                            @endif
                            <h2 class="text-center">{{ $tool->name }}</h2>

                            <h3>Nama Kategori</h3>
                            <div>
                                <span
                                    class="badge {{ __("core.$tool->condition.class") }}">{{ __("core.$tool->condition.text") }}</span>
                                <span class="mdi {{ __("core.$tool->status.symbol") }}"></span>
                                {{ __("core.$tool->status.text") }}
                            </div>

                            <div class="my-2">
                                <form action="#" method="post">
                                    <input type="hidden" name="inventory_id">
                                    <button type="submit" class="btn btn-outline-danger">HAPUS</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Menu untuk alat</h5>
                            @if ($tool->status == 'available')
                                <button class="btn btn-warning">Pinjam</button>
                            @else
                                <button class="btn btn-outline-danger" disabled>{{ __("core.$tool->status.text") }}</button>
                            @endif
                            <button class="btn btn-info">Catat Penggunaan</button>
                        </div>
                    </div>
                </div>

                {{-- Kanan - Tab detail dan edit --}}
                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Detail</button>
                                </li>

                            </ul>

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Deskripsi</h5>
                                    @if ($tool->description)
                                        {!! $tool->description !!}
                                    @else
                                        <p class="small fst-italic">
                                            Belum ditambahkan!
                                        </p>
                                    @endif
                                    <div class="row mt-2">
                                        <div class="col-lg-3 col-md-4 label">Spesifikasi</div>
                                        <div class="col-lg-9 col-md-8"><a href="#" class="btn btn-primary">Cek
                                                disini</a></div>
                                    </div>

                                    <h5 class="card-title">Informasi lengkap</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama Alat</div>
                                        <div class="col-lg-9 col-md-8">{{ $tool->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Merk</div>
                                        <div class="col-lg-9 col-md-8">{{ $tool->merk }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Seri</div>
                                        <div class="col-lg-9 col-md-8">{{ $tool->series }}
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Tanggal Pembelian</div>
                                        <div class="col-lg-9 col-md-8">@tanggal($tool->purchase_date)</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nomor Identitas</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->identification_number }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Harga Beli</div>
                                        <div class="col-lg-9 col-md-8">@uang($tool->price)
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">No. Inventaris</div>
                                        <div class="col-lg-9 col-md-8">{{ $tool->inventory_number }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Terakhir data diperbarui :</div>
                                        <div class="col-lg-9 col-md-8">@tanggal($tool->updated_at)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
