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

        $report = $report->load('verificator:id,name', 'analyst:id,name');


        return view('Tools.Report.show', compact('title', 'report'));
    }

    public function verify(Request $request, ReportProblem $report)
    {
        $data = $report->find($request->report_id);

        $input = [
            'status' => $request->status,
            'verified_at' => now(),
            'verificator_id' => auth()->id()
        ];

        $data->update($input);

        return back()->with('success', 'Laporan diverifikasi');
    }

    public function accessing(Request $request, ReportProblem $report)
    {
        $data = $report->find($request->report_id);

        $accessed = false;
        $status = 'rejected';

        if ($request->status == 'accepted') :
            $accessed = true;
            $status = "accessed";
        endif;

        $input = [
            'accessed' => $accessed,
            'status' => $status
        ];

        $data->update($input);

        return back()->with('success', 'Data ditelah diperbarui');
    }

    public function analyzing(Request $request, ReportProblem $report)
    {
        $data = $report->find($request->report_id);

        $input = [
            'status' => 'analyzed',
            'analyzed_at' => now(),
            'analyst_id' => auth()->id(),
            'analysis' => $request->analysis
        ];

        $data->update($input);

        return back()->with('success', 'Laporan dianalisis');
    }

    public function advancing(Request $request, ReportProblem $report)
    {
        $data = $report->find($request->report_id);

        $input = $request->validate([
            'advance_operator' => 'required',
            'advance_in_charge' => 'required',
            'advance_description' => 'required',
            'advance_target' => 'required|after_or_equal:today'
        ]);

        $input += [
            'status' => 'advancing'
        ];

        $data->update($input);

        return back()->with('success', 'Laporan diperbarui');
    }

    public function repairing(Request $request, ReportProblem $report)
    {
        $data = $report->find($request->report_id);

        $input = $request->validate([
            'repair_in_charge' => 'required',
            'repair_description' => 'required',
            'repair_target' => 'required|after_or_equal:today'
        ]);

        $input += [
            'status' => 'repairing'
        ];

        $data->update($input);

        return back()->with('success', 'Laporan diperbarui');
    }

    public function finalize(Request $request, ReportProblem $report)
    {
        $data = $report->find($request->report_id);

        $input = $request->validate([
            'effective_status' => 'required',
            'supervisor_note' => 'nullable'
        ]);

        $input += [
            'status' => 'done'
        ];

        $data->update($input);

        return back()->with('success', 'Laporan diselesaikan');
    }
}
