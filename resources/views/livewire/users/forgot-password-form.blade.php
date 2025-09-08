<div class="max-w-md mx-auto p-6 bg-white border border-gray-200 shadow rounded-lg">
    <x-alert-messages />

    <form wire:submit.prevent="sendResetLink" class="space-y-4">
        <div>
            <label for="email" class="form-label">{{ __("messages.email") }}</label>
            <input type="email" id="email" wire:model.defer="email" class="form-control @error('email') border-red-500 @enderror" wire:loading.attr="disabled" wire:target="login">
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <x-button-loading type="submit" icon="fas fa-sign-in-alt" class="my-2">
            {{ __('messages.send_link') }}
        </x-button-loading>
    </form>
</div>
