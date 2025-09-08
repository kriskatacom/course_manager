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
    public $showDeleteModal = false;
    public $userToDelete;

    protected $paginationTheme = "tailwind";

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($userId)
    {
        $this->userToDelete = User::findOrFail($userId);
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->userToDelete = null;
        $this->showDeleteModal = false;
    }

    public function deleteUser()
    {
        if ($this->userToDelete) {
            $this->userToDelete->delete();
            session()->flash('success', __("messages.user_deleted"));
            $this->cancelDelete();
            $this->render();
        }
    }

    public function render()
    {
        $query = User::with('roles')
            ->orderBy('id', 'desc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            });
        }

        $users = $query->paginate($this->perPage);

        return view('livewire.admin.users.users-table', [
            'users' => $users,
        ]);
    }
}
