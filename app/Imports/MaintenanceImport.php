<?php

namespace App\Imports;

use App\Models\Maintenance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MaintenanceImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Maintenance([
            'activity_name' => $row['name'],
            'agenda' => $row['schedule'],
            'month' => Carbon::create(date('Y'), $row['month'], 1, 8, 0, 0),
            'description' => $row['description'],
            'in_charge' => $row['in_charge']
        ]);
    }
}
