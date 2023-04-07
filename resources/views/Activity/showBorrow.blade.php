@extends('Template.layouts')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Peminjaman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                    <li class="breadcrumb-item">Peminjaman</li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
            <a href="{{ route('activity.borrow.all') }}" class="btn btn-primary"><span class="mdi mdi-arrow-left"></span>
                Kembali</a>
        </div><!-- End Page Title -->

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rincian</h5>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }} memverifikasi data!
                            </div>
                        @endif
                        <form>
                            {{-- Status --}}
                            <div class="row mb-1">
                                <label for="status" class="col-md-4 col-lg-3 col-form-label">Status</label>
                                <div class="col-md-8 col-lg-5">
                                    <span
                                        class="badge {{ __("core.$borrow->status.class") }}">{{ __("core.$borrow->status.text") }}</span>
                                </div>
                            </div>

                            {{-- Nama alat --}}
                            <div class="row mb-0">
                                <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama Alat</label>
                                <div class="col-md-8 col-lg-5">
                                    <input name="name" type="text" readonly class="form-control-plaintext"
                                        value="{{ $borrow->inventory->name }}">
                                </div>
                            </div>

                            {{-- No inventaris --}}
                            <div class="row mb-0">
                                <label for="inventory_number" class="col-md-4 col-lg-3 col-form-label">Nomor
                                    Inventaris</label>
                                <div class="col-md-8 col-lg-5">
                                    <input name="inventory_number" type="text" readonly class="form-control-plaintext"
                                        value="{{ $borrow->inventory->inventory_number }}">
                                </div>
                            </div>

                            {{-- Borrower --}}
                            <div class="row mb-0">
                                <label for="borrower_name" class="col-md-4 col-lg-3 col-form-label">Nama Peminjam</label>
                                <div class="col-md-8 col-lg-5">
                                    <input name="borrower_name" type="text" readonly class="form-control-plaintext"
                                        value="{{ $borrow->user->name }}">
                                </div>
                            </div>

                            {{-- Start Borrow --}}
                            <div class="row mb-0">
                                <label for="start_borrow" class="col-md-4 col-lg-3 col-form-label">Mulai Peminjaman</label>
                                <div class="col-md-8 col-lg-5">
                                    <div class="form-control-plaintext">
                                        {{ $borrow->start_borrow_date->isoFormat('dddd, DD MMMM Y') }}
                                    </div>
                                </div>
                            </div>

                            {{-- Expected End Borrow --}}
                            <div class="row mb-0">
                                <label for="end_borrow" class="col-md-4 col-lg-3 col-form-label">Rencana
                                    Pengembalian</label>
                                <div class="col-md-8 col-lg-5">
                                    <div class="form-control-plaintext">
                                        {{ $borrow->expected_return_date->isoFormat('dddd, DD MMMM Y') }}
                                    </div>
                                </div>
                            </div>

                            {{-- Actual Return --}}
                            <div class="row mb-0">
                                <label for="actual_return" class="col-md-4 col-lg-3 col-form-label">Realisasi
                                    Pengembalian</label>
                                <div class="col-md-8 col-lg-5">
                                    <div class="form-control-plaintext">
                                        @empty($borrow->actual_return_date)
                                            Belum ada data.
                                        @else
                                            {{ $borrow->actual_return_date->isoFormat('dddd, DD MMMM Y') }}
                                        @endempty
                                    </div>
                                </div>
                            </div>

                            {{-- Purpose --}}
                            <div class="row mb-0">
                                <label for="purpose" class="col-md-4 col-lg-3 col-form-label">Tujuan</label>
                                <div class="col-md-8 col-lg-5">
                                    <div class="form-control-plaintext">
                                        {{ __("activity.$borrow->purpose") }}
                                    </div>
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="row mb-0">
                                <label for="description" class="col-md-4 col-lg-3 col-form-label">Deskripsi</label>
                                <div class="col-md-8 col-lg-5">
                                    <div class="form-control-plaintext">
                                        {{ $borrow->description }}
                                    </div>
                                </div>
                            </div>

                            {{-- Verifikator --}}
                            <div class="row mb-0">
                                <label for="verificator" class="col-md-4 col-lg-3 col-form-label">Verifikator</label>
                                <div class="col-md-8 col-lg-5">
                                    <div class="form-control-plaintext">
                                        @empty($borrow->verificator_id)
                                            <div class="fst-italic">Belum Diverifikasi</div>
                                        @else
                                            {{ $borrow->verificator->name }}
                                        @endempty
                                    </div>
                                </div>
                            </div>

                            {{-- Verified at --}}
                            <div class="row mb-0">
                                <label for="verified_at" class="col-md-4 col-lg-3 col-form-label">Di-verifikasi pada</label>
                                <div class="col-md-8 col-lg-5">
                                    <div class="form-control-plaintext">
                                        @empty($borrow->verified_at)
                                            <div class="fst-italic">Belum Diverifikasi</div>
                                        @else
                                            {{ $borrow->verified_at }}
                                        @endempty
                                    </div>
                                </div>
                            </div>

                            {{-- Catatan Verifikator --}}
                            <div class="row mb-0">
                                <label for="verified_note" class="col-md-4 col-lg-3 col-form-label">Catatan
                                    Verifikator</label>
                                <div class="col-md-8 col-lg-5">
                                    <div class="form-control-plaintext">
                                        @empty($borrow->verified_at)
                                            <div class="fst-italic">Belum Diverifikasi</div>
                                        @else
                                            {{ $borrow->verified_note }}
                                        @endempty
                                    </div>
                                </div>
                            </div>

                            {{-- Created At --}}
                            <div class="row mb-0">
                                <label for="created_at" class="col-md-4 col-lg-3 col-form-label">Diajukan pada</label>
                                <div class="col-md-8 col-lg-5">
                                    <div class="form-control-plaintext">
                                        {{ $borrow->created_at->isoFormat('dddd, DD MMMM Y - HH:mm:ss') }}
                                    </div>
                                </div>
                            </div>

                            {{-- Updated At --}}
                            <div class="row mb-0">
                                <label for="updated_at" class="col-md-4 col-lg-3 col-form-label">Diubah pada</label>
                                <div class="col-md-8 col-lg-5">
                                    <div class="form-control-plaintext">
                                        {{ $borrow->updated_at->isoFormat('dddd, DD MMMM Y - HH:mm:ss') }}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @role('admin')
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Verifikasi Pinjaman</h5>
                            @if ($borrow->verified_at)
                                <p>Sudah diverifikasi</p>
                            @else
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('activity.borrow.verify') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $borrow->id }}">
                                    <input type="hidden" name="unique_id" value="{{ $borrow->inventory_id }}">
                                    <div class="row align-items-center">
                                        <legend class="col-sm-4 col-form-label">
                                            Ubah Status
                                        </legend>
                                        <div class="col-sm-6 d-flex flex-row justify-content-evenly">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="accepted" id="accept" />
                                                <label class="form-check-label text-success" for="accept">
                                                    Setujui
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="rejected" id="reject" />
                                                <label class="form-check-label text-danger" for="reject">
                                                    Tolak
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="description" class="col-md-4 col-lg-3 col-form-label">Catatan</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="verified_note" class="form-control" id="description" style="height: 100px" maxlength="255"></textarea>
                                        </div>
                                        <div id="descHelp" class="form-text">Tuliskan tujuan (maks:255 karakter)
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endrole
        </div>

    </main><!-- End #main -->
@endsection
