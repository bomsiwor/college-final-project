<?php

namespace App\Services;

use App\Models\Maintenance;

class MaintenanceAgendaService
{
    public function handle($data)
    {
        $activity_name = collect($data['activity_name']);

        $agendas = $data['agenda'];
        $charges = $data['in_charge'];
        $month = $data['month'];

        $data = $this->processData($activity_name, $agendas, $charges, $month);

        try {
            foreach ($data as $d) :
                Maintenance::create($d);
            endforeach;
        } catch (\Throwable $e) {
            return false;
        }

        return true;
    }

    private function processData($activity, array $agenda, array $charges, array $time): array
    {
        $data = $activity
            ->reject(function ($item) {
                if (!$item) :
                    return true;
                endif;
            })
            ->map(function ($item, $key) use ($agenda, $charges, $time) {
                return [
                    'activity_name' => $item,
                    'agenda' => $agenda[$key],
                    'in_charge' => $charges[$key],
                    'month' => $time[$key]
                ];
            })->toArray();

        return $data;
    }
}
