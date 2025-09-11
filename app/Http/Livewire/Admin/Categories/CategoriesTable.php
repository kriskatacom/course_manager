<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesTable extends Component
{
    use WithPagination;

    protected $listeners = ["deleted" => "handleDeleted"];

    public $status = null;

    protected $queryString = [
        'status' => ['except' => null],
    ];

    public function handleDeleted()
    {
        session()->flash('success', 'Записът беше изтрит успешно!');
        $this->resetPage();

        $this->dispatchBrowserEvent('flash-message', [
            'message' => __("messages.category_move_trash"),
            'type' => 'success',
            'timeout' => 3000
        ]);
    }

    public function setStatusFilter($status)
    {
        $this->status = $status;
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

            $this->dispatchBrowserEvent('flash-message', [
                'message' => __("messages.category_restored"),
                'type' => 'success',
                'timeout' => 6000
            ]);
        }
    }

    public function deletePermanently($categoryId)
    {
        $category = Category::onlyTrashed()->find($categoryId);

        if ($category) {
            if ($category->children()->withTrashed()->exists()) {
                foreach ($category->children()->withTrashed()->get() as $child) {
                    $child->forceDelete();
                }
            }

            $category->forceDelete();

            $this->dispatchBrowserEvent('flash-message', [
                'message' => __("messages.category_deleted_successfully"),
                'type' => 'success',
                'timeout' => 3000
            ]);
        }
    }

    public function render()
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->with('childrenRecursive')
            ->when($this->status, function ($query) {
                if ($this->status === 'deleted') {
                    $query->onlyTrashed();
                } else {
                    $query->where('status', $this->status);
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $categoriesCount = Category::count();

        return view("livewire.admin.categories.categories-table", [
            "categories" => $categories,
            "categoriesCount" => $categoriesCount,
        ]);
    }
}
