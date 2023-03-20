<div class="modal fade" id="presensiModal" tabindex="-1" aria-labelledby="presensiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="presensiModalLabel">Catat Kunjungan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="presensi">
                    <div class="row mb-3">
                        <label for="occupation" class="col-md-4 col-lg-3 col-form-label">Keperluan</label>
                        <div class="col-md-8 col-lg-9">
                            <select class="form-select" aria-label="Default select example" name="occupation"
                                wire:model.defer='occupation'>
                                <option selected value="null">Pilih opsi</option>
                                @foreach (App\Enums\PresensiEnum::cases() as $tipe)
                                    <option value="{{ $tipe->value }}">{{ __('activity.' . $tipe->value) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-lg-3 col-form-label">Keterangan</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea name="description" class="form-control" id="description" style="height: 100px" maxlength="255"
                                wire:model.defer='description'></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="presensi">Simpan</button>
            </div>
        </div>
    </div>
</div>
