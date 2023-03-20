<div class="table-responsive" wire:init='loadData'>
    @isset($attendances)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Keperluan</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $att)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $att->user->name }}</td>
                        <td>{{ __('activity.' . $att->occupation) }}</td>
                        <td>{{ $att->attendance_time->isoFormat('dddd') }}</td>
                        <td>{{ $att->attendance_time->isoFormat('D MMMM Y') }}</td>
                        <td>{{ $att->attendance_time->isoFormat('HH:mm:ss') }} WIB</td>
                        <td>{{ $att->description }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
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
