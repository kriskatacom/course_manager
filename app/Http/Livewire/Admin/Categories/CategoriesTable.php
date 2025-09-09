<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesTable extends Component
{
    use WithPagination;
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

    public function restore($categoryId)
    {
        $category = Category::onlyTrashed()->find($categoryId);

        if ($category) {
            $category->restore();
            $category->status = 'archived';
            $category->saveQuietly();

            $this->emit('flash', __("messages.category_restored"), 'success');
        }
    }

    public function render()
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->with('childrenRecursive')
            ->when($this->statusFilter, function ($query) {
                if ($this->statusFilter === 'deleted') {
                    $query->onlyTrashed();
                } else {
                    $query->where('status', $this->statusFilter);
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view("livewire.admin.categories.categories-table", [
            "categories" => $categories,
        ]);
    }
}