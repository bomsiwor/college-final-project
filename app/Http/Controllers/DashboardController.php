<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\Borrow;
use App\Models\Attendance;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {
        $stats = Attendance::statistic();
        $borrows = Borrow::summaryOfAll();
        $title = 'Dashboard - Pagu';

        $topTool = Tool::topBorrowed();
        // dd($data);
        return view('Dashboard.index', compact('stats', 'title', 'borrows', 'topTool'));
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

    public function agenda()
    {
        $title = 'Agenda Laboratorium';

        return view('Dashboard.agenda', compact('title'));
    }

    public function blank()
    {
        $title = 'Percobaan ';
        return view('Dashboard.blank', compact('title'));
    }
}
