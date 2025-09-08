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

    public function messages()
    {
        return [
            "email.required" => __("messages.validation_email_required"),
            "email.email" => __("messages.validation_email_email"),
            "email.exists" => __("messages.validation_email_exists"),
        ];
    }

    public function sendResetLink()
    {
        $this->validate();

        $user = \App\Models\User::where('email', $this->email)->first();

        if (!$user) {
            session()->flash("error", __("messages.validation_email_exists"));
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

        session()->flash("message", __("messages.reset_link_sent"));
    }

    public function render()
    {
        return view("livewire.users.forgot-password-form");
    }
}
