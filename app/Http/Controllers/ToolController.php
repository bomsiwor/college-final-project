<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\Tool;
use App\Imports\ToolImport;
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

        // $totalGroup = count($data);
        // $perPage = 10;
        // $page = Paginator::resolveCurrentPage('page');

        // $data = new LengthAwarePaginator($data->forPage($page, $perPage), $totalGroup, $perPage, $page, [
        //     'path' => Paginator::resolveCurrentPath(),
        //     'pageName' => 'page',
        // ]);

        return view('Tools.index', compact('data', 'title', 'count'));
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
        // dd($request->file('toolFile'));
        try {
            Excel::import(new ToolImport, $request->file('toolFile'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }

        return "sukses";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function show(Tool $tool)
    {
        $title = 'Detail Alat';

        // $borrows = $tool->load(['borrow' => function ($query) {
        //     $query->select('borrows.inventory_id', 'borrows.status', 'borrows.id as borrow_id');
        // }]);

        // dd($borrows);

        // $additional = Tool::where('id', 1)->select(DB::raw('round(datediff(now(), purchase_date)/365,2) as selisih_tahun'))->get();
        // dd($additional);

        return view('Tools.detail', compact('tool', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function edit(Tool $tool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tool $tool)
    {
        //
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
}
