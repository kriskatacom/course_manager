<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = auth()->user();

        if (!$user || !$user->hasPermission($permission)) {
            return redirect()->route("home")->with("error", "Нямате достъп до тази страница.");
        }

        return $next($request);
    }
}