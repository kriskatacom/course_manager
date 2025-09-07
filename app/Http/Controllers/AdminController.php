<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $usersCount = User::count();
        
        return view("admin.dashboard", compact("usersCount"));
    }
}
