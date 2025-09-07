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
}