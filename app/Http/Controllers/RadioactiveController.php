<?php

namespace App\Http\Controllers;

use App\Models\Radioactive;
use App\Actions\GetNuclideAction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class RadioactiveController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['role:lecturer']);
    // }

    public function index()
    {
        $title = 'Data ZRA';
        $data  = Radioactive::summary();
        return view('Radioactive.index', compact('title', 'data'));
    }

    public function show(Radioactive $radioactive, GetNuclideAction $action)
    {
        $title = 'Detail Sumber';

        $iaea = $action->handle($radioactive->slug, 'levels');

        return view('Radioactive.detail', compact('radioactive', 'title', 'iaea'));
    }

    public function detail($isotopes)
    {
        $title = 'Detail ZRA';
    }

    public function destroy(Radioactive $radioactive)
    {
        try {
            $radioactive->delete();
        } catch (\Throwable $e) {
            return response()->json(['error'], 404);
        }

        return response()->json(['data' => 'sukses']);
    }
}
