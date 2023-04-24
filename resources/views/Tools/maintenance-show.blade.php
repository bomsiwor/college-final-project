@extends('Template.layouts')

@section('main')
    <h2>
        Detail Operasi</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item">Aset</li>
            <li class="breadcrumb-item"><a href="{{ route('maintenance.index') }}">Perawatan</a></li>
            <li class="breadcrumb-item active"># {{ $maintenance->id }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="card-title">Data lengkap</h4>
                            @if (session('success'))
                                <div class="alert alert-success">Data diperbarui!</div>
                            @endif
                            <address>
                                <p class="fw-bold">Nama Kegiatan</p>
                                <p>{{ $maintenance->activity_name }}</p>
                            </address>
                            <address>
                                <p class="fw-bold">Agenda</p>
                                <p>{{ $maintenance->agenda }}</p>
                            </address>
                            <address>
                                <p class="fw-bold">Rencana Pelaksanaan</p>
                                <p>{{ $maintenance->month->isoFormat('MMMM Y') }}</p>
                            </address>
                            <address>
                                <p class="fw-bold">Pelaksana</p>
                                <p>{{ $maintenance->in_charge }}</p>
                            </address>
                            <address>
                                <p class="fw-bold">Keterangan</p>
                                <p>{{ $maintenance->description }}</p>
                            </address>
                            <hr class="d-md-none">
                        </div>
                        <div class="col-md-4">
                            <div>
                                <a href="#" class="btn btn-sm btn-warning mb-2">Edit data</a>
                                <button class="btn btn-danger btn-sm mb-2"
                                    onclick="deleteData({{ $maintenance->id }})">Hapus data</button>
                                @if ($maintenance->is_done)
                                    <button class="btn btn-sm btn-danger mb-2"
                                        onclick="cancelVerify({{ $maintenance->id }})">Batalkan verifikasi</button>
                                @endif
                            </div>
                            <address>
                                <p class="fw-bold">Status</p>
                                <p>
                                    @if ($maintenance->is_done)
                                        Telah dilaksanakan
                                    @else
                                        Belum dilaksanakan
                                    @endif
                                </p>
                            </address>
                            <address>
                                <p class="fw-bold">Realisasi Pelaksanaan</p>
                                <p>{{ $maintenance->actual_date ? $maintenance->actual_date->isoFormat('dddd, DD MMMM Y') : 'Belum dilaksanakan' }}
                                </p>
                            </address>
                            <address>
                                <p class="fw-bold">Dokumen</p>
                                @if ($maintenance->document)
                                    <a href="{{ route('maintenance.download', ['maintenance' => $maintenance->id]) }}"
                                        class="btn btn-sm btn-info">Unduh dokumen</a>
                                @else
                                    <p>-</p>
                                @endif
                            </address>
                            <address>
                                <p class="fw-bold">Catatan Pelaksanaan</p>
                                <p>{{ $maintenance->operation_note ? $maintenance->operation_note : '-' }}
                                </p>
                            </address>
                            <address>
                                <p class="fw-bold">Dibuat pada</p>
                                <p>{{ $maintenance->created_at }}</p>
                            </address>
                            <address>
                                <p class="fw-bold">Diperbarui pada</p>
                                <p>{{ $maintenance->updated_at }}</p>
                            </address>
                            <hr class="d-md-none">
                        </div>
                        @if (!$maintenance->is_done)
                            <div class="col-md-4">
                                <h4 class="card-title">Verifikasi</h4>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('maintenance.verify') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $maintenance->id }}">
                                    <div class="row mb-3 align-items-center align-item-center">
                                        <label for="actualDate" class="col-sm-4 col-form-label-sm">Tanggal
                                            Pelaksanaan</label>
                                        <div class="col-sm-8">
                                            <input type="date" id="actualDate" class="form-control" name="actual_date">
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-start">
                                        <label for="operation_note" class="col-sm-4 col-form-label-sm">Catatan</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" style="height: 200px" name="operation_note"></textarea>
                                        </div>
                                    </div>

                                    <div class="row align-content-center mb-1">
                                        <label for="document" class="col-sm-4 col-form-label-sm">Dokumen</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="document" multiple id="document">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-check form-check-success">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="is_done"
                                                    value="1">
                                                Tandai telah dilaksanakan
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('vendorScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('script')
    <script>
        function cancelVerify(id) {
            Swal.fire({
                title: `Yakin membatalkan verifikasi untuk ${id} ?`,
                text: "Tindakan ini tidak dapat dikembalikan, harus dilakukan verifikasi ulang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = {{ $maintenance->id }};
                    $.ajax({
                        method: "POST",
                        url: "{{ route('maintenance.unverify') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            data: id,
                        },
                        dataType: "json",
                        beforeSend: function(response) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Tunggu',
                                text: 'Proses sedang berjalan!',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            })
                        },
                        success: function(response) {
                            let timerInterval
                            Swal.fire({
                                title: 'Sukses!',
                                icon: 'success',
                                html: 'Halaman akan disegarkan dalam <b></b> milliseconds.',
                                timer: 2500,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.reload()
                                }
                            })
                        },
                        error: function(response) {
                            Swal.fire(
                                'Gagal',
                                'Operasi gagal dilakukan',
                                'error'
                            )
                        }
                    });
                }
            })
        }

        function deleteData(id) {
            Swal.fire({
                title: 'Yakin untuk menghapus data?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('maintenance.delete') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: {{ $maintenance->id }}
                        },
                        dataType: "json",
                        beforeSend: function(response) {
                            Swal.fire({
                                title: 'Tunggu...',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            })
                        },
                        success: function(response) {
                            let timerInterval
                            Swal.fire({
                                title: 'Sukses!',
                                icon: 'success',
                                html: 'Halaman akan disegarkan dalam <b></b> milliseconds.',
                                timer: 2500,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location.replace(
                                        "{{ route('maintenance.index') }}")
                                }
                            })
                        },
                        error: function(response) {
                            Swal.fire(
                                'Gagal',
                                'Operasi gagal dilakukan',
                                'error'
                            )
                        }
                    });
                }
            })
        }
    </script>
@endsection
