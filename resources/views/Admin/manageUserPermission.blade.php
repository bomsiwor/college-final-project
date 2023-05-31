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
        <a href="{{ route('admin.manageUser') }}" class="btn btn-primary my-2">Kembali</a>
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
                    <h5 class="card-title">Daftar User berdasarkan Previlege</h5>
                    <p>Menampilkan daftar user dengan previlege - <span class="fw-bold">{{ __("core.$previlege") }}</span>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $da)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $da->name }}
                                            <br>
                                            {{ $da->profession->profession_name }}
                                            <br>
                                            {{ $da->institution->institution_name }}
                                        </td>
                                        <td>
                                            <form action="{{ route('user.previlege.update') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="previlege" value="{{ $previlege }}">
                                                <input type="hidden" name="operation" value="revoke">
                                                <input type="hidden" name="user_id" value="{{ $da->id }}">
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus
                                                    Previlege</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambahkan User</h5>
                    <div class="alert alert-info">
                        Tambahkan previlege - <span class="fw-bold">{{ __("core.$previlege") }} - kepada user
                            tertentu.</span>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('user.previlege.update') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="previlege" value="{{ $previlege }}">
                            <input type="hidden" name="operation" value="assign">
                            <div class="col-lg-12 my-2">
                                <label for="name">ID User</label>
                                <input name="user_id" type="text" class="form-control form-control-sm " id="user_id">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
