@extends('Template.layouts')

@section('main')
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#toolLogModal">log alat</button>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#radiationLogModal">log rad</button>

    {{-- Modal tool log --}}
    @livewire('activity.tool-log')
    @livewire('radiation-log-component')
@endsection

@push('vendorStyle')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

    @livewireStyles
@endpush

@section('script')
    @livewireScripts
    <script>
        $(document).ready(function() {
            $('.my-select').selectpicker();
        });
    </script>
@endsection
