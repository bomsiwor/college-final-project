<div class="card mb-3">
    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
        <p class="text-center small">
            Masukkan data-data anda di bawah ini.
        </p>
    </div>
    <form class="row g-3" wire:submit.prevent="submit" id="formRegister" novalidate method="post" autocomplete="off">
        <div class="row">
            <div class="card-body col-md-6">
                <!-- Nama depan -->
                <div class="col-12 mb-2">
                    <label for="name" class="form-label">Nama <em>(tanpa gelar)</em> </label>
                    <input type="text" class="form-control  @if ($errors->has('name')) is-invalid @endif"
                        id="name" required wire:model.defer='name' />
                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-12 mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required
                        wire:model.defer='email' />
                    @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Username -->
                <div class="col-12 mb-2">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="username"
                            wire:model.name='username' required />
                    </div>
                    @error('username')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="col-12 mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password"
                        wire:model.defer='password' required />
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="card-body col-md-6">
                <!-- Warga -->
                <div class="col-12">
                    <div class="row align-items-center">
                        <legend class="col-sm-6 col-form-label">
                            Warga STTN?
                        </legend>
                        <div class="col-sm-6 d-flex flex-row justify-content-evenly">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="wargaCheck" value="yes"
                                    onclick="check_warga('yes')" id="wargaYes" wire:model.defer='wargaCheck' />
                                <label class="form-check-label" for="wargaYes">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="wargaCheck" value="no"
                                    onclick="check_warga('no')" id="wargaNo" wire:model.defer='wargaCheck' />
                                <label class="form-check-label" for="wargaNo">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="d-none d-sm-block d-md-none">
                <div id="warga-callback" class="d-none animate__animated" wire:ignore.self>
                    <!-- Posisi -->
                    <div class="col-12">
                        <div class="row">
                            <legend class="col-sm-6 col-form-label">
                                Posisi
                            </legend>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="position" id="position1"
                                        value="dosen" wire:model.defer='position' onclick="showIdInput('dosen')" />
                                    <label class="form-check-label" for="position1">
                                        Dosen
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="position" id="position2"
                                        value="mahasiswa" onclick="showIdInput('mahasiswa')"
                                        wire:model.defer='position' />
                                    <label class="form-check-label" for="position2">
                                        Mahasiswa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="position" id="position3"
                                        value="staff" onclick="showIdInput('staff')" wire:model.defer='position' />
                                    <label class="form-check-label" for="position3">
                                        Staff
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Prodi --}}
                    <div id="prodiContainer" class="col-12 my-1 d-none" wire:ignore.self>
                        <label for="prodi" class="form-label">Program Studi</label>
                        <div wire:ignore>
                            <select class="selectpicker" data-live-search="true" name="prodi" id="prodi"
                                wire:model.defer='prodi'>
                                @foreach ($study_program as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- NIM -->
                    <div class="col-12 d-none animate__animated" id="mahasiswa-input" wire:ignore.self>
                        <!-- NIM -->
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" id="nim"
                            wire:model.defer='nim' />
                        @error('nim')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- NIP -->
                    <div class="col-12 d-block animate__animated" id="dosenStaff-input" wire:ignore.self>
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-control" id="nip"
                            wire:model.defer='nip' />
                        @error('nip')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Unit -->
                    <div class="col-12 my-1 d-none" id="unitContainer" wire:ignore>
                        <label for="example" class="form-label">Unit</label>
                        <div>
                            <select class="selectpicker" data-live-search="true" name="unit" id="unit"
                                wire:model.defer='unit'>
                                <option selected>Pilih...
                                </option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div id="nonWarga-callback" class="d-none animate__animated" wire:ignore.self>
                    <!-- Pekerjaan -->
                    <div class="col-12 my-1" wire:ignore>
                        <label for="profession" class="form-label">Pekerjaan</label>
                        <div>
                            <select class="selectpicker" data-live-search="true" name="profession" id="profession">
                                @foreach ($professions as $pro)
                                    <option value="{{ $pro->id }}">
                                        {{ $pro->profession_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Instansi -->
                    <div class="col-12" wire:ignore>
                        <label for="institution" class="form-label">Asal Instansi</label>
                        <div>
                            <select class="selectpicker" data-live-search="true" name="institution" id="institution"
                                wire:model.defer='institution'>
                                @foreach ($institutions as $inc)
                                    <option value="{{ $inc->id }}">
                                        {{ $inc->institution_name }}</option>
                                @endforeach
                                <option value="other">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <!-- Nama & alamat instansi -->
                    <div class="d-none" id="institutionAddressContainer">
                        <!-- Nama -->
                        <div class="col-12">
                            <label for="institutionName" class="form-label">Nama
                                Instansi</label>
                            <input type="text" name="institutionName" class="form-control" id="institutionName"
                                wire:model.defer='institutionName' />
                            @error('institutionName')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="col-12">
                            <label for="institutionAddress" class="form-label">Alamat
                                Instansi</label>
                            <input type="text" name="institutionAddress" class="form-control"
                                id="institutionAddress" />
                            <div class="text-danger">
                                Masukkan alamat!
                            </div>
                        </div>
                    </div>

                    {{-- Identifier --}}
                    <div class="col-12">
                        <label for="identifier" class="form-label">Jenis Identitas</label>
                        <input type="text" name="identifier" class="form-control" id="identifier" />
                        <div class="text-danger">
                            Masukkan alamat!
                        </div>
                    </div>

                    {{-- Identifier Number --}}
                    <div class="col-12">
                        <label for="identifierNumber" class="form-label">Nomor Identitas</label>
                        <input type="text" name="identifierNumber" class="form-control" id="identifierNumber" />
                        <div class="text-danger">
                            Masukkan alamat!
                        </div>
                    </div>
                </div>

                <!-- Setuju peraturan -->
                <div class="col-12 my-2">
                    <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="yes"
                            id="acceptTerms" required wire:model.defer='acceptTerms' />
                        <label class="form-check-label" for="acceptTerms">Saya yakin data yang
                            saya masukan sudah
                            benar & jujur</label>
                        @error('acceptTerms')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center my-3">
            <button class="btn btn-primary col-4" type="submit">
                Daftar
            </button>
            <div class="col-12 text-center">
                <p class="small mb-0">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">Log in</a>
                </p>
            </div>
        </div>
    </form>
</div>
<script>
    var wargaOption;

    function check_warga(option) {
        const $warga = $("#warga-callback");
        const $nonwarga = $("#nonWarga-callback");

        $warga
            .toggleClass("d-none animate__fadeOut", option !== "yes")
            .toggleClass("d-block animate__fadeIn", option === "yes");

        $nonwarga
            .toggleClass("d-none animate__fadeOut", option !== "no")
            .toggleClass("d-block animate__fadeIn", option === "no");

        wargaOption = option == "yes" ? true : false;

        if (!wargaOption) {
            $('input[name="position"]').prop("checked", false);
        }
    }

    $("#institution").change(function(e) {
        e.preventDefault();
        $("#institutionAddressContainer")
            .toggleClass("d-none", $(this).val() !== "other")
            .toggleClass("d-block", $(this).val() === "other")
    });

    function showIdInput(pos) {
        const $mahasiswaInput = $("#mahasiswa-input");
        const $dosenStaffInput = $("#dosenStaff-input");
        const $unitContainer = $("#unitContainer");
        const $prodiContainer = $('#prodiContainer');

        $mahasiswaInput
            .toggleClass("d-none animate__fadeOut", pos !== "mahasiswa")
            .toggleClass("d-block animate__fadeIn", pos === "mahasiswa");

        $dosenStaffInput
            .toggleClass("d-none animate__fadeOut", pos === "mahasiswa")
            .toggleClass("d-block animate__fadeIn", pos !== "mahasiswa");

        $unitContainer
            .toggleClass("d-none", pos !== "staff");
        $prodiContainer
            .toggleClass("d-none", pos !== "mahasiswa");
    }
</script>
