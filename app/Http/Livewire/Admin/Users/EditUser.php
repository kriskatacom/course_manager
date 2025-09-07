<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;

class EditUser extends Component
{
    public $user;

    protected $rules = [
        "user.name" => "required|string|max:255",
    ];

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
    }

    public function personalDataUpdate()
    {
        $this->validate();

        $this->user->save();

        session()->flash("success", __("messages.saved_changes"));
        return redirect()->route("admin.users.edit", $this->user->id);
    }

    public function render()
    {
        return view("livewire.admin.users.edit-user");
    }
}
