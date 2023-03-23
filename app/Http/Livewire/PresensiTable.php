<?php

namespace App\Http\Livewire;

use App\Models\Radioactive;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class PresensiTable extends DataTableComponent
{
    protected $model = Radioactive::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nama", "name")
                ->sortable(),
            Column::make("Nomor isotop", "isotope_number")
                ->sortable()
                ->searchable(),
            Column::make("Aktivitas (Curie)", "activity_ci")
                ->sortable(),
            Column::make("Aktivitas (Becquerel)", "activity_bq")
                ->sortable(),
        ];
    }
}
