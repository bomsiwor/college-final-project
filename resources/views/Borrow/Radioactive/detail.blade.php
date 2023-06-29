@extends('Template.layouts')

@section('main')
    <h2 class="fw-bold">
        Detail Peminjaman</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item">Peminjaman</li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
    <a href="{{ route('borrow.radioactive.index') }}" class="btn btn-primary"><span class="mdi mdi-arrow-left"></span>
        Kembali</a>

    <div class="row my-2 animate__animated animate__fadeIn">
        <div class="col-lg-12">
            <div class="card px-2" id="borrowDetailCard">
                <div class="card-body">
                    <div class="container-fluid">
                        <h3 class="text-right my-3">
                            Peminjaman&nbsp;&nbsp;#{{ $borrow->id }}
                        </h3>
                        <hr />
                    </div>
                    <div class="container-fluid d-flex flex-wrap justify-content-between">
                        <div class="col-lg-3 col-6 ps-0">
                            <p class="mt-3 mb-2"><b>Data Peminjam</b></p>
                            <p>
                                {{ $borrow->user->name }}<br />{{ $borrow->user->profession->profession_name }}<br />{{ $borrow->user->institution->institution_name }}
                            </p>
                        </div>
                        <div class="col-lg-3 col-6 pr-0">
                            <p class="mt-3 mb-2 text-right">
                                <b>Tanggal Peminjaman</b>
                            </p>
                            <p class="text-right">{{ $borrow->start_borrow_date->isoFormat('dddd, DD-MM-Y') }}<br /></p>
                        </div>
                        <div class="col-lg-3 col-8 pr-0">
                            <p class="mt-3 mb-2 text-right"><b>Pengembalian</b></p>
                            <p class="text-right">
                                Rencana&ensp;: {{ $borrow->expected_return_date->isoFormat('dddd, DD-MM-Y') }}<br />
                                Realisasi&ensp;: @empty($borrow->actual_return_date)
                                    <span class="text-muted">Belum diverifikasi</span>
                                @else
                                    {{ $borrow->actual_return_date->isoFormat('dddd, DD-MM-Y') }}
                                @endempty
                                <br />
                            </p>
                        </div>
                        <div class="col-lg-3 col-4 pr-0">
                            <p class="mt-3 mb-2 text-right"><b>Status</b></p>
                            <p class="text-right">
                                <span
                                    class="badge {{ __("core.$borrow->status.class") }}">{{ __("core.$borrow->status.text") }}</span><br />

                            </p>
                        </div>
                    </div>
                    <div class="container-fluid d-flex flex-wrap justify-content-between">
                        <div class="col-lg-3 col-6 ps-0">
                            <p class="mb-0 mt-3"><b>Pengajuan</b></p>
                            <p>
                                Dibuat pada : {{ $borrow->created_at->isoFormat('dddd, DD-MM-Y') }}
                                <br />
                                Diperbarui pada : {{ $borrow->updated_at->isoFormat('dddd, DD-MM-Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="container-fluid mt-3 d-flex justify-content-center w-100">
                        <div class="table-responsive w-100">
                            <table class="table">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th>Nama Barang</th>
                                        <th class="text-right">Nomor Inventaris</th>
                                        <th class="text-right">Keperluan</th>
                                        <th class="text-right">Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-right">
                                        <td class="text-left lh-lg">{{ $borrow->radioactive->full_name }}
                                        </td>
                                        <td>{{ $borrow->radioactive->inventory_number }}</td>
                                        <td>{{ __("activity.$borrow->purpose") }}</td>
                                        <td class="text-wrap lh-sm" style="width: 40%">
                                            {{ $borrow->description }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container-fluid d-lg-none">
                        <p class="text-danger">
                            *geser tabel ke kanan untuk info lebih lengkap
                        </p>
                    </div>
                    <div class="container-fluid mt-3 w-100">
                        @empty($borrow->verified_at)
                            <p class="text-right">Belum diverifikasi</p>
                        @else
                            <p class="text-right mb-1">
                                <b>Verifikator</b> : {{ $borrow->verificator->name }}
                            </p>
                            <p class="text-right">pada {{ $borrow->verified_at->isoFormat('dddd, DD-MM-Y') }}</p>
                            <p class="text-right mb-1">
                                <b>Catatan</b> : {{ $borrow->verified_note }}
                            </p>
                            <hr />
                        @endempty
                    </div>
                    @role('admin|ka-lab')
                        @empty($borrow->verified_at)
                            <div class="container-fluid w-100">
                                <form id="verification" action="{{ route('borrow.radioactive.verify') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $borrow->id }}">
                                    <input type="hidden" name="unique_id" value="{{ $borrow->inventory_id }}">
                                    <div class="form-group col-lg-6">
                                        <label for="note">Catatan</label>
                                        <textarea style="height: 100px" class="form-control" name="verified_note" id="description" rows="3"></textarea>
                                    </div>
                                </form>

                                <button type="submit" form="verification" name="status" value="accepted" class="btn btn-success">
                                    <i class="ti-check me-1"></i>Setuju
                                </button>
                                <button type="submit" class="btn btn-danger" form="verification" name="status" value="rejected">
                                    <i class="ti-close me-1"></i>Tolak
                                </button>
                            </div>
                        @endempty
                    @endrole
                </div>
            </div>
        </div>
    </div>
@endsection
