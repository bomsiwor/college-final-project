@extends('Template.layouts')

@section('main')
    <h2 class="fw-bold">Pesan dari pengguna</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item active">Kritik & Saran</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Daftar pesan dari pengguna</h5>
            @foreach ($data as $message)
                <div class="media border p-2">
                    <div class="media-body">
                        <h4 class="mt-0">{{ $message->subject }}</h4>
                        <p class="text-muted">oleh : {{ $message->name }}</p>
                        <p>{{ $message->message_text }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
