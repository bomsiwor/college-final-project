@extends('Template.layouts')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Semua Data Peminjaman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                    <li class="breadcrumb-item">Pemjinjaman</li>
                    <li class="breadcrumb-item active">Semua</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Semua peminjaman</h5>
                        Menampilkan semua pengajuan peminjaman inventaris dari laboratorium.
                        <!-- Table with hoverable rows -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Peminjam</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Tanggal Pinjam</th>
                                        <th scope="col">Tanggal Kembali</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Verifikator</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $borrow)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td class="fs-6">{{ $borrow->user->name }}</td>
                                            <td class="text-center">{{ $borrow->inventory->name }}</td>
                                            <td class="text-center">
                                                {{ $borrow->start_borrow_date->isoFormat('dddd, DD-MM-Y') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $borrow->expected_return_date->isoFormat('dddd, DD-MM-Y') }}</td>
                                            <td><span
                                                    class="badge {{ __("core.$borrow->status.class") }}">{{ __("core.$borrow->status.text") }}</span>
                                            </td>
                                            <td class="fst-italic fs-6 text-center">
                                                @empty($borrow->verificator)
                                                    Belum diverifikasi
                                                @else
                                                    {{ $borrow->verificator->name }}
                                                @endempty
                                            </td>
                                            <td class="text-center"><a
                                                    href="{{ route('activity.borrow.detail', ['borrow' => $borrow->id]) }}"
                                                    class="btn btn-sm btn-primary">Detail</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with hoverable rows -->
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->
@endsection
