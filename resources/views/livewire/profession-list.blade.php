<div class="card">
    <div class="card-body">
        <h5 class="card-title">Daftar Profesi</h5>
        <button class="btn btn-warning" wire:click='shuffleData'>Refresh</button>
        <div wire:init='loadProfesions'>
            @isset($profesions)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Pekerjaan</th>
                            <th scope="col">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profesions as $pro)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $pro->profession_name }}</td>
                                <td>{{ $pro->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
