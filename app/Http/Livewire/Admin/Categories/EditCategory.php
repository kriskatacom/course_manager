<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Str;

class EditCategory extends Component
{
    public $categories;
    public $category;
    public $name;
    public $description;
    public $parent_id = null;
    public $status = "draft";

    public function messages()
    {
        return [
            'name.required' => __('messages.category_name_required'),
            'name.string' => __('messages.category_name_string'),
            'name.max' => __('messages.category_name_max'),
            'name.unique' => __('messages.category_name_unique'),
            'description.max' => __('messages.category_description_max'),
            'status.required' => __('messages.category_status_required'),
        ];
    }

    public function mount($categoryId = null)
    {
        $this->categories = Category::all();

        if ($categoryId) {
            $this->category = Category::find($categoryId);
            $this->name = $this->category->name;
            $this->parent_id = $this->category->parent_id;
            $this->description = $this->category->description;
            $this->status = $this->category->status;
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
            "parent_id" => ["nullable", "exists:categories,id"],
            "description" => ["nullable", "max:255"],
            'status' => ['required', Rule::in(Category::STATUSES)],
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

        $this->parent_id = $this->parent_id ?: null;

        if ($this->category) {
            $this->category->update([
                "name" => $this->name,
                "slug" => $slug,
                "parent_id" => $this->parent_id,
                "description"=> $this->description,
                "status"=> $this->status,
            ]);
        } else {
            $this->category = Category::create([
                "name" => $this->name,
                "slug" => $slug,
                "parent_id" => $this->parent_id,
                "description"=> $this->description,
                "status"=> $this->status,
            ]);
        }

        session()->flash("success", __("messages.saved_changes"));

        return redirect()->route("admin.categories.edit", $this->category->id);
    }

    public function getCategoryOptions($categories = null, $prefix = '', $excludeId = null)
    {
        $categories = $categories ?? Category::whereNull('parent_id')->orderBy('name')->get();
        $options = [];

        foreach ($categories as $category) {
            if ($excludeId && $category->id == $excludeId) {
                continue;
            }

            $options[] = [
                'id' => $category->id,
                'name' => $prefix . $category->name,
            ];

            if ($category->childrenRecursive->count()) {
                $options = array_merge(
                    $options,
                    $this->getCategoryOptions($category->childrenRecursive, $prefix . '- ', $excludeId)
                );
            }
        }

        return $options;
    }
}
