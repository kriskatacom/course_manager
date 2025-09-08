<div x-data="{ open: @entangle('open') }" x-cloak>
    {{-- Модал --}}
    <div 
        x-show="open" 
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

        <div class="bg-white rounded shadow-lg w-1/3">
            <h2 class="p-5 text-xl font-semibold pb-5 border-b border-gray-200">
                Потвърждение за изтриване
            </h2>

            <p class="p-5">
                Сигурни ли сте, че искате да изтриете този запис?
            </p>

            <div class="p-5 border-t border-gray-200 flex justify-end space-x-5">
                <button 
                    @click="open = false" 
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                    Откажи
                </button>

                <x-button-loading icon="fas fa-sign-in-alt" class="btn-danger" wire:click="delete">
                    {{ __('messages.delete') }}
                </x-button-loading>
            </div>
        </div>
    </div>
</div>
