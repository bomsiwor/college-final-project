<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Actions\deleteMaintenanceAction;
use App\Actions\VerifyMaintenanceAction;
use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use App\Http\Requests\VerifyMaintenance;
use App\Services\MaintenanceAgendaService;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class MaintenanceController extends Controller
{
    public function index()
    {
        $title = "Perawatan Alat";

        $data = Maintenance::summary();

        return view('Maintenance.index', compact('title', 'data'));
    }

    public function detail(Maintenance $maintenance)
    {
        $title = 'Detail operasi';

        return view('Maintenance.detail', compact('maintenance', 'title'));
    }

    public function create()
    {
        $title = 'Tambah data';

        return view('Maintenance.create', compact('title'));
    }

    public function store(StoreMaintenanceRequest $request, MaintenanceAgendaService $service)
    {
        $validated = $request->validated();

        if (!$service->handle($validated)) :
            return back()->withErrors(['failed' => 'Gagal menambahkan!']);
        endif;

        return to_route('maintenance.index')->with('created', 'Sukses menambahkan data!');
    }

    public function update(UpdateMaintenanceRequest $request)
    {
        Maintenance::where('id', $request->id)->update($request->validated());

        return back()->with('success', 'success');
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
