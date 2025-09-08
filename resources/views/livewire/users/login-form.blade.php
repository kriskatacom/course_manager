<div class="max-w-md mx-auto p-6 bg-white border border-gray-200 shadow rounded-lg">
    <x-alert-messages />

    <form wire:submit.prevent="login" class="space-y-4">
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

        <div class="space-y-1">
            <a href="{{ route("users.register") }}" class="page-link flex items-center space-x-2" title="{{ __("messages.register") }}">
                <i class="fas fa-user-plus"></i>
                <span>{{ __("messages.register") }}</span>
            </a>
            <a href="{{ route("password.request") }}" class="page-link flex items-center space-x-2" title="{{ __("messages.forgot_password") }}">
                <i class="fas fa-unlock-alt"></i>
                <span>{{ __("messages.forgot_password") }}</span>
            </a>
        </div>

        <button type="submit"
                class="btn-primary w-full flex justify-center items-center space-x-2"
                wire:loading.attr="disabled">
            <span wire:loading.remove class="flex items-center space-x-2">
                <i class="fas fa-sign-in-alt"></i>
                <span>{{ __("messages.login") }}</span>
            </span>
            <span wire:loading class="flex items-center justify-center">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
        </button>
    </form>
</div>