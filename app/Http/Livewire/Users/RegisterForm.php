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

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ];

    public function register()
    {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
            ],
        ], [
            'name.required' => 'Моля, въведете име.',
            'name.min' => 'Името трябва да е поне :min символа.',
            'name.max' => 'Името не може да е повече от :max символа.',
            'email.required' => 'Моля, въведете имейл.',
            'email.email' => 'Моля, въведете валиден имейл.',
            'email.unique' => 'Този имейл вече е регистриран.',
            'password.required' => 'Моля, въведете парола.',
            'password.confirmed' => 'Паролата не съвпада с потвърждението.',
            'password.min' => 'Паролата трябва да е поне :min символа.',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        auth()->login($user);

        session()->flash('success', 'Регистрацията е успешна!');

        return redirect()->route('users.login');
    }

    public function render()
    {
        return view('livewire.users.register-form');
    }
}