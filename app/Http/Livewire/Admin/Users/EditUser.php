<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditUser extends Component
{
    public $userId;
    public $user;

    public $name;
    public $emailNew;
    public $emailCurrent;
    public $current_password;
    public $password_confirmation;
    public $new_password;
    public $successMessage = "asd";

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->user = User::findOrFail($userId);

        $this->name = $this->user->name;
        $this->emailCurrent = $this->user->email;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->user->update(['name' => $this->name]);

        session()->flash('success', __('messages.saved_changes'));
        session()->flash('success_type', 'profile'); // отделяме типа
        return redirect()->route('admin.users.edit', $this->userId);
    }

    public function updateEmail()
    {
        $this->validate([
            'emailNew' => 'required|email|unique:users,email,' . $this->user->id,
        ]);

        $this->user->update(['email' => $this->emailNew]);
        $this->emailCurrent = $this->user->email;

        session()->flash('success', __('messages.saved_changes'));
        session()->flash('success_type', 'email'); // отделяме типа
        return redirect()->route('admin.users.edit', $this->userId);
    }

    public function updatePassword()
    {
        $rules = [
            'new_password' => 'required|string|min:8|confirmed',
        ];

        if (auth()->id() === $this->user->id) {
            $rules['current_password'] = 'required|string';
        }

        $this->validate($rules);

        if (auth()->id() === $this->user->id) {
            if (!Hash::check($this->current_password, $this->user->password)) {
                $this->addError('current_password', __('messages.current_password_incorrect'));
                return;
            }
        }

        $this->user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->current_password = $this->new_password = $this->password_confirmation = '';

        session()->flash('success', __('messages.password_updated_successfully'));
        session()->flash('success_type', 'password'); // отделяме типа
        return redirect()->route('admin.users.edit', $this->userId);
    }

    public function render()
    {
        return view('livewire.admin.users.edit-user');
    }
}
