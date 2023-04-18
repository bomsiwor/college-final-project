<?php

namespace App\Actions;

use App\Models\Tool;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdateToolRequest;

class UpdateToolAction
{

    public function handle(UpdateToolRequest $request): bool
    {
        $data = $request->validated();

        $images = [];
        if ($request->file('images')) {
            foreach ($request->file('images') as $key => $file) {
                $fileName = time() . rand(1, 99) . '.' . $file->extension();
                $file->storeAs('images', $fileName);
                $images["image_$key"]['name'] = $fileName;
                $images["image_$key"]['description'] = "$request->name - $key";
            }
            unset($data['images']);
            $data['tool_image'] = $images;
        }

        $tool = Tool::where('inventory_unique', $request->unique)->select('tool_image', 'inventory_unique')->first();

        if ($tool->tool_image) :
            foreach ($tool->tool_image as $key => $value) :
                if (File::exists(public_path("storage/images/" . $value['name']))) :
                    File::delete(public_path("storage/images/" . $value['name']));
                else :
                    continue;
                endif;
            endforeach;
        endif;

        try {
            Tool::where('inventory_unique', $request->unique)->update($data);
        } catch (\Throwable $e) {
            return false;
        }

        return true;
    }
}
