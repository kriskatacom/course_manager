<?php

namespace App\Http\Controllers;

use App\Models\Role;

class RoleController extends Controller
{
    public function all()
    {
        $rolesCount = Role::count();
        return view("admin.roles.index", compact("rolesCount"));
    }

    public function edit($locale, $id)
    {
        $role = null;

        if ($id != 0) {
            $role = Role::with("users")->find($id);

            if (!$role) {
                return redirect()->route("admin.roles.index")
                    ->with("error", __("messages.record_not_found"));
            }
        }

        return view("admin.roles.edit", compact("role"));
    }
}