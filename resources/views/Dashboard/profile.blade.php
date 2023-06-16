@extends('Template.layouts')

@push('vendorStyle')
    @livewireStyles
@endpush

@push('vendorScript')
    @livewireScripts
@endpush

@section('main')
    <h2 class="fw-bold">Profil Kamu</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item active">Profil</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="border-bottom text-center pb-4">
                                <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('assets/img/profile/default-pic.png') }}"
                                    alt="profile" class="img-lg rounded-circle mb-3" />
                                <div class="mb-3">
                                    <h3>{{ auth()->user()->name }}</h3>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h5 class="mb-0 me-2 text-muted">{{ auth()->user()->institution->institution_name }}
                                        </h5>
                                    </div>
                                </div>
                                <p class="w-75 mx-auto mb-3">
                                    {{ auth()->user()->description }}
                                </p>
                                @if (auth()->user()->profile_picture)
                                    <button class="btn btn-warning" id="deletePhotoButton">Hapus foto profil</button>
                                @endif
                            </div>
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left"> Status </span>
                                    <span class="float-right text-success">Aktif</span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left"> Phone </span>
                                    <span class="float-right text-muted">
                                        {{ auth()->user()->phone ?? '-' }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left"> Surel </span>
                                    <span class="float-right text-muted">
                                        {{ auth()->user()->email }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left"> Alamat </span>
                                    <span class="float-right text-muted">
                                        {{ auth()->user()->address ?? '-' }}
                                    </span>
                                </p>

                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="mt-4 py-2 border-top border-bottom">
                                <!-- Navtab -->
                                <ul class="nav nav-tabs profile-navbar" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#overview"
                                            role="tab" aria-controls="overview" aria-selected="true">
                                            <i class="ti-user"></i>
                                            Detail
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#change-password"
                                            role="tab" aria-selected="false">
                                            <i class="ti-calendar"></i>
                                            Ubah Password
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content tab-content-basic">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="d-flex justify-content-between">
                                        <h4>Detail akun</h4>
                                        <button type="submit" class="btn btn-sm btn-primary"
                                            form="update-profile-form">Simpan</button>
                                    </div>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            Profil berhasil diupdate!
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>
                                                        {{ $error }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('updateProfile') }}" method="post" id="update-profile-form"
                                        enctype="multipart/form-data">
                                        @csrf
                                        {{-- Gambar --}}
                                        <div class="form-group row align-content-center mb-1">
                                            <label for="image" class="col-sm-3 col-form-label-sm">Upload Foto
                                                Profil</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="profile_picture" id="image">
                                            </div>
                                        </div>
                                        <!-- Nama -->
                                        <div class="form-group mb-1">
                                            <label for="fullname">Nama Lengkap
                                                <span class="fst-italic"> (tanpa gelar)</span>
                                            </label>
                                            <input type="text" class="form-control form-control" id="fullName"
                                                value="{{ auth()->user()->name }}" name="name" />
                                        </div>

                                        <!-- Username -->
                                        <div class="form-group mb-1">
                                            <label for="username">Username </label>
                                            <input type="text" class="form-control form-control"
                                                value="{{ auth()->user()->username }}" name="username" />
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group mb-1">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control form-control" id="email"
                                                value="{{ auth()->user()->email }}" name="email" />
                                        </div>

                                        @if (auth()->user()->study_program_id)
                                            <!-- Prodi -->
                                            <div class="form-group mb-1">
                                                <label for="study_program">Program Studi</label>
                                                <input type="study_program" class="form-control form-control"
                                                    id="study_program" value="{{ auth()->user()->study_program->name }}"
                                                    disabled />
                                            </div>
                                        @endif

                                        @if (auth()->user()->unit)
                                            <!-- Prodi -->
                                            <div class="form-group mb-1">
                                                <label for="study_program">Unit</label>
                                                <input type="study_program" class="form-control form-control"
                                                    id="study_program" value="{{ auth()->user()->unit->unit_name }}"
                                                    disabled />
                                            </div>
                                        @endif

                                        <!-- Indentifier -->
                                        <div class="form-group mb-1">
                                            <label for="identifier">Jenis Identitas</label>
                                            <input type="identifier" class="form-control form-control" id="identifier"
                                                value="{{ auth()->user()->identifier }}" disabled />
                                        </div>

                                        <!-- Prodi -->
                                        <div class="form-group mb-1">
                                            <label for="identification_number">Nomor Identitas</label>
                                            <input type="identification_number" class="form-control form-control"
                                                id="identification_number" name="identification_number"
                                                value="{{ auth()->user()->identification_number }}" />
                                        </div>

                                        <!-- Prodi -->
                                        <div class="form-group mb-1">
                                            <label for="address">Alamat</label>
                                            <input type="address" class="form-control form-control" id="address"
                                                value="{{ auth()->user()->address }}" name="address" />
                                        </div>

                                        <!-- Prodi -->
                                        <div class="form-group mb-1">
                                            <label for="phone">Nomor Telepon</label>
                                            <input type="phone" class="form-control form-control" id="phone"
                                                value="{{ auth()->user()->phone }}" name="phone" />
                                        </div>

                                        <!-- Instansi -->
                                        <div class="form-group mb-1">
                                            <label for="institution_name">Asal Instansi</label>
                                            <input type="institution_name" class="form-control form-control"
                                                id="institution_name"
                                                value="{{ auth()->user()->institution->institution_name }}"
                                                name="institution_name" disabled style="height: 60px" />
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="insitituion_address">Alamat Instansi</label>
                                            <input type="insitituion_address" class="form-control form-control"
                                                id="insitituion_address"
                                                value="{{ auth()->user()->institution->institution_address }}"
                                                name="insitituion_address" disabled style="height: 60px" />
                                        </div>

                                        <!-- Deskpripsi -->
                                        <div class="form-group mb-1">
                                            <label for="description">Deskripsi</label>
                                            <textarea name="description" id="description" rows="3" class="form-control form-control-sm"
                                                style="height: 100px"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="change-password" role="tabpanel"
                                    aria-labelledby="contact-tab">
                                    <h4>Ubah Kata Sandi</h4>
                                    <div class="alert alert-warning">
                                        Kamu login menggunakan sosial media. Tambahkan
                                        sandi agar dapat login menggunakan email &
                                        password. <br> Jika kamu login menggunakan social media, maka <b> kata sandi
                                            default</b> adalah 'password'
                                    </div>
                                    <p>
                                        Kata sandi minimal memuat 6 karakter
                                    </p>
                                    @livewire('change-password-component')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('vendorScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('script')
    <script>
        $("#deletePhotoButton").click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apa anda yakin?',
                text: "Foto yang sudah dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yakin!',
                cancelButtonText: 'Batal',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: "{{ route('deletePhoto') }}",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        beforeSend: (response) => {
                            Swal.fire({
                                title: 'Tunggu...',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            })
                        },
                        success: function(response) {
                            let timerInterval
                            Swal.fire({
                                title: 'Terhapus!',
                                icon: 'success',
                                text: 'Data sudah dihapus.',
                                html: 'Halaman akan disegarkan dalam <b></b> milliseconds.',
                                timer: 2500,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector(
                                        'b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                location.reload();
                            })
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            Swal.fire(
                                'Gagal',
                                'Operasi gagal dilakukan',
                                'error'
                            )
                        }
                    });

                }
            });
        });
    </script>
@endsection
