<?php

namespace App\Http\Livewire\Admin\Permissions;

use App\Models\Role;
use Livewire\Component;
use App\Models\Permission;

class EditPermission extends Component
{
    public $roles;
    public $selectedRoles = [];
    public Permission $permission;
    public $permissionId;
    public $name;
    public $label;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:permissions,name,' . $this->permissionId,
            "label" => "required|string|max:255",
        ];
    }

    protected function messages()
    {
        return [
            "name.required" => __("messages.validation_permission_required"),
            "name.unique" => __("messages.validation_permission_unique"),
            "label.required" => __("messages.validation_permission_label"),
        ];
    }

    public function mount($permissionId = null)
    {
        $this->permissionId = $permissionId;
        $this->roles = Role::all();

        if ($permissionId) {
            $this->permission = Permission::with('roles')->findOrFail($permissionId);
            $this->name = $this->permission->name;
            $this->label = $this->permission->label;
            $this->selectedRoles = $this->permission->roles->pluck('id')->toArray();
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $this->permissionId,
            'label' => 'required|string|max:255',
            'selectedRoles' => 'required|array|min:1',
        ]);

        if ($this->permissionId) {
            $permission = Permission::findOrFail($this->permissionId);
            $permission->update([
                'name' => $this->name,
                'label' => $this->label,
            ]);
            session()->flash('success', __("messages.permission_updated"));
        } else {
            $permission = Permission::create([
                'name' => $this->name,
                'label' => $this->label,
            ]);
            session()->flash('success', __("messages.permission_created"));
        }

        $permission->roles()->sync($this->selectedRoles);

        return redirect()->route('admin.permissions.index');
    }

    public function render()
    {
        return view("livewire.admin.permissions.edit-permission");
    }
}