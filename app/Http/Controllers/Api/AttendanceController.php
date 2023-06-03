<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public $limit = 30;
    public $offset = 0;

    public function index(Request $request)
    {
        $this->limit = $request->input('limit') ?? $this->limit;
        $this->offset = $request->input('offset') ?? $this->offset;

        $attendances = Attendance::limit($this->limit)->offset($this->offset)->with('user:id,name')->get();

        // return response()->json([
        //     'code' => 200,
        //     'success' => true,
        //     'message' => 'Sukses',
        //     'data' => [
        //         'attendances' => $attendances,
        //         'limit' => $this->limit,
        //         'offset' => $this->offset
        //     ]
        // ]);

        return response()->success([
            'attendances' => $attendances,
            'limit' => $this->limit,
            'offset' => $this->offset
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'occupation' => 'required',
                'description' => 'nullable'
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

        $attendance = Attendance::create(
            [
                'user_id' => $request->user()->id,
                'occupation' => $validated['occupation'],
                'description' => $validated['description'],
                'attendance_time' => now()
            ]
        );

        // return response()->json([
        //     'code' => 201,
        //     'success' => true,
        //     'message' => 'Sukses tercatat!',
        //     'data' => $attendance
        // ], 201);
        return response()->created($attendance);
    }
}
