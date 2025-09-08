<div class="px-5 mb-5 space-y-5">
    <form wire:submit.prevent="create" class="border border-gray-200 rounded shadow">
        <div class="space-y-5 p-5">
            <div>
                <label for="name" class="form-label">{{ __("messages.name") }}</label>
                <input type="text" wire:model.defer="name" class="form-control" placeholder="{{ __("messages.enter_name") }}">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="form-label">{{ __("messages.email") }}</label>
                <input type="email" wire:model.defer="email" class="form-control" placeholder="{{ __("messages.enter_email") }}">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password" class="form-label">{{ __("messages.password") }}</label>
                <input type="password" wire:model.defer="password" class="form-control" placeholder="{{ __("messages.enter_password") }}">
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="roles-container">
                @foreach($roles as $r)
                    <label class="role-checkbox">
                        <input type="checkbox" wire:model.defer="selectedRoles" value="{{ $r->id }}">
                        <span class="checkmark">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="role-text">{{ $r->label }}</span>
                    </label>
                @endforeach
            </div>

            @error('selectedRoles')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror

            <x-button-loading type="submit" icon="fas fa-sign-in-alt" class="my-2">
                {{ __('messages.save_changes') }}
            </x-button-loading>
        </div>
    </form>
</div>
