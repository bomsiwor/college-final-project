<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Menu Utama</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="/dashboard">
                <i class="mdi mdi-view-dashboard"></i>
                <span>Pagu</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        {{-- Admin menu --}}
        @role('admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="mdi mdi-application-settings"></i><span>Menu Admin</span><i
                        class="mdi mdi-shield-crown ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.manageUser') }}">
                            <i class="mdi mdi-circle"></i><span>Kelola User</span>
                        </a>
                    </li>
                    <li>
                        <a href="tables-data.html">
                            <i class="mdi mdi-circle"></i><span>Kelola Aset</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('activity.admin.borrow') }}">
                            <i class="mdi mdi-circle"></i><span>Kelola Peminjaman</span>
                        </a>
                    </li>
                    <li>
                        <a href="tables-data.html">
                            <i class="mdi mdi-circle"></i><span>Kelola Postingan</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endrole

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('activity.presensi') }}">
                <i class="mdi mdi-badge-account-alert"></i>
                <span>Presensi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard.help') }}">
                <i class="mdi mdi-tools"></i>
                <span>Logging Barang</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard.help') }}">
                <i class="mdi mdi-radioactive-circle"></i>
                <span>Logging Radiasi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#asset-nav" data-bs-toggle="collapse" href="#">
                <i class="mdi mdi-file-cabinet"></i><span>Aset/Inventori</span><i class="mdi mdi-tools ms-auto"></i>
            </a>
            <ul id="asset-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('tool.index') }}">
                        <i class="mdi mdi-circle"></i><span>Alat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('radioactive.index') }}">
                        <i class="mdi mdi-circle"></i><span>Bahan</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#izin-nav" data-bs-toggle="collapse" href="#">
                <i class="mdi mdi-file-cabinet"></i><span>Perizinan</span><i class="mdi mdi-information ms-auto"></i>
            </a>
            <ul id="izin-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('activity.borrow.all') }}">
                        <i class="mdi mdi-circle"></i><span>Peminjaman Alat/Bahan</span>
                    </a>
                </li>
                <li>
                    <a href="tables-general.html">
                        <i class="mdi mdi-circle"></i><span>Penggunaan Lab</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- End Tables Nav -->

        <li class="nav-heading">Menu Lain</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard.help') }}">
                <i class="mdi mdi-help-rhombus"></i>
                <span>Bantuan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard.contact') }}">
                <i class="mdi mdi-contactless-payment-circle-outline"></i>
                <span>Kontak Kami</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="mdi mdi-post"></i>
                <span>Postingan</span>
            </a>
        </li>
        <!-- End Profile Page Nav -->
    </ul>
</aside>
<!-- End Sidebar-->
