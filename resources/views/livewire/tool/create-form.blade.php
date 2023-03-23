<div>
    @if ($changed)
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> menambah data.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="" id="createTool" wire:submit.prevent='submit'>
        {{-- Nama alat --}}
        <div class="row mb-3">
            <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama Alat</label>
            <div class="col-md-8 col-lg-5">
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" wire:model.defer='name'>
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Nomor Inventaris --}}
        <div class="row mb-3">
            <label for="inventory_number" class="col-md-4 col-lg-3 col-form-label">Nomor Inventaris</label>
            <div class="col-md-8 col-lg-5">
                <input name="inventory_number" type="text"
                    class="form-control @error('inventory_number') is-invalid @enderror" id="inventory_number"
                    wire:model.defer='inventory_number'>
                @error('inventory_number')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Merk --}}
        <div class="row mb-3">
            <label for="merk" class="col-md-4 col-lg-3 col-form-label">Merk</label>
            <div class="col-md-8 col-lg-5">
                <input name="merk" type="text" class="form-control @error('merk') is-invalid @enderror"
                    id="merk" wire:model.defer='merk'>
                @error('merk')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- series --}}
        <div class="row mb-3">
            <label for="series" class="col-md-4 col-lg-3 col-form-label">Seri/Tipe</label>
            <div class="col-md-8 col-lg-5">
                <input name="series" type="text" class="form-control @error('series') is-invalid @enderror"
                    id="series" wire:model.defer='series'>
                @error('series')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Kondisi --}}
        <div class="row mb-3">
            <label for="condition" class="col-md-4 col-lg-3 col-form-label">Kondisi</label>
            <div class="col-md-8 col-lg-5">
                <select class="form-select @error('condition') is-invalid @enderror" name="condition"
                    wire:model.defer='condition'>
                    <option value="null">Pilih...</option>
                    <option value="good">Baik/Layak pakai</option>
                    <option value="not good">Kurang Baik</option>
                    <option value="broken">Rusak</option>
                </select>
                @error('condition')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- status --}}
        <div class="row mb-3">
            <label for="status" class="col-md-4 col-lg-3 col-form-label">Status</label>
            <div class="col-md-8 col-lg-5">
                <select class="form-select @error('status') is-invalid @enderror" name="status"
                    wire:model.defer='status'>
                    <option value="null">Pilih</option>
                    <option value="available">Ada</option>
                    <option value="borrowed">Dipinjam</option>
                    <option value="maintained">Perawatan</option>
                </select>
                @error('status')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Tanggal Beli --}}
        <div class="row mb-3">
            <label for="purchase_date" class="col-md-4 col-lg-3 col-form-label">Tanggal Beli</label>
            <div class="col-md-8 col-lg-5">
                <input name="purchase_date" type="date"
                    class="form-control @error('purchase_date') is-invalid @enderror" id="purchase_date"
                    wire:model.defer='purchase_date'>
                @error('purchase_date')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Harga --}}
        <div class="row mb-3">
            <label for="price" class="col-md-4 col-lg-3 col-form-label">Harga</label>
            <div class="col-md-8 col-lg-5">
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                    <input name="price" type="text" class="form-control @error('price') is-invalid @enderror"
                        id="price" wire:model.defer='price'>
                </div>
                @error('price')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="row mb-3" wire:ignore>
            <label for="description" class="col-md-4 col-lg-3 col-form-label">Deskripsi/Keterangan</label>
            <div class="col-md-8 col-lg-9">
                <input id="description" type="hidden">
                <trix-editor input="description"></trix-editor>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mx-1">Simpan alat</button>
    </form>

    <script>
        var trixEditor = document.getElementById("description")

        addEventListener("trix-blur", function(event) {
            @this.set('value', trixEditor.getAttribute('value'))
        });
    </script>

</div>
