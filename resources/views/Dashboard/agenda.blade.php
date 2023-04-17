@extends('Template.layouts')

@section('main')
    <h2 class="fw-bold">Agenda Laboratorium</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item active">Agenda</li>
        </ol>
    </nav>
@endsection
