<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Request;

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
