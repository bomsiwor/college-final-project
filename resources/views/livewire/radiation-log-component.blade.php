<div class="modal fade" id="radiationLogModal" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="modal-title">Penerimaan Dosis Radiasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-2">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($data_added)
                    <div class="alert alert-success">
                        Sukses menambahkan data
                    </div>
                @endif

                <form action="#" wire:submit.prevent='submit' id="radiationLogForm">
                    {{-- Tujuan --}}
                    <div class="row mb-3 align-items-center">
                        <label for="deskripsiPinjam" class="col-sm-4 col-form-label-sm">Tujuan</label>
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
                    <div class="row mb-3 align-items-center">
                        <label for="inputTime" class="col-sm-4 col-form-label-sm ">Waktu Mulai</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control w-50 @error('start_time') is-invalid @enderror"
                                wire:model.defer='start_time'>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="inputTime" class="col-sm-4 col-form-label-sm">Waktu Selesai</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control w-50 @error('end_time') is-invalid @enderror"
                                wire:model.defer='end_time'>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-start">
                        <label for="description" class="col-sm-4 col-form-label-sm">Keterangan</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" style="height: 100px" placeholder="Maksimum 255 karakter..."
                                wire:model.defer='description' maxlength="255"></textarea>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Dosis</span>
                        <input type="text" class="form-control @error('dose') is-invalid @enderror" id="basic-url"
                            aria-describedby="basic-addon3" wire:model.defer='dose'
                            placeholder="(Koma menggunakan titik)">
                        <span class="input-group-text">&micro;Sv</span>
                    </div>

                </form>
            </div>
            {{-- End Modla Body --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="radiationLogForm">Simpan data</button>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->
