<div
    x-data="{ show: false }"
    x-cloak
    x-on:flash-message.window="show = true; setTimeout(() => show = false, 3000)"
    x-show="show"
    class="{{ $type === 'success' 
        ? 'bg-green-100 border border-green-400 text-green-700' 
        : 'bg-red-100 border border-red-400 text-red-700' }} 
        px-4 py-3 rounded relative mx-5 mb-5"
    role="alert"
>
    {{ $message }}
</div>
