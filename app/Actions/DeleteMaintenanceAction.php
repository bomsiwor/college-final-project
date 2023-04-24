<?php

namespace App\Actions;

use App\Models\Maintenance;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class deleteMaintenanceAction
{

    public function handle(int $id): bool
    {
        $data = Maintenance::find($id);

        if ($data->document) :
            Gdrive::delete($data->document);
        endif;

        try {
            $data->delete();
        } catch (\Throwable $e) {
            return false;
        }

        return true;
    }
}
