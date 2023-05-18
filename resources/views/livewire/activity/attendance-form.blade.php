<div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="attendanceModalLabel">Catat Kunjungan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="" id="presensi" wire:submit.prevent='submit'>
                    <div class="row mb-3">
                        <label for="occupation" class="col-md-4 col-lg-3 col-form-label">Keperluan</label>
                        <div class="col-md-8 col-lg-9">
                            <select class="form-select" aria-label="Default select example" name="occupation"
                                wire:model.defer='occupation'>
                                <option value="">Pilih...</option>
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
