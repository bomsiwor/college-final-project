@extends('Template.layouts')

@section('main')
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#toolLogModal">log alat</button>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#radiationLogModal">log rad</button>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#attendanceModal">presensi</button>

    <form action="{{ route('dashboard.blank') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="file" class="form-control-sm">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <button class="btn btn-primary" id="swals" onclick="trigSwals()">Swal</button>

    {{-- Modal tool log --}}
    @livewire('activity.tool-log')
    @livewire('radiation-log-component')
    @livewire('activity.attendance-form')
@endsection

@push('vendorStyle')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

    @livewireStyles
@endpush

@push('vendorScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('script')
    @livewireScripts
    <script>
        $(document).ready(function() {
            $('.my-select').selectpicker();
        });

        function trigSwals() {
            Swal.fire({
                title: 'Yakin hapus verifikasi?',
                text: "Tindakan ini tidak dapat dikembalikan, harus dilakukan verifikasi ulang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }
    </script>

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
