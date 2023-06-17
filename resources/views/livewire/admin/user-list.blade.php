<div wire:init='loadData'>
    @isset($data)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Data</th>
                        <th scope="col">Role</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $da)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $da->name }}
                                <br>
                                {{ $da->profession->profession_name }}
                                <br>
                                {{ $da->institution->institution_name }}
                            </td>
                            <td><span
                                    class="badge {{ __('core.' . $da->getRoleNames()->first() . '.class') }}">{{ __('core.' . $da->getRoleNames()->first() . '.text') }}</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle toggle-dark btn-sm mb-0 me-0"
                                        type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"> Aksi </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <a class="dropdown-item" href="#">Edit data</a>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('admin.reset-password') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $da->id }}">
                                            <button type="submit" class="dropdown-item">Reset Password</button>
                                        </form>
                                        @if ($da->getRoleNames()->first() !== 'ka-lab' && $da->id !== auth()->id())
                                            <form action="{{ route('user.role.update') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $da->id }}">
                                                @if ($da->getRoleNames()->first() == 'user')
                                                    <input type="hidden" name="role" value="admin">
                                                    <button type="submit" class="dropdown-item">Jadikan Admin</button>
                                                @else
                                                    <input type="hidden" name="role" value="user">
                                                    <button type="submit" class="dropdown-item">Jadikan User</button>
                                                @endif
                                            </form>

                                            <form action="{{ route('user.delete', ['user' => $da->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="dropdown-item text-danger">Hapus user</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </td>
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
