<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function manageUser()
    {
        $title = 'Kelola User';

        return view('Admin.manageUser', compact('title'));
    }
}
