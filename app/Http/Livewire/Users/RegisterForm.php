<?php

namespace App\Http\Livewire\Users;

use App\Models\Role;
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
            "name.required" => __("messages.validation_name_required"),
            "name.min" => __("messages.validation_name_min"),
            "name.max" => __("messages.validation_name_max"),
            "email.required" => __("messages.validation_email_required"),
            "email.email" => __("messages.validation_email_email"),
            "email.unique" => __("messages.validation_email_unique"),
            "password.required" => __("messages.validation_password_required"),
            "password.confirmed" => __("messages.validation_password_confirmed"),
            "password.min" => __("messages.validation_password_min"),
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

        if (User::count() === 1) {
            $adminRole = Role::firstOrCreate(["name" => "admin"], ["label" => "Администратор"]);
            $user->roles()->attach($adminRole);
        }

        $userRole = Role::where("name", "user")->first();
        if ($userRole) {
            $user->roles()->attach($userRole);
        }

        auth()->login($user);

        session()->flash("success", __("messages.registration_success"));

        return redirect()->route("home");
    }

    public function render()
    {
        return view("livewire.users.register-form");
    }
}
