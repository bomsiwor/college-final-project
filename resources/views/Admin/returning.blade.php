@extends('Template.layouts')

@push('vendorStyle')
    @livewireStyles
@endpush

@push('vendorScript')
    @livewireScripts
@endpush

@section('main')

    <h2 class="fw-bold">Kelola Data Pengembalian</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item">Pengembalian</li>
            <li class="breadcrumb-item active">Semua</li>
        </ol>
    </nav>


    <div class="row">
        <div class="col-lg-12">
            @if (session('success'))
                <div class="alert alert-success">
                    Data pengembalian diperbarui dan dicatat dalam data pengembalian.
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Tombol Tab --}}
            <ul class="nav nav-pills border-0" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-tool-borrow-tab" data-bs-toggle="pill" href="#pills-tool-borrow"
                        role="tab" aria-controls="pills-tool-borrow" aria-selected="true">Barang/Alat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-radioactive-borrow-tab" data-bs-toggle="pill"
                        href="#pills-radioactive-borrow" role="tab" aria-controls="pills-radioactive-borrow"
                        aria-selected="false">Sumber</a>
                </li>
            </ul>
            <div class="card my-1">
                <div class="card-body">
                    {{-- Tab --}}
                    <div class="tab-content border-0" id="pills-tabContent">
                        {{-- Tab alat --}}
                        <div class="tab-pane fade active show" id="pills-tool-borrow" role="tabpanel"
                            aria-labelledby="pills-tool-borrow-tab">
                            @livewire('admin.tool-borrow')
                        </div>

                        {{-- Tab sumber --}}
                        <div class="tab-pane fade" id="pills-radioactive-borrow" role="tabpanel"
                            aria-labelledby="pills-radioactive-borrow-tab">
                            @livewire('admin.radioactive-borrow')
                        </div>
                    </div>
                </div>
            </div>


            {{-- Tombol Tab --}}
            <ul class="nav nav-pills border-0 mt-2" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-returning-borrow-tab" data-bs-toggle="pill"
                        href="#pills-returning-borrow" role="tab" aria-controls="pills-returning-borrow"
                        aria-selected="true">Barang/Alat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-radioactive-returning-tab" data-bs-toggle="pill"
                        href="#pills-radioactive-returning" role="tab" aria-controls="pills-radioactive-returning"
                        aria-selected="false">Sumber</a>
                </li>
            </ul>
            {{-- Card pengembalian --}}
            <div class="card my-2">
                <div class="card-body">
                    {{-- Tab --}}
                    <div class="tab-content border-0" id="pills-tabContent">
                        {{-- Tab alat --}}
                        <div class="tab-pane fade active show" id="pills-returning-borrow" role="tabpanel"
                            aria-labelledby="pills-returning-borrow-tab">
                            @livewire('admin.tool-returning-component')
                        </div>

                        {{-- Tab sumber --}}
                        <div class="tab-pane fade" id="pills-radioactive-returning" role="tabpanel"
                            aria-labelledby="pills-radioactive-returning-tab">
                            @livewire('admin.radioactive-returning-component')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Modal pengembalian alat --}}
    <div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="returnModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('borrow.tool.return') }}" method="post" id="returnForm">
                        @csrf
                        {{-- Tanggal --}}
                        <div class="row mb-3 align-items-center align-item-center">
                            <label for="returningDate" class="col-sm-4 col-form-label-sm">Tanggal Pengembalian</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control w-50 " name="returning_date">
                                <div id="returningDateHelp" class="form-text">Minimal hari ini.
                                </div>
                            </div>
                        </div>
                        {{-- Tujuan --}}
                        <div class="row mb-3 align-items-center">
                            <label for="deskripsiPinjam" class="col-sm-4 col-form-label-sm">Kondisi</label>
                            <div class="col-sm-8">
                                <select id="deskripsiPinjam" class="form-select " aria-label="Pilih Kondisi..."
                                    name="condition">
                                    <option value="">Pilih Kondisi..</option>
                                    <option value="good">Baik</option>
                                    <option value="minor">Rusak Ringan</option>
                                    <option value="severe">Rusak berat</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="id" name="id">

                        <div class="row mb-3 align-items-center">
                            <label for="description" class="col-md-4 col-lg-3 col-form-label-sm">Keterangan</label>
                            <div class="col-md-8 col-lg-9">
                                <textarea name="description" class="form-control " id="description" style="height: 100px" maxlength="255"></textarea>
                                <div id="descHelp" class="form-text">Maksimum 255 karakter
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="returnForm">Submit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal pengembalian Sumber --}}
    <div class="modal fade" id="radioactive-return-modal" tabindex="-1" aria-labelledby="radioactive-return-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="radioactive-return-modalLabel">Pengembalian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('borrow.radioactive.return') }}" method="post" id="radioactiveReturnForm">
                        @csrf
                        {{-- Tanggal --}}
                        <div class="row mb-3 align-items-center align-item-center">
                            <label for="returningDate" class="col-sm-4 col-form-label-sm">Tanggal Pengembalian</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control w-50 " name="returning_date">
                                <div id="returningDateHelp" class="form-text">Minimal hari ini.
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="id" name="id">

                        <div class="row mb-3 align-items-center">
                            <label for="description" class="col-md-4 col-lg-3 col-form-label-sm">Keterangan</label>
                            <div class="col-md-8 col-lg-9">
                                <textarea name="description" class="form-control " id="description" style="height: 100px" maxlength="255"></textarea>
                                <div id="descHelp" class="form-text">Maksimum 255 karakter
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="radioactiveReturnForm">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const exampleModal = document.getElementById('returnModal')
        if (exampleModal) {
            exampleModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const id = button.getAttribute('data-bs-whatever')
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                // Update the modal's content.
                const modalTitle = exampleModal.querySelector('.modal-title')
                const modalBodyInput = exampleModal.querySelector('#id')

                modalTitle.textContent = `Pengembalian #ID-${id}`
                modalBodyInput.value = id
            })
        }
    </script>

    {{-- Pengembalian sumber --}}
    <script>
        const modalBox = document.getElementById('radioactive-return-modal')
        if (modalBox) {
            modalBox.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const id = button.getAttribute('data-bs-whatever')
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                // Update the modal's content.
                const modalTitle = modalBox.querySelector('.modal-title')
                const modalBodyInput = modalBox.querySelector('#id')

                modalTitle.textContent = `Pengembalian #ID-${id}`
                modalBodyInput.value = id
            })
        }
    </script>
@endsection
