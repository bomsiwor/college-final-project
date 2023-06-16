@extends('Auth.layout')

@section('main')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">

            <div class="content-wrapper d-flex align-items-center auth px-0">

                <div class="row w-100 mx-0">
                    <div class="col-lg-6 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="{{ asset('assets/img/logo-insnuk.png') }}" alt="logo">
                            </div>
                            <h4>Registrasi</h4>
                            <h6 class="fw-light">Isi data-data yang diperlukan</h6>
                            <form action="{{ route('auth.github.form') }}" method="post">
                                @csrf

                                <input type="hidden" name="nickname" value="{{ $user->nickname }}">
                                <input type="hidden" name="name" value="{{ $user->name }}">
                                <input type="hidden" name="email" value="{{ $user->email }}">
                                <div class="row form-group">
                                    <div class="col-lg-6">
                                        <label for="password">Kata Sandi</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control form-control-sm">
                                        @error('password')
                                            <label class="error text-danger">
                                                {{ $message }}
                                            </label>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="identifier">Jenis Identitas</label>
                                        <select name="identifier" id="identifier" class="form-select select2">
                                            <option value="null">Pilih di bawah ini...</option>
                                            <option value="KTP">Kartu Tanda Penduduk</option>
                                            <option value="SIM">Surat Izin Mengemudi</option>
                                            <option value="NIM">Nomor Induk Mahasiswa</option>
                                            <option value="NIP">Nomor Induk Pegawai</option>
                                            <option value="NIS">Nomor Induk Siswa</option>
                                            <option value="PASPOR">Pasport</option>
                                            <option value="KIA">Kartu Identitas Anak</option>
                                        </select>
                                        @error('identifier')
                                            <label class="error text-danger">
                                                {{ $message }}
                                            </label>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="identification_number">Nomor Identitas</label>
                                        <input type="text" name="identification_number" id="identification_number"
                                            class="form-control">
                                        @error('identification_number')
                                            <label class="error text-danger">
                                                {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Daftar!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection

@push('vendorScript')
    <script src="{{ asset('dist/js/jquery-3.6.4.min.js') }}"></script>
@endpush

@section('script')
    <script>
        console.log('Created by Bomsiwor');
    </script>
@endsection
