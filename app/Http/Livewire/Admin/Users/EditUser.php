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
    public $role;

    protected $rules = [
        "user.name" => "required|string|max:255",
        "newEmail" => "required|email|unique:users,email",
        "currentPassword" => "nullable|string",
        "newPassword" => "required|string|min:8|confirmed",
        "passwordConfirmation" => "required_with:newPassword|same:newPassword",
    ];

    protected $messages = [
        "user.name.required" => "Името е задължително.",
        "user.name.max" => "Името не може да надвишава :max символа.",
        "newEmail.required" => "Имейлът е задължителен.",
        "newEmail.email" => "Въведете валиден имейл адрес.",
        "newEmail.unique" => "Този имейл вече съществува.",
        "newPassword.required" => "Паролата е задължителна.",
        "newPassword.min" => "Паролата трябва да съдържа поне :min символа.",
        "newPassword.confirmed" => "Паролите не съвпадат.",
        "passwordConfirmation.required_with" => "Потвърждението на паролата е задължително.",
        "passwordConfirmation.same" => "Паролите не съвпадат.",
    ];

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
        $this->roles = Role::all();
        $this->role = $this->user->roles->first()?->name ?? null;
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

    public function updateRole()
    {
        if (empty($this->role)) {
            $this->user->roles()->sync([]);
            session()->flash('success', __('messages.saved_changes'));
            return redirect()->route("admin.users.edit", $this->user->id);
        }

        $role = Role::where('name', $this->role)->first();

        if (!$role) {
            $this->addError('role', __("messages.selected_role_incorrect"));
            return;
        }

        $this->user->roles()->sync([$role->id]);

        session()->flash('success', __('messages.saved_changes'));
        return redirect()->route("admin.users.edit", $this->user->id);
    }

    public function render()
    {
        return view("livewire.admin.users.edit-user");
    }
}
