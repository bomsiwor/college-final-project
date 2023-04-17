<?php

namespace App\Actions;

use App\Models\Tool;
use App\Models\ToolLog;
use Illuminate\Support\Facades\DB;

class StoreToolLogAction
{

    private $inventory_id;

    public function handle(array $data, array $additional): bool
    {
        $this->inventory_id = Tool::select('inventory_unique as data')
            ->where('log_flag', $data['detector'])
            ->first();

        $required_data = [
            'inventory_id' => $this->inventory_id->data,
            'user_id' => auth()->user()->id,
            'log_date' => now(),
            'end_condition' => 'good'
        ];

        $data = array_merge($data, $required_data);

        $data['additional'] = $additional;

        try {
            DB::transaction(function () use ($data) {
                ToolLog::create($data);

                Tool::updateConditionBy('log_flag', $data['detector'], [
                    'condition' => 'good'
                ]);
            });
        } catch (\Throwable $e) {
            return false;
        }

        return true;
    }
}
