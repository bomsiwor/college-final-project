<?php

namespace App\Http\Controllers\Api;

use App\Models\ToolLog;
use App\Models\RadiationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller
{
    public $limit = 30;
    public $offset = 0;

    public function radiationIndex(Request $request, RadiationLog $logs)
    {
        $this->limit = $request->input('limit') ?? $this->limit;
        $this->offset = $request->input('offset') ?? $this->offset;

        $data = $logs->limit($this->limit)->offset($this->offset)->with('user:id,name')->get();

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Sukses',
            'data' => [
                'data' => $data,
                'limit' => $this->limit,
                'offset' => $this->offset
            ]
        ]);
    }

    public function radiationStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'start_time' => 'required',
                'end_time' => 'required',
                'purpose' => 'required',
                'description' => 'nullable',
                'doses' => 'required|numeric|min:0'
            ]
        );

        if ($validator->fails()) :
            return response()->json([
                'code' => 403,
                'success' => false,
                'message' => 'Gagal mencatat!',
                'data' => $validator->errors()
            ], 403);
        endif;

        $validated = $validator->validated();

        $validated += [
            'user_id' => $request->user()->id,
            'log_date' => now()
        ];

        $log = RadiationLog::create($validated);

        return response()->json([
            'code' => 201,
            'success' => true,
            'message' => 'Sukses tercatat!',
            'data' => $log
        ], 201);
    }

    public function toolLogIndex(Request $request, ToolLog $logs)
    {
        $this->limit = $request->input('limit') ?? $this->limit;
        $this->offset = $request->input('offset') ?? $this->offset;

        $data = $logs->limit($this->limit)->offset($this->offset)->with('user:id,name')->get();

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Sukses',
            'data' => [
                'data' => $data,
                'limit' => $this->limit,
                'offset' => $this->offset
            ]
        ]);
    }

    public function toolLogStore(Request $request, ToolLog $logs)
    {
        $flag = DB::table('tools')->select('log_flag', 'inventory_number')->whereNotNull('log_flag')->get()->pluck('log_flag');

        $validator = Validator::make(
            $request->all(),
            [
                'detector' => 'required',
                'purpose' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'hv' => 'exclude_unless:detector,naitl,gm,xrf|required_if:detector,gm,naitl,xrf|numeric',
                'amp' => 'exclude_unless:detector,naitl,gm,xrf|required_if:detector,naitl,gm,xrf|numeric',
                'start_doses' => 'exclude_unless:detector,xrf|required_if:detector,xrf|numeric',
                'end_doses' => 'exclude_unless:detector,xrf|required_if:detector,xrf|numeric',
                'laju_paparan' => 'exclude_unless:detector,xrf|required_if:detector,xrf|numeric',
                'adc' => 'exclude_if:adc,null|numeric'
                // 'hv' => 'required'
            ]
        );

        if ($validator->fails()) :
            return response()->json([
                'code' => 403,
                'success' => false,
                'message' => 'Gagal mencatat!',
                'data' => $validator->errors()
            ], 403);
        endif;

        $validated = $validator->validated();

        $validated += [
            'user_id' => $request->user()->id,
            'log_date' => now(),
            'inventory_id' => DB::table('tools')
                ->select('inventory_unique')
                ->where('log_flag', $validated['detector'])
                ->whereNotNull('log_flag')
                ->pluck('inventory_unique')->first(),
            'log_flag' => $validated['detector'],
            'end_condition' => 'good',
            'additional' => ([
                'hv' => (isset($validated['hv']) ? $validated['hv'] : null),
                'amp' => (isset($validated['amp']) ? $validated['amp'] : null),
                'start_doses' => (isset($validated['start_doses']) ? $validated['start_doses'] : null),
                'end_doses' => (isset($validated['end_doses']) ? $validated['end_doses'] : null),
                'laju_paparan' => (isset($validated['laju_paparan']) ? $validated['laju_paparan'] : null),
                'adc' => (isset($validated['adc']) ? $validated['adc'] : null),
            ])
        ];

        try {
            $log = $logs->create($validated);
        } catch (\Throwable $e) {
            return response()->json([
                'code' => 403,
                'success' => false,
                'message' => 'Gagal!',
                'data' => $e->getMessage()
            ], 403);
        }

        return response()->json([
            'code' => 201,
            'success' => true,
            'message' => 'Sukses tercatat!',
            'data' => $log
        ], 201);
    }
}
