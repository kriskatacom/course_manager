<?php

namespace App\Http\Controllers;

use App\Models\Permission;

class PermissionController extends Controller
{
    public function all()
    {
        $permissionsCount = Permission::count();
        return view("admin.permissions.index", compact("permissionsCount"));
    }

    public function edit($locale, $id)
    {
        $permission = null;

        if ($id != 0) {
            $permission = Permission::with("roles")->find($id);

            if (!$permission) {
                return redirect()->route("admin.permissions.index")
                    ->with("error", __("messages.selected_permission_incorrect"));
            }
        }

        return view("admin.permissions.edit", compact("permission"));
    }
}