<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRadioactiveRequest;
use App\Models\Radioactive;
use Illuminate\Http\Request;

class RadioactiveController extends Controller
{

    public function index()
    {
        $title = 'Data ZRA';
        $data  = Radioactive::summary();
        return view('Radioactive.index', compact('title', 'data'));
    }

    public function show(Radioactive $radioactive)
    {
        $title = 'Detail Sumber';

        return view('Radioactive.detail', compact('radioactive', 'title'));
    }

    public function create()
    {
        $title = 'Tambah data';

        return view('Radioactive.create', compact('title'));
    }

    public function update(UpdateRadioactiveRequest $request)
    {
        dd($request->all());
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
