<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Role;
use Auth;
use Hash;
use Livewire\Component;
use App\Models\User;

class EditUser extends Component
{
    public $user;
    public $roles;
    public $newEmail;
    public $currentPassword;
    public $newPassword;
    public $newPassword_confirmation;
    public $selectedRoles = [];

    protected $rules = [
        "user.name" => "required|string|max:255",
        "newEmail" => "required|email|unique:users,email",
        "currentPassword" => "nullable|string",
        "newPassword" => "required|string|min:8|confirmed",
        "passwordConfirmation" => "required_with:newPassword|same:newPassword",
    ];

    protected function messages()
    {
        return [
            "user.name.required" => __("messages.validation_name_required"),
            "user.name.max" => __("messages.validation_name_max"),
            "newEmail.required" => __("messages.validation_email_required"),
            "newEmail.email" => __("messages.validation_email_email"),
            "newEmail.unique" => __("messages.validation_email_unique"),
            "newPassword.required" => __("messages.validation_password_required"),
            "newPassword.min" => __("messages.validation_password_min"),
            "newPassword.confirmed" => __("messages.validation_password_confirmed"),
            "passwordConfirmation.required_with" => __("messages.validation_password_confirmation_required"),
            "passwordConfirmation.same" => __("messages.validation_password_same"),
        ];
    }

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
        $this->roles = Role::all();
        $this->selectedRoles = $this->user->roles->pluck('name')->toArray();
    }

    public function personalDataUpdate()
    {
        $this->validate([
            "user.name" => "required|string|max:255",
        ]);

        $this->user->save();

        session()->flash("success", __("messages.saved_changes"));
        return redirect()->route("admin.users.edit", $this->user->id);
    }

    public function updateEmail()
    {
        $this->validate([
            "newEmail" => "required|email|unique:users,email",
        ]);

        $this->user->email = $this->newEmail;
        $this->user->email_verified_at = null;
        $this->user->save();

        session()->flash("success", __("messages.saved_changes"));
        return redirect()->route("admin.users.edit", $this->user->id);
    }

    public function updatePassword()
    {
        $this->validate([
            'newPassword' => 'required|string|min:8|confirmed',
        ]);

        if (
            Auth::user()->id == $this->user->id &&
            !Auth::attempt(["email" => $this->user->email, "password" => $this->currentPassword])
        ) {
            $this->addError('currentPassword', __("messages.current_password_incorrect"));
            return;
        }

        $this->user->password = Hash::make($this->newPassword);
        $this->user->save();

        session()->flash("success", __("messages.saved_changes"));
        return redirect()->route("admin.users.edit", $this->user->id);
    }

    public function updateRoles()
    {
        $roleIds = Role::whereIn('name', $this->selectedRoles)->pluck('id')->toArray();

        $this->user->roles()->sync($roleIds);

        session()->flash('success', __('messages.saved_changes'));
        return redirect()->route('admin.users.edit', $this->user->id);
    }

    public function render()
    {
        return view("livewire.admin.users.edit-user");
    }
}
