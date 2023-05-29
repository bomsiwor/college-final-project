<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaintenanceController extends Controller
{
    public $limit = 30;
    public $offset = 0;
    //
    public function index(Request $request)
    {
        $this->limit = $request->input('limit') ?? $this->limit;
        $this->offset = $request->input('offset') ?? $this->offset;

        $maintenances = Maintenance::apiSummary($this->limit, $this->offset);

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Sukses',
            'data' => [
                'maintenances' => $maintenances,
                'limit' => $this->limit,
                'offset' => $this->offset
            ]
        ]);
    }

    public function show(Maintenance $maintenance)
    {
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Sukses',
            'data' => $maintenance
        ]);
    }

    public function store(Request $request, Maintenance $maintenance)
    {
        $input = $request->all();

        $rules = [
            'activity_name' => 'required|min:5',
            'agenda' => 'required|min:10',
            'in_charge' => 'required|min:5',
            'month' => 'required|after_or_equal:today',
        ];

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
            $maintenance->create($validated);
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
            'data' => $maintenance
        ], 201);
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $rules = [
            'activity_name' => 'sometimes|required',
            'agenda' => 'sometimes|required',
            'in_charge' => 'sometimes|required',
            'month' => 'sometimes|required'
        ];

        $input = $request->all();

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
            $maintenance->update($validated);
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
            'data' => $maintenance
        ], 200);
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => "Data perawatan ID-$maintenance->id Sukses terhapus!",
            'data' => []
        ], 200);
    }
}
