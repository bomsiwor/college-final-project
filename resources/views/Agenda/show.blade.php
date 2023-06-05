@extends('Template.layouts')


@section('main')
    <div class="pagetitle">
        <h2 class="fw-bold">Detail</h2>
        <nav>
            <ol class="breadcrumb bg-primary">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                <li class="breadcrumb-item">Agenda</li>
                <li class="breadcrumb-item active">Detail</li>
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
                    <h5 class="card-title mb-1 me-2">{{ $agenda->agenda_name }}</h5>
                    <p>Dilaksanakan pada @tanggal($agenda->date) pukul {{ $agenda->start_time }} sampai {{ $agenda->end_time }}
                    </p>
                    <p>{{ $document->description ?? 'Tidak ada keterangan' }}</p>
                </div>
            </div>

        </div>

    </div>
@endsection
