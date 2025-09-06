<?php

namespace App\Http\Controllers;

use Auth;

class UserController extends Controller
{
    public function register()
    {
        return view("users.register");
    }

    public function login()
    {
        return view("users.login");
    }
    public function forgot()
    {
        return view("users.forgot");
    }

    public function profile()
    {
        return view("users.profile");
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('users.login');
    }
}
