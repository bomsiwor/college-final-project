<div class="modal fade" id="editModal" tabindex="-1" wire:ignore.self>
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

                <form action="#" method="post" id="editMaintenanceForm">

                </form>
            </div>
            {{-- End Modla Body --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="editMaintenanceForm">Simpan data</button>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->
