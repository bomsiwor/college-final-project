<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Exports\AttendanceExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    private $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function index()
    {
        $title = 'Presensi';

        return view('Activity.Attendance.index', compact('title'));
    }

    public function total()
    {
        $title = 'Semua data kunjungan';
        $data = $this->attendance->all();

        return view('Activity.Attendance.total', compact('title', 'data'));
    }

    public function me()
    {
        $title = 'Data kunjungan pribadi';
        $data = $this->attendance->where('user_id', auth()->id())->get();

        return view('Activity.Attendance.me', compact('title', 'data'));
    }

    public function download()
    {
        try {
            return Excel::download(new AttendanceExport, 'presensi.xlsx');
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }
}
