<div class="modal fade" id="toolLogModal" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="modal-title">Catat Penggunaan Alat</h5>
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
                        Sukses menambahkan data!
                    </div>
                @endif

                <div class="alert alert-warning">
                    Jika form error, pilih detektor lain lalu pilih kembali detektor sebelumnya.
                </div>

                <form action="#" wire:submit.prevent='submit' id="toolLogForm">
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
                    {{-- Waktu Mulai --}}
                    <div class="row mb-3 align-items-center">
                        <label for="startTime" class="col-sm-4 col-form-label-sm">Waktu Mulai</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control w-50 @error('start_time') is-invalid @enderror"
                                wire:model.defer='start_time'>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-start">
                        <label for="endTime" class="col-sm-4 col-form-label-sm">Waktu Selesai</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control w-50 @error('end_time') is-invalid @enderror"
                                wire:model.defer='end_time'>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="description" class="col-md-4 col-form-label-sm">Keterangan</label>
                        <div class="col-md-8">
                            <select name="detector" id="detector" class="form-select" wire:model='detector'>
                                <option value="null">Pilih Detektor...</option>
                                <option value="naitl">NaI(Tl)</option>
                                <option value="gm">Geiger Muller</option>
                                <option value="alpha">Alpha</option>
                                <option value="cdte">CdTe</option>
                                <option value="xrf">XRF</option>
                            </select>
                        </div>
                    </div>

                    {{-- Selain XMET --}}
                    <div>
                        <div class="row mb-3 align-items-center">
                            <label for="hv" class="col-sm-4 col-form-label-sm">HV</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('hv') is-invalid @enderror"
                                    wire:model.defer='hv' @disabled(!$hv_active)>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label for="amp" class="col-sm-4 col-form-label-sm">Amp</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('amp') is-invalid @enderror"
                                    wire:model.defer='amp' @disabled(!$amp_active)>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label for="adc" class="col-sm-4 col-form-label-sm">ADC</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('adc') is-invalid @enderror"
                                    wire:model.defer='adc' @disabled(!$adc_active)>
                            </div>
                        </div>
                    </div>

                    {{-- Khusus XMET --}}
                    <div @class(['d-none' => !$xmet_active])>
                        <div class="row mb-3 align-items-center">
                            <label for="start_doses" class="col-sm-4 col-form-label-sm">Dosis Awal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('start_doses') is-invalid @enderror"
                                    wire:model.defer='start_doses'>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label for="end_doses" class="col-sm-4 col-form-label-sm">Dosis Akhir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('end_doses') is-invalid @enderror"
                                    wire:model.defer='end_doses'>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label for="laju_paparan" class="col-sm-4 col-form-label-sm">Laju Paparan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('laju_paparan') is-invalid @enderror"
                                    wire:model.defer='laju_paparan'>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            {{-- End Modla Body --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="toolLogForm">Simpan data</button>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->
