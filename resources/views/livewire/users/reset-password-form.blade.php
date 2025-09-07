<div class="max-w-md mx-auto p-6 bg-white rounded shadow">
    @if (session()->has("message"))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session("message") }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent="resetPassword" class="space-y-4">
        <div>
            <label for="email" class="form-label">Имейл</label>
            <input type="email" id="email" wire:model.defer="email" class="form-control @error("email") border-red-500 @enderror" wire:loading.attr="disabled" wire:target="login">
            @error("email") <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="form-label">Нова парола</label>
            <input type="password" id="password" wire:model.defer="password" class="form-control @error("password") border-red-500 @enderror" wire:loading.attr="disabled" wire:target="login">
            @error("password") <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="form-label">Повтори новата парола</label>
            <input type="password" id="password_confirmation" wire:model.defer="password_confirmation" class="form-control" required>
        </div>

        <input type="hidden" wire:model.defer="token" value="{{ request()->route('token') }}">

        <div class="flex justify-end">
            <button type="submit" class="btn-primary w-full flex justify-center items-center space-x-2"
                wire:loading.attr="disabled">
                <span wire:loading.remove class="flex items-center space-x-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Смяна на паролата</span>
                </span>
                <span wire:loading class="flex items-center justify-center">
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
            </button>
        </div>
    </form>
</div>
