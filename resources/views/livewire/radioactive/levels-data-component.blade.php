<div wire:init='loadData' class="row">
    {{-- Tabel data level --}}
    <div class="col-md-9 order-2 order-md-1">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data IAEA</h5>
                @isset($apiData)
                    <div class="table-responsive" style="height: 600px">
                        <table class="table table-hover table-bordered border-primary">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>z</th>
                                    <th>n</th>
                                    <th>Energi</th>
                                    <th>jp</th>
                                    <th>Waktu paruh</th>
                                    <th>Waktu paruh (s)</th>
                                    <th>Decay</th>
                                    <th>Magnetic Dipole</th>
                                    <th>Electric Quadrupole</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apiData as $api)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $api['z'] }}</td>
                                        <td>{{ $api['n'] }}</td>
                                        <td>{{ $api['energy'] }}</td>
                                        <td>{{ $api['jp'] }}</td>
                                        <td>{{ $api['half_life'] }} {{ $api['unit_hl'] }}</td>
                                        <td>{{ $api['half_life_sec'] }}</td>
                                        <td>{{ $api['decay_1'] }}</td>
                                        <td>{{ $api['magnetic_dipole'] }}</td>
                                        <td>{{ $api['electric_quadrupole'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="card-text placeholder-glow">
                        <span class="placeholder bg-info col-7"></span>
                        <span class="placeholder bg-info col-4"></span>
                        <span class="placeholder bg-info col-4"></span>
                        <span class="placeholder bg-info col-6"></span>
                        <span class="placeholder bg-info col-8"></span>
                    </p>
                @endisset
            </div>
        </div>
    </div>

    {{-- Card aktivitias saat ini --}}
    <div class="col-md-3 order-1 order-md-2 mb-1">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Aktivitas saat ini</h5>
                @isset($apiData)
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">Curie</p>
                        <p class="text-muted">{{ $activity }} <b>&micro;Ci</b></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">Becquerel</p>
                        <p class="text-muted">{{ $activity_bq }} <b>Bq</b></p>
                    </div>
                    <p class="text-muted">Persentase sisa aktivitas</p>
                    <div class="progress progress-md">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100" style="width: {{ ($activity / $initialActivity) * 100 }}%"></div>
                    </div>
                    <p class="text-end">{{ ($activity / $initialActivity) * 100 }}%</p>
                @else
                    <p class="card-text placeholder-glow">
                        <span class="placeholder bg-info col-4"></span>
                        <span class="placeholder bg-info col-4"></span>
                        <span class="placeholder bg-info col-8"></span>
                    </p>
                @endisset
            </div>
        </div>
    </div>
</div>
