@extends('Template.layouts')

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
        <div class="col-lg-9">
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
                    <h5 class="card-title">Semua peminjaman</h5>

                    <div class="alert alert-warning">
                        <h6 class="fw-bold">
                            <i class="mdi mdi-information"></i> PETUNJUK!
                        </h6>
                        <ul class="mb-0">
                            <li>
                                Data yang ditampilkan adalah peminjaman yang <STRONG>sudah disetujui</STRONG> melalui
                                halaman <a href="{{ route('borrow.index') }}">PEMINJAMAN</a>
                            </li>
                            <li>
                                Gunakan tombol <strong>Kembalikan</strong> untuk mencatat pengembalian alat
                            </li>
                            <li>
                                Geser tabel ke kanan untuk kolom yang lebih lengkap
                            </li>
                        </ul>
                    </div>



                    {{-- Tab --}}
                    <div class="tab-content border-0" id="pills-tabContent">
                        {{-- Tab alat --}}
                        <div class="tab-pane fade active show" id="pills-tool-borrow" role="tabpanel"
                            aria-labelledby="pills-tool-borrow-tab">
                            @if (!$data->isEmpty())
                                <p>
                                    Menampilkan semua pengajuan peminjaman inventaris dari laboratorium <b>yang telah
                                        disetujui.</b>
                                </p>
                                <!-- Table with hoverable rows -->
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">#</th>
                                                <th scope="col">Nama Peminjam</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Tanggal Pinjam</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $borrow)
                                                <tr>
                                                    <th>{{ $loop->iteration }}</th>
                                                    <td>{{ $borrow->user->name }}</td>
                                                    <td class="text-center">{{ $borrow->inventory->name }}</td>
                                                    <td class="text-center text-wrap w-50">
                                                        @tanggal($borrow->start_borrow_date) s/d @tanggal($borrow->expected_return_date)
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $borrow->status_peminjaman }}
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#returnModal"
                                                            data-bs-whatever="{{ $borrow->id }}">Kembalikan</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Table with hoverable rows -->
                            @else
                                <p>Tidak ada data untuk ditampilkan.</p>
                            @endif
                        </div>

                        {{-- Tab sumber --}}
                        <div class="tab-pane fade" id="pills-radioactive-borrow" role="tabpanel"
                            aria-labelledby="pills-radioactive-borrow-tab">
                            <div class="media">
                                <img class="me-3 w-25 rounded" src="../../../../images/samples/300x300/10.jpg"
                                    alt="sample image">
                                <div class="media-body">
                                    <p>I'm thinking two circus clowns dancing. You? Finding a needle in a haystack isn't
                                        hard when every straw is computerized. Tell him time is of the essence.
                                        Somehow, I doubt that. You have a good heart, Dexter.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card pengembalian --}}
            <div class="card my-1">
                <div class="card-body">
                    <h5 class="card-title">Pengembalian</h5>
                    <!-- Table with hoverable rows -->
                    @if (!$returnings->isEmpty())
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">ID Pinjaman</th>
                                        <th scope="col">Verifikator</th>
                                        <th scope="col">Tanggal Kembali</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($returnings as $returning)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td class="text-center">{{ $returning->id }} - <a
                                                    href="{{ route('borrow.tool.show', ['borrow' => $returning->id]) }}"
                                                    class="border border-primary px-1 py-1"
                                                    style="text-decoration: none">Detail</a>
                                            <td class="text-center">{{ $returning->verificator->name }}</td>
                                            <td class="text-center">
                                                {{ $returning->returning_date->isoFormat('dddd, DD-MM-Y') }}
                                            </td>
                                            <td class="text-center">{{ __("core.$returning->condition.text") }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Tidak ada ditampikan</p>
                    @endif

                    <!-- End Table with hoverable rows -->
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
@endsection

@section('script')
    <script>
        const exampleModal = document.getElementById('returnModal')
        if (exampleModal) {
            exampleModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const recipient = button.getAttribute('data-bs-whatever')
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                // Update the modal's content.
                const modalTitle = exampleModal.querySelector('.modal-title')
                const modalBodyInput = exampleModal.querySelector('#id')

                modalTitle.textContent = `Pengembalian #ID-${recipient}`
                modalBodyInput.value = recipient
            })
        }
    </script>
@endsection
