<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nama Lengkap", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Username", "username")
                ->sortable(),
            Column::make("Identifier", "identifier")
                ->sortable(),
            Column::make("Nomor Identitas", "identification_number")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
        ];
    }
}
