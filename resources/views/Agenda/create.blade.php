@extends('Template.layouts')


@section('main')
    <div class="pagetitle">
        <h2 class="fw-bold">Tambah Data</h2>
        <nav>
            <ol class="breadcrumb bg-primary">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                <li class="breadcrumb-item">Agenda</li>
                <li class="breadcrumb-item active">Tambah data</li>
            </ol>
        </nav>
        <a href="{{ route('agenda.index') }}" class="btn btn-primary mb-2"><span class="mdi mdi-arrow-left"></span>
            Kembali</a>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah agenda</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('agenda.store') }}" method="post">
                        @csrf
                        {{-- Data 1 --}}
                        <div>
                            {{-- Baris 1 --}}
                            <div class="row mb-3 form-group">
                                {{-- Nama Kegiatan --}}
                                <div class="col-lg-6">
                                    <label for="agenda_name">Nama Kegiatan</label>
                                    <input name="agenda_name" type="text"
                                        class="form-control @error('agenda_name') is-invalid @enderror" id="agenda_name"
                                        value="{{ old('agenda_name') }}">
                                    @error('agenda_name')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Tanggal --}}
                                <div class="col-lg-6">
                                    <label for="date">Tanggal</label>
                                    <input name="date" type="date"
                                        class="form-control @error('date') is-invalid @enderror" id="date"
                                        value="{{ old('date') }}">
                                    @error('date')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Waktu mulai --}}
                                <div class="col-lg-6">
                                    <label for="start_time">Waktu mulai</label>
                                    <input name="start_time" type="time"
                                        class="form-control @error('start_time') is-invalid @enderror" id="start_time"
                                        value="{{ old('start_time') }}">
                                    @error('start_time')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Waktu akhir --}}
                                <div class="col-lg-6">
                                    <label for="end_time">Waktu Akhir</label>
                                    <input name="end_time" type="time"
                                        class="form-control @error('end_time') is-invalid @enderror" id="end_time"
                                        value="{{ old('end_time') }}">
                                    @error('end_time')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label for="description">Deskripsi Kegiatan</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" style="height:100px"></textarea>
                                </div>
                            </div>


                        </div>
                        <button type="submit" class="btn btn-sm btn-primary mt-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
