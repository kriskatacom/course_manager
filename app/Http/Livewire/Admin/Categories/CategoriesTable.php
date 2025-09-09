<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesTable extends Component
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
        $categories = Category::whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('created_at', 'desc')
            ->get();

        return view("livewire.admin.categories.categories-table", [
            "categories" => $categories,
        ]);
    }
}