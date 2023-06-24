<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RadioactiveBorrow;
use App\Models\RadioactiveReturning;
use App\Services\RadioactiveBorrowService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RadioactiveReturnController extends Controller
{
    public $limit = 30;
    public $offset = 0;

    public function index(Request $request)
    {
        $this->limit = $request->input('limit') ?? $this->limit;
        $this->offset = $request->input('offset') ?? $this->offset;

        $returns = RadioactiveReturning::select('id', 'borrow_id', 'verificator_id', 'returning_date', 'created_at')
            ->with('verificator:id,name')
            ->orderBy('created_at')
            ->limit($this->limit)
            ->offset($this->offset)
            ->get();

        // $returns = RadioactiveReturning::all();

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

    public function verify(Request $request, RadioactiveBorrow $borrow, RadioactiveBorrowService $service)
    {
        $input = $request->all();

        $rules = [
            'returning_date' => 'required|after_or_equal:today',
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

        $response = $service->apiReturning($borrow, $request);

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
