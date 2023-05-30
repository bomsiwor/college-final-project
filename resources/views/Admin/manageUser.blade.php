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
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            Sukses, {{ session('success') }}
                        </div>
                    @endif
                    <h5 class="card-title">Daftar User</h5>
                    <p>Kelola dan telusuri akun pengguna disini</p>

                    @livewire('admin.user-list')
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Admin Previleges</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Previlege</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
