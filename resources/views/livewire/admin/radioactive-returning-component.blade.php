<div wire:init='loadData'>
    <h5 class="card-title">Semua Pengembalian - Sumber RA</h5>

    @isset($returnings)
        <!-- Table with hoverable rows -->
        @if (!$returnings->isEmpty())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">ID Pinjaman</th>
                            <th scope="col">Verifikator</th>
                            <th scope="col">Tanggal Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($returnings as $returning)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td class="text-center">{{ $returning->id }} - <a
                                        href="{{ route('borrow.radioactive.show', ['borrow' => $returning->id]) }}"
                                        class="border border-primary px-1 py-1" style="text-decoration: none">Detail</a>
                                <td class="text-center">{{ $returning->verificator->name }}</td>
                                <td class="text-center">
                                    {{ $returning->returning_date->isoFormat('dddd, DD-MM-Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>Tidak ada ditampikan</p>
        @endif

        <!-- End Table with hoverable rows -->
    @else
        <p class="card-text placeholder-glow">
            <span class="placeholder bg-info col-7"></span>
            <span class="placeholder bg-info col-4"></span>
            <span class="placeholder bg-info col-4"></span>
            <span class="placeholder bg-info col-6"></span>
            <span class="placeholder bg-info col-8"></span>
        </p>
    @endisset
</div>
