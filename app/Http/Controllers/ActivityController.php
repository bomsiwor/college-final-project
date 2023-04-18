<?php

namespace App\Http\Controllers;


use App\Models\Borrow;
use App\Models\Attendance;
use App\Models\Returning;
use App\Services\BorrowService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Pagination\Paginator;

use Illuminate\Pagination\LengthAwarePaginator;

class ActivityController extends Controller
{
    public function presensi()
    {
        $title = 'Presensi sendiri';
        return view('Activity.presensi', compact('title'));
    }

    public function allAttendance()
    {
        $title = 'Semua Kunjungan';
        $data = Attendance::with('user:id,name')->get();

        $totalGroup = count($data);
        $perPage = 10;
        $page = Paginator::resolveCurrentPage('page');

        $data = new LengthAwarePaginator($data->forPage($page, $perPage), $totalGroup, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

        return view('Activity.allAttendance', compact('title', 'data'));
    }

    public function indexOfBorrow()
    {
        $title = 'Data Peminjaman';
        $data = Borrow::summaryOfAll();

        return view('Activity.allBorrow', compact('data', 'title'));
    }

    public function showBorrow(Borrow $borrow)
    {
        $title = 'Detail Peminjaman';

        return view('Activity.showBorrow', compact('title', 'borrow'));
    }

    public function verifyBorrow(Request $request, BorrowService $service): RedirectResponse
    {
        $response = $service->verify($request);

        if ($response) :
            return back()->with('success', 'Sukses');
        else :
            abort(500);
        endif;
    }

    public function adminBorrow()
    {
        $title = 'Admin - Peminjaman';
        $data = Borrow::where('status', 'accepted')->whereNull('actual_return_date')->get();
        $returnings = Returning::select('id', 'borrow_id', 'verificator_id', 'returning_date', 'condition', 'created_at')
            ->with('verificator:id,name')
            ->orderBy('created_at')->get();

        return view('Admin.showBorrow', compact('data', 'title', 'returnings'));
    }

    public function returnBorrow(Borrow $borrow, BorrowService $service): RedirectResponse
    {
        $response = $service->returning($borrow);

        if ($response) :
            return redirect()->back();
        else :
            abort(500);
        endif;
    }

    public function radiationLog()
    {
        $title = 'Penerimaan Radiasi';

        return view('Activity.radiationLog', compact('title'));
    }
}
