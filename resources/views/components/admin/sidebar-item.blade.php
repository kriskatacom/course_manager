@props([
    "route",
    "icon",
    "text",
    "active" => ""
])

<li>
    <a href="{{ route($route) }}"
       class="py-3 px-6 border-b border-gray-200 hover:text-white hover:bg-primary flex items-center gap-3
              {{ request()->routeIs($active) ? "text-white bg-primary" : "text-gray-700" }}">
        <i class="{{ $icon }} text-2xl"></i>
        {{ __($text) }}
    </a>
</li>
