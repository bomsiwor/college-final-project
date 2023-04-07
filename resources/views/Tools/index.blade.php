@extends('Template.layouts')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Aset Alat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Pagu</a></li>
                    <li class="breadcrumb-item">Aset</li>
                    <li class="breadcrumb-item active">Alat</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Alat</h5>
                            <div class="table-responsive">
                                <table class="table table-hover" id="toolTable">
                                    <thead class="text-center">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Alat</th>
                                            <th scope="col">Merk</th>
                                            <th scope="col">Seri</th>
                                            <th scope="col">Kondisi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $da)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $da->name }}</td>
                                                <td>{{ $da->merk }}</td>
                                                <td>{{ $da->series }}</td>
                                                <td><span
                                                        class="badge {{ __("core.$da->condition.class") }}">{{ __("core.$da->condition.text") }}</span>
                                                </td>
                                                <td><span class="mdi {{ __("core.$da->status.symbol") }}"></span>
                                                    {{ __("core.$da->status.text") }}
                                                </td>
                                                <td><a class="btn btn-primary mx-1 my-1"
                                                        href="{{ route('tool.detail', ['tool' => $da->inventory_unique]) }}">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- End Table with hoverable rows -->
                            </div>

                            {{-- <div>
                                {{ $data->links() }}
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    @role('admin')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Tambah Data</h5>
                                <p>Tambahkan data peralatan yang dimiliki.</p>
                                <a href="{{ route('tool.create') }}" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i>
                                    Tambah Manual</a>
                                <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal"
                                    data-bs-target="#toolBulkModal">
                                    Upload File
                                </button>
                            </div>
                        </div>
                    @endrole

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistik</h5>
                            <p>Saat ini Laboratorium Instrumentasi Nuklir memiliki, <br>
                                {{ count($data) }} Alat dengan rincian :</p>
                            <ol type="1">
                                @foreach ($count as $c)
                                    <li>
                                        <b> {{ __("core.$c->condition.text") }} </b> : {{ $c->num }} alat
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <div class="modal fade" id="toolBulkModal" tabindex="-1" aria-labelledby="toolBulkModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="toolBulkModalLabel">Upload Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Upload file berformat XLS atau CSV. Dengan kolom-kolom yang harus dibuat sesuai dengan <a
                            href="#">Panduan ini!</a></p>
                    <form action="{{ route('tool.create.bulk') }}" method="post" id="toolForm"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="occupation" class="col-md-4 col-lg-3 col-form-label">File</label>
                            <div class="col-md-8 col-lg-9">
                                <input type="file" class="form-control" name="toolFile" id="toolFile">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="toolForm">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let table = new DataTable("#toolTable");
    </script>
@endsection
