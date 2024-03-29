<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\Borrow;
use App\Models\Message;
use App\Models\Attendance;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Actions\StoreMessageAction;
use App\Models\Agenda;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class DashboardController extends Controller
{

    public function index()
    {
        // Attendance
        $attendances = Attendance::statistic()->get();
        $label = $attendances->pluck('name')->map(function ($item) {
            return __("activity.$item");
        })->toArray();
        $value = $attendances->pluck('value')->toArray();

        // Check peminjaman pengumuman
        $borrow_announce = DB::table('borrows')
            ->where('created_at', '>=', now()->subDays(7))
            ->whereNull('verified_at');

        $borrow_announce_admin = $borrow_announce->count();

        $borrow_announce_user = $borrow_announce
            ->where('user_id', '=', auth()->id())
            ->count();

        // Agenda hari ini
        $agendas = Agenda::todayEvent();

        $title = 'Dashboard - Pagu';

        return view('Dashboard.index', compact('label', 'title', 'value', 'borrow_announce_admin', 'borrow_announce_user', 'agendas'));
    }

    public function profile()
    {
        $title = 'Profil';

        return view('Dashboard.profile', compact('title'));
    }

    public function help()
    {
        $title = 'Bantuan';

        return view('Dashboard.help', compact('title'));
    }

    public function contact()
    {
        $title = 'Kontak kami';

        return view('Dashboard.contact', compact('title'));
    }

    public function blank(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        Gdrive::put("folder1/$fileName", $file);
        return 'sukses';
    }

    public function storeMessage(Request $request, StoreMessageAction $action)
    {
        $message = $action->handle($request);

        if ($message->wasRecentlyCreated) :
            return back()->with('success', 'sukses');
        else :
            abort(500);
        endif;
    }
}
