<?php

namespace App\Actions;

use App\Models\Tool;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdateToolRequest;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class UpdateToolAction
{

    public function handle(UpdateToolRequest $request): bool
    {
        $data = $request->validated();

        $data['tool_image'] = $this->processImage($request->file('images'), $request->name);

        unset($data['images']);

        $data['manual'] = $this->processManual($request->file('manual'), $request->name);

        $this->deleteOldFile($request->unique);

        try {
            Tool::where('inventory_unique', $request->unique)->update($data);
        } catch (\Throwable $e) {
            return false;
        }

        return true;
    }

    public function processImage($images, $name): array | null
    {
        $data = [];

        if ($images !== null) {
            foreach ($images as $key => $file) {
                $fileName = time() . rand(1, 99) . '.' . $file->extension();
                $file->storeAs('inventory-images', $fileName);
                $data["image_$key"]['name'] = $fileName;
                $data["image_$key"]['description'] = "$name - $key";
            }
        } else {
            $data = null;
        }

        return $data;
    }

    public function processManual($manual, string $name): string | null
    {
        if ($manual !== null) :
            $manualFile = $manual;
            $manualName  = time() . rand(1, 99) . Str::slug($name) . '.' . $manualFile->extension();

            // Gunakan google drive
            $manualPath = "/manuals/$manualName";
            // Gdrive::put($manualPath, $manualFile);

            Storage::putFileAs('manuals', $manualFile, $manualName);
        else :
            $manualPath = null;
        endif;

        return $manualPath;
    }

    public function deleteOldFile(string $unique_number): void
    {
        $tool = Tool::where('inventory_unique', $unique_number)->select('tool_image', 'inventory_unique')->first();

        if ($tool->tool_image) :
            foreach ($tool->tool_image as $key => $value) :
                if (File::exists(public_path("storage/images/" . $value['name']))) :
                    File::delete(public_path("storage/images/" . $value['name']));
                else :
                    continue;
                endif;
            endforeach;
        endif;

        if ($tool->manual) :
            $oldManual = $tool->manual;
            // Gunakan Gdrive
            // Gdrive::delete("/manual/$oldManual");
            // File::delete(public_path("storage" . $oldManual));
            Storage::disk('public')->delete($oldManual);
        endif;
    }
}
