<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
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

        $totalGroup = count($data);
        $perPage = 10;
        $page = Paginator::resolveCurrentPage('page');

        $data = new LengthAwarePaginator($data->forPage($page, $perPage), $totalGroup, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

        return view('Activity.allAttendance', compact('title', 'data'));
    }
}
