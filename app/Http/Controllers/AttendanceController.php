<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

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
}
