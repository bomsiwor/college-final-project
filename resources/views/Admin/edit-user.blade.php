@extends('Template.layouts')

@section('main')
    <h2 class="fw-bold">Edit data User</h2>
    <nav>
        <ol class="breadcrumb bg-info">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
    </nav>
    <a href="{{ route('admin.manageUser') }}" class="btn btn-primary my-1">Kembali</a>

    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h5 class="card-title">Edit Data</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.update-user') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="row form-group">
                            <div class="col-lg-4">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control form-control-sm"
                                    value="{{ $user->name }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="email">Surel</label>
                                <input type="text" name="email" id="email" class="form-control form-control-sm"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="phone">No Telepon</label>
                                <input type="text" name="phone" id="phone" class="form-control form-control-sm"
                                    value="{{ $user->phone }}">
                            </div>

                            <div class="col-lg-4">
                                <label for="identifier">Jenis Identitas</label>
                                <select name="identifier" id="identifier" class="form-select select2">
                                    <option value="null">Pilih di bawah ini...</option>
                                    <option value="KTP" @selected($user->identifier == 'KTP')>Kartu Tanda Penduduk</option>
                                    <option value="SIM" @selected($user->identifier == 'SIM')>Surat Izin Mengemudi</option>
                                    <option value="NIM" @selected($user->identifier == 'NIM')>Nomor Induk Mahasiswa</option>
                                    <option value="NIP" @selected($user->identifier == 'NIP')>Nomor Induk Pegawai</option>
                                    <option value="NIS" @selected($user->identifier == 'NIS')>Nomor Induk Siswa</option>
                                    <option value="PASPOR" @selected($user->identifier == 'PASPOR')>Pasport</option>
                                    <option value="KIA" @selected($user->identifier == 'KIA')>Kartu Identitas Anak</option>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label for="identification_number">Nomor Identitas</label>
                                <input type="text" name="identification_number" id="identification_number"
                                    class="form-control" value="{{ $user->identification_number }}">
                                <label class="error">Minimum 5 digit</label>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-4">
                                <label for="profession_id">Pekerjaan</label>
                                <select name="profession_id" id="profession_id" class="form-select">
                                    <option value="">Pilih di bawah ini...</option>
                                    @foreach ($professions as $profession)
                                        <option value="{{ $profession->id }}" @selected($user->profession_id == $profession->id)>
                                            {{ $profession->profession_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label for="institution">Nama Instansi</label>
                                <select name="institution_id" id="institution" class="form-select">
                                    <option value="">Pilih di bawah ini...</option>
                                    @foreach ($institutions as $institution)
                                        <option value="{{ $institution->id }}" @selected($user->institution_id == $institution->id)>
                                            {{ $institution->institution_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0 form-group">
                            <div class="col-lg-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" id="internal_check" value="1"
                                            @checked($user->study_program_id || $user->unit_id)>
                                        Internal Poltek Nuklir
                                        <i class="input-helper"></i></label>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-4">
                                <label for="study_program_id">Program Studi</label>
                                <select class="form-select" name="study_program_id" id="study_program_id">
                                    <option value="">Pilih...</option>
                                    <option value="1" @selected($user->study_program_id == 1)>Teknokimia Nuklir</option>
                                    <option value="2" @selected($user->study_program_id == 2)>Elektronika Instrumentasi</option>
                                    <option value="3" @selected($user->study_program_id == 3)>ElektroMekanika</option>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label for="unit">Unit</label>
                                <select class="form-select" name="unit_id" id="unit">
                                    <option value="">Pilih...</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}" @selected($user->unit_id == $unit->id)>
                                            {{ $unit->unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const checker = $('#internal_check');
            let check = checker.is(':checked');

            $('#unit').prop('disabled', !check);
            $('#study_program_id').prop('disabled', !check);


            checker.change(function(e) {
                e.preventDefault();
                check = checker.is(':checked');

                $('#unit').prop('disabled', !check);
                $('#study_program_id').prop('disabled', !check);
            });
        });

        // $("#internal_check").change(function(e) {
        //     e.preventDefault();
        //     let check = $(this).is(':checked');

        //     $('#unit').prop('disabled', !check);
        //     $('#study_program_id').prop('disabled', !check);
        // });
    </script>
@endsection
