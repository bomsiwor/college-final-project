<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data['stats'] = Attendance::statistic()->get();
        // dd($data);
        return view('Dashboard.index', $data);
    }

    public function profile()
    {
        $data = [
            'data' => 'inidata'
        ];

        return view('Dashboard.profile', $data);
    }

    public function help()
    {
        return view('Dashboard.help');
    }

    public function contact()
    {
        return view('Dashboard.contact');
    }
}
