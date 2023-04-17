@extends('Template.layouts')

@push('vendorStyle')
    @livewireStyles
@endpush

@push('vendorScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Alat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tool.index') }}">Alat</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
            <a href="{{ route('tool.index') }}" class="btn btn-primary"><span class="mdi mdi-arrow-left"></span> Kembali</a>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">

                {{-- Kiri - Profil --}}
                <div class="col-xl-4">

                    <div class="card bg-light-subtle border border-light-subtle">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            @if (!$tool->tool_image)
                                <img src="{{ asset('assets/img/no-image.png') }}" alt="photo" class="rounded-circle">
                            @else
                                ada..
                            @endif
                            <h2 class="text-center">{{ $tool->name }}</h2>

                            <h3><span class="mdi {{ __("core.$tool->status.symbol") }}"></span>
                                {{ __("core.$tool->status.text") }}</h3>
                            <div>
                                <span
                                    class="badge {{ __("core.$tool->condition.class") }}">{{ __("core.$tool->condition.text") }}</span>

                            </div>

                            @role('admin')
                                <div class="my-2">
                                    <button class="btn btn-outline-danger" onclick="deleteButton()">HAPUS</button>
                                </div>
                            @endrole
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Menu untuk alat</h5>
                            @if ($tool->status == 'available')
                                <button class="btn btn-warning" type="button" data-bs-toggle="modal"
                                    data-bs-target="#borrowModal">Pinjam</button>
                            @else
                                <button class="btn btn-outline-danger" disabled>{{ __("core.$tool->status.text") }}</button>
                            @endif
                            <button class="btn btn-info">Catat Penggunaan</button>
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
                                        data-bs-target="#detail-tool">Detail</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#edit-tool">Edit
                                        Data</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#borrow-tab">Peminjaman</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#maintenance-tab">Perawatan</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#usage-tab">Penggunaan</button>
                                </li>

                            </ul>

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active detail-tool" id="detail-tool">
                                    <h5 class="card-title">Deskripsi</h5>
                                    @if ($tool->description)
                                        {!! $tool->description !!}
                                    @else
                                        <p class="small fst-italic">
                                            Belum ditambahkan!
                                        </p>
                                    @endif
                                    <div class="row mt-2">
                                        <div class="col-lg-3 col-md-4 label my-2">Spesifikasi</div>
                                        <div class="col-lg-9 col-md-8"><a href="#" class="btn btn-primary">Cek
                                                disini</a></div>
                                    </div>

                                    <h5 class="card-title">Informasi lengkap</h5>

                                    <div class="row mb-2">
                                        <div class="col-lg-3 col-md-4 label text-muted">Nama Alat</div>
                                        <div class="col-lg-9 col-md-8">{{ $tool->name }}</div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-lg-3 col-md-4 label text-muted"><b>Merk</b></div>
                                        <div class="col-lg-9 col-md-8">{{ $tool->merk }}
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-lg-3 col-md-4 label text-muted">Seri</div>
                                        <div class="col-lg-9 col-md-8">{{ $tool->series }}
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-lg-3 col-md-4 label text-muted">Tanggal Pembelian</div>
                                        <div class="col-lg-9 col-md-8">@tanggal($tool->purchase_date)</div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-lg-3 col-md-4 label text-muted">Harga Beli</div>
                                        <div class="col-lg-9 col-md-8">@uang($tool->price)
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-lg-3 col-md-4 label text-muted">No. Inventaris</div>
                                        <div class="col-lg-9 col-md-8">{{ $tool->inventory_number }}</div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-lg-3 col-md-4 label text-muted">Terakhir data diperbarui</div>
                                        <div class="col-lg-9 col-md-8">@tanggal($tool->updated_at)</div>
                                    </div>
                                </div>

                                <div class="tab-pane fade edit-tool" id="edit-tool">
                                    <h5 class="card-title">Edit Detail Alat</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem aperiam magni
                                        molestiae laboriosam repellendus ipsum repellat itaque dolor ipsam unde dolore eum
                                        tempora fugit beatae placeat, temporibus, odit, quibusdam harum libero facilis
                                        explicabo quasi? Corrupti eos eius minus. Id similique magni error quia?
                                        Exercitationem, nobis voluptas dolore, impedit quibusdam harum rerum maiores
                                        voluptate necessitatibus libero optio veniam atque iste. Laborum, numquam ad sunt,
                                        consequuntur accusamus doloribus nisi iure fugiat omnis voluptas totam, cupiditate
                                        aperiam repellendus enim ducimus necessitatibus. Quod deserunt harum aliquam
                                        possimus quas cumque minus cum at soluta pariatur quae molestias dolore, earum nihil
                                        expedita fuga distinctio, ea libero?</p>
                                </div>

                                <div class="tab-pane fade borrow-tab" id="borrow-tab">
                                    <h5 class="card-title">Riwayat Peminjaman</h5>
                                    @livewire('tool.borrow-component', ['toolId' => $tool->inventory_unique])
                                </div>

                                <div class="tab-pane fade maintenance-tab" id="maintenance-tab">
                                    <h5 class="card-title">Riwayat Perawatan</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem aperiam magni
                                        molestiae laboriosam repellendus ipsum repellat itaque dolor ipsam unde dolore eum
                                        tempora fugit beatae placeat, temporibus, odit, quibusdam harum libero facilis
                                        explicabo quasi? Corrupti eos eius minus. Id similique magni error quia?
                                        Exercitationem, nobis voluptas dolore, impedit quibusdam harum rerum maiores
                                        voluptate necessitatibus libero optio veniam atque iste. Laborum, numquam ad sunt,
                                        consequuntur accusamus doloribus nisi iure fugiat omnis voluptas totam, cupiditate
                                        aperiam repellendus enim ducimus necessitatibus. Quod deserunt harum aliquam
                                        possimus quas cumque minus cum at soluta pariatur quae molestias dolore, earum nihil
                                        expedita fuga distinctio, ea libero?</p>
                                </div>

                                <div class="tab-pane fade usage-tab" id="usage-tab">
                                    <h5 class="card-title">Pencatatan Operasional Alat</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem aperiam magni
                                        molestiae laboriosam repellendus ipsum repellat itaque dolor ipsam unde dolore eum
                                        tempora fugit beatae placeat, temporibus, odit, quibusdam harum libero facilis
                                        explicabo quasi? Corrupti eos eius minus. Id similique magni error quia?
                                        Exercitationem, nobis voluptas dolore, impedit quibusdam harum rerum maiores
                                        voluptate necessitatibus libero optio veniam atque iste. Laborum, numquam ad sunt,
                                        consequuntur accusamus doloribus nisi iure fugiat omnis voluptas totam, cupiditate
                                        aperiam repellendus enim ducimus necessitatibus. Quod deserunt harum aliquam
                                        possimus quas cumque minus cum at soluta pariatur quae molestias dolore, earum nihil
                                        expedita fuga distinctio, ea libero?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
    @livewireScripts

    @livewire('tool.borrow-form', ['tool' => $tool])
@endsection

@section('script')
    <script>
        window.addEventListener('added-borrow', event => {
            $('#borrowModal').modal('hide');
            Swal.fire({
                title: '<strong>Sukses!</strong>',
                icon: 'success',
                html: 'Catatan peminjaman anda dapat dilihat pada , ' +
                    '<a href="{{ route('activity.borrow.all') }}">halaman ini</a> ',
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: true,
                confirmButtonText: 'Oke!',
            })
        })

        function deleteButton() {
            Swal.fire({
                title: 'Apa anda yakin?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yakin!',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    var dataToSend = {
                        _token: "{{ csrf_token() }}"
                    };

                    $.ajax({
                        url: '{{ route('tool.delete', ['tool' => $tool->inventory_unique]) }}',
                        data: dataToSend,
                        type: 'DELETE',
                        success: function(result) {
                            console.log(result.data);
                            let timerInterval
                            Swal.fire({
                                title: 'Terhapus!',
                                icon: 'success',
                                text: 'Data sudah dihapus.',
                                html: 'Anda akan diarahkan ke halaman data alat dalam <b></b> milliseconds.',
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                $(location).attr('href', '{{ route('tool.index') }}');
                            })
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log('Data gagal dihapus');
                        }
                    });
                }
            })
        }
    </script>
@endsection
