<div wire:init='loadData'>
    @isset($data)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Role</th>
                        <th scope="col">Pekerjaan</th>
                        <th scope="col">Institusi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $da)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $da->name }}</td>
                            <td><span
                                    class="badge {{ __('core.' . $da->getRoleNames()->first() . '.class') }}">{{ __('core.' . $da->getRoleNames()->first() . '.text') }}</span>
                            </td>
                            <td>{{ $da->profession->profession_name }}</td>
                            <td>{{ $da->institution->institution_name }}</td>
                            <td><button class="btn btn-sm btn-primary">Detail</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Table with hoverable rows -->
        </div>
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
