<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Role;
use DB;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $selectedRoles = [];

    public $roles = [];

    protected function rules()
    {
        return [
            "name" => "required|string|min:3|max:100",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:6",
            "selectedRoles" => "required|array|min:1",
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => __('messages.validation_name_required'),
            'name.min' => __('messages.validation_name_min'),
            'name.max' => __('messages.validation_name_max'),
            'email.required' => __('messages.validation_email_required'),
            'email.email' => __('messages.validation_email_email'),
            'email.unique' => __('messages.validation_email_unique'),
            'password.required' => __('messages.validation_password_required'),
            'password.min' => __('messages.validation_password_min'),
            'selectedRoles.required' => __('messages.validation_roles_required'),
            'selectedRoles.array' => __('messages.validation_roles_array'),
            'selectedRoles.min' => __('messages.validation_roles_min'),
        ];
    }

    public function mount()
    {
        $this->roles = Role::all();
        $this->selectedRoles = [Role::where('name', 'user')->value('id')];
    }

    public function create()
    {
        $this->validate();

        $user = DB::transaction(function () {
            $user = User::create([
                "name" => $this->name,
                "email" => $this->email,
                "password" => Hash::make($this->password),
            ]);

            $user->roles()->sync($this->selectedRoles);
            return $user;
        });

        session()->flash("success", __("messages.user_created"));
        return redirect()->route('admin.users.edit', $user->id);
    }

    public function render()
    {
        return view("livewire.admin.users.create-user");
    }
}
