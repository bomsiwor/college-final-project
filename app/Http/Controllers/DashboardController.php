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
        $stats = Attendance::statistic();
        $title = 'Dashboard - Pagu';

        // dd($data);
        return view('Dashboard.index', compact('stats', 'title'));
    }

    public function profile()
    {
        $title = 'Profil';

        return view('Dashboard.profile', compact('title'));
    }

    public function help()
    {
        $title = 'Bantuan';

        return view('Dashboard.help', compact('title'));
    }

    public function contact()
    {
        $title = 'Kontak kami';

        return view('Dashboard.contact', compact('title'));
    }
}
