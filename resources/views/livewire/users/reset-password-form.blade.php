<div class="max-w-md mx-auto p-6 bg-white rounded shadow">
    <x-alert-messages />

    <form wire:submit.prevent="resetPassword" class="space-y-4">
        <div>
            <label for="email" class="form-label">{{ __("messages.email") }}</label>
            <input type="email" id="email" wire:model.defer="email" class="form-control @error("email") border-red-500 @enderror" wire:loading.attr="disabled" wire:target="login">
            @error("email") <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="form-label">{{ __("messages.password") }}</label>
            <input type="password" id="password" wire:model.defer="password" class="form-control @error("password") border-red-500 @enderror" wire:loading.attr="disabled" wire:target="login">
            @error("password") <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="form-label">{{ __("messages.repeat_password") }}</label>
            <input type="password" id="password_confirmation" wire:model.defer="password_confirmation" class="form-control" required>
        </div>

        <input type="hidden" wire:model.defer="token" value="{{ request()->route('token') }}">

        <x-button-loading type="submit" icon="fas fa-sign-in-alt" target="resetPassword">
            {{ __('messages.save_changes') }}
        </x-button-loading>
    </form>
</div>
