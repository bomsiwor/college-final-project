<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\Borrow;
use App\Models\Attendance;
use App\Models\Returning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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

    public function verifyBorrow(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required',
            'verified_note' => 'nullable'
        ]);

        $meta = [
            'verificator_id' => Auth::user()->id,
            'verified_at' => now()
        ];

        $validated += $meta;

        try {
            Borrow::where('id', $request->id)->update($validated);

            if ($request->status == 'accepted') :
                Tool::where('inventory_unique', $request->unique_id)->update(['status' => 'borrowed']);
            endif;
        } catch (\Throwable $e) {
            return $e->getMessage();
        }

        return back()->with('success', 'Sukses');
    }

    public function adminBorrow()
    {
        $title = 'Admin - Peminjaman';
        $data = Borrow::where('status', 'accepted')->whereNull('actual_return_date')->get();
        $returnings = Returning::select('id', 'borrow_id', 'verificator_id', 'returning_date', 'condition', 'created_at')->with('verificator:id,name')->orderBy('created_at')->get();

        return view('Admin.showBorrow', compact('data', 'title', 'returnings'));
    }

    public function returnBorrow(Borrow $borrow)
    {
        DB::transaction(function () use ($borrow) {
            $borrow->actual_return_date = now()->addDays(10);
            $borrow->save();

            Returning::create([
                'borrow_id' => $borrow->id,
                'verificator_id' => Auth::user()->id,
                'returning_date' => now()->addDays(10),
                'condition' => 'good'
            ]);

            Tool::where('inventory_unique', $borrow->inventory_id)->update(['status' => 'available']);
        });

        return redirect()->back();
    }
}
