<div>

    @if ($pwdChanged)
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> mengubah password. Diingat ya!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form wire:submit.prevent="submit" method="post">
        <div class="row mb-3">
            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Kata Sandi
                sekarang</label>
            <div class="col-md-8 col-lg-9">
                <input name="password" type="password" class="form-control" id="currentPassword"
                    wire:model='currentpwd'>
            </div>
            @error('currentpwd')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="newpassword" class="col-md-4 col-lg-3 col-form-label">Kata sandi baru</label>
            <div class="col-md-8 col-lg-9">
                <input name="newpassword" type="password" class="form-control" id="newPassword"
                    wire:model.defer='newpwd'>
            </div>
            @error('newpwd')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="newpassword_confirmation" class="col-md-4 col-lg-3 col-form-label">Masukkan kembali kata
                sandi baru</label>
            <div class="col-md-8 col-lg-9">
                <input name="newpassword_confirmation" type="password" class="form-control"
                    id="newpassword_confirmation" wire:model.defer='newpwd_confirmation'>
            </div>
            @error('newpwd_confirmation')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Ubah kata sandi</button>
        </div>
    </form><!-- End Change Password Form -->
</div>
