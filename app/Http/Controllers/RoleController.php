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
}