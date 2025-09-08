<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;
    protected $paginationTheme = "tailwind";

    public $search = "";
    public $perPage = 10;
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
        $query = User::with("roles")
            ->orderBy("id", "desc");

        if ($this->search) {
            $query->where(function ($q) {
                $q->where("name", "like", "%{$this->search}%")
                    ->orWhere("email", "like", "%{$this->search}%");
            });
        }

        $users = $query->paginate($this->perPage);

        return view("livewire.admin.users.users-table", [
            "users" => $users,
        ]);
    }
}
