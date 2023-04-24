<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Actions\deleteMaintenanceAction;
use App\Actions\VerifyMaintenanceAction;
use App\Http\Requests\VerifyMaintenance;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class MaintenanceController extends Controller
{
    public function index()
    {
        $title = "Perawatan Alat";

        $data = Maintenance::summary();

        return view('Tools.maintenance-index', compact('title', 'data'));
    }

    public function detail(Maintenance $maintenance)
    {
        $title = 'Detail operasi';

        return view('Tools.maintenance-show', compact('maintenance', 'title'));
    }

    public function verify(VerifyMaintenance $request, VerifyMaintenanceAction $action)
    {
        $response = $action->handle($request);

        if ($response) :
            return back()->with('success', 'sukses');
        else :
            abort(500);
        endif;
    }

    public function unverify(Request $request, VerifyMaintenanceAction $action)
    {
        if ($request->ajax()) :
            $response = $action->undo($request->data);

            if ($response) :
                return response()->json([
                    'message' => 'success'
                ], 200);
            else :
                return response()->json([
                    'message' => 'error'
                ], 404);
            endif;
        endif;
    }

    public function delete(Request $request, deleteMaintenanceAction $action)
    {
        if ($request->ajax()) :
            $response = $action->handle($request->id);

            if ($response) :
                return response()->json([]);
            else :
                return response()->json([], 404);
            endif;

        endif;
    }

    public function download(Maintenance $maintenance)
    {
        $data = Gdrive::get($maintenance->document);
        return response($data->file, 200)
            ->header('Content-Type', $data->ext)
            ->header('Content-disposition', 'attachment; filename="' . $data->filename . '"');
    }
}
