<div wire:init='loadData'>
    <h5 class="card-title">Semua peminjaman - Alat/Barang</h5>
    <div class="alert alert-warning">
        <h6 class="fw-bold">
            <i class="mdi mdi-information"></i> PETUNJUK!
        </h6>
        <ul class="mb-0">
            <li>
                Data yang ditampilkan adalah peminjaman yang <STRONG>sudah disetujui</STRONG> melalui
                halaman <a href="{{ route('borrow.index') }}">PEMINJAMAN</a>
            </li>
            <li>
                Gunakan tombol <strong>Kembalikan</strong> untuk mencatat pengembalian alat
            </li>
            <li>
                Geser tabel ke kanan untuk kolom yang lebih lengkap
            </li>
        </ul>
    </div>
    @isset($data)
        @if (!$data->isEmpty())
            <p>
                Menampilkan semua pengajuan peminjaman inventaris dari laboratorium <b>yang telah
                    disetujui.</b>
            </p>
            <!-- Table with hoverable rows -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nama Peminjam</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $borrow)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $borrow->user->name }}</td>
                                <td class="text-center">{{ $borrow->inventory->name }}</td>
                                <td class="text-center text-wrap w-50">
                                    @tanggal($borrow->start_borrow_date) s/d @tanggal($borrow->expected_return_date)
                                </td>
                                <td class="text-center">
                                    {{ __('core.' . $borrow->status_peminjaman) }}
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#returnModal"
                                        data-bs-whatever="{{ $borrow->id }}">Kembalikan</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End Table with hoverable rows -->
        @else
            <p>Tidak ada data untuk ditampilkan.</p>
        @endif
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
