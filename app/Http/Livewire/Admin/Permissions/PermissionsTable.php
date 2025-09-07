<?php

namespace App\Http\Livewire\Admin\Permissions;

use App\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;

class PermissionsTable extends Component
{
    use WithPagination;

    public $search = "";
    public $perPage = 10;

    protected $paginationTheme = "tailwind";

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Permission::orderBy('id', 'desc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%");
            });
        }

        $permissions = $query->paginate($this->perPage);

        return view('livewire.admin.permissions.permissions-table', [
            'permissions' => $permissions,
        ]);
    }
}
