<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function profile()
    {
        $data = [
            'user' => Auth::user()->student->study_program
        ];

        dd($data);

        return view('Dashboard.profile', $data);
    }
}
