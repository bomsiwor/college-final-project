<?php

namespace App\Http\Controllers\Api;

use App\Models\Borrow;
use App\Models\Returning;
use Illuminate\Http\Request;
use App\Services\BorrowService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ToolReturnController extends Controller
{
    public $limit = 30;
    public $offset = 0;

    public function index(Request $request)
    {
        $this->limit = $request->input('limit') ?? $this->limit;
        $this->offset = $request->input('offset') ?? $this->offset;

        $returns = Returning::select('id', 'borrow_id', 'verificator_id', 'returning_date', 'condition', 'created_at')
            ->with('verificator:id,name', 'borrow:id')
            ->orderBy('created_at')->limit($this->limit)->offset($this->offset)->get();

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Sukses',
            'data' => [
                'returns' => $returns,
                'limit' => $this->limit,
                'offset' => $this->offset
            ]
        ]);
    }

    public function verify(Request $request, Borrow $borrow, BorrowService $service)
    {
        $input = $request->all();

        $rules = [
            'returning_date' => 'required|after_or_equal:today',
            'condition' => 'required'
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

        $response = $service->returningApi($borrow, $request);

        if ($response) :
            return response()->json([
                'code' => 201,
                'success' => true,
                'message' => 'Sukses menyimpan pengembalian!',
                'data' => []
            ], 201);
        else :
            return response()->json([
                'code' => 403,
                'success' => false,
                'message' => 'Gagal menyimpan!',
                'data' => []
            ], 403);
        endif;
    }
}
