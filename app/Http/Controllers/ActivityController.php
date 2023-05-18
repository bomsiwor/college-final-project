<?php

namespace App\Http\Controllers;


use App\Models\Borrow;
use App\Models\Attendance;
use App\Models\Returning;
use App\Services\BorrowService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Pagination\Paginator;

use Illuminate\Pagination\LengthAwarePaginator;

class ActivityController extends Controller
{
    public function presensi()
    {
        $title = 'Presensi sendiri';
        return view('Activity.presensi', compact('title'));
    }

    public function allAttendance()
    {
        $title = 'Semua Kunjungan';
        $data = Attendance::with('user:id,name')->get();

        return view('Activity.Attendance.index', compact('title', 'data'));
    }

    public function adminBorrow()
    {
        $title = 'Admin - Peminjaman';
        $data = Borrow::where('status', 'accepted')->whereNull('actual_return_date')->get();
        $returnings = Returning::select('id', 'borrow_id', 'verificator_id', 'returning_date', 'condition', 'created_at')
            ->with('verificator:id,name')
            ->orderBy('created_at')->get();

        return view('Admin.showBorrow', compact('data', 'title', 'returnings'));
    }

    public function radiationLog()
    {
        $title = 'Penerimaan Radiasi';

        return view('Activity.radiationLog', compact('title'));
    }
}
