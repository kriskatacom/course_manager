@props([
    'type' => 'button',
    'icon' => null,
    'target' => null,
])

<button type="{{ $type }}"
        {{ $attributes->merge(['class' => 'btn-primary flex justify-center items-center space-x-2']) }}
        wire:loading.attr="disabled"
        @if($target) wire:target="{{ $target }}" @endif>

    <span class="flex items-center space-x-2"
          wire:loading.remove
          @if($target) wire:target="{{ $target }}" @endif>
        @if($icon)
            <i class="{{ $icon }}"></i>
        @endif
        <span>{{ $slot }}</span>
    </span>

    <span class="flex items-center justify-center" wire:loading @if($target) wire:target="{{ $target }}" @endif>
        <i class="fas fa-spinner fa-spin"></i>
        <span>{{ $slot }}</span>
    </span>
</button>
