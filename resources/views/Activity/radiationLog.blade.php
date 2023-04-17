@extends('Template.layouts')

@section('main')
    <h2 class="fw-bold">Catatan Penerimaan Radiasi</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Aktivitas</a></li>
            <li class="breadcrumb-item active">Penerimaan Radiasi</li>
        </ol>
    </nav>
@endsection
