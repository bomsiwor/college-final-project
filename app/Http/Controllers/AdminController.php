<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Message;
use App\Models\Returning;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function manageUser()
    {
        $title = 'Kelola User';

        return view('Admin.manageUser', compact('title'));
    }

    public function manageMessage()
    {
        $title = 'Pesan & Kritik pengguna';
        $data = Message::all();

        return view('Admin.manageMessage', compact('title', 'data'));
    }

    public function manageBorrow()
    {
        $title = 'Admin - Peminjaman';
        $data = Borrow::forAdmin();
        $returnings = Returning::select('id', 'borrow_id', 'verificator_id', 'returning_date', 'condition', 'created_at')
            ->with('verificator:id,name')
            ->orderBy('created_at')->get();

        return view('Admin.showBorrow', compact('data', 'title', 'returnings'));
    }
}
