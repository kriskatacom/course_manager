<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function all()
    {
        return view("admin.categories.index");
    }

    public function edit($locale, $id)
    {
        $category = null;

        if ($id != 0) {
            $category = Category::find($id);

            if (!$category) {
                return redirect()->route("admin.categories.index")
                    ->with("error", __("messages.category_not_found"));
            }
        }

        return view("admin.categories.edit", compact("category"));
    }
}