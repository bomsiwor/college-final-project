<div wire:poll.20s='loadData'>
    <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="mdi mdi-bell-outline"></i>
            @isset($notif)
                <span
                    class="badge bg-primary badge-number @if ($notif->count() == 0) d-none @endif">{{ $notif->count() }}</span>
                <!-- End Notification Icon -->
            @endisset
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
                @isset($notif)
                    Anda memiliki {{ $notif->count() }} pemberitahuan belum direspon
                @else
                    Tidak ada pemberitahuan
                @endisset
                {{-- <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a> --}}
            </li>
            <li>
                <hr class="dropdown-divider" />
            </li>

            <div wire:init='loadData'>
                @isset($notif)
                    @foreach ($notif as $n)
                        <li class="notification-item">
                            <i class="mdi mdi-exclamation-thick text-warning"></i>
                            <div>
                                <h4>Peminjaman - {{ $n->inventory->name }}</h4>
                                <p>{{ $n->user->name }} meminjam untuk {{ __("activity.$n->purpose") }}</p>
                                <p>{{ $n->created_at->diffForHumans() }} <a
                                        href="{{ route('activity.borrow.detail', ['borrow' => $n->id]) }}"
                                        class="badge rounded-pill bg-primary">Lihat
                                        Detail <span class="mdi mdi-arrow-right"></span></a></p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                    @endforeach
                @else
                    <li class="notification-item">
                        <i class="mdi mdi-check-circle-outline text-success"></i>
                        <div>
                            <h4>Kosong</h4>
                            <p>Tidak ada pemberitahuan terbaru</p>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                @endisset
            </div>


            <li>
                <hr class="dropdown-divider" />
            </li>
            <li class="dropdown-footer">
                <a href="#">Lihat semua</a>
            </li>
        </ul>
        <!-- End Notification Dropdown Items -->
    </li>
</div>
