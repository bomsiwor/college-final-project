<div>
    @if ($changed)
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> menambah data.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="" id="createTool" wire:submit.prevent='submit'>
        <div class="row mb-3 form-group">
            {{-- Nama alat --}}
            <div class="col-lg-6">
                <label for="name">Nama Alat</label>
                <input name="name" type="text"
                    class="form-control form-control-sm @error('name') is-invalid @enderror" id="name"
                    wire:model.defer='name'>
                @error('name')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>

            {{-- No inventaris --}}
            <div class="col-lg-6">
                <label for="inventory_number">Nomor Inventaris</label>
                <input name="inventory_number" type="text"
                    class="form-control @error('inventory_number') is-invalid @enderror" id="inventory_number"
                    wire:model.defer='inventory_number'>
                @error('inventory_number')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>
        </div>

        <div class="row mb-3 form-group">
            {{-- Merk --}}
            <div class=" col-lg-6">
                <label for="merk">Merk</label>
                <input name="merk" type="text" class="form-control @error('merk') is-invalid @enderror"
                    id="merk" wire:model.defer='merk'>
                @error('merk')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>

            {{-- Series --}}
            <div class=" col-lg-6">
                <label for="series">Seri/Tipe</label>
                <input name="series" type="text" class="form-control @error('series') is-invalid @enderror"
                    id="series" wire:model.defer='series'>
                @error('series')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>
        </div>

        <div class="row mb-3 form-group">
            {{-- Kondisi --}}
            <div class=" col-lg-6">
                <label for="condition">Kondisi</label>
                <select class="form-select @error('condition') is-invalid @enderror" name="condition"
                    wire:model.defer='condition'>
                    <option value="null">Pilih...</option>
                    <option value="good">Baik/Layak pakai</option>
                    <option value="minor">Kurang Baik</option>
                    <option value="severe">Rusak</option>
                    <option value="unknown">Tidak diketahui</option>
                </select>
                @error('condition')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>

            {{-- status --}}
            <div class="col-lg-6">
                <label for="status">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" name="status"
                    wire:model.defer='status'>
                    <option value="null">Pilih</option>
                    <option value="available">Ada</option>
                    <option value="borrowed">Dipinjam</option>
                    <option value="maintained">Perawatan</option>
                    <option value="unavailable">Tidak Tersedia</option>
                </select>
                @error('status')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>


        {{-- used-status --}}
        <div class="row mb-3 form-group">
            <div class="col-lg-6">
                <label for="used_status">Status Operasional</label>
                <select class="form-select @error('used_status') is-invalid @enderror" name="used_status"
                    wire:model.defer='used_status'>
                    <option value="null">Pilih</option>
                    <option value="used">Digunakan</option>
                    <option value="unused">Tidak Digunakan</option>
                </select>
                @error('used_status')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>
        </div>

        <div class="row mb-3 form-group">
            {{-- Tanggal Beli --}}
            <div class="col-lg-6">
                <label for="purchase_date">Tanggal Beli</label>
                <input name="purchase_date" type="date"
                    class="form-control @error('purchase_date') is-invalid @enderror" id="purchase_date"
                    wire:model.defer='purchase_date'>
                @error('purchase_date')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Harga --}}
            <div class="col-lg-6">
                <label for="price">Harga</label>
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                    <input name="price" type="text" class="form-control @error('price') is-invalid @enderror"
                        id="price" wire:model.defer='price'>
                </div>
                @error('price')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="row mb-3 form-group">
            <label for="description">Deskripsi/Keterangan</label>
            <textarea class="form-control" id="description" rows="4" style="height: 75px"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mx-1">Simpan alat</button>
    </form>

</div>
