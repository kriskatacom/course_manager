<?php

namespace App\Http\Middleware;

use Closure;

class AddLocaleToRedirects
{
    public function handle($request, Closure $next)
    {
        app('url')->defaults(['locale' => app()->getLocale()]);

        return $next($request);
    }
}
