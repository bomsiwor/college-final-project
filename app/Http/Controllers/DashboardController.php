<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
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
