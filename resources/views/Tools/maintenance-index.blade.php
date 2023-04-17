@extends('Template.layouts')

@section('main')
    <h2>Data Perawatan Alat</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item">Aset</li>
            <li class="breadcrumb-item active">Perawatan</li>
        </ol>
    </nav>
@endsection
