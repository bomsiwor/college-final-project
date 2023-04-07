<div class="modal fade" id="borrowModal" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulir Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="#" wire:submit.prevent='submit' id="borrowForm">
                    {{-- Nama Alat --}}
                    <div class="row mb-3">
                        <label for="toolName" class="col-sm-4 col-form-label">Nama Alat</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{ $toolName }}" id="toolName" class="form-control"
                                disabled>
                        </div>
                    </div>

                    {{-- No Inventory --}}
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">No Inventaris</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{ $invNumber }}" class="form-control" disabled>
                        </div>
                    </div>

                    {{-- Tanggal --}}
                    <div class="row mb-3 align-item-center">
                        <label for="startBorrow" class="col-sm-4 col-form-label">Tanggal Peminjaman</label>
                        <div class="col-sm-8">
                            <input type="date"
                                class="form-control w-50 @error('start_borrow_date') is-invalid @enderror"
                                wire:model='start_borrow_date'>
                        </div>
                        <div id="startBorrowHelp" class="form-text">Minimal hari ini.
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="endBorrow" class="col-sm-4 col-form-label">Pengembalian</label>
                        <div class="col-sm-8">
                            <input type="date"
                                class="form-control w-50 @error('expected_return_date') is-invalid @enderror"
                                wire:model='expected_return_date'>
                        </div>
                        <div id="endBorrowHelp" class="form-text">Minimal sama dengan tanggal peminjaman
                        </div>
                    </div>

                    {{-- Tujuan --}}
                    <div class="row mb-3">
                        <label for="deskripsiPinjam" class="col-sm-4 col-form-label">Tujuan</label>
                        <div class="col-sm-8">
                            <select id="deskripsiPinjam" class="form-select @error('purpose') is-invalid @enderror"
                                aria-label="Pilih Tujuan..." name="purpose" wire:model.defer='purpose'>
                                <option value="">Pilih Tujuan..</option>
                                <option value="kuliah">{{ __('activity.' . 'kuliah') }}</option>
                                <option value="uprak">{{ __('activity.' . 'uprak') }}</option>
                                <option value="ta">{{ __('activity.' . 'ta') }}</option>
                                <option value="riset">{{ __('activity.' . 'riset') }}</option>
                                <option value="pemas">{{ __('activity.' . 'pemas') }}</option>
                                <option value="sosialisasi">{{ __('activity.' . 'sosialisasi') }}</option>
                                <option value="other">{{ __('activity.' . 'other') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-lg-3 col-form-label">Keterangan</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                style="height: 100px" maxlength="255" wire:model.defer='description'></textarea>
                        </div>
                        <div id="descHelp" class="form-text">Tuliskan tujuan (maks:255 karakter) apabila memilih opsi
                            <code>Lainnya</code>
                        </div>
                    </div>

                </form>
            </div>
            {{-- End Modla Body --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="borrowForm">Simpan data</button>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->
