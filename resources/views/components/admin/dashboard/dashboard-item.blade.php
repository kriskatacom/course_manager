@props([
    "title" => "Title",
    "count" => 0,
    "icon" => "fa-solid fa-circle",
    "route" => "#",
])

@php
    $isActive = request()->url() === url($route);
    $classes = "flex justify-between items-center p-5 border border-gray-200 rounded shadow hover:text-white hover:bg-primary";
    $classes .= $isActive ? " text-white bg-primary" : "";
@endphp

<li>
    <a href="{{ $route }}" class="{{ $classes }}">
        <div class="flex flex-col text-2xl">
            <span>{{ $title }}</span>
            <div class="text-4xl font-extrabold mt-2">{{ $count }}</div>
        </div>
        <i class="{{ $icon }} text-4xl"></i>
    </a>
</li>