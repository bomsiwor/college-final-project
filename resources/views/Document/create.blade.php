@extends('Template.layouts')


@section('main')
    <div class="pagetitle">
        <h2 class="fw-bold">Tambah Data</h2>
        <nav>
            <ol class="breadcrumb bg-primary">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                <li class="breadcrumb-item">Dokumen</li>
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
                    <h5 class="card-title">Form Tambah dokumen</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('document.admin.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- Data 1 --}}
                        <div>
                            {{-- Baris 1 --}}
                            <div class="row mb-3 form-group">
                                {{-- Judul DOkumen --}}
                                <div class="col-lg-6">
                                    <label for="title">Judul Dokumen</label>
                                    <input name="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Kategori --}}
                                <div class="col-lg-6">
                                    <label for="category">Kategori</label>
                                    <select id="category" class="form-select @error('category') is-invalid @enderror"
                                        aria-label="Pilih Tujuan..." name="category">
                                        <option value="">Pilih Kategori..</option>
                                        <option value="modul">Modul</option>
                                        <option value="procedure">Prosedur Kinerja</option>
                                        <option value="sop">Tata Tertib</option>
                                        <option value="other">Lainnya</option>
                                    </select>
                                    @error('category')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- Topik --}}
                                <div class="col-lg-6">
                                    <label for="topic">Topik</label>
                                    <input name="topic" type="text"
                                        class="form-control @error('topic') is-invalid @enderror" id="topic"
                                        value="{{ old('topic') }}">
                                    @error('topic')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>

                                {{-- File --}}
                                <div class="col-lg-6">
                                    <label for="file">Upload</label>
                                    <input name="file" type="file"
                                        class="form-control @error('file') is-invalid @enderror" id="file"
                                        value="{{ old('file') }}">
                                    @error('file')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description" cols="30" rows="10"
                                        class="form-control @error('description') is-invalid @enderror" style="height:100px"></textarea>
                                    @error('description')
                                        <label class="error text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
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
