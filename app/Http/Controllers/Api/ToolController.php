<?php

namespace App\Http\Controllers\Api;

use App\Models\Tool;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ToolController extends Controller
{
    public $limit = 30;
    public $offset = 0;
    //
    public function index(Request $request)
    {
        $this->limit = $request->input('limit') ?? $this->limit;
        $this->offset = $request->input('offset') ?? $this->offset;

        $tools = Tool::ApiSummary()->limit($this->limit)->offset($this->offset)->get();

        // return response()->json([
        //     'code' => 200,
        //     'success' => true,
        //     'message' => 'Sukses',
        //     'data' => [
        //         'tools' => $tools,
        //         'limit' => $this->limit,
        //         'offset' => $this->offset
        //     ]
        // ]);

        return response()->success([
            'tools' => $tools,
            'limit' => $this->limit,
            'offset' => $this->offset
        ]);
    }

    public function show(Tool $tool)
    {
        // return response()->json([
        //     'code' => 200,
        //     'success' => true,
        //     'message' => 'Sukses',
        //     'data' => $tool
        // ]);
        return response()->success($tool);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'inventory_number' => 'nullable',
            'merk' => 'required',
            'series' => 'required',
            'condition' => 'required',
            'status' => 'required',
            'used_status' => 'required',
            'purchase_date' => 'required|before_or_equal:today',
            'price' => 'nullable|integer|min:1000',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) :
            return response()->json([
                'code' => 403,
                'success' => false,
                'message' => 'Gagal menyimpan!',
                'data' => $validator->errors()
            ], 403);
        endif;

        $validated = $validator->validated();

        $validated += ['inventory_unique' => Str::uuid()];

        $tool = Tool::create($validated);

        // return response()->json([
        //     'code' => 201,
        //     'success' => true,
        //     'message' => 'Sukses tercatat!',
        //     'data' => $tool
        // ], 201);
        return response()->created($tool);
    }

    public function update(Request $request, Tool $tool)
    {
        $input = $request->all();

        $validator = Validator::make(
            $input,
            [
                'name' => 'sometimes|required',
                'inventory_number' => 'sometimes|nullable',
                'merk' => 'sometimes|required',
                'series' => 'sometimes|required',
                'condition' => 'sometimes|required',
                'used_status' => 'sometimes|required',
                'purchase_date' => 'sometimes|required|before_or_equal:today',
                'price' => 'sometimes|nullable|numeric|min:100',
                'images.*' => 'sometimes|nullable|mimes:jpg,png|max:2048',
                'manual' => 'sometimes|nullable|mimes:pdf|max:4096'
            ]
        );

        if ($validator->fails()) :
            return response()->json([
                'code' => 403,
                'success' => false,
                'message' => 'Gagal menyimpan!',
                'data' => $validator->errors()
            ], 403);
        endif;

        $validated = $validator->validated();

        try {
            $tool->update($validated);
        } catch (\Throwable $e) {
            return response()->json([
                'code' => 403,
                'success' => false,
                'message' => 'Gagal menghpapus!',
                'data' => $e->getMessage()
            ], 403);
        }

        // return response()->json([
        //     'code' => 200,
        //     'success' => true,
        //     'message' => 'Sukses terupdate!',
        //     'data' => $tool
        // ], 200);

        return response()->success($tool, "Sukses terupdate!");
    }

    public function destroy(Tool $tool)
    {
        try {
            if ($tool->tool_image) :
                foreach ($tool->tool_image as $key => $value) :
                    if (File::exists(public_path("storage/inventory-images/" . $value['name']))) :
                        File::delete(public_path("storage/inventory-images/" . $value['name']));
                    else :
                        continue;
                    endif;
                endforeach;
            endif;
            $tool->delete();
        } catch (\Throwable $e) {
            return response()->json([
                'code' => 403,
                'success' => false,
                'message' => 'Gagal menghpapus!',
                'data' => $e->getMessage()
            ], 403);
        }

        // return response()->json([
        //     'code' => 200,
        //     'success' => true,
        //     'message' => 'Sukses terhapus!',
        //     'data' => []
        // ], 200);
        return response()->success([], "Sukses terhapus!");
    }
}
