<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class RolesTable extends Component
{
    use WithPagination;

    public $search = "";
    public $perPage = 10;

    protected $paginationTheme = "tailwind";

    protected $listeners = ["deleted" => "handleDeleted"];

    public function handleDeleted()
    {
        session()->flash('success', 'Записът беше изтрит успешно!');
        $this->resetPage();
        $this->emit('flash', 'Записът беше изтрит успешно!', 'success');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Role::orderBy('id', 'desc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%");
            });
        }

        $roles = $query->paginate($this->perPage);

        return view('livewire.admin.roles.roles-table', [
            'roles' => $roles,
        ]);
    }
}
