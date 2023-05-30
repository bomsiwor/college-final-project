<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Message;
use App\Models\Returning;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function manageUser()
    {
        $title = 'Kelola User';

        $previleges = Role::findByName('admin')->getAllPermissions();

        return view('Admin.manageUser', compact('title', 'previleges'));
    }

    public function manageMessage()
    {
        $title = 'Pesan & Kritik pengguna';
        $data = Message::all();

        return view('Admin.manageMessage', compact('title', 'data'));
    }

    public function returning()
    {
        $title = 'Admin - Peminjaman';

        return view('Admin.returning', compact('title'));
    }
}
