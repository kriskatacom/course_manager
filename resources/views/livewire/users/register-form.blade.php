<div class="max-w-md mx-auto p-6 bg-white border border-gray-200 shadow rounded-lg">
    <x-alert-messages />

    <form wire:submit.prevent="register" class="space-y-4">
        <div>
            <label for="name" class="form-label">Име</label>
            <input type="text" id="name" wire:model.defer="name" class="form-control @error('name') border-red-500 @enderror" wire:loading.attr="disabled" wire:target="register">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="form-label">Имейл</label>
            <input type="email" id="email" wire:model.defer="email" class="form-control @error('email') border-red-500 @enderror" wire:loading.attr="disabled" wire:target="register">
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="form-label">Парола</label>
            <input type="password" id="password" wire:model.defer="password" class="form-control @error('password') border-red-500 @enderror" wire:loading.attr="disabled" wire:target="register">
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="form-label">Повтори паролата</label>
            <input type="password" id="password_confirmation" wire:model.defer="password_confirmation" wire:loading.attr="disabled" wire:target="register" class="form-control">
        </div>

        <div class="space-y-1">
            <a href="{{ route('users.login') }}" class="page-link flex items-center space-x-2"
                title="Влизане в профила">
                <i class="fas fa-sign-in-alt"></i>
                <span>Влизане в профила</span>
            </a>
        </div>

        <button type="submit" class="btn-primary w-full flex justify-center items-center space-x-2" wire:loading.attr="disabled">
            <span wire:loading.remove>
                <i class="fas fa-user-plus"></i>
                <span>Създаване</span>
            </span>
            <span wire:loading class="flex items-center justify-center">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
        </button>
    </form>
</div>