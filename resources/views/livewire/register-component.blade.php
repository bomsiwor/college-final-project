<div>
    <p><b>Langkah ({{ $currentStep }}/3)</b></p>
    @switch($currentStep)
        @case(1)
            <div class="step-one">
                <div class="row form-group">

                    <div class="col">
                        <label for="name">Nama lengkap <span class="fs-italic">(tanpa gelar)</span></label>
                        <input type="text" name="name" id="name"
                            class="form-control form-control-sm @error('name') is-invalid @enderror" wire:model.defer='name'>
                        @error('name')
                            <label class="error text-danger">
                                {{ $message }}
                            </label>
                        @enderror
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control form-control-sm @error('email') is-invalid @enderror" wire:model.defer='email'>
                        @error('email')
                            <label class="error text-danger">
                                {{ $message }}
                            </label>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label for="password">Kata Sandi</label>
                        <input type="password" name="password" id="password"
                            class="form-control form-control-sm @error('password') is-invalid @enderror"
                            wire:model.defer='password'>
                        @error('password')
                            <label class="error text-danger">
                                {{ $message }}
                            </label>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" wire:model.defer='wargaCheck' value="1">
                            Internal Poltek Nuklir
                            <i class="input-helper"></i></label>
                    </div>
                </div>
            </div>
        @break

        @case(2)
            <div class="step-two">
                <div class="row form-group">
                    @if ($wargaCheck)
                        <p>Posisi anda</p>
                        <div class="d-flex flex-wrap justify-content-evenly">
                            <button class="btn btn-primary" wire:click="changePosition('lecturer')">Dosen</button>
                            <button class="btn btn-warning" wire:click="changePosition('student')">Mahasiswa</button>
                            <button class="btn btn-info" wire:click="changePosition('staff')">Staff</button>
                        </div>
                    @else
                        <p>Kondisi Anda</p>
                        <div class="d-flex flex-wrap justify-content-evenly">
                            <button class="btn btn-primary" wire:click="changePosition('unemployed')">Tidak Bekerja</button>
                            <button class="btn btn-warning" wire:click="changePosition('work')">Bekerja</button>
                        </div>
                    @endif
                </div>
            </div>
        @break

        @case(3)
            <div class="step-three">
                <div class="row form-group">
                    @if ($position == 'student')
                        <div class="col-lg-6">
                            <label for="prodi">Program Studi</label>
                            <select class="form-select" name="prodi" id="prodi" wire:model.defer='prodi'>
                                <option value="1">Teknokimia Nuklir</option>
                                <option value="2">Elektronika Instrumentasi</option>
                                <option value="3">ElektroMekanika</option>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <input type="hidden" name="identifier" wire:model.defer='identifier' value="NIM">
                            <label for="identification_number">NIM</label>
                            <input wire:model.defer='identification_number' type="text" name="identification_number"
                                id="identification_number" class="form-control">
                            @error('identification_number')
                                <label class="error text-danger">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>
                    @elseif($position == 'staff')
                        <div class="col-lg-6">
                            <label for="unit">Unit</label>
                            <select class="form-select" name="unit" id="unit" wire:model.defer='unit'>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input type="hidden" name="identifier" wire:model.defer='identifier' value="NIP">
                            <label for="identification_number">NIP</label>
                            <input wire:model.defer='identification_number' type="text" name="identification_number"
                                id="identification_number" class="form-control">
                            @error('identification_number')
                                <label class="error text-danger">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>
                    @elseif($position == 'lecturer')
                        <div class="col-lg-6">
                            <input type="hidden" name="identifier" wire:model.defer='identifier' value="NIP">
                            <label for="identification_number">NIP</label>
                            <input wire:model.defer='identification_number' type="text" name="identification_number"
                                id="identification_number" class="form-control">
                            @error('identification_number')
                                <label class="error text-danger">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>
                    @else
                        <div class="col-lg-6">
                            <label for="identifier">Jenis Identitas</label>
                            <select name="identifier" id="identifier" class="form-select select2"
                                wire:model.defer='identifier'>
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
                            <input wire:model.defer='identification_number' type="text" name="identification_number"
                                id="identification_number" class="form-control">
                            @error('identification_number')
                                <label class="error text-danger">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>
                    @endif

                </div>

                @if ($position == 'work')
                    <div class="row form-group">
                        {{-- Pekerjaan --}}
                        <div class="col-lg-6">
                            <label for="profession_id">Pekerjaan</label>
                            <select name="profession_id" id="profession_id" class="form-select"
                                wire:model.defer='profession_id'>
                                <option value="">Pilih di bawah ini...</option>
                                @foreach ($professions as $profession)
                                    <option value="{{ $profession->id }}">{{ $profession->profession_name }}</option>
                                @endforeach
                            </select>
                            @error('profession_id')
                                <label class="error text-danger">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>

                        {{-- Tempat bekerja --}}
                        <div class="col-lg-6">
                            <label for="institution">Nama Instansi</label>
                            <select name="institution" id="institution" class="form-select" wire:model.defer='institution'>
                                <option value="">Pilih di bawah ini...</option>
                                @foreach ($institutions as $institution)
                                    <option value="{{ $institution->id }}">{{ $institution->institution_name }}</option>
                                @endforeach
                                <option value="other">Lainnya</option>
                            </select>
                            @error('institution')
                                <label class="error text-danger">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>


                    </div>
                @endif
            </div>
        @break

        @case(4)
            <div class="step-four">
                @error('failed')
                    <div class="alert alert-danger">

                        {{ $message }}

                    </div>
                @enderror
                {{-- Tambah tempat bekerja --}}
                @if ($institution == 'other')
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <label for="institution_name">Nama Organisasi/Instansi</label>
                            <input type="text" name="institution_name" id="institution_name"
                                class="form-control form-control-sm @error('institution_name') is-invalid @enderror"
                                wire:model.defer='institution_name'>
                            @error('institution_name')
                                <label class="error text-danger">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="institution_address">Alamat Instansi</label>
                            <input type="text" name="institution_address" id="institution_address"
                                class="form-control form-control-sm @error('institution_address') is-invalid @enderror"
                                wire:model.defer='institution_address'>
                            @error('institution_address')
                                <label class="error text-danger">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>
                    </div>
                @endif

                <div class="row form-group">
                    <div class="col-lg-8">
                        <div class="col">
                            <label for="phone">No Telepon yang dapat dihubungi</label>
                            <input type="text" name="phone" id="phone"
                                class="form-control form-control-sm @error('phone') is-invalid @enderror"
                                wire:model.defer='phone'>
                            @error('phone')
                                <label class="error text-danger">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" value="1"
                                        wire:model.defer='acceptTerms'>
                                    Data yang saya masukkan benar dan jujur
                                    <i class="input-helper"></i></label>
                            </div>
                            @error('acceptTerms')
                                <label class="error text-danger">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        @break

    @endswitch

    <div class="action-buttons row">
        <div class="d-flex justify-content-evenly">
            @if ($currentStep > 1)
                <button type="button" class="btn btn-dark" wire:click='decreaseStep'>Kembali</button>
            @endif

            @if ($currentStep < 4)
                <button type="button" class="btn btn-primary" wire:click='increaseStep'>Lanjut</button>
            @endif

            @if ($currentStep == 4)
                <button type="submit" class="btn btn-success" wire:click='register'>Daftar</button>
            @endif
        </div>
    </div>

</div>
