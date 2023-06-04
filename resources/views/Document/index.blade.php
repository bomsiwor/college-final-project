@extends('Template.layouts')

@section('main')
    <h2 class="fw-bold">Dokumen</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item active">Dokumen</li>
            <li class="breadcrumb-item active">Modul</li>
        </ol>
    </nav>


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p>Topik yang tersedia</p>
                    <form action="{{ route('document.index', ['document' => $category]) }}">
                        @forelse ($topics as $topic)
                            <button type="submit" class="btn btn-sm btn-outline-primary" name="search"
                                value="{{ $topic }}">{{ $topic }}</button>

                        @empty
                            <p>Tidak ada</p>
                        @endforelse
                    </form>
                </div>

                <div class="col-md-8">
                    <form action="{{ route('document.index', ['document' => $category]) }}">
                        <div class="row form-group">
                            <label for="search">Cari dokumen</label>
                            <div class="col-md-9">
                                <input type="text" name="search" id="search" placeholder="Masukkan kata kunci..."
                                    class="form-control" autocomplete="off" value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        @forelse ($document as $doc)
            <div class="col-md-4">
                <div class="card my-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">{{ $doc->title }}</h4>
                            <div>
                                <span
                                    class="badge border border-primary text-primary">{{ __("core.$doc->category") }}</span>
                            </div>
                        </div>
                        <p>{{ $doc->topic }}</p>
                    </div>

                    <div class="card-footer d-flex justify-content-end gap-2">
                        <form action="{{ route('document.download') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success" name="id"
                                value="{{ $doc->id }}">Unduh</button>
                        </form>
                        <a href="{{ route('document.show', ['document' => $doc->id]) }}"
                            class="btn btn-sm btn-primary">Detail</a>
                    </div>
                </div>
            </div>

            {{ $document->links() }}
        @empty
            <p>Tidak ada</p>
        @endforelse


    </div>
@endsection
