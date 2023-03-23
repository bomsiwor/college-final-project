@extends('Template.layouts')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Daftar Kunjungan Laboratorium</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Pagu</a></li>
                    <li class="breadcrumb-item">Presensi</li>
                    <li class="breadcrumb-item active">Total</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Kunjungan</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Keperluan</th>
                                            <th scope="col">Hari</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Waktu</th>
                                            <th scope="col">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $da)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $da->user->name }}</td>
                                                <td>{{ __('activity.' . $da->occupation) }}</td>
                                                <td>@hari($da->attendance_time)</td>
                                                <td>@tanggal($da->attendance_time)
                                                </td>
                                                <td>{{ $da->attendance_time->isoFormat('HH:mm:ss') }} WIB
                                                </td>
                                                <td>{{ $da->description }}
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
            </div>
        </section>

    </main><!-- End #main -->
@endsection
