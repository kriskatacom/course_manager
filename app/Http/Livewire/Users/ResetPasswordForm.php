<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ResetPasswordForm extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string|min:8|confirmed',
        'token' => 'required|string',
    ];

    public function resetPassword()
    {
        $validatedData = $this->validate();

        $status = Password::reset(
            $validatedData,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('message', 'Паролата беше сменена успешно.');
            return redirect()->route('users.login');
        } else {
            throw ValidationException::withMessages([
                'email' => ['Невалиден токен или имейл. Опитайте отново.'],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.users.reset-password-form');
    }
}