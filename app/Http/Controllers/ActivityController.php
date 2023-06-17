<?php

namespace App\Http\Controllers;

use App\Exports\RadiationLogExport;
use App\Models\Borrow;
use App\Models\Attendance;
use App\Models\RadiationLog;
use App\Models\Returning;
use Excel;

class ActivityController extends Controller
{
    public function radiationLog(RadiationLog $logs)
    {
        $title = 'Penerimaan Radiasi';
        $data = $logs->all();

        return view('Activity.radiationLog', compact('title', 'data'));
    }

    public function radiationLogDownload()
    {
        return Excel::download(new RadiationLogExport, 'log-radiasi.xlsx');
    }
}
