@extends('Template.layouts')


@section('main')
    <div class="pagetitle">
        <h2 class="fw-bold">Detail</h2>
        <nav>
            <ol class="breadcrumb bg-primary">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                <li class="breadcrumb-item">Dokumen</li>
                <li class="breadcrumb-item active">Edit data</li>
            </ol>
        </nav>
        <a href="{{ route('agenda.index') }}" class="btn btn-primary mb-2"><span class="mdi mdi-arrow-left"></span>
            Kembali</a>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-md-8">
            {{-- Utama --}}
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex justify-content-md-between">
                        <h5 class="card-title mb-1 me-2">{{ $document->title }}</h5>
                        <div>
                            <span
                                class="badge border border-primary text-primary">{{ __("core.$document->category") }}</span>
                        </div>

                    </div>
                    <p class="mb-2 fw-bold">{{ $document->topic }}</p>
                    <p>{{ $document->description ?? 'Tidak ada keterangan' }}</p>
                </div>
                <div class="card-footer">
                    <form action="{{ route('document.download') }}" method="post">
                        @csrf
                        <button name="id" value="{{ $document->id }}" class="btn btn-sm btn-primary"><span
                                class="mdi mdi-arrow-down"></span>Unduh dokumen</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted"><span class="mdi mdi-clock"></span>Diupload pada : @tanggal($document->created_at)</p>
                    <p class="text-muted"><span class="mdi mdi-clock"></span>Terakhir diperbarui : @tanggal($document->updated_at)</p>
                </div>
            </div>
        </div>
    </div>
@endsection
