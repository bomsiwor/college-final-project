@extends('Template.layouts')

@push('vendorStyle')
    @livewireStyles
@endpush

@section('main')
    <div class="pagetitle">
        <h2 class="fw-bold">Tambah Data</h2>
        <nav>
            <ol class="breadcrumb bg-primary">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
                <li class="breadcrumb-item">Sumber</li>
                <li class="breadcrumb-item active">Tambah data</li>
            </ol>
        </nav>
        <a href="{{ route('report.index') }}" class="btn btn-primary mb-2"><span class="mdi mdi-arrow-left"></span>
            Kembali</a>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Pengajuan Permintaan Tindakan Perbaikan</h5>
                    @livewire('tool.report-problem-component')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('vendorScript')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('script')
    <script>
        window.addEventListener('request-stored', event => {
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
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.replace(
                        "{{ route('report.index') }}")
                }
            })
        })
    </script>
@endsection
