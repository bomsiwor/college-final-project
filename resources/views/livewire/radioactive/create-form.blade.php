<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="" wire:submit.prevent='submit'>
        <div class="row mb-3 form-group">
            {{-- Nama alat --}}
            <div class="col-lg-4">
                <label for="element_name">Nama Element</label>
                <input name="element_name" type="text"
                    class="form-control form-control-sm @error('element_name') is-invalid @enderror" id="element_name"
                    wire:model.defer='element_name'>
                @error('element_name')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>

            {{-- No isotop --}}
            <div class="col-lg-4">
                <label for="isotope_number">Nomor Isotop</label>
                <input name="isotope_number" type="text"
                    class="form-control @error('isotope_number') is-invalid @enderror" id="isotope_number"
                    wire:model.defer='isotope_number'>
                @error('isotope_number')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>

            {{-- Simbol --}}
            <div class="col-lg-4">
                <label for="element_symbol">Simbol Element</label>
                <input name="element_symbol" type="text"
                    class="form-control @error('element_symbol') is-invalid @enderror" id="element_symbol"
                    wire:model.defer='element_symbol'>
                @error('element_symbol')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>
        </div>

        <div class="row mb-3 form-group">
            {{-- No urut --}}
            <div class=" col-lg-6">
                <label for="entry_number">Nomor urut sumber</label>
                <input name="entry_number" type="text"
                    class="form-control @error('entry_number') is-invalid @enderror" id="entry_number"
                    wire:model.defer='entry_number'>
                @error('entry_number')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>

            {{-- No inventaris --}}
            <div class=" col-lg-6">
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
            {{-- No urut --}}
            <div class=" col-lg-6">
                <label for="quantity">Kuantitas</label>
                <input name="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror"
                    id="quantity" wire:model.defer='quantity'>
                @error('quantity')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>

            {{-- No inventaris --}}
            <div class=" col-lg-6">
                <label for="initial_activity">Aktivitas Awal</label>
                <input name="initial_activity" type="text"
                    class="form-control @error('initial_activity') is-invalid @enderror" id="initial_activity"
                    wire:model.defer='initial_activity'>
                @error('initial_activity')
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
                    <option value="sealed">Terbungkus</option>
                    <option value="unsealed">Terbuka</option>
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
                <label for="properties">Sifat</label>
                <select class="form-select @error('properties') is-invalid @enderror" name="properties"
                    wire:model.defer='properties'>
                    <option value="null">Pilih</option>
                    <option value="solid">Padatan</option>
                    <option value="powdery">Bubuk</option>
                    <option value="liquid">Cairan</option>
                </select>
                @error('properties')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>

            {{-- Kemasan --}}
            <div class="col-lg-6">
                <label for="packaging_type">Kemasan/Bungkusan</label>
                <select class="form-select @error('packaging_type') is-invalid @enderror" name="packaging_type"
                    wire:model.defer='packaging_type'>
                    <option value="null">Pilih</option>
                    <option value="Box">Box</option>
                    <option value="Shielded">Shielded</option>
                    <option value="Tube">Tabung</option>
                </select>
                @error('packaging_type')
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
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>

            {{-- Harga --}}
            <div class="col-lg-6">
                <label for="manufacturing_date">Tanggal dibuat</label>
                <input name="manufacturing_date" type="date"
                    class="form-control @error('manufacturing_date') is-invalid @enderror" id="manufacturing_date"
                    wire:model.defer='manufacturing_date'>
                @error('manufacturing_date')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
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
