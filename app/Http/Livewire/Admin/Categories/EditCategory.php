<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Str;

class EditCategory extends Component
{
    public $categories;
    public $category;
    public $name;

    public function messages()
    {
        return [
            'name.required' => __('messages.category_name_required'),
            'name.string' => __('messages.category_name_string'),
            'name.max' => __('messages.category_name_max'),
            'name.unique' => __('messages.category_name_unique'),
        ];
    }

    public function mount($categoryId = null)
    {
        $this->categories = Category::all();

        if ($categoryId) {
            $this->category = Category::find($categoryId);
        }
    }

    public function save()
    {
        $this->validate([
            "name" => [
                "required",
                "string",
                "max:255",
                Rule::unique("categories", "name")->ignore($this->category?->id),
            ],
        ]);

        $slug = Str::slug($this->name);

        $originalSlug = $slug;
        $counter = 1;

        while (
            Category::where("slug", $slug)
                ->when($this->category, fn($q) => $q->where("id", "!=", $this->category->id))
                ->exists()
        ) {
            $slug = $originalSlug . "-" . $counter++;
        }

        if ($this->category) {
            $this->category->update([
                "name" => $this->name,
                "slug" => $slug,
            ]);
        } else {
            $this->category = Category::create([
                "name" => $this->name,
                "slug" => $slug,
            ]);
        }

        session()->flash("success", __("messages.saved_changes"));

        return redirect()->route("admin.categories.edit", $this->category->id);
    }

    public function render()
    {
        return view("livewire.admin.categories.edit-category");
    }
}