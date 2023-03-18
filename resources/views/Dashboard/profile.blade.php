@extends('Template.layouts')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profil Kamu</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">

                {{-- Kiri - Profil --}}
                <div class="col-xl-4">

                    <div class="card bg-light-subtle border border-light-subtle">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            @if (!auth()->user()->profile_picture)
                                <img src="{{ asset('assets/img/profile/default-pic.png') }}" alt="Profile"
                                    class="rounded-circle">
                            @else
                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile"
                                    class="rounded-circle">
                            @endif
                            <h2 class="text-center">{{ auth()->user()->name }}</h2>

                            @if (auth()->user()->hasRole('student'))
                                <h3>{{ auth()->user()->study_program->name }}</h3>
                            @elseif (auth()->user()->hasRole('lecturer'))
                                <h3>Dosen</h3>
                            @elseif (auth()->user()->hasRole('staff'))
                                <h3>Staff - {{ auth()->user()->unit->unit_name }}</h3>
                            @endif

                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="mdi mdi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="mdi mdi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="mdi mdi-github"></i></a>
                                <a href="#" class="linkedin"><i class="mdi mdi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kanan - Tab detail dan edit --}}
                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Detail</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profil</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Ubah Password</button>
                                </li>

                            </ul>

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Tentang</h5>
                                    <p class="small fst-italic">
                                        @if (auth()->user()->description)
                                            {{ auth()->user()->description }}
                                        @else
                                            Kosong.. isi cerita tentang kamu.
                                        @endif
                                    </p>
                                    <h5 class="card-title">Detail Profil</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Pekerjaan</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->profession->profession_name }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Asal Institusi</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->institution->institution_name }}
                                        </div>
                                    </div>

                                    @if (auth()->user()->hasRole('student'))
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Program Studi</div>
                                            <div class="col-lg-9 col-md-8">{{ auth()->user()->study_program->name }}</div>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Jenis Identitas</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->identifier }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nomor Identitas</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->identification_number }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Alamat</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->address }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">No. Telp</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->phone }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                                    </div>
                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    @livewire('edit-profile')

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <h4>Petunjuk</h4>
                                    <p>Kata sandi sekurang-kurangnya mengandung 1 simbol, 1 angka, dan 1 huruf kapital</p>
                                    @livewire('change-password-component')

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    @livewireScripts

    <script>
        function openFileUpload() {
            document.getElementById("hiddenFile").click();

        }
    </script>
@endsection

@section('script')
    <script>
        $('#deletePhoto').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Kamu yakin?',
                text: "Hapus foto profil?! Foto dapat diperbarui di kemudian hari",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deletePhoto');
                    Swal.fire(
                        'Sukses!',
                        'Foto profil telah dihapus',
                        'success'
                    )
                }
            })
        });
    </script>
@endsection
