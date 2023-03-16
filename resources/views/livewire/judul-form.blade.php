<div class="card">
    <div class="card-body">

        <h5 class="card-title">{{ $title }}</h5>
        @if ($changed)
            <div class="alert alert-dark my-1" role="alert">
                Judul Keganti
            </div>
        @endif
        <form wire:submit.prevent='changeTitle'>
            <div class="mb-3">
                <label for="judul" class="form-label">Masukan judul baru</label>
                <input type="text" class="form-control" id="judul" placeholder="contoh"
                    wire:model.defer="newTitle">
            </div>
            <button type="submit" class="btn btn-primary" wire:loading.delay.longest
                wire:loading.attr='disabled'>Ganti</button>
        </form>

        <div class="my-1">
            <button type="submit" class="btn btn-warning" wire:click='gantiJudulPaksa'>Tambah kounter</button>
            <button type="submit" class="btn btn-info" wire:click="$emit('addmapuluh')">Tambah 50</button>
            <button class="btn btn-info" wire:click='$refresh'>Refresh</button>
        </div>


    </div>
</div>
