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

    public function resetPassword(Request $request, $token)
    {
        $email = $request->email;

        $reset = DB::table("password_resets")
            ->where("email", $email)
            ->first();

        if (!$reset || !Hash::check($token, $reset->token) || Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {
            return redirect("users.login")->with("error", "Този линк вече е невалиден. Моля, поискайте нов.");
        }

        return view("users.reset-password", [
            "token" => $token,
            "email" => $email,
            "title" => "Смяна на паролата"
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            "token" => "required",
            "email" => "required|email",
            "password" => "required|min:8|confirmed",
        ], [
            "email.required" => "Моля, въведете имейл адрес.",
            "email.email" => "Въведеният имейл е невалиден.",
            "password.required" => "Моля, въведете нова парола.",
            "password.min" => "Паролата трябва да съдържа поне 8 символа.",
            "password.confirmed" => "Паролите не съвпадат.",
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
            ? redirect()->route("users.login")->with("success", "Паролата беше сменена успешно. Моля, влезте с новата парола.")
            : back()->with("error", "Възникна проблем при смяната на паролата. Опитайте отново.");
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

    public function all()
    {
        $users = User::with("roles")->paginate(10);
        $usersCount = User::count();
        
        return view("admin.users.index", compact("users", "usersCount"));
    }
}
