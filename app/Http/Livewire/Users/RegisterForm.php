<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class RegisterForm extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            "name" => ["required", "string", "min:3", "max:50"],
            "email" => ["required", "email", "max:255", "unique:users,email"],
            "password" => ["required", "string", "confirmed", Password::min(8)],
        ];
    }

    protected function messages()
    {
        return [
            "name.required" => "Моля, въведете име.",
            "name.min" => "Името трябва да е поне :min символа.",
            "name.max" => "Името не може да е повече от :max символа.",
            "email.required" => "Моля, въведете имейл.",
            "email.email" => "Моля, въведете валиден имейл.",
            "email.unique" => "Този имейл вече е регистриран.",
            "password.required" => "Моля, въведете парола.",
            "password.confirmed" => "Паролата не съвпада с потвърждението.",
            "password.min" => "Паролата трябва да е поне :min символа.",
        ];
    }

    public function register()
    {
        $validatedData = $this->validate();

        $user = User::create([
            "name" => $validatedData["name"],
            "email" => $validatedData["email"],
            "password" => Hash::make($validatedData["password"]),
        ]);

        auth()->login($user);

        session()->flash("success", "Регистрацията е успешна!");

        return redirect()->route("home");
    }

    public function render()
    {
        return view("livewire.users.register-form");
    }
}