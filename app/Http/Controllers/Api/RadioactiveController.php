<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Radioactive;
use Illuminate\Http\Request;

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
