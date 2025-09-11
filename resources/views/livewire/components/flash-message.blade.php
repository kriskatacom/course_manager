<div 
    x-data="{ messages: [] }"
    x-cloak
    x-on:flash-message.window="event => {
        let timeout = event.detail.timeout || 3000;
        let id = Date.now() + Math.random();

        messages.push({
            id: id,
            type: event.detail.type || 'success',
            message: event.detail.message,  // взимаме съобщението тук
            timeout: timeout
        });

        setTimeout(() => {
            messages = messages.filter(m => m.id !== id);
        }, timeout);
    }"
    class="fixed bottom-5 right-5 z-50 flex flex-col gap-3"
>
    <template x-for="msg in messages" :key="msg.id">
        <div
            x-transition.opacity.duration.300ms
            class="flex items-center gap-3 px-6 py-4 rounded-2xl shadow-xl text-lg font-medium max-w-md w-full"
            :class="msg.type === 'success' 
                ? 'bg-green-50 text-green-800 border border-green-300' 
                : 'bg-red-50 text-red-800 border border-red-300'"
            role="alert"
        >
            <i :class="msg.type === 'success' 
                ? 'fas fa-check-circle text-green-600 text-2xl' 
                : 'fas fa-times-circle text-red-600 text-2xl'"></i>
            <span x-text="msg.message"></span>
        </div>
    </template>
</div>
