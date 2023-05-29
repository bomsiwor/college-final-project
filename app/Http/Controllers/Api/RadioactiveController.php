<?php

namespace App\Http\Controllers\Api;

use App\Models\Radioactive;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RadioactiveController extends Controller
{
    //
    public $limit = 30;
    public $offset = 0;
    //
    public function index(Request $request)
    {
        $this->limit = $request->input('limit') ?? $this->limit;
        $this->offset = $request->input('offset') ?? $this->offset;

        $radioactives = Radioactive::apiSummary();

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Sukses',
            'data' => [
                'radioactives' => $radioactives,
                'limit' => $this->limit,
                'offset' => $this->offset
            ]
        ]);
    }

    public function show(Radioactive $radioactive)
    {
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Sukses',
            'data' => $radioactive
        ]);
    }

    public function store(Request $request, Radioactive $radioactive)
    {
        $input = $request->all();

        $rules = [
            'element_name' => 'required',
            'isotope_number' => 'required',
            'element_symbol' => 'required',
            'purchase_date' => 'nullable',
            'manufacturing_date' => 'required|before:today',
            'initial_activity' => 'required|numeric|min:0.001',
            'packaging_type' => 'required',
            'status' => 'required',
            'condition' => 'required',
            'properties' => 'required',
            'description' => 'nullable',
            'inventory_number' => 'nullable',
            'quantity' => 'required|numeric|min:0',
            'entry_number' => 'required|numeric|unique:radioactives,entry_number|min:1'
        ];

        if (!$input) :
            return response()->json([
                'code' => 302,
                'success' => false,
                'message' => 'Data kosong',
                'data' => []
            ], 302);
        endif;

        $validator = Validator::make($input, $rules);

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
            $radioactive->create($validated);
        } catch (\Throwable $e) {
            return response()->json([
                'code' => 403,
                'success' => false,
                'message' => 'Gagal menyimpan!',
                'data' => $e->getMessage()
            ], 403);
        }

        return response()->json([
            'code' => 201,
            'success' => true,
            'message' => 'Sukses menyimpan!',
            'data' => $radioactive
        ], 201);
    }

    public function update(Request $request, Radioactive $radioactive)
    {
        $input = $request->all();
        $rules = [
            'element_name' => 'sometimes|required',
            'isotope_number' => 'sometimes|required',
            'element_symbol' => 'sometimes|required',
            'purchase_date' => 'nullable',
            'manufacturing_date' => 'sometimes|required|before:today',
            'initial_activity' => 'sometimes|required|numeric|min:0.001',
            'packaging_type' => 'sometimes|required',
            'condition' => 'sometimes|required',
            'properties' => 'sometimes|required',
            'description' => 'nullable',
            'inventory_number' => 'nullable',
            'quantity' => 'sometimes|required|numeric|min:0',
            'entry_number' => [
                'sometimes',
                'required',
                'numeric',
                'min:1',
                Rule::unique('radioactives', 'entry_number')->ignore($radioactive->id)
            ]
        ];

        if (!$input) :
            return response()->json([
                'code' => 302,
                'success' => false,
                'message' => 'Data kosong',
                'data' => []
            ], 302);
        endif;

        $validator = Validator::make($input, $rules);

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
            $radioactive->update($validated);
        } catch (\Throwable $e) {
            return response()->json([
                'code' => 403,
                'success' => false,
                'message' => 'Gagal menghpapus!',
                'data' => $e->getMessage()
            ], 403);
        }

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Sukses terupdate!',
            'data' => $radioactive
        ], 200);
    }

    public function destroy(Radioactive $radioactive)
    {
        $radioactive->delete();

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Sukses terhapus!',
            'data' => []
        ], 200);
    }
}
