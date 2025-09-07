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
            "email.required" => "Моля, въведете имейл.",
            "email.email" => "Моля, въведете валиден имейл.",
            "password.required" => "Моля, въведете парола.",
            "password.min" => "Паролата трябва да е поне :min символа.",
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
            $this->addError("email", "Невалиден имейл или парола.");
        }
    }

    public function render()
    {
        return view("livewire.users.login-form");
    }
}
