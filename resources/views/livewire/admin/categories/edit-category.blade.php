<div class="px-5 mb-5 space-y-5">
    <form wire:submit.prevent="save" class="border border-gray-200 rounded shadow">
        <div class="space-y-5 p-5">
            <div class="grid lg:grid-cols-2 gap-5">
                <div>
                    <label for="name" class="form-label">{{ __("messages.category_name") }}</label>
                    <input type="text" wire:model.defer="name" class="form-control"
                        placeholder="{{ __("messages.enter_category_name") }}">
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="parent_id" class="form-label">{{ __("messages.parent_category") }}</label>
                    <select wire:model="parent_id" id="parent_id" class="form-control">
                        <option value="">{{ __("messages.no_parent") }}</option>
                        @foreach($this->getCategoryOptions(null, '', $this->category?->id) as $categoryOption)
                            <option value="{{ $categoryOption['id'] }}">{{ $categoryOption['name'] }}</option>
                        @endforeach
                    </select>
                    @error('parent_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="space-x-5 flex items-center">
                <x-button-loading type="submit" icon="fas fa-sign-in-alt" target="save">
                    {{ __('messages.save_changes') }}
                </x-button-loading>
                <a href="{{ route("admin.categories.index") }}" class="page-link">
                    {{ __("messages.back") }}
                </a>
            </div>
        </div>
    </form>
</div>