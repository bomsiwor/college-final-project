@extends('Template.layouts')

@section('script')
    @livewireScripts

    <script>
        window.addEventListener('attendance-stored', event => {
            let timerInterval
            Swal.fire({
                title: 'Sukses!',
                icon: 'success',
                html: 'Data anda sudah tercatat<br>Pesan ini akan tertutup dalam <b></b> milliseconds.',
                timer: 2000,
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
                $(function() {
                    $('#attendanceModal').modal('hide');
                });
            })
        })
    </script>
@endsection

@push('vendorStyle')
    @livewireStyles
@endpush

@section('main')
    <div class="pagetitle">
        <h2 class="fw-bold">Data Kunjungan</h2>
        <nav>
            <ol class="breadcrumb bg-primary">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                <li class="breadcrumb-item">Aktivitas</li>
                <li class="breadcrumb-item active">Presensi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <h4>Pilih Data</h4>
    <div class="row">
        {{-- Isi presensi --}}
        <div class="col-lg-3">
            <div class="card bg-linkedin mb-2">
                <div class="card-body">
                    <h5 class="card-title text-white">ISI PRESENSI</h5>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#attendanceModal"
                        class="stretched-link text-decoration-none text-white fw-bold">Klik disini <span
                            class="mdi mdi-arrow-right"></span></a>
                </div>
            </div>
        </div>

        {{-- Semua data card --}}
        <div class="col-lg-3">
            <div class="card bg-info mb-2">
                <div class="card-body">
                    <h5 class="card-title text-white">Semua data</h5>
                    <p class="text-white">Semua data presensi</p>
                    <a href="{{ route('attendance.total') }}" class="btn btn-sm btn-primary">Lihat data</a>
                </div>
            </div>
        </div>

        {{-- Data sendiri card --}}
        <div class="col-lg-3">
            <div class="card bg-primary">
                <div class="card-body">
                    <h5 class="card-title text-white">Data Sendiri</h5>
                    <p class="text-white">Data presensi akun ini</p>
                    <a href="{{ route('attendance.me') }}" class="btn btn-sm btn-info">Lihat data</a>
                </div>
            </div>
        </div>
    </div>

    @livewire('activity.attendance-form')
@endsection

@push('vendorScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
