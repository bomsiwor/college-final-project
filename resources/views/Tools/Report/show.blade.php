@extends('Template.layouts')

@section('main')
    <h2 class="fw-bold">
        Detail Pelaporan</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Pagu</a></li>
            <li class="breadcrumb-item">Permintaan Perbaikan</li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
    <a href="{{ route('report.index') }}" class="btn btn-primary"><span class="mdi mdi-arrow-left"></span>
        Kembali</a>

    <div class="row my-2 animate__animated animate__fadeIn">
        <div class="col-lg-12">
            <div class="card px-2" id="borrowDetailCard">
                <div class="card-body">
                    <div class="container-fluid">
                        <h3 class="text-right my-3">
                            Permintaan Tindakan Perbaikan # {{ $report->id }}
                        </h3>
                        <hr />
                    </div>

                    {{-- Baris pengajuan --}}
                    <div class="container-fluid row d-flex flex-wrap gap-3">
                        <div class="col-lg-3">
                            <p class="mt-3 mb-2"><b>Data Pelapor</b></p>
                            <p>
                                Nama Pelapor : {{ $report->user->name }}
                                <br>
                                Identitas :
                                {{ $report->user->identifier->value . ' - ' . $report->user->identification_number }}
                                <br>
                                Diajukan pada : @tanggal($report->created_at)
                            </p>
                        </div>
                        <div class="col-lg-4 pr-0">
                            <p class="mt-3 mb-2 text-right">
                                <b>Detail Alat</b>
                            </p>
                            <p>
                                Nama Alat : {{ $report->tool->name }}
                                <br>
                                Nomor Inventaris : {{ $report->tool->inventory_number }}
                                <br>
                                Kondisi : <span
                                    class="badge {{ __("core.$report->condition.class") }}">{{ __("core.$report->condition.text") }}</span>

                            </p>
                        </div>
                        <div class="col-lg-3 pr-0">
                            <p class="mt-3 mb-2 text-right"><b>Uraian</b></p>
                            <p class="text-right">
                                {{ $report->description }}
                            </p>
                        </div>
                    </div>
                    @role('admin')
                        <div class="container-fluid">
                            <button class="btn btn-sm btn-primary">Lanjutkan</button>
                            <button class="btn btn-sm btn-danger">Tolak</button>
                        </div>
                    @endrole
                    <hr class="text-secondary">

                    {{-- Baris ANALISA --}}
                    <div class="container-fluid">
                        <p><b>Analisis Penyebab Ketidaksesuaian</b></p>
                    </div>
                    @if ($report->verified_at && $report->accessed)
                        <div class="container-fluid row d-flex flex-wrap">
                            <div class="col-lg-6">
                                <p><b> Uraian analisa</b></p>
                            </div>
                            <div class="col-lg-3">
                                <p class="mb-0 mt-3"><b>Analis</b></p>
                                <p>
                                    nama analis
                                </p>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <p>Jika analisis telah dilakukan, Isi hasil analisis dengan klik tombol di bawah.</p>
                            <button class="btn btn-sm btn-primary">Isi data</button>
                        </div>
                    @else
                        <div class="container-fluid">
                            <p>Menunggu persetujuan pengelola dan kepala Laboratorium</p>
                        </div>
                    @endif
                    <hr class="text-secondary">

                    {{-- Baris TINDAK LANJUT --}}
                    <div class="container-fluid">
                        <p><b>Tindak lanjut</b></p>
                        @if ($report->analyzed_at)
                            <div class="row d-flex flex-wrap justify-content-between">
                                <div class="col-lg-3 ps-0">
                                    <p class="mb-0 mt-3"><b>Personel</b></p>
                                    <p>Ditindaklanjuti oleh : </p>
                                </div>
                                <div class="col-lg-3 ps-0">
                                    <p class="mb-0 mt-3"><b>Penanggung jawab</b></p>
                                    <p>
                                        nama PJ
                                    </p>
                                </div>
                                <div class="col-lg-3 ps-0">
                                    <p class="mb-0 mt-3"><b>Target Selesai</b></p>
                                    <p>
                                        Tanggal
                                    </p>
                                </div>
                            </div>

                            <p>Isi keterangan tindakan lanjut untuk laporan ini.</p>
                            <button class="btn btn-sm btn-primary">Isi data</button>
                        @else
                            <p>Menunggu hasil analisis</p>
                        @endif
                    </div>
                    <hr class="text-secondary">

                    {{-- Baris PERBAIKAN --}}
                    <div class="container-fluid">
                        <p><b>Perbaikan</b></p>
                        @if ($report->advance_target)
                            <div class="row d-flex flex-wrap justify-content-between">
                                <div class="col-lg-3 ps-0">
                                    <p class="mb-0 mt-3"><b>Personel</b></p>
                                    <p>Ditindaklanjuti oleh :
                                        <br>
                                        Menetapkan SOP :

                                    </p>

                                </div>
                                <div class="col-lg-3 ps-0">
                                    <p class="mb-0 mt-3"><b>Penanggung jawab</b></p>
                                    <p>
                                        nama PJ
                                    </p>
                                </div>
                                <div class="col-lg-3 ps-0">
                                    <p class="mb-0 mt-3"><b>Target Selesai</b></p>
                                    <p>
                                        Tanggal
                                    </p>
                                </div>
                            </div>
                            <p>Isi keterangan tindakan perbaikan untuk laporan ini.</p>
                            <button class="btn btn-sm btn-primary">Isi data</button>
                        @else
                            <p>Menunggu tindak lanjut</p>
                        @endif
                    </div>


                    <hr class="text-secondary">

                    {{-- Baris PEMERIKSAAN --}}
                    <div class="container-fluid ">
                        <p><b>Pemeriksaan Tindakan Perbaikan</b></p>
                        @if ($report->repair_target)
                            <div class="row d-flex flex-wrap justify-content-between">
                                <div class="col-lg-3 ps-0">
                                    <p class="mb-0 mt-3"><b>Personel</b></p>
                                    <p>Dinyatakan : EFEKTIF/TIDAK
                                    </p>

                                </div>
                                <div class="col-lg-3 ps-0">
                                    <p class="mb-0 mt-3"><b>CATATAN</b></p>
                                    <p>

                                    </p>
                                </div>
                                <div class="col-lg-3 ps-0">
                                    <p class="mb-0 mt-3"><b>Diperiksa oleh</b></p>
                                    <p>
                                        KALAB
                                    </p>
                                </div>
                            </div>
                            <p>Isi keterangan dan selesaikan laporan ini.</p>
                            <button class="btn btn-sm btn-primary">Isi data</button>
                        @else
                            <p>Menunggu perbaikan</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
