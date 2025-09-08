<div class="px-5 mb-5 space-y-5">
    <form wire:submit.prevent="personalDataUpdate" class="border border-gray-200 rounded shadow">
        <h2 class="text-xl font-semibold border-b border-gray-200 p-5">{{ __("messages.personal_data") }}</h2>

        <div class="space-y-5 p-5">
            <div>
                <label for="name" class="form-label">{{ __("messages.name") }}</label>
                <input type="text" wire:model.defer="user.name" class="form-control"
                    placeholder="{{ __("messages.enter_name") }}">
                @error('user.name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="space-x-5 flex items-center">
                <x-button-loading type="submit" icon="fas fa-sign-in-alt" target="personalDataUpdate">
                    {{ __('messages.save_changes') }}
                </x-button-loading>
                <a href="{{ route("admin.users.index") }}" class="page-link">
                    {{ __("messages.back") }}
                </a>
            </div>
        </div>
    </form>
    <form wire:submit.prevent="updateEmail" class="border border-gray-200 rounded shadow">
        <h2 class="text-xl font-semibold border-b border-gray-200 p-5">{{ __("messages.change_email") }}</h2>

        <div class="space-y-5 p-5">
            <div>
                <label for="email" class="form-label">{{ __("messages.current_email") }}</label>
                <input type="email" value="{{ $user->email }}" disabled="true" class="form-control">
            </div>

            <div>
                <label for="newEmail" class="form-label">{{ __("messages.new_email") }}</label>
                <input type="email" wire:model.defer="newEmail" class="form-control">
                @error('newEmail') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="space-x-5 flex items-center">
                <x-button-loading type="submit" icon="fas fa-sign-in-alt" target="updateEmail">
                    {{ __('messages.save_changes') }}
                </x-button-loading>
                <a href="{{ route("admin.users.index") }}" class="page-link">
                    {{ __("messages.back") }}
                </a>
            </div>
        </div>
    </form>
    <form wire:submit.prevent="updatePassword" class="border border-gray-200 rounded shadow">
        <h2 class="text-xl font-semibold border-b border-gray-200 p-5">{{ __("messages.change_password") }}</h2>

        <div class="space-y-5 p-5">
            @if (Auth::user()->id == $user->id)
                <div>
                    <label for="currentPassword" class="form-label">{{ __("messages.current_password") }}</label>
                    <input type="password" wire:model.defer="currentPassword" class="form-control">
                    @error('currentPassword') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            @endif

            <div>
                <label for="newPassword" class="form-label">Нова парола</label>
                <input type="password" id="newPassword" wire:model.defer="newPassword" class="form-control">
                @error('newPassword') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="newPassword_confirmation" class="form-label">Потвърждаване на паролата</label>
                <input type="password" id="newPassword_confirmation" wire:model.defer="newPassword_confirmation"
                    class="form-control">
            </div>

            <div class="space-x-5 flex items-center">
                <x-button-loading type="submit" icon="fas fa-sign-in-alt" target="updatePassword">
                    {{ __('messages.save_changes') }}
                </x-button-loading>
                <a href="{{ route("admin.users.index") }}" class="page-link">
                    {{ __("messages.back") }}
                </a>
            </div>
        </div>
    </form>
    <form wire:submit.prevent="updateRoles" class="border border-gray-200 rounded shadow">
        <h2 class="text-xl font-semibold border-b border-gray-200 p-5">{{ __("messages.change_role") }}</h2>

        <div class="space-y-5 p-5">
            <div class="roles-container">
                @foreach($roles as $r)
                    <label class="role-checkbox">
                        <input type="checkbox" wire:model.defer="selectedRoles" value="{{ $r->name }}">
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

            <div class="space-x-5 flex items-center">
                <x-button-loading type="submit" icon="fas fa-sign-in-alt" target="updateRoles">
                    {{ __('messages.save_changes') }}
                </x-button-loading>
                <a href="{{ route("admin.users.index") }}" class="page-link">
                    {{ __("messages.back") }}
                </a>
            </div>
        </div>
    </form>
</div>