<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Services\BorrowService;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {
        $title = 'Data Peminjaman';
        $data = Borrow::summaryOfAll();

        return view('Activity.allBorrow', compact('data', 'title'));
    }

    public function show(Borrow $borrow)
    {
        $title = 'Detail Peminjaman';

        return view('Activity.showBorrow', compact('title', 'borrow'));
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function verify(Request $request, BorrowService $service)
    {
        $response = $service->verify($request);

        if ($response) :
            return back()->with('success', 'Sukses');
        else :
            abort(500);
        endif;
    }

    public function return(Request $request, BorrowService $service)
    {
        $data = Borrow::find($request->id);
        $response = $service->returning($data, $request);

        if ($response) :
            return back()->with('success', 'sukses');
        else :
            abort(500);
        endif;
    }
}
