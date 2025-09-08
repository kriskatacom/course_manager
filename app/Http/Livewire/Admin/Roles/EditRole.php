<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditRole extends Component
{
    public $role = null;
    public $name;
    public $label;
    public $selectedPermissions = [];
    public $permissions;

    public function messages()
    {
        return [
            'name.required' => __('messages.role_name_required'),
            'name.string' => __('messages.role_name_string'),
            'name.max' => __('messages.role_name_max'),
            'name.unique' => __('messages.role_name_unique'),
            'label.string' => __('messages.role_label_string'),
            'label.max' => __('messages.role_label_max'),
        ];
    }

    public function mount($roleId = null)
    {
        $this->permissions = Permission::all();
        $this->selectedPermissions = [];

        if ($roleId) {
            $this->role = Role::find($roleId);

            if (!$this->role) {
                session()->flash('error', __('messages.record_not_found'));
                return redirect()->route('admin.roles.index');
            }

            $this->name = $this->role->name;
            $this->label = $this->role->label;
            $this->selectedPermissions = $this->role->permissions->pluck('id')->toArray();
        }
    }

    public function save()
    {
        $this->validate([
            "name" => [
                "required",
                "string",
                "max:255",
                Rule::unique("roles", "name")->ignore($this->role?->id),
            ],
            "label" => "nullable|string|max:255",
        ]);

        if ($this->role) {
            $this->role->update([
                "name" => $this->name,
                "label" => $this->label,
            ]);
        } else {
            $this->role = Role::create([
                "name" => $this->name,
                "label" => $this->label,
            ]);
        }

        session()->flash("success", __("messages.saved_changes"));
        return redirect()->route("admin.roles.edit", $this->role->id);
    }

    public function savePermissions()
    {
        $this->role->permissions()->sync($this->selectedPermissions);

        session()->flash("success", __("messages.saved_changes"));
        return redirect()->route("admin.roles.edit", $this->role->id);
    }

    public function render()
    {
        return view("livewire.admin.roles.edit-role");
    }
}
