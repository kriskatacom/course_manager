<!-- Лични данни -->
<div class="m-5 bg-white border border-gray-200 shadow rounded-lg">
    <h2 class="text-xl font-semibold p-5 border-b border-gray-200">Лични данни</h2>

    <form wire:submit.prevent="updateProfile" class="space-y-4 p-5">
        @if(session()->has('success') && session('success_type') === 'profile')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-2">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <label for="name" class="form-label">Име</label>
            <input type="text" id="name" wire:model.defer="name"
                   class="form-control @error('name') border-red-500 @enderror"
                   wire:loading.attr="disabled" wire:target="updateProfile">
            @error('name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-primary flex justify-center items-center space-x-2"
                wire:loading.attr="disabled" wire:target="updateProfile">
            <span wire:loading.remove wire:target="updateProfile" class="flex items-center space-x-2">
                <i class="fas fa-save"></i>
                <span>{{ __("messages.save_changes") }}</span>
            </span>
            <span wire:loading wire:target="updateProfile" class="flex items-center justify-center">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
        </button>
    </form>
</div>

<!-- Промяна на имейл -->
<div class="m-5 bg-white border border-gray-200 shadow rounded-lg">
    <h2 class="text-xl font-semibold p-5 border-b border-gray-200">Промяна на имейл</h2>

    <form wire:submit.prevent="updateEmail" class="space-y-4 p-5">
        @if(session()->has('success') && session('success_type') === 'email')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-2">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <label for="email_current" class="form-label">Текущ имейл</label>
            <input type="text" id="email_current" value="{{ $emailCurrent }}" class="form-control" disabled>
        </div>

        <div>
            <label for="email_new" class="form-label">Нов имейл</label>
            <input type="email" id="email_new" wire:model.defer="emailNew"
                   class="form-control @error('emailNew') border-red-500 @enderror"
                   wire:loading.attr="disabled" wire:target="updateEmail">
            @error('emailNew')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-primary flex justify-center items-center space-x-2"
                wire:loading.attr="disabled" wire:target="updateEmail">
            <span wire:loading.remove wire:target="updateEmail" class="flex items-center space-x-2">
                <i class="fas fa-sign-in-alt"></i>
                <span>{{ __("messages.save_changes") }}</span>
            </span>
            <span wire:loading wire:target="updateEmail" class="flex items-center justify-center">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
        </button>
    </form>
</div>

<!-- Промяна на парола -->
<div class="m-5 bg-white border border-gray-200 shadow rounded-lg">
    <h2 class="text-xl font-semibold p-5 border-b border-gray-200">Промяна на паролата</h2>

    <form wire:submit.prevent="updatePassword" class="space-y-4 p-5">
        @if(session()->has('success') && session('success_type') === 'password')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-2">
                {{ session('success') }}
            </div>
        @endif

        @if(auth()->id() == $user->id)
        <div>
            <label for="current_password" class="form-label">Текуща парола</label>
            <input type="password" id="current_password" wire:model.defer="current_password"
                   class="form-control @error('current_password') border-red-500 @enderror"
                   wire:loading.attr="disabled" wire:target="updatePassword">
            @error('current_password')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        @endif

        <div>
            <label for="new_password" class="form-label">Нова парола</label>
            <input type="password" id="new_password" wire:model.defer="new_password"
                   class="form-control @error('new_password') border-red-500 @enderror"
                   wire:loading.attr="disabled" wire:target="updatePassword">
            @error('new_password')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="form-label">Потвърждаване на новата парола</label>
            <input type="password" id="password_confirmation" wire:model.defer="password_confirmation"
                   class="form-control @error('password_confirmation') border-red-500 @enderror"
                   wire:loading.attr="disabled" wire:target="updatePassword">
            @error('password_confirmation')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-primary flex justify-center items-center space-x-2"
                wire:loading.attr="disabled" wire:target="updatePassword">
            <span wire:loading.remove wire:target="updatePassword" class="flex items-center space-x-2">
                <i class="fas fa-save"></i>
                <span>{{ __("messages.save_changes") }}</span>
            </span>
            <span wire:loading wire:target="updatePassword" class="flex items-center justify-center">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
        </button>
    </form>
</div>
