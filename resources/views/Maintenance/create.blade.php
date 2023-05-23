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
                <li class="breadcrumb-item">Perawatan</li>
                <li class="breadcrumb-item active">Tambah data</li>
            </ol>
        </nav>
        <a href="{{ route('maintenance.index') }}" class="btn btn-primary mb-2"><span class="mdi mdi-arrow-left"></span>
            Kembali</a>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah agenda perawatan</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('maintenance.store') }}" method="post">
                        @csrf
                        {{-- Data 1 --}}
                        <div>
                            {{-- Baris 1 --}}
                            <div class="row mb-3 form-group">
                                {{-- Nama Kegiatan --}}
                                <div class="col-lg-6">
                                    <label for="activity_name">Nama Kegiatan</label>
                                    <input name="activity_name[0]" type="text"
                                        class="form-control @error('activity_name.0') is-invalid @enderror"
                                        id="activity_name.0" value="{{ old('activity_name.0') }}">
                                    @error('activity_name.0')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Rincian --}}
                                <div class="col-lg-6">
                                    <label for="agenda">Rincian Kegiatan</label>
                                    <input name="agenda[0]" type="text"
                                        class="form-control @error('agenda.0') is-invalid @enderror" id="agenda.0"
                                        value="{{ old('agenda.0') }}">
                                    @error('agenda.0')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            {{-- Baris 2 --}}
                            <div class="row mb-3 form-group">
                                {{-- Penanggung jawab --}}
                                <div class="col-lg-6">
                                    <label for="in_charge.0">Penanggung Jawab</label>
                                    <input name="in_charge[0]" type="text"
                                        class="form-control @error('in_charge.0') is-invalid @enderror" id="in_charge.0"
                                        value="{{ old('in_charge.0') }}">
                                    @error('in_charge.0')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Rincian --}}
                                <div class="col-lg-6">
                                    <label for="month.0">Rencana Tanggal Pelaksanaan</label>
                                    <input name="month[0]" type="date"
                                        class="form-control @error('month.0') is-invalid @enderror" id="month.0"
                                        value="{{ old('month.0') }}">
                                    @error('month.0')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>
                            <hr class="text-primary">
                        </div>

                        {{-- Data 2 --}}
                        <div>
                            {{-- Baris 1 --}}
                            <div class="row mb-3 form-group">
                                {{-- Nama Kegiatan --}}
                                <div class="col-lg-6">
                                    <label for="activity_name">Nama Kegiatan</label>
                                    <input name="activity_name[1]" type="text"
                                        class="form-control @error('activity_name.1') is-invalid @enderror"
                                        id="activity_name.1" value="{{ old('activity_name.1') }}">
                                    @error('activity_name.1')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Rincian --}}
                                <div class="col-lg-6">
                                    <label for="agenda">Rincian Kegiatan</label>
                                    <input name="agenda[1]" type="text"
                                        class="form-control @error('agenda.1') is-invalid @enderror" id="agenda.1"
                                        value="{{ old('agenda.1') }}">
                                    @error('agenda.1')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            {{-- Baris 2 --}}
                            <div class="row mb-3 form-group">
                                {{-- Penanggung jawab --}}
                                <div class="col-lg-6">
                                    <label for="in_charge.1">Penanggung Jawab</label>
                                    <input name="in_charge[1]" type="text"
                                        class="form-control @error('in_charge.1') is-invalid @enderror" id="in_charge.1"
                                        value="{{ old('in_charge.1') }}">
                                    @error('in_charge.1')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Rincian --}}
                                <div class="col-lg-6">
                                    <label for="month.1">Rencana Tanggal Pelaksanaan</label>
                                    <input name="month[1]" type="date"
                                        class="form-control @error('month.1') is-invalid @enderror" id="month.1"
                                        value="{{ old('month.1') }}">
                                    @error('month.1')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>
                            <hr class="text-primary">
                        </div>

                        {{-- Data 3 --}}
                        <div>
                            {{-- Baris 1 --}}
                            <div class="row mb-3 form-group">
                                {{-- Nama Kegiatan --}}
                                <div class="col-lg-6">
                                    <label for="activity_name">Nama Kegiatan</label>
                                    <input name="activity_name[2]" type="text"
                                        class="form-control @error('activity_name.2') is-invalid @enderror"
                                        id="activity_name.2" value="{{ old('activity_name.2') }}">
                                    @error('activity_name.2')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Rincian --}}
                                <div class="col-lg-6">
                                    <label for="agenda">Rincian Kegiatan</label>
                                    <input name="agenda[2]" type="text"
                                        class="form-control @error('agenda.2') is-invalid @enderror" id="agenda.2"
                                        value="{{ old('agenda.2') }}">
                                    @error('agenda.2')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            {{-- Baris 2 --}}
                            <div class="row mb-3 form-group">
                                {{-- Penanggung jawab --}}
                                <div class="col-lg-6">
                                    <label for="in_charge.2">Penanggung Jawab</label>
                                    <input name="in_charge[2]" type="text"
                                        class="form-control @error('in_charge.2') is-invalid @enderror" id="in_charge.2"
                                        value="{{ old('in_charge.2') }}">
                                    @error('in_charge.2')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Rincian --}}
                                <div class="col-lg-6">
                                    <label for="month.2">Rencana Tanggal Pelaksanaan</label>
                                    <input name="month[2]" type="date"
                                        class="form-control @error('month.2') is-invalid @enderror" id="month.2"
                                        value="{{ old('month.2') }}">
                                    @error('month.2')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>
                            <hr class="text-primary">
                        </div>

                        {{-- Data 4 --}}
                        <div>
                            {{-- Baris 1 --}}
                            <div class="row mb-3 form-group">
                                {{-- Nama Kegiatan --}}
                                <div class="col-lg-6">
                                    <label for="activity_name.3">Nama Kegiatan</label>
                                    <input name="activity_name[3]" type="text"
                                        class="form-control @error('activity_name.3') is-invalid @enderror"
                                        id="activity_name.3" value="{{ old('activity_name.3') }}">
                                    @error('activity_name.3')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Rincian --}}
                                <div class="col-lg-6">
                                    <label for="agenda.3">Rincian Kegiatan</label>
                                    <input name="agenda[3]" type="text"
                                        class="form-control @error('agenda.3') is-invalid @enderror" id="agenda.3"
                                        value="{{ old('agenda.3') }}">
                                    @error('agenda.3')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            {{-- Baris 2 --}}
                            <div class="row mb-3 form-group">
                                {{-- Penanggung jawab --}}
                                <div class="col-lg-6">
                                    <label for="in_charge.3">Penanggung Jawab</label>
                                    <input name="in_charge[3]" type="text"
                                        class="form-control @error('in_charge.3') is-invalid @enderror" id="in_charge.3"
                                        value="{{ old('in_charge.3') }}">
                                    @error('in_charge.3')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Rincian --}}
                                <div class="col-lg-6">
                                    <label for="month.3">Rencana Tanggal Pelaksanaan</label>
                                    <input name="month[3]" type="date"
                                        class="form-control @error('month.3') is-invalid @enderror" id="month.3"
                                        value="{{ old('month.3') }}">
                                    @error('month.3')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>
                            <hr class="text-primary">
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('vendorScript')
    @livewireScripts
@endpush
