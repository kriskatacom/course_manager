<?php

namespace App\Http\Livewire\Users;

use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Throwable;

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

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash("message", "Изпратихме ви имейл с линк за смяна на паролата.");
        } else {
            session()->flash("error", "Не успяхме да изпратим линк. Опитайте отново.");
        }
    }

    public function render()
    {
        return view("livewire.users.forgot-password-form");
    }
}