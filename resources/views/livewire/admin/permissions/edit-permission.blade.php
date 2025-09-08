<div class="px-5 mb-5 space-y-5">
    <form wire:submit.prevent="save" class="border border-gray-200 rounded shadow">
        <div class="space-y-5 p-5">
            <div>
                <label for="name" class="form-label">{{ __("messages.permission_name") }}</label>
                <input type="text" id="name" wire:model.defer="name" class="form-control" placeholder="{{ __("messages.enter_permission_name") }}">
                @error('name') 
                    <span class="text-red-600 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <div>
                <label for="label" class="form-label">{{ __("messages.permission_label") }}</label>
                <input type="text" id="label" wire:model.defer="label" class="form-control" placeholder="{{ __("messages.enter_permission_label") }}">
                @error('label') 
                    <span class="text-red-600 text-sm">{{ $message }}</span> 
                @enderror
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

            <div class="space-x-5">
                <button type="submit" class="btn-primary px-4 py-2">
                    {{ __("messages.save_changes") }}
                </button>
                <a href="{{ route("admin.permissions.index") }}" class="page-link">
                    {{ __("messages.back") }}
                </a>
            </div>
        </div>
    </form>
</div>
