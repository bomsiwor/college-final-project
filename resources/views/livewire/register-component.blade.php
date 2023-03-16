<div class="card mb-3">
    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
        <p class="text-center small">
            Masukkan data-data anda di bawah ini.
        </p>
    </div>
    <div class="row justify-content-center">
        @if ($notif)
            <div class="col-8">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on
                    some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>
    <form class="row g-3" wire:submit.prevent="submit" id="formRegister" novalidate method="post">
        <div class="row">
            <div class="card-body col-md-6">
                <!-- Nama depan -->
                <div class="col-12 mb-2">
                    <label for="firstName" class="form-label">Nama
                        Depan</label>
                    <input type="text" class="form-control  @if ($errors->has('firstName')) is-invalid @endif"
                        id="firstName" required wire:model='firstName' />
                    @error('firstName')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Nama Belakang -->
                <div class="col-12 mb-2">
                    <label for="lastName" class="form-label">Nama Belakang</label>
                    <input type="text" name="last-name" class="form-control" id="lastName" wire:model='lastName' />
                    @error('lastName')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-12 mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required
                        wire:model='email' />
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
                        <input type="text" name="username" class="form-control" id="username" wire:model='username'
                            required />
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
                    <input type="password" name="password" class="form-control" id="password" wire:model='password'
                        required />
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
                                    onclick="check_warga('yes')" />
                                <label class="form-check-label" for="wargaYes">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="wargaCheck" value="no"
                                    onclick="check_warga('no')" />
                                <label class="form-check-label" for="wargaNo">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="warga-callback" class="d-none animate__animated">
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

                    <!-- NIP/NIM -->
                    <div class="col-12 d-none animate__animated" id="mahasiswa-input">
                        <!-- NIM -->
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" id="nim"
                            wire:model='nim' />
                        @error('nim')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- NIP -->
                    <div class="col-12 d-block animate__animated" id="dosenStaff-input">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-control" id="nip" />
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
                            <select class="selectpicker" data-live-search="true" name="unit" id="unit">
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div id="nonWarga-callback" class="d-none animate__animated">
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
                            <select class="selectpicker" data-live-search="true" name="institution"
                                id="institution">
                                @foreach ($institutions as $inc)
                                    <option value="{{ $inc->id }}">
                                        {{ $inc->institution_name }}</option>
                                @endforeach
                                <option value="other">Lainnya</option>
                            </select>
                        </div>
                        <div class="text-danger">
                            Masukkan instansi dengan benar
                        </div>
                    </div>

                    <!-- Nama & alamat instansi -->
                    <div class="d-none" id="institutionAddressContainer">
                        <!-- Nama -->
                        <div class="col-12">
                            <label for="institutionName" class="form-label">Nama
                                Instansi</label>
                            <input type="text" name="institutionName" class="form-control"
                                id="institutionName" />
                            <div class="text-danger">
                                Masukkan asal instansi kamu!
                            </div>
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
                </div>

                <!-- Setuju peraturan -->
                <div class="col-12 my-2">
                    <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="yes"
                            id="acceptTerms" required wire:model='acceptTerms' />
                        <label class="form-check-label" for="acceptTerms">Saya yakin data yang
                            saya masukan sudah
                            benar & jujur</label>
                        @error('acceptTerms')
                            <div class="text-danger">Harus dicentang!</div>
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
            $("#nim").removeAttr("required");
            $("#nip").removeAttr("required");
        }

        $("#institutionName").prop("required", !wargaOption);
        $("#institutionAddress").prop("required", !wargaOption);
    }

    $("#institution").change(function(e) {
        e.preventDefault();
        $("#institutionAddressContainer")
            .toggleClass("d-none", $(this).val() !== "other")
            .toggleClass("d-block", $(this).val() === "other")
            .find("input")
            .prop("required", $(this).val() === "other");
    });

    function showIdInput(pos) {
        const $mahasiswaInput = $("#mahasiswa-input");
        const $dosenStaffInput = $("#dosenStaff-input");
        const $unitContainer = $("#unitContainer");

        $mahasiswaInput
            .toggleClass("d-none animate__fadeOut", pos !== "mahasiswa")
            .toggleClass("d-block animate__fadeIn", pos === "mahasiswa")
            .find("input")
            .prop("required", pos === "mahasiswa" && wargaOption);

        $dosenStaffInput
            .toggleClass("d-none animate__fadeOut", pos === "mahasiswa")
            .toggleClass("d-block animate__fadeIn", pos !== "mahasiswa")
            .find("input")
            .prop("required", (pos === "dosen" || pos === "staff") && wargaOption);

        $unitContainer
            .toggleClass("d-none", pos !== "staff")
            .find("#nip")
            .prop("required", pos === "staff" && wargaOption);
    }
</script>
