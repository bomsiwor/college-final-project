<div class="card">
    <div class="card-body">
        <h5 class="card-title">Ini hasil pencetanmu</h5>
        <p>
            Telah dipencet {{ $count }} kali.
        </p>
        <div wire:poll.5s>
            <p>Sekarang jam {{ now() }}</p>
        </div>

        <div class="btn btn-primary" wire:click="increment">Tambah</div>
        <div class="btn btn-warning" wire:click="resetCount">Reset</div>
        <div class="btn btn-info" wire:click='munculkan'>Munculkan list</div>

        @if ($displayed)
            @livewire('sebuah-list')
        @endif
    </div>
</div>
