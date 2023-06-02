<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\RadioactiveBorrow;
use App\Http\Controllers\Controller;
use App\Models\Radioactive;
use Illuminate\Support\Facades\Validator;

class RadioactiveBorrowController extends Controller
{
    public $limit = 30;
    public $offset = 0;
    public $borrow;

    public function __construct()
    {
        $this->borrow = new RadioactiveBorrow();
    }

    public function index(Request $request)
    {
        $this->limit = $request->input('limit') ?? $this->limit;
        $this->offset = $request->input('offset') ?? $this->offset;

        try {
            $borrows = $this->borrow->apiSummary($this->limit, $this->offset);
        } catch (\Throwable $e) {
            return $e->getMessage();
        }

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Sukses',
            'data' => [
                'borrows' => $borrows,
                'limit' => $this->limit,
                'offset' => $this->offset
            ]
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'inventory_id' => 'required',
            'start_borrow_date' => 'required|date|after_or_equal:today',
            'expected_return_date' => 'required|date|after_or_equal:start_borrow_date',
            'purpose' => 'required',
            'description' => 'required_if:purpose,other',
        ];

        $input = $request->all();

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

        $validated += [
            'user_id' => $request->user()->id
        ];

        $borrow = $this->borrow->create($validated);

        return response()->json([
            'code' => 201,
            'success' => true,
            'message' => 'Sukses tercatat!',
            'data' => $borrow
        ], 201);
    }

    public function verify(Request $request, RadioactiveBorrow $borrow)
    {
        if ($borrow->status) :
            return response()->json([
                'code' => 403,
                'success' => false,
                'message' => 'Sudah diverifikasi',
                'data' => []
            ], 403);
        endif;

        $status = [
            'accepted',
            'rejected'
        ];

        $rules = [
            'status' => ['required', Rule::in($status)],
            'verified_note' => 'nullable',
        ];

        $input = $request->all();

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

        $validated += [
            'verificator_id' => $request->user()->id,
            'verified_at' => now()
        ];

        $borrow->update($validated);

        if ($validated['status'] == 'accepted') :
            $this->acceptBorrow($borrow->inventory_id);
        endif;

        return response()->json([
            'code' => 201,
            'success' => true,
            'message' => 'Sukses diverifikasi!',
            'data' => [
                'status' => $validated['status']
            ]
        ], 201);
    }

    private function acceptBorrow($inventory)
    {
        Radioactive::where('inventory_unique', $inventory)->update([
            'status' => 'borrowed'
        ]);
    }

    public function delete(Request $request, RadioactiveBorrow $borrow)
    {
        if ($request->user()->id !== $borrow->user_id) :
            return response()->json([
                'code' => 401,
                'success' => false,
                'message' => 'Permintaan gagal dilakukan',
                'data' => []
            ], 401);
        endif;

        if ($borrow->verified_at !== null) :
            return response()->json([
                'code' => 403,
                'success' => false,
                'message' => 'Permintaan gagal dilakukan',
                'data' => []
            ], 403);
        endif;

        $borrow->delete();

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Sukses dihapus!',
            'data' => []
        ], 200);
    }
}
