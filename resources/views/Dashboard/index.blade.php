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

    {{-- Quick menu mobile --}}
    <div class="row my-2 d-md-none">
        {{-- Presensi --}}
        <div class="col-4 col-lg-4">
            <div class="card mb-1">
                <div class="card-body text-center py-2">
                    <div class="d-flex justify-content-center">
                        <div style="width:50px;height:50px"
                            class="bg-primary rounded text-center text-white d-flex align-items-center justify-content-center fs-2">
                            <span class="mdi mdi-book-clock-outline"></span>
                        </div>
                    </div>
                    <small>
                        <a data-bs-toggle="modal" data-bs-target="#attendanceModal"
                            class="stretched-link text-decoration-none text-primary fw-bold" style="font-size: 8px">Catat
                            kunjungan</a>
                    </small>
                </div>
            </div>
        </div>

        {{-- Log Radiasi --}}
        <div class="col-4 col-lg-4">
            <div class="card mb-1">
                <div class="card-body text-center py-2">
                    <div class="d-flex justify-content-center">
                        <div style="width:50px;height:50px"
                            class="bg-primary rounded text-center text-white d-flex align-items-center justify-content-center fs-2">
                            <span class="mdi mdi-cog"></span>
                        </div>
                    </div>
                    <small>
                        <a data-bs-toggle="modal" data-bs-target="#toolLogModal"
                            class="stretched-link text-decoration-none text-primary fw-bold" style="font-size: 10px">Log
                            Detektor</a>
                    </small>
                </div>
            </div>
        </div>

        {{-- Log Alat --}}
        <div class="col-4 col-lg-4">
            <div class="card mb-1" style="height: 110px">
                <div class="card-body text-center py-2">
                    <div class="d-flex justify-content-center">
                        <div style="width:50px;height:50px"
                            class="bg-primary rounded text-center text-white d-flex align-items-center justify-content-center fs-2">
                            <span class="mdi mdi-radioactive"></span>
                        </div>
                    </div>
                    <small>
                        <a data-bs-toggle="modal" data-bs-target="#radiationLogModal"
                            class="stretched-link text-decoration-none text-primary fw-bold" style="font-size: 10px">Log
                            Radiasi</a>
                    </small>
                </div>
            </div>
        </div>

        {{-- Alat --}}
        <div class="col-4 col-lg-4">
            <div class="card mb-1" style="height: 110px">
                <div class="card-body text-center py-2">
                    <div class="d-flex justify-content-center">
                        <div style="width:50px;height:50px"
                            class="bg-primary rounded text-center text-white d-flex align-items-center justify-content-center fs-2">
                            <span class="mdi mdi-tools"></span>
                        </div>
                    </div>
                    <small>
                        <a href="{{ route('tool.index') }}" class="stretched-link text-decoration-none text-primary fw-bold"
                            style="font-size: 10px">Daftar Alat</a>
                    </small>
                </div>
            </div>
        </div>

        {{-- Radioactive --}}
        <div class="col-4 col-lg-4">
            <div class="card mb-1" style="height: 110px">
                <div class="card-body text-center py-2">
                    <div class="d-flex justify-content-center">
                        <div style="width:50px;height:50px"
                            class="bg-primary rounded text-center text-white d-flex align-items-center justify-content-center fs-2">
                            <span class="mdi mdi-radioactive-circle"></span>
                        </div>
                    </div>
                    <small>
                        <a href="{{ route('radioactive.index') }}"
                            class="stretched-link text-decoration-none text-primary fw-bold"
                            style="font-size: 10px">Daftar Sumber</a>
                    </small>
                </div>
            </div>
        </div>

        {{-- Menu lain --}}
        <div class="col-4 col-lg-4">
            <div class="card mb-1 bg-primary" style="height: 110px">
                <div class="card-body text-center py-2">
                    <div class="d-flex justify-content-center">
                        <div style="width:50px;height:50px"
                            class="bg-white rounded text-center text-primary d-flex align-items-center justify-content-center fs-2">
                            <span class="mdi mdi-view-grid"></span>
                        </div>
                    </div>
                    <small>
                        <a data-bs-toggle="offcanvas" class="stretched-link text-decoration-none text-white fw-bold"
                            style="font-size: 10px">Menu lain</a>
                    </small>
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

                {{-- Card pengumuman --}}
                <div class="row">
                    <div class="col grid-margin stretch-card">
                        <div class="card bg-primary">
                            <div class="card-body text-white">
                                <h5 class="card-title text-white"><span class="mdi mdi-information"></span> Pemberitahuan
                                </h5>
                                @if ($borrow_announce_admin || $borrow_announce_user)
                                    @role('admin|ka-lab')
                                        @if ($borrow_announce_admin)
                                            <small>
                                                <h5><span class="fw-bold">ADMIN</span> : ada {{ $borrow_announce_admin }}
                                                    pengajuan
                                                    pinjaman dalam 7 hari terakhir
                                                    belum diperiksa.</h5>
                                            </small>
                                        @endif

                                        <hr>
                                    @endrole

                                    @if ($borrow_announce_user)
                                        <small>
                                            <h5>Ada <span class="badge rounded bg-white text-primary">
                                                    {{ $borrow_announce_user }}</span> pengajuan
                                                pinjaman anda
                                                belum diperiksa oleh Admin.</h5>
                                        </small>
                                    @endif

                                    <a href="{{ route('borrow.index') }}"
                                        class="btn btn-lg btn-info border-0 mb-0 text-white">Cek
                                        sekarang!</a>
                                @else
                                    <p class="fw-bold">All set!</p>
                                @endif
                                @if ($agendas->isNotEmpty())
                                    <hr class="text-white">
                                    <h6 class="fw-bold">Agenda hari ini :</h6>
                                    <ul class="mb-0">
                                        @foreach ($agendas as $agenda)
                                            <li>
                                                {{ $agenda->agenda_name }} : {{ $agenda->start_time }} -
                                                {{ $agenda->end_time }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <h6 class="fw-bold">Tidak ada agenda hari ini</h6>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded table-darkBGImg">
                            <div class="card-body">
                                <div class="col-sm-8">
                                    <h3 class="text-white upgrade-info mb-0">
                                        Data radioisotop terintegrasi dengan <span class="fw-bold">IAEA</span> !
                                    </h3>
                                    <a href="{{ route('radioactive.index') }}" class="btn btn-info upgrade-btn">Let's
                                        Go!</a>
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
                                        <h4 class="card-title card-title-dash">Statistik Kunjungan</h4>
                                    </div>
                                    <canvas class="my-auto chartjs-render-monitor" id="doughnutChart" height="484"
                                        width="726" style="display: block; width: 363px; height: 242px;"></canvas>
                                    <div id="doughnut-chart-legend" class="mt-5 text-center  ">
                                        <div class="chartjs-legend d-flex flex-wrap">
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

    {{-- Modal petunjuk --}}
    <div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="welcomeModalLabel">Petunjuk awal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="fw-bold">
                        SELAMAT DATANG
                    </h4>
                    <p>
                        Ini adalah halaman utama aplikasi sistem informasi Laboratorium Instrumentasi Nuklir. <br>
                        Gunakan <b> menu cepat</b> untuk mengisi data :
                    </p>
                    <ol>
                        <li>
                            <b>Kunjungan</b>
                        </li>
                        <li>
                            <b>Pencatatan penggunaan
                                detektor</b>
                        </li>
                        <li>
                            <b>Pencatatan penerimaan radiasi</b>.
                        </li>
                    </ol>

                    <p>
                        Menu lain dapat ditemukan melalui tombol di pojok kiri atas (untuk pengguna mobile) dan di sidebar
                        di sisi kiri layar (untuk pengguna komputer).
                        <hr class="text-muted">
                        Petunjuk lain dapat anda temukan di halaman bantuan atau dapat di klik <a
                            href="{{ route('dashboard.help') }}">DI SINI!</a>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('vendorStyle')
    @livewireStyles
@endpush

@push('vendorScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('dist/js/Chart.min.js') }}"></script>
    {{-- <script src="{{ asset('dist/js/chart.js') }}"></script> --}}
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

    <script>
        if ($("#doughnutChart").length) {
            var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
            var doughnutPieData = {
                datasets: [{
                    data: @json($value),
                    backgroundColor: [
                        "#1F3BB3",
                        "#FDD0C7",
                        "#52CDFF",
                        "#81DADA",
                        "#00C853", "#FFEB3B", "#FF6F00", "#4A148C"
                    ],
                    borderColor: [
                        "#1F3BB3",
                        "#FDD0C7",
                        "#52CDFF",
                        "#81DADA",
                        "#00C853", "#FFEB3B", "#FF6F00", "#4A148C"
                    ],
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: @json($label)
            };
            var doughnutPieOptions = {
                cutoutPercentage: 50,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                legend: false,
                legendCallback: function(chart) {
                    var text = [];
                    text.push('<div class="chartjs-legend"><ul class="d-flex justify-content-center flex-wrap">');
                    for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
                        text.push('<li><span style="background-color:' + chart.data.datasets[0].backgroundColor[i] +
                            '">');
                        text.push('</span>');
                        if (chart.data.labels[i]) {
                            text.push(chart.data.labels[i]);
                        }
                        text.push('</li>');
                    }
                    text.push('</div></ul>');
                    return text.join("");
                },

                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                tooltips: {
                    callbacks: {
                        title: function(tooltipItem, data) {
                            return data['labels'][tooltipItem[0]['index']];
                        },
                        label: function(tooltipItem, data) {
                            return data['datasets'][0]['data'][tooltipItem['index']];
                        }
                    },

                    backgroundColor: '#fff',
                    titleFontSize: 14,
                    titleFontColor: '#0B0F32',
                    bodyFontColor: '#737F8B',
                    bodyFontSize: 11,
                    displayColors: false
                }
            };
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: doughnutPieData,
                options: doughnutPieOptions
            });
            document.getElementById('doughnut-chart-legend').innerHTML = doughnutChart.generateLegend();
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#welcomeModal').modal('show');
        });
    </script>
@endsection
