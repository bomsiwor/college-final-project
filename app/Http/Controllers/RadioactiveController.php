<?php

namespace App\Http\Controllers;

use App\Actions\GetNuclideAction;
use App\Models\Radioactive;
use Illuminate\Support\Facades\Http;

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
}
