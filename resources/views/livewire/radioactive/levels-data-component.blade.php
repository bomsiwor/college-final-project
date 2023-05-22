<div wire:init='loadData'>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data IAEA</h5>
                @isset($apiData)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>z</th>
                                    <th>n</th>
                                    <th>Energi</th>
                                    <th>jp</th>
                                    <th>Waktu paruh</th>
                                    <th>satuan</th>
                                    <th>Waktu paruh (s)</th>
                                    <th>Decay</th>
                                    <th>Magnetic Dipole</th>
                                    <th>Electric Quadrupole</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apiData as $api)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $api['z'] }}</td>
                                        <td>{{ $api['n'] }}</td>
                                        <td>{{ $api['energy'] }}</td>
                                        <td>{{ $api['jp'] }}</td>
                                        <td>{{ $api['half_life'] }}</td>
                                        <td>{{ $api['unit_hl'] }}</td>
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
</div>
