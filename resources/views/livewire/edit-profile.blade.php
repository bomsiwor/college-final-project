<div>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($changed)
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> mengubah profil.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Profile Edit Form -->
    <form wire:submit.prevent='submit'>
        <div class="row mb-3">
            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
            <div class="col-md-8 col-lg-9">
                <img src="@if (auth()->user()->profile_picture) {{ auth()->user()->profile_picture }} @else {{ asset('assets/img/profile/default-pic.png') }} @endif"
                    alt="Profile">
                <div class="pt-2">
                    <button class="btn btn-primary btn-sm" type="button" onclick="openFileUpload()"><i
                            class="mdi mdi-tray-arrow-up"></i></button>
                    <input type="file" name="photo" id="hiddenFile" class="d-none" wire:model='photo'>
                    <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i
                            class="mdi mdi-delete"></i></a>
                </div>
            </div>
        </div>

        @if ($photo)
            <div class="row mb-3">
                <label for="previewImage" class="col-md-4 col-lg-3 col-form-label">Preview</label>
                <div class="col-md-8 col-lg-9">
                    <img src="{{ $photo->temporaryUrl() }}" alt="Profile">
                </div>
            </div>
        @endif
        <div wire:loading>Mengunggah...</div>

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap <em>(tanpa gelar)</em></label>
            <div class="col-md-8 col-lg-9">
                <input name="name" type="text" class="form-control" id="name"
                    value="{{ auth()->user()->name }}" wire:model.defer='name'>
            </div>
        </div>

        <div class="row mb-3">
            <label for="description" class="col-md-4 col-lg-3 col-form-label">Tentang</label>
            <div class="col-md-8 col-lg-9">
                <textarea name="description" class="form-control" id="description" style="height: 100px" maxlength="255"
                    wire:model.defer='description'>{{ auth()->user()->description }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="institution" class="col-md-4 col-lg-3 col-form-label">Institusi</label>
            <div class="col-md-8 col-lg-9">
                <input name="institution" type="text" class="form-control" id="institution"
                    value="{{ auth()->user()->institution->institution_name }}" disabled>
            </div>
        </div>

        <div class="row mb-3">
            <label for="profession" class="col-md-4 col-lg-3 col-form-label">Pekerjaan</label>
            <div class="col-md-8 col-lg-9">
                <input name="profession" type="text" class="form-control" id="profession"
                    value="{{ auth()->user()->profession->profession_name }}" disabled>
            </div>
        </div>

        <div class="row mb-3">
            <label for="profession" class="col-md-4 col-lg-3 col-form-label">Jenis Identitas</label>
            <div class="col-md-8 col-lg-9">
                <input name="profession" type="text" class="form-control" id="profession" disabled
                    wire:model.defer='identifier'>
            </div>
        </div>

        <div class="row mb-3">
            <label for="profession" class="col-md-4 col-lg-3 col-form-label">Nomor Identitas</label>
            <div class="col-md-8 col-lg-9">
                <input name="profession" type="text" class="form-control" id="profession"
                    wire:model.defer='identification_number'>
            </div>
        </div>

        <div class="row mb-3">
            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
            <div class="col-md-8 col-lg-9">
                <input name="address" type="text" class="form-control" id="Address"
                    value="{{ auth()->user()->address }}" wire:model.defer='address'>
            </div>
        </div>

        <div class="row mb-3">
            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">No. Telepon</label>
            <div class="col-md-8 col-lg-9">
                <input name="phone" type="text" class="form-control" id="Phone"
                    value="{{ auth()->user()->phone }}" wire:model.defer='phone'>
            </div>
        </div>

        <div class="row mb-3">
            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
            <div class="col-md-8 col-lg-9">
                <input name="email" type="email" class="form-control" id="Email"
                    value="{{ auth()->user()->email }}" wire:model.defer='email'>
            </div>
        </div>

        <div class="row mb-3">
            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
            <div class="col-md-8 col-lg-9">
                <input name="twitter" type="text" class="form-control" id="Twitter"
                    value="https://twitter.com/#">
            </div>
        </div>

        <div class="row mb-3">
            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
            <div class="col-md-8 col-lg-9">
                <input name="facebook" type="text" class="form-control" id="Facebook"
                    value="https://facebook.com/#">
            </div>
        </div>

        <div class="row mb-3">
            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
            <div class="col-md-8 col-lg-9">
                <input name="instagram" type="text" class="form-control" id="Instagram"
                    value="https://instagram.com/#">
            </div>
        </div>

        <div class="row mb-3">
            <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
            <div class="col-md-8 col-lg-9">
                <input name="linkedin" type="text" class="form-control" id="Linkedin"
                    value="https://linkedin.com/#">
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form><!-- End Profile Edit Form -->
</div>
