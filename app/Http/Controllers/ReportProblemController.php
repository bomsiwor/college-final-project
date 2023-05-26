<?php

namespace App\Http\Controllers;

use App\Models\ReportProblem;
use Illuminate\Http\Request;

class ReportProblemController extends Controller
{
    //
    public function index()
    {
        $title = 'Laporkan Kerusakan';

        $reports = ReportProblem::summary();

        return view('Tools.report', compact('title', 'reports'));
    }

    public function create()
    {
        $title = 'Ajukan';

        return view('Tools.Report.create', compact('title'));
    }

    public function show(ReportProblem $report)
    {
        $title = 'Detail';

        return view('Tools.Report.show', compact('title', 'report'));
    }
}
