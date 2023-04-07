<?php

namespace App\Imports;

use App\Models\Tool;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ToolImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Tool([
            'name' => $row['name'],
            'merk' => $row['merk'],
            'series' => $row['series'],
            'description' => $row['description'],
            'condition' => $row['condition'],
            'status' => $row['status'],
            'purchase_date' => $row['purchase_date'],
            'price' => $row['price'],
            'used_status' => $row['used_status'],
            'inventory_number' => $row['inventory_number'],
            'inventory_unique' => Str::uuid()
        ]);
    }
}
