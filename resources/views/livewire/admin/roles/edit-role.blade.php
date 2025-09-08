<div class="px-5 mb-5 space-y-5">
    <form wire:submit.prevent="save" class="border border-gray-200 rounded shadow">
        <div class="space-y-5 p-5">
            <div>
                <label for="name" class="form-label">{{ __("messages.role_key") }}</label>
                <input type="text" wire:model.defer="name" class="form-control"
                    placeholder="{{ __("messages.enter_role_key") }}">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="label" class="form-label">{{ __("messages.role_label") }}</label>
                <input type="text" wire:model.defer="label" class="form-control"
                    placeholder="{{ __("messages.enter_role_name") }}">
                @error('label') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="space-x-5 flex items-center">
                <x-button-loading type="submit" icon="fas fa-sign-in-alt" target="save">
                    {{ __('messages.save_changes') }}
                </x-button-loading>
                <a href="{{ route("admin.roles.index") }}" class="page-link">
                    {{ __("messages.back") }}
                </a>
            </div>
        </div>
    </form>
    @if (isset($role))
        <form wire:submit.prevent="savePermissions" class="border border-gray-200 rounded shadow">
            <h2 class="text-xl font-semibold mx-5 mt-5">{{ __("messages.permissions") }}</h2>
            <div class="space-y-5 p-5">
                <div class="roles-container flex-col">
                    @foreach($permissions as $permission)
                        <label class="role-checkbox">
                            <input type="checkbox" wire:model.defer="selectedPermissions" value="{{ $permission->id }}">
                            <span class="checkmark">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="role-text">{{ $permission->label }}</span>
                        </label>
                    @endforeach
                </div>

                @error('selectedPermissions')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

                <div class="space-x-5 flex items-center">
                    <x-button-loading type="submit" icon="fas fa-sign-in-alt" target="savePermissions">
                        {{ __('messages.save_changes') }}
                    </x-button-loading>
                    <a href="{{ route("admin.roles.index") }}" class="page-link">
                        {{ __("messages.back") }}
                    </a>
                </div>
            </div>
        </form>
    @endif
</div>
