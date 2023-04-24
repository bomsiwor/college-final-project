<div>

    @if ($pwdChanged)
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> mengubah password. Diingat ya!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form wire:submit.prevent="submit" method="post">
        <div class="form-group mb-1">
            <label for="currentPassword">Kata sandi sekarang</label>
            <input type="password" class="form-control form-control @error('currentpwd') is-invalid @enderror"
                id="currentPassword" placeholder="Kata sandi sekarang" wire:model='currentpwd' />
            @error('currentpwd')
                <label for="currentPassword" class="error text-danger mb-0">Masukkan password
                    dengan benar</label>
            @enderror
        </div>

        <div class="form-group mb-1">
            <label for="newPassword">Kata sandi baru</label>
            <input type="password" class="form-control form-control @error('newpwd') is-invalid @enderror"
                id="newPassword" placeholder="Kata sandi baru" wire:model.defer='newpwd' />
            @error('newpwd')
                <label for="newPassword" class="error text-danger mb-0">Masukkan dengan
                    benar</label>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="confirmPassword">Konfirmasi kata sandi baru</label>
            <input type="password" class="form-control form-control" id="confirmPassword"
                placeholder="Konfirmasi Password" wire:model.defer='newpwd_confirmation' />
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
