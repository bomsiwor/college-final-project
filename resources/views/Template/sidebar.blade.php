<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        {{-- Pagu --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Pagu</span>
            </a>
        </li>
        {{-- Presensi --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('attendance.index') }}">
                <i class="mdi mdi-door-open menu-icon"></i>
                <span class="menu-title">Presensi</span>
            </a>
        </li>
        {{-- Admin --}}
        @can('manage-site')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#admin-menu" aria-expanded="false"
                    aria-controls="admin-menu">
                    <i class="mdi mdi-lock menu-icon"></i>
                    <span class="menu-title">Menu Admin</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="admin-menu">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.manageUser') }}">
                                Kelola User</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.returning') }}">Kelola
                                Pengembalian</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="#">Kelola Dokumen</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="#">Kelola Agenda</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="#">Kelola Postingan</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.manageMessage') }}">Kritik & Saran
                                User</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endcan

        {{-- Aset --}}
        <li class="nav-item nav-category">Aset & Inventaris</li>
        {{-- Alat --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-tools"></i>
                <span class="menu-title">Alat</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('tool.index') }}">Daftar
                            Alat</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('tool.logs.index') }}">Log
                            Penggunaan</a></li>
                </ul>
            </div>
        </li>
        {{-- Sumber --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-advanced" aria-expanded="false"
                aria-controls="ui-advanced">
                <i class="menu-icon mdi mdi-radioactive-circle-outline"></i>
                <span class="menu-title">Sumber Radioaktif</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-advanced">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('radioactive.index') }}">Daftar
                            Sumber</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- Peminjaman --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('borrow.index') }}">
                <i class="mdi mdi-book-clock-outline menu-icon"></i>
                <span class="menu-title">Peminjaman</span>
            </a>
        </li>

        {{-- Perawatan --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('maintenance.index') }}">
                <i class="mdi mdi-book-clock-outline menu-icon"></i>
                <span class="menu-title">Perawatan</span>
            </a>
        </li>
        {{-- Laporkan --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('report.index') }}">
                <i class="mdi mdi-alert menu-icon"></i>
                <span class="menu-title text-danger">Laporkan Kerusakan</span>
            </a>
        </li>
        <li class="nav-item nav-category">Laboratorium</li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="mdi mdi-location-enter menu-icon"></i>
                <span class="menu-title">Izin Penggunaan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('activity.radiationLog') }}">
                <i class="mdi mdi-skull-scan menu-icon"></i>
                <span class="menu-title">Log Penerimaan Dosis</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#documentLab" aria-expanded="false"
                aria-controls="documentLab">
                <i class="menu-icon mdi mdi-file-certificate"></i>
                <span class="menu-title">Dokumen</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="documentLab">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="../../pages/samples/login.html">
                            Praktikum</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../../pages/samples/login-2.html">
                            Tata-tertib</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../../pages/samples/register.html">
                            Prosedur Kinerja</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Penting</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.agenda') }}">
                <i class="menu-icon mdi mdi-calendar"></i>
                <span class="menu-title">Jadwal</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.help') }}">
                <i class="menu-icon mdi mdi-help"></i>
                <span class="menu-title">Bantuan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.contact') }}">
                <i class="menu-icon mdi mdi-phone"></i>
                <span class="menu-title">Kontak Kami</span>
            </a>
        </li>
    </ul>
</nav>
