<div wire:init='loadData' class="row overflow-scroll" style="height: 600px">
    @empty($data)
        Tidak ada data!
    @else
        @foreach ($data as $da)
            <div class="col-lg-6 my-2">
                <div class="card shadow">
                    <div class="card-body">
                        <p><span class="fw-bold"> {{ $da->user->name }} - {{ __("activity.$da->purpose") }}</span> <br>
                            {{ $da->start_borrow_date->isoFormat('DD MMMM Y') . ' s.d ' . $da->expected_return_date->isoFormat('DD MMMM Y') }}
                        </p>
                        <hr class="text-muted">
                        <p>
                            <span class="text-muted">Status</span> :
                            @if ($da->status == 'returned')
                                Telah dikembalikan <span class="fw-bold">{{ __("core.$da->status_peminjaman") }}</span>
                                pada
                                {{ $da->actual_return_date->isoFormat('DD MMMM Y') }} dengan kondisi
                                {{ __("core.$da->after_condition.text") }}
                            @else
                                Belum kembali
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- <div class="table-responsive">
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
        </div> --}}
    @endempty
</div>
