<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Borrow;
use App\Models\Message;
use App\Models\Returning;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;

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

    public function resetPassword(Request $request)
    {
        $user = User::find($request->id);

        $realPassword = strtolower(Str::random(6));
        $password = Hash::make($realPassword);
        Mail::to($user->email)->send(new ResetPassword($realPassword));
        $user->password = $password;
        $user->save();

        return to_route('admin.manageUser')->with('success', "Sukses mengirikan email reset kata sandi ke $user->email!");
    }
}
