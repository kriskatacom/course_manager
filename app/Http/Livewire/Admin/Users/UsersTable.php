<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
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
        $users = User::with("roles")
            ->where("name", "like", "%" . $this->search . "%")
            ->orWhere("email", "like", "%" . $this->search . "%")
            ->orderBy("id", "desc")
            ->paginate($this->perPage);

        return view("livewire.admin.users.users-table", [
            "users" => $users,
        ]);
    }
}
