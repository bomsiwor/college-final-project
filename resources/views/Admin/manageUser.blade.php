@extends('Template.layouts')

@push('vendorStyle')
    @livewireStyles
@endpush

@push('vendorScript')
    @livewireScripts
@endpush

@section('main')
    <h2 class="fw-bold">Kelola User</h2>
    <nav>
        <ol class="breadcrumb bg-info">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Kelola User</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8 mb-2">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h5 class="card-title">Daftar User</h5>
                    <p>Kelola dan telusuri akun pengguna disini</p>

                    <div class="overflow-scroll" style="max-height: 300px">
                        @livewire('admin.user-list')
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Admin Previleges</h5>
                    <div class="alert alert-info">
                        Cek pengguna berdasarkan kemampuan pengguna yang dimiliki
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Previlege</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($previleges as $previlege)
                                    <tr>
                                        <td>{{ __("core.$previlege->name") }}</td>
                                        <td><a href="{{ route('user.previlege', ['previlege' => $previlege->name]) }}"
                                                class="btn btn-sm btn-info">Cek</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
