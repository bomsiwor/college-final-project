<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\Tool;
use App\Models\ToolLog;
use App\Imports\ToolImport;
use Illuminate\Http\Request;
use App\Actions\UpdateToolAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdateToolRequest;
use Illuminate\Support\Facades\Storage;

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
        $title = 'Detail Alat';
        return view('Tools.detail', compact('tool', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateToolRequest $request, UpdateToolAction $action)
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
            if ($tool->tool_image) :
                foreach ($tool->tool_image as $key => $value) :
                    if (File::exists(public_path("storage/inventory-images/" . $value['name']))) :
                        File::delete(public_path("storage/inventory-images/" . $value['name']));
                    else :
                        continue;
                    endif;
                endforeach;
            endif;
            $tool->delete();
        } catch (\Throwable $e) {
            return response()->json(['error'], 404);
        }

        return response()->json(['data' => 'sukses']);
    }

    public function indexLog()
    {
        $title = 'Catatan Penggunaan Alat';

        return view('Tools.Log.index', compact('title'));
    }

    public function showLog($flag, ToolLog $toolLog)
    {
        $title = 'Catatan penggunaan alat';
        $data = $toolLog->where('log_flag', $flag)->get();

        return view('Tools.Log.show', compact('title', 'data', 'flag'));
    }

    public function download(Request $request)
    {
        $tool = Tool::where('inventory_unique', $request->inventory_unique)->first();
        return Storage::download($tool->manual);
    }
}
