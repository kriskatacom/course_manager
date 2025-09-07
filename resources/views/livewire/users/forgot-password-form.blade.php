<div class="max-w-md mx-auto p-6 bg-white border border-gray-200 shadow rounded-lg">
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-green-100 text-red-800 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('message'))
        <div class="bg-green-100 text-blue-800 p-3 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="sendResetLink" class="space-y-4">
        <div>
            <label for="email" class="form-label">Имейл</label>
            <input type="email" id="email" wire:model.defer="email" class="form-control @error('email') border-red-500 @enderror" wire:loading.attr="disabled" wire:target="login">
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
                class="btn-primary w-full flex justify-center items-center space-x-2"
                wire:loading.attr="disabled">
            <span wire:loading.remove class="flex items-center space-x-2">
                <i class="fas fa-sign-in-alt"></i>
                <span>Изпращане на линк</span>
            </span>
            <span wire:loading class="flex items-center justify-center">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
        </button>
    </form>
</div>
