<?php

namespace App\Http\Controllers;

use App\Exports\RadioactiveBorrowExport;
use App\Models\Radioactive;
use App\Models\RadioactiveBorrow;
use App\Services\RadioactiveBorrowService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RadioactiveBorrowController extends Controller
{
    public function index()
    {
        $title = 'Data Peminjaman sumber';

        $borrows = RadioactiveBorrow::summaryOfAll();

        return view('Borrow.Radioactive.index', compact('borrows', 'title'));
    }

    public function show(RadioactiveBorrow $borrow)
    {
        $title = 'Detail Peminjaman';

        return view('Borrow.Radioactive.detail', compact('title', 'borrow'));
    }

    public function delete()
    {
    }

    public function verify(Request $request, RadioactiveBorrowService $service)
    {
        $response = $service->verify($request);

        if ($response) :
            return back()->with('success', 'Sukses');
        else :
            abort(500);
        endif;
    }

    public function return(Request $request, RadioactiveBorrowService $service)
    {
        $data = RadioactiveBorrow::find($request->id);
        $response = $service->returning($data, $request);

        if ($response) :
            return back()->with('success', 'sukses');
        else :
            abort(500);
        endif;
    }

    public function download()
    {
        return Excel::download(new RadioactiveBorrowExport, 'peminjaman-sumber' . now()->getTimestamp() . '.xlsx');
    }
}
