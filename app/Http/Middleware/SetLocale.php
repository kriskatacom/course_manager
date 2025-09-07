<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->route('locale');

        if (!in_array($locale, ['bg', 'en'])) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}