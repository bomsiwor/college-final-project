@extends('Template.layouts')

@section('main')
    <div class="bg-primary text-white py-3 px-2 border-bottom mb-3 d-flex align-items-center">
        <div class="animate__animated animate__fadeIn animate__delay-1s me-3 bg-white p-3 rounded">
            <img style="max-width: 60px" src="{{ asset('assets/img/dashboard/poltek-logo.png') }}" alt="logo poltek">
        </div>
        <div class="animate__animated animate__fadeInLeft animate__delay-1s">
            <h3><strong> Halaman Utama</strong></h3>
            <h5><small>Sistem Informasi Laboratorium - Instrumentasi Nuklir</small></h5>
        </div>
    </div>
    {{-- Quick menu --}}
    <div class="bg-white rounded p-3 mb-2 mt-4 d-none d-lg-block position-relative">
        <div class="position-absolute bg-primary text-white rounded p-2" style="top: -20px">
            <h5 class="fw-bold mb-0 animate__animated animate__pulse animate__delay-1s animate__infinite">Menu Cepat</h5>
        </div>
        <div class="row animate__animated animate__fadeInDown  ">
            <div class="col-sm-12">
                <div class="statistics-details d-flex align-items-start justify-content-between">
                    <div class="text-center">
                        <p class="statistics-title">Presensi Cepat</p>
                        <button class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#attendanceModal">Presensi</button>
                        <p class="text-success d-flex"><i class="mdi mdi-menu-right"></i><span>Data kunjungan</span></p>
                    </div>
                    <div class="text-center">
                        <p class="statistics-title">Log Alat</p>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#toolLogModal">Catat</button>
                        <p class="text-success d-flex"><i class="mdi mdi-menu-right"></i><span>Penggunaan detektor</span>
                        </p>
                    </div>
                    <div class="text-center">
                        <p class="statistics-title">Log Radiasi</p>
                        <button class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#radiationLogModal">Catat</button>
                        <p class="text-success d-flex"><i class="mdi mdi-menu-right"></i><span>Penerimaan radiasi</span></p>
                    </div>
                    <div class="text-center">
                        <p class="statistics-title">Alat</p>
                        <a href="{{ route('tool.index') }}" class="btn btn-info">Daftar alat</a>
                    </div>
                    <div class="text-center">
                        <p class="statistics-title">Sumber</p>
                        <a href="{{ route('radioactive.index') }}" class="btn btn-info">Daftar Sumber</a>
                    </div>
                    <div class="text-center">
                        <p class="statistics-title">Perawatan</p>
                        <a href="{{ route('maintenance.index') }}" class="btn btn-info">Perawatan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Banner --}}
    <div class="home-tab">
        {{-- Banner dan statistik --}}
        <div class="row">
            {{-- Banner --}}
            <div class="col-lg-8 d-flex flex-column">
                <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded table-darkBGImg">
                            <div class="card-body">
                                <div class="col-sm-8">
                                    <h3 class="text-white upgrade-info mb-0">
                                        Data radioisotop terintegrasi dengan <span class="fw-bold">IAEA</span> !
                                    </h3>
                                    <a href="#" class="btn btn-info upgrade-btn">Let's Go!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Statistik --}}
            <div class="col-lg-4 d-flex flex-column">
                <div class="col-12 grid-margin">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title card-title-dash">Type By Amount</h4>
                                    </div>
                                    <canvas class="my-auto chartjs-render-monitor" id="doughnutChart" height="484"
                                        width="726" style="display: block; width: 363px; height: 242px;"></canvas>
                                    <div id="doughnut-chart-legend" class="mt-5 text-center">
                                        <div class="chartjs-legend">
                                            <ul class="justify-content-center">
                                                <li><span style="background-color:#1F3BB3"></span>Total</li>
                                                <li><span style="background-color:#FDD0C7"></span>Net</li>
                                                <li><span style="background-color:#52CDFF"></span>Gross</li>
                                                <li><span style="background-color:#81DADA"></span>AVG</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    {{-- Modal tool log --}}
    @livewire('activity.tool-log')
    @livewire('radiation-log-component')
    @livewire('activity.attendance-form')
@endsection

@push('vendorStyle')
    @livewireStyles
@endpush

@push('vendorScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('script')
    @livewireScripts
    <script>
        window.addEventListener('attendance-stored', event => {
            let timerInterval
            Swal.fire({
                title: 'Sukses!',
                icon: 'success',
                html: 'Data anda sudah tercatat<br>Pesan ini akan tertutup dalam <b></b> milliseconds.',
                timer: 2000,
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
                $(function() {
                    $('#attendanceModal').modal('hide');
                });
            })
        })
    </script>
@endsection
