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
    <form action="" id="createTool" wire:submit.prevent='submit'>
        <div class="row mb-3 form-group">
            {{-- Alat --}}
            <div class="col-lg-6">
                <label for="status">Pilih alat</label>
                <select class="form-select @error('inventory_id') is-invalid @enderror" name="inventory_id"
                    wire:model.defer='inventory_id'>
                    <option value="null">Pilih...</option>
                    @foreach ($data as $tool)
                        <option value="{{ $tool->id }}">{{ $tool->name . '-' . $tool->inventory_number }}
                        </option>
                    @endforeach
                </select>
                @error('inventory_id')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>

            {{-- Kondisi Alat --}}
            <div class="col-lg-6">
                <label for="condition">Condition</label>
                <select class="form-select @error('condition') is-invalid @enderror" name="condition"
                    wire:model.defer='condition'>
                    <option value="null">Pilih</option>
                    <option value="minor">Rusak Ringan</option>
                    <option value="major">Rusak Berat</option>
                </select>
                @error('condition')
                    <label class="error text-danger">
                        {{ $message }}
                    </label>
                @enderror
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="form-group">
            <label for="description">Deskripsi/Keterangan</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="4"
                style="height: 75px" wire:model.defer='description'></textarea>
        </div>

        <button type="submit" class="btn btn-primary mx-1">Simpan alat</button>
    </form>

</div>
