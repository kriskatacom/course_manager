<div class="px-5 mb-5 space-y-5">
    <form wire:submit.prevent="save" class="border border-gray-200 rounded shadow">
        <div class="space-y-5 p-5">
            <div>
                <label for="name" class="form-label">{{ __("messages.role_key") }}</label>
                <input type="text" wire:model.defer="name" class="form-control" placeholder="{{ __("messages.enter_role_key") }}">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="label" class="form-label">{{ __("messages.role_label") }}</label>
                <input type="text" wire:model.defer="label" class="form-control" placeholder="{{ __("messages.enter_role_name") }}">
                @error('label') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="space-x-5">
                <button type="submit" class="btn-primary px-4 py-2">
                    {{ __("messages.save_changes") }}
                </button>
                <a href="{{ route("admin.roles.index") }}" class="page-link">{{ __("messages.back") }}</a>
            </div>
        </div>
    </form>
</div>