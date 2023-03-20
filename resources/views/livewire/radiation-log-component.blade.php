<div class="modal fade" id="radiationLogModal" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penerimaan Dosis Radiasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="#" wire:submit.prevent='submit' id="radiationLogForm">
                    <div class="row mb-3">
                        <label for="inputTime" class="col-sm-4 col-form-label">Waktu Mulai</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control w-50" wire:model.defer='start_time'>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputTime" class="col-sm-4 col-form-label">Waktu Selesai</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control w-50" wire:model.defer='end_time'>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Keterangan</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" style="height: 100px" placeholder="Maksimum 255 karakter..."
                                wire:model.defer='description'></textarea>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Dosis</span>
                        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3"
                            wire:model.defer='dose' placeholder="(Koma menggunakan titik)">
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
