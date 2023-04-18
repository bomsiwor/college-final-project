<?php

namespace App\Http\Controllers;

use App\Actions\UpdateToolAction;
use App\Http\Requests\UpdateToolRequest;
use Excel;
use App\Models\Tool;
use App\Imports\ToolImport;
use App\Models\ToolLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Aset - Peralatan';
        $data = Tool::summary();

        $count = DB::table('tools')
            ->select(DB::raw('count(*) as num'), 'condition')
            ->groupBy('condition')
            ->get();

        return view(
            'Tools.index',
            compact(
                'data',
                'title',
                'count'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Alat';
        return view('Tools.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeExcel(Request $request)
    {
        $this->validate($request, [
            'toolFile' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new ToolImport, $request->file('toolFile'));
        } catch (\Throwable $e) {
            return back();
        }

        return back()->with('success', 'Sukses menguggah data ke database');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function show(Tool $tool)
    {
        return view('Tools.detail', compact('tool', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateToolRequest $request, UpdateToolAction $action): RedirectResponse
    {
        if ($action->handle($request)) :
            return back()->with('success', 'sukses');
        else :
            abort(500);
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tool $tool)
    {
        try {
            $tool->delete();
        } catch (\Throwable $e) {
            return response()->json(['error'], 404);
        }

        return response()->json(['data' => 'sukses']);
    }

    public function logs(Request $request)
    {
        $data = ToolLog::create($request->all());

        $add = $data->additional;

        dd($add['hv']);
    }

    public function maintenance()
    {
        $title = "Perawatan Alat";

        return view('Tools.maintenance-index', compact('title'));
    }

    public function report()
    {
        $title = 'Laporkan Kerusakan';

        return view('Tools.report', compact('title'));
    }
}
