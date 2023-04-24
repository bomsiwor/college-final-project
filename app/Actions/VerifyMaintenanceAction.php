<?php

namespace App\Actions;

use App\Models\Maintenance;
use Illuminate\Support\Str;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class VerifyMaintenanceAction
{
    public function handle($updatedData): bool
    {
        try {
            $data = Maintenance::where('id', $updatedData->id)->firstOrFail();
        } catch (\Throwable $e) {
            return $e->getMessage();
        }

        $file = $updatedData->file('document');
        $fileName = Str::slug($data->activity_name . ' ' . strtotime($updatedData['actual_date'])) . '.' . $file->getClientOriginalExtension();
        $filePath = "/maintenance/$fileName";

        $validated = $updatedData->validated();

        $validated['document'] = $filePath;

        $data->update($validated);

        if ($data->wasChanged()) :
            Gdrive::put($filePath, $updatedData->file('document'));
            return true;
        else :
            return false;
        endif;
    }

    public function undo($id): bool
    {
        $data = Maintenance::where('id', $id)->first();

        $data->actual_date = null;

        if ($data->document) :
            Gdrive::delete($data->document);
        endif;
        $data->document = null;
        $data->operation_note = null;
        $data->is_done = false;

        $data->save();

        if ($data->wasChanged()) :
            return true;
        else :
            return false;
        endif;
    }
}
