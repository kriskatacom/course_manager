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

    protected function messages()
    {
        return [
            'email.required' => __('messages.validation_email_required'),
            'email.email' => __('messages.validation_email_email'),
            'email.exists' => __('messages.validation_email_exists'),
            'password.required' => __('messages.validation_password_required'),
            'password.min' => __('messages.validation_password_min'),
            'password.confirmed' => __('messages.validation_password_confirmed'),
            'token.required' => __('messages.validation_token_required'),
        ];
    }

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
            session()->flash('message', __('messages.password_reset_success'));
            return redirect()->route('users.login');
        } else {
            throw ValidationException::withMessages([
                'email' => [__('messages.password_reset_error')],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.users.reset-password-form');
    }
}
