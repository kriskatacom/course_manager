<?php

namespace App\Http\Livewire\Users;

use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginForm extends Component
{
    public $email;
    public $password;

    protected function rules()
    {
        return [
            "email" => ["required", "email", "max:255"],
            "password" => ["required", "string", Password::min(8)],
        ];
    }

    protected function messages()
    {
        return [
            "email.required" => __("messages.validation_email_required"),
            "email.email" => __("messages.validation_email_email"),
            "password.required" => __("messages.validation_password_required"),
            "password.min" => __("messages.validation_password_min"),
        ];
    }

    public function login()
    {
        $validatedData = $this->validate();

        if (
            Auth::attempt([
                "email" => $validatedData["email"],
                "password" => $validatedData["password"],
            ])
        ) {
            session()->regenerate();
            return redirect()->route("home");
        } else {
            $this->addError("email", __("messages.invalid_email_or_password"));
        }
    }

    public function render()
    {
        return view("livewire.users.login-form");
    }
}
