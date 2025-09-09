<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $usersCount = User::count();
        $categoriesCount = Category::count();
        
        return view("admin.dashboard", compact(
            "usersCount", "categoriesCount"));
    }
}
