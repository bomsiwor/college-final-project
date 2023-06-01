@extends('Template.layouts')

@push('vendorStyle')
    @livewireStyles
@endpush

@push('vendorScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('main')
    <h2 class="fw-bold">Detail Sumber <small class="text-muted">- {{ $radioactive->element_name }} -
            {{ $radioactive->isotope_number }}</small></h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item"><a href="{{ route('radioactive.index') }}">Sumber RA</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
    <a href="{{ route('radioactive.index') }}" class="btn btn-primary"><span class="mdi mdi-arrow-left"></span> Kembali</a>

    <div class="row my-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        @if (session('success'))
                            <div class="alert alert-success">
                                Data sumber berhasil diperbarui.
                            </div>
                        @endif

                        {{-- Kolom kiri --}}
                        <div class="col-lg-4">
                            <div class="border-bottom text-center pb-4">

                                <div class="mb-2">
                                    <h3>{{ $radioactive->element_name }}</h3>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h5 class="mb-0 me-2 text-muted">
                                            {{ $radioactive->element_symbol . '-' . $radioactive->isotope_number }}</h5>
                                    </div>
                                </div>

                                <div class="mx-auto">
                                    <span class="mdi {{ __("core.$radioactive->status.symbol") }}"></span>
                                    {{ __("core.$radioactive->status.text") }}
                                </div>
                                <div class="mx-auto">
                                    <span
                                        class="badge border-dark border text-dark">{{ __("core.$radioactive->condition") }}</span>
                                </div>
                            </div>
                            <div class="border-bottom py-4">
                                <p>Deskripsi</p>
                                <div>
                                    @if ($radioactive->description)
                                        {{ $radioactive->description }}
                                    @else
                                        <span class="text-muted">Belum ada deskripsi</span>
                                    @endif
                                </div>
                                <div class="py-2">
                                    <p class="clearfix">
                                        <span class="float-left"> Diupload pada </span>
                                        <span
                                            class="float-right text-muted">{{ $radioactive->created_at->isoFormat('DD-MMMM-Y') }}</span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left"> Diperbarui pada </span>
                                        <span class="float-right text-muted">
                                            {{ $radioactive->updated_at->isoFormat('DD-MMMM-Y') }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="my-3 d-flex justify-content-around">
                                <button class="btn btn-primary btn-sm mb-2" type="button" data-bs-toggle="modal"
                                    data-bs-target="#borrowModal">
                                    Pinjam
                                </button>
                                @role('admin')
                                    <button class="btn btn-danger btn-sm mb-2" onclick="deleteItem()">
                                        Hapus Data
                                    </button>
                                @endrole
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="home-tab">
                                {{-- Tab --}}
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active ps-0" id="detail-tab" data-bs-toggle="tab"
                                                href="#detail" role="tab" aria-controls="detail"
                                                aria-selected="true">Detail</a>
                                        </li>
                                        @role('admin')
                                            <li class="nav-item">
                                                <a class="nav-link" id="edit-tab" data-bs-toggle="tab" href="#edit"
                                                    role="tab" aria-selected="false">Edit Detail</a>
                                            </li>
                                        @endrole
                                        <li class="nav-item">
                                            <a class="nav-link" id="borrowing-tab" data-bs-toggle="tab" href="#borrowing"
                                                role="tab" aria-selected="false">Peminjaman</a>
                                        </li>
                                    </ul>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger mb-0">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {{-- Konten tab --}}
                                <div class="tab-content tab-content-basic">
                                    {{-- Detail --}}
                                    <div class="tab-pane fade show active" id="detail" role="tabpanel"
                                        aria-labelledby="detail-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <address>
                                                    <p class="fw-bold">Nama Sumber</p>
                                                    <p>{{ $radioactive->element_name }} -
                                                        {{ $radioactive->isotope_number }}</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Nomor Inventaris / No Urut Sumber</p>
                                                    <p>{{ $radioactive->inventory_number . ' / ' . $radioactive->entry_number }}
                                                    </p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Aktivitas Awal</p>
                                                    <p>{{ $radioactive->initial_activity }} &micro;Ci</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Dibuat pada</p>
                                                    <p>@tanggal($radioactive->manufacturing_date)</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Sifat</p>
                                                    <p>{{ $radioactive->properties }}</p>
                                                </address>
                                                <address>
                                                    <p class="fw-bold">Bentuk wadah</p>
                                                    <p>{{ $radioactive->packaging_type }}</p>
                                                </address>
                                                @if ($radioactive->purchase_date)
                                                    <address>
                                                        <p class="fw-bold">Kuantitas</p>
                                                        <p>{{ $radioactive->quantity }}</p>
                                                    </address>
                                                    <address>
                                                        <p class="fw-bold">Tanggal pengadaan</p>
                                                        <p>@tanggal($radioactive->purchase_date)</p>
                                                    </address>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Edit --}}
                                    @role('admin')
                                        <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                                            <h4>Form ubah data</h4>
                                            <form action="{{ route('radioactive.update') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="unique"
                                                    value="{{ $radioactive->inventory_unique }}">

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        {{-- Nama Element --}}
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="name" class="col-sm-3 col-form-label-sm">Nama
                                                                Unsur</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="element_name" id="element_name"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $radioactive->element_name }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        {{-- No isotop --}}
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="inventory_number"
                                                                class="col-sm-3 col-form-label-sm">Nomor
                                                                Isotope</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="isotope_number"
                                                                    id="isotope_number" class="form-control form-control-sm"
                                                                    value="{{ $radioactive->isotope_number }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    {{-- Simbol --}}
                                                    <div class="col-lg-6">
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="element_symbol"
                                                                class="col-sm-3 col-form-label-sm">Simbol</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="element_symbol"
                                                                    id="element_symbol" class="form-control form-control-sm"
                                                                    value="{{ $radioactive->element_symbol }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Aktivitas Awal --}}
                                                    <div class="col-lg-6">
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="initial_activity"
                                                                class="col-sm-3 col-form-label-sm">Aktivitas
                                                                awal</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">

                                                                    <input type="text" class="form-control"
                                                                        name="initial_activity" id="initial_activity"
                                                                        value="{{ $radioactive->initial_activity }}">
                                                                    <div class="input-group-append">
                                                                        <span
                                                                            class="input-group-text bg-primary text-white">Ci</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    {{-- No Urut --}}
                                                    <div class="col-lg-6">
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="entry_number" class="col-sm-3 col-form-label-sm">NO
                                                                Urut</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="entry_number" id="entry_number"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $radioactive->entry_number }}" />
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-6">
                                                        {{-- No Inventaris --}}
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="inventory_number"
                                                                class="col-sm-3 col-form-label-sm">No
                                                                Inventaris</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="inventory_number"
                                                                    id="inventory_number" class="form-control form-control-sm"
                                                                    value="{{ $radioactive->inventory_number }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        {{-- Tanggal pengadaan --}}
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="purchase_date"
                                                                class="col-sm-3 col-form-label-sm">Tanggal
                                                                pengadaan</label>
                                                            <div class="col-sm-9">
                                                                <input type="date" name="purchase_date" id="purchase_date"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $radioactive->purchase_date ? $radioactive->purchase_date->isoFormat('Y-MM-DD') : '-' }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        {{-- Tanggal Pembuatan --}}
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="manufacturing_date"
                                                                class="col-sm-3 col-form-label-sm">Tanggal
                                                                Pembuatan</label>
                                                            <div class="col-sm-9">
                                                                <input type="date" name="manufacturing_date"
                                                                    id="manufacturing_date"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $radioactive->manufacturing_date->isoFormat('Y-MM-DD') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        {{-- Sifat --}}
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="properties"
                                                                class="col-sm-3 col-form-label-sm">Sifat</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-select" name="properties">
                                                                    <option value="null">Pilih...</option>
                                                                    <option value="solid" @selected($radioactive->properties == 'solid')>Padatan
                                                                    </option>
                                                                    <option value="powdery" @selected($radioactive->properties == 'powdery')>Bubuk
                                                                    </option>
                                                                    <option value="liquid" @selected($radioactive->properties == 'liquid')>Cair
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        {{-- Kondisi --}}
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="condition"
                                                                class="col-sm-3 col-form-label-sm">Kondisi</label>
                                                            <div class="col-sm-9">
                                                                <select name="condition" id="condition" class="form-select">
                                                                    <option value="null">Pilih...</option>
                                                                    <option value="sealed" @selected($radioactive->condition == 'sealed')>
                                                                        Terbungkus</option>
                                                                    <option value="unsealed" @selected($radioactive->condition == 'unsealed')>
                                                                        Terbuka</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        {{-- Pembungkus --}}
                                                        <div class="form-group row align-content-center mb-1">
                                                            <label for="packaging_type"
                                                                class="col-sm-3 col-form-label-sm">Pembungkus</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="packaging_type"
                                                                    id="packaging_type" class="form-control"
                                                                    value="{{ $radioactive->packaging_type }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary text-white">Simpan</button>
                                            </form>
                                        </div>
                                    @endrole

                                    {{-- Peminjaman --}}
                                    <div class="tab-pane fade" id="borrowing" role="tabpanel"
                                        aria-labelledby="borrowing-tab">
                                        <h4>Contact us </h4>
                                        <p>
                                            Feel free to contact us if you have any questions!
                                        </p>
                                        <p>
                                            <i class="ti-headphone-alt text-info"></i>
                                            +123456789
                                        </p>
                                        <p>
                                            <i class="ti-email text-success"></i>
                                            contactus@example.com
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @livewire('radioactive.levels-data-component', ['slug' => $radioactive->slug, 'radioactive_id' => $radioactive->id])


    @livewire('radioactive.borrow-form', ['radioactive' => $radioactive])
    @livewireScripts
@endsection



@section('script')
    <script>
        window.addEventListener('added-borrow', event => {
            $('#borrowModal').modal('hide');
            Swal.fire({
                title: '<strong>Sukses!</strong>',
                icon: 'success',
                html: 'Catatan peminjaman anda dapat dilihat pada , ' +
                    '<a href="{{ route('borrow.index') }}">halaman ini</a> ',
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: true,
                confirmButtonText: 'Oke!',
            })
        })

        function deleteItem() {
            Swal.fire({
                title: 'Apa anda yakin?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yakin!',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
                customClass: {
                    confirmButton: 'btn btn-sm btn-primary',
                    cancelButton: 'btn btn-sm btn-danger'
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    var dataToSend = {
                        _token: "{{ csrf_token() }}"
                    };

                    $.ajax({
                        url: '{{ route('radioactive.delete', ['radioactive' => $radioactive->inventory_unique]) }}',
                        data: dataToSend,
                        type: 'DELETE',
                        beforeSend: function(response) {
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
                        success: function(result) {
                            console.log(result.data);
                            let timerInterval
                            Swal.fire({
                                title: 'Terhapus!',
                                icon: 'success',
                                text: 'Data sudah dihapus.',
                                html: 'Anda akan diarahkan ke halaman data sumber dalam <b></b> milliseconds.',
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
                                $(location).attr('href', "{{ route('radioactive.index') }}");
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
            })
        }
    </script>
@endsection
