<button type="{{ $type ?? 'button' }}"
        class="btn-primary w-full flex justify-center items-center space-x-2 {{ $class ?? '' }}"
        wire:loading.attr="disabled"
        {{ $attributes }}>
    
    <span wire:loading.remove class="flex items-center space-x-2">
        @if(isset($icon))
            <i class="{{ $icon }}"></i>
        @endif
        <span>{{ $slot }}</span>
    </span>

    <span wire:loading class="flex items-center justify-center">
        <i class="fas fa-spinner fa-spin"></i>
    </span>
</button>
