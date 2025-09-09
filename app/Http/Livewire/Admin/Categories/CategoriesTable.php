<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;

class CategoriesTable extends Component
{
    protected $listeners = ["deleted" => "handleDeleted"];
    public $statusFilter = null;


    public function handleDeleted()
    {
        session()->flash('success', 'Записът беше изтрит успешно!');
        $this->resetPage();
        $this->emit('flash', 'Записът беше изтрит успешно!', 'success');
    }

    public function setStatusFilter($status)
    {
        $this->statusFilter = $status;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::whereNull('parent_id')
            ->with('childrenRecursive')
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view("livewire.admin.categories.categories-table", [
            "categories" => $categories,
        ]);
    }
}
