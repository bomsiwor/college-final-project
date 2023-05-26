<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportProblemController extends Controller
{
    //
    public function index()
    {
        $title = 'Laporkan Kerusakan';

        return view('Tools.report', compact('title'));
    }

    public function create()
    {
        $title = 'Ajukan';

        return view('Tools.Report.create', compact('title'));
    }
}
