<?php

namespace App\Imports;

use App\Models\Radioactive;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RadionuclideImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Radioactive([
            'inventory_unique' => Str::uuid(),
            'element_name' => $row['element_name'],
            'element_symbol' => $row['element_symbol'],
            'isotope_number' => $row['isotope_number'],
            'manufacturing_date' => $row['manufacturing_date'],
            'initial_activity' => $row['initial_activity'],
            'entry_number' => $row['entry_number'],
            'inventory_number' => $row['serial_number'],
            'status' => "available",
            'condition' => $row['condition'],
            'properties' => $row['properties'],
            'quantity' => $row['quantity'],
            'packaging_type' => $row['packaging_type'],
            'slug' => $row['isotope_number'] . $row['element_symbol'],
        ]);
    }
}
