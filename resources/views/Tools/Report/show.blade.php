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
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    {{-- Baris pengajuan --}}
                    <div class="container-fluid row d-flex flex-wrap gap-3">
                        <div class="col-lg-3">
                            <p class="mt-3 mb-2"><b>Data Pelapor</b></p>
                            <p>
                                Nama Pelapor : {{ $report->user->name }}
                                <br>
                                Identitas :
                                {{ $report->user->identifier . ' - ' . $report->user->identification_number }}
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
                    @can('manage-site')
                        <div class="container-fluid">
                            @if ($report->verified_at)
                                <p>Disetujui oleh {{ $report->verificator->name }} pada @tanggal($report->verified_at)</p>
                            @endif

                            @if ($report->accessed)
                                <p>Disetujui oleh kepala laboratorium</p>
                            @endif
                            <div class="d-flex flex-wrap">
                                @if (!$report->verified_at)
                                    <div class="me-2 mb-2">
                                        <small>
                                            <p>Untuk admin</p>
                                        </small>
                                        <form action="{{ route('report.verify') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="report_id" value="{{ $report->id }}">
                                            <button type="submit" class="btn btn-sm btn-primary" name="status"
                                                value="accept">Lanjutkan</button>
                                            <button type="submit" class="btn btn-sm btn-danger" name="status"
                                                value="reject">Tolak</button>
                                        </form>
                                    </div>
                                @endif

                                @if (!$report->accessed)
                                    @role('ka-lab')
                                        <div>
                                            <small>
                                                <p>Untuk Kepala laboratorian</p>
                                            </small>
                                            <form action="{{ route('report.accessing') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="report_id" value="{{ $report->id }}">
                                                <button type="submit" class="btn btn-sm btn-primary" name="status"
                                                    value="accepted">Lanjutkan</button>
                                                <button type="submit" class="btn btn-sm btn-danger" name="status"
                                                    value="reject">Tolak</button>
                                            </form>
                                        </div>
                                    @endrole
                                @endif
                            </div>
                        </div>
                    @endcan
                    <hr class="text-secondary">

                    {{-- Baris ANALISA --}}
                    <div class="container-fluid">
                        <p><b>Analisis Penyebab Ketidaksesuaian</b></p>
                        @if ($report->verified_at && $report->accessed && $report->analyzed_at)
                            <div class="row d-flex flex-wrap">
                                <div class="col-lg-6">
                                    <p><b> Uraian analisa</b></p>
                                    <p>{{ $report->analysis }}</p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="mb-0 mt-3"><b>Analis</b></p>
                                    <p>
                                        {{ $report->analyst->name }}
                                    </p>
                                    <p>Dianalisis pada @tanggal($report->analyzed_at)</p>
                                </div>
                            </div>
                        @elseif(!$report->analyzed_at && $report->accessed)
                            <div class="row">
                                <p>Jika analisis telah dilakukan, Isi hasil analisis dengan klik tombol di bawah.</p>

                                <div class="col-lg-6">
                                    <form action="{{ route('report.analyzing') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="report_id" value="{{ $report->id }}">
                                        <textarea name="analysis" class="form-control" name="analysis" id="analysis" cols="30" rows="5"
                                            style="height: 120px"></textarea>
                                        <button type="submit" class="btn btn-sm btn-primary mt-2">Isi data</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <p>Menunggu persetujuan pengelola dan kepala Laboratorium</p>
                        @endif
                    </div>
                    <hr class="text-secondary">

                    {{-- Baris TINDAK LANJUT --}}
                    <div class="container-fluid">
                        <p><b>Tindak lanjut</b></p>
                        @if ($report->advance_target)
                            <div class="row d-flex flex-wrap justify-content-between">
                                <div class="col-lg-3">
                                    <p class="mb-0 mt-3"><b>Personel</b></p>
                                    <p>Ditindaklanjuti oleh : {{ $report->advance_operator }}</p>

                                </div>
                                <div class="col-lg-3">
                                    <p class="mb-0 mt-3"><b>Penanggung jawab</b></p>
                                    <p>
                                        {{ $report->advance_in_charge }}
                                    </p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="mb-0 mt-3"><b>Target Selesai</b></p>
                                    <p>
                                        @tanggal($report->advance_target)
                                    </p>
                                </div>
                            </div>
                            <p><b>Deskripsi</b></p>
                            <p>{{ $report->advance_description }}</p>
                        @elseif($report->analyzed_at)
                            @can('manage-site')
                                <p>Isi keterangan tindakan lanjut untuk laporan ini.</p>
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
                                <form action="{{ route('report.advancing') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="report_id" value="{{ $report->id }}">
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label for="advance_operator">Operator</label>
                                            <input type="text" name="advance_operator" id="advance_operator"
                                                class="form-control">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="advance_target">Target selesai</label>
                                            <input type="date" name="advance_target" id="advance_target"
                                                class="form-control">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="advance_description">Deskripsi</label>
                                            <textarea class="form-control" name="advance_description" id="advance_description" cols="30" rows="10"
                                                style="height: 100px"></textarea>
                                        </div>
                                    </div>
                                    <label for="advance_in_charge">Penanggung Jawab</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="advance_in_charge"
                                                    id="optionsRadios1" value="Pengelola Lab">
                                                Pengelola Lab
                                                <i class="input-helper"></i></label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="advance_in_charge"
                                                    id="optionsRadios2" value="Kepala Laboratorium">
                                                Kepala Laboratorium
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-primary">Isi Data</button>
                                </form>
                            @else
                                <p>Menunggu ditindaklanjuti</p>
                            @endcan
                        @else
                            <p>Menunggu hasil analisis</p>
                        @endif

                    </div>

                    <hr class="text-secondary">

                    {{-- Baris PERBAIKAN --}}
                    <div class="container-fluid">
                        <p><b>Perbaikan</b></p>
                        @if ($report->repair_target)
                            <div class="row d-flex flex-wrap justify-content-between">
                                <div class="col-lg-3">
                                    <p class="mb-0 mt-3"><b>Deskripsi</b></p>
                                    <p>Pengelola Laboratorium
                                        <br>
                                        Menetapkan SOP :
                                        <br>
                                        {{ $report->repair_description }}

                                    </p>

                                </div>
                                <div class="col-lg-3">
                                    <p class="mb-0 mt-3"><b>Penanggung jawab</b></p>
                                    <p>
                                        {{ $report->repair_in_charge }}
                                    </p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="mb-0 mt-3"><b>Target Selesai</b></p>
                                    <p>
                                        @tanggal($report->repair_target)
                                    </p>
                                </div>
                            </div>
                        @elseif ($report->advance_target)
                            @can('manage-site')
                                <p>Isi keterangan perbaikan untuk laporan ini.</p>
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
                                <form action="{{ route('report.repairing') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="report_id" value="{{ $report->id }}">
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label for="repair_target">Target selesai</label>
                                            <input type="date" name="repair_target" id="repair_target"
                                                class="form-control">
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="repair_description">Deskripsi/SOP</label>
                                            <textarea class="form-control" name="repair_description" id="repair_description" cols="30" rows="10"
                                                style="height: 100px"></textarea>
                                        </div>
                                    </div>
                                    <label for="repair_in_charge">Penanggung Jawab</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="repair_in_charge"
                                                    id="optionsRadios1" value="Pengelola Lab">
                                                Pengelola Lab
                                                <i class="input-helper"></i></label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="repair_in_charge"
                                                    id="optionsRadios2" value="Kepala Laboratorium">
                                                Kepala Laboratorium
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-primary">Isi Data</button>
                                </form>
                            @else
                                <p>Menunggu ditindaklanjuti</p>
                            @endcan
                        @else
                            <p>Menunggu tindak lanjut</p>
                        @endif
                    </div>

                    <hr class="text-secondary">

                    {{-- Baris PEMERIKSAAN --}}
                    <div class="container-fluid ">
                        <p><b>Pemeriksaan Tindakan Perbaikan</b></p>
                        @if ($report->effective_status)
                            <div class="row d-flex flex-wrap justify-content-between">
                                <div class="col-lg-3">
                                    <p class="mb-0 mt-3"><b>Efektivitas</b></p>
                                    <p>Dinyatakan : {{ $report->effective_status ? 'Efektif' : 'Tidak efektif' }}
                                    </p>

                                </div>
                                <div class="col-lg-3">
                                    <p class="mb-0 mt-3"><b>CATATAN</b></p>
                                    <p>
                                        {{ $report->supervisor_note }}
                                    </p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="mb-0 mt-3"><b>Diperiksa oleh</b></p>
                                    <p>
                                        Kepala Laboratorium
                                    </p>
                                </div>
                            </div>
                        @elseif ($report->repair_target)
                            @can('manage-site')
                                <p>Isi keterangan tindakan lanjut untuk laporan ini.</p>
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
                                <form action="{{ route('report.finalize') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="report_id" value="{{ $report->id }}">
                                    <label for="effective_status">Hasil Perbaikan</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="effective_status"
                                                    id="optionsRadios1" value="1">
                                                Efektif
                                                <i class="input-helper"></i></label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="effective_status"
                                                    id="optionsRadios2" value="0">
                                                Tidak efektif
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <label for="supervisor_note">Catatan Pemeriksaan</label>
                                    <textarea class="form-control" name="supervisor_note" id="supervisor_note" cols="30" rows="10"
                                        style="height: 120px"></textarea>

                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Isi Data</button>
                                </form>
                            @else
                                <p>Menunggu pemeriksaan akhir dilakukan</p>
                            @endcan
                        @else
                            <p>Menunggu perbaikan</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
