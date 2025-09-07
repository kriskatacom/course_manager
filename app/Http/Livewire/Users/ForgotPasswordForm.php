<?php

namespace App\Http\Livewire\Users;

use DB;
use Hash;
use Livewire\Component;
use App\Notifications\ResetPasswordCustom;
use Str;

class ForgotPasswordForm extends Component
{
    public $email;

    protected $rules = [
        "email" => "required|email|max:255|exists:users,email",
    ];

    protected $messages = [
        "email.required" => "Моля, въведете имейл.",
        "email.email" => "Моля, въведете валиден имейл.",
        "email.exists" => "Не откриваме потребител с такъв имейл.",
    ];

    public function sendResetLink()
    {
        $this->validate();

        $user = \App\Models\User::where('email', $this->email)->first();

        if (!$user) {
            session()->flash("error", "Не откриваме потребител с такъв имейл.");
            return;
        }

        // Генериране на токен
        $token = Str::random(64);

        // Запис в базата
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $user->email,
            'locale' => app()->getLocale()
        ], false));

        $user->notify(new ResetPasswordCustom($url));

        session()->flash("message", "Изпратихме ви имейл с линк за смяна на паролата.");
    }

    public function render()
    {
        return view("livewire.users.forgot-password-form");
    }
}
