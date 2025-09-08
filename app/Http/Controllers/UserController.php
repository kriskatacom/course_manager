<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Str;

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

    public function forgotPassword()
    {
        return view("users.forgot-password");
    }

    public function resetPassword($locale, $token, $email)
    {
        $reset = DB::table("password_resets")
            ->where("email", $email)
            ->first();

        if (!$reset || !Hash::check($token, $reset->token) || Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {
            return redirect()->route("users.login")
                ->with("error", __("messages.invalid_token"));
        }

        return view("users.reset-password", [
            "token" => $token,
            "email" => $email,
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            "token" => "required",
            "email" => "required|email",
            "password" => "required|min:8|confirmed",
        ], [
            "email.required" => __("messages.enter_email"),
            "email.email" => __("messages.invalid_email"),
            "password.required" => __("messages.enter_new_password"),
            "password.min" => __("messages.password_min_length"),
            "password.confirmed" => __("messages.passwords_not_match"),
        ]);

        $status = Password::reset(
            $request->only("email", "password", "password_confirmation", "token"),
            function ($user, $password) {
                $user->forceFill([
                    "password" => Hash::make($password),
                    "remember_token" => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route("users.login")->with("success", __("messages.password_changed"))
            : back()->with("error", __("messages.password_change_failed"));
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

        return redirect()->route("users.login");
    }

    // admin methods
    public function all()
    {
        $usersCount = User::count();
        return view("admin.users.index", compact("usersCount"));
    }

    public function edit($locale, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route("admin.users.index")->with("error", __("messages.selected_role_incorrect"));
        }

        return view("admin.users.edit", compact("user"));
    }

    public function create()
    {
        return view("admin.users.create");
    }
}