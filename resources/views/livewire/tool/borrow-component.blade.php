<div wire:init='loadData'>
    @empty($data)
        Tidak ada data!
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Peminjam</th>
                        <th scope="col">Keperluan</th>
                        <th scope="col">Tanggal Peminjaman</th>
                        <th scope="col">Tanggal Kembali</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $d->user->name }}</td>
                            <td>{{ __("activity.$d->purpose") }}</td>
                            <td class="text-center">{{ $d->start_borrow_date->isoFormat('DD MMMM Y') }}</td>
                            <td>
                                @empty($d->actual_return_date)
                                    -
                                @else
                                    {{ $d->actual_return_date->isoFormat('DD MMMM Y') }}
                                @endempty
                            </td>
                            <td class="text-center">{{ __("core.$d->status_peminjaman") }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endempty
</div>
