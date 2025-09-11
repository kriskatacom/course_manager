@props([
    "href" => "route('home')",
    "icon" => "fa-save",
    "title" => null,
    "variant" => "primary",
])

<a href="{{ $href }}"
   title="{{ $title }}"
   {{ $attributes->merge(["class" => "block btn-{$variant}"]) }}>
    @if($icon)
        <i class="fa-solid {{ $icon }}"></i>
    @endif
    {{ $slot }}
</a>
