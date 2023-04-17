<?php

namespace App\Actions;

use App\Models\RadiationLog;

class StoreRadiationLogAction
{
    public function handle($data): RadiationLog
    {
        $data += [
            'user_id' => auth()->id(),
            'log_date' => now()
        ];

        $response = RadiationLog::create($data);

        if ($response->wasRecentlyCreated) :
            return $response;
        endif;

        return $response;
    }
}
