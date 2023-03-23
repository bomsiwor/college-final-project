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
                                <table class="table table-hover">
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
                                                        href="{{ route('tool.detail', ['tool' => $da->inventory_number]) }}">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- End Table with hoverable rows -->
                            </div>

                            <div>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Data</h5>
                            <p>Tambahkan data peralatan yang dimiliki.</p>
                            <a href="{{ route('tool.create') }}" class="btn btn-primary"><i
                                    class="mdi mdi-plus-circle"></i> Tambah</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistik</h5>
                            <p>Saat ini Laboratorium Instrumentasi Nuklir memiliki, <br>
                                {{ count($data) }} Alat dengan rincian :</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
