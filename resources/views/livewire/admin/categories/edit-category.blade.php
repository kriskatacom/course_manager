<div class="mb-5 space-y-5">
    <livewire:components.flash-message />

    <form wire:submit.prevent="save" class="border border-gray-200 rounded shadow m-5">
        <div class="space-y-5 p-5">

            <!-- Основна информация за категорията -->
            <h3 class="text-2xl font-semibold">{{ __("messages.general_information") }}</h3>
            <div class="grid lg:grid-cols-2 gap-5">
                <div>
                    <label for="name" class="form-label">{{ __("messages.category_name") }}</label>
                    <input type="text" wire:model.defer="name" class="form-control" placeholder="{{ __("messages.enter_category_name") }}" wire:loading.attr="disabled" wire:target="save">
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                @php
                    $categories = $this->getCategoryOptions(null, '', $this->category?->id);
                @endphp

                @if (count($categories) > 0)
                    <div>
                        <label for="parent_id" class="form-label">{{ __("messages.parent_category") }}</label>
                        <select wire:model="parent_id" id="parent_id" class="form-control" wire:loading.attr="disabled" wire:target="save">
                            <option value="">{{ __("messages.no_parent") }}</option>
                            @foreach($categories as $categoryOption)
                                <option value="{{ $categoryOption['id'] }}">{{ $categoryOption['name'] }}</option>
                            @endforeach
                        </select>
                        @error('parent_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                @endif
            </div>

            <!-- Статус на категорията -->
            <h3 class="text-2xl font-semibold">{{ __("messages.status") }}</h3>
            <div>
                <label for="status" class="form-label">{{ __("messages.category_status") }}</label>
                <select wire:model="status" id="status" class="form-control" wire:loading.attr="disabled" wire:target="save">
                    @foreach(\App\Models\Category::STATUSES as $status)
                        <option value="{{ $status }}">{{ __("messages.$status") }}</option>
                    @endforeach
                </select>
                @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Описание на категорията -->
            <h3 class="text-2xl font-semibold">{{ __("messages.description") }}</h3>
            <div>
                <label for="description" class="form-label">{{ __("messages.category_description") }}</label>
                <textarea wire:model.defer="description" id="description" placeholder="{{ __("messages.enter_category_description") }}" class="form-control" rows="5" wire:loading.attr="disabled" wire:target="save"></textarea>
                @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="space-x-5 flex items-center">
                <x-button-loading type="submit" icon="fas fa-sign-in-alt" target="save">
                    {{ __('messages.save_changes') }}
                </x-button-loading>
                <a href="{{ route("admin.categories.index") }}" class="page-link">
                    {{ __("messages.back") }}
                </a>
            </div>

            <!-- Danger Zone -->
            @if($category->id)
                <h3 class="text-2xl font-semibold text-red-600">{{ __("messages.danger_zone") }}</h3>
                <div class="p-5 border border-red-200 rounded bg-red-50">
                    <p class="mb-5 text-red-700 max-w-md">
                        {{ __("messages.move_to_trash_category_message") }}
                    </p>
                    <button type="button" class="btn-danger" wire:click="$emit('openModal', {{ $category->id }}, '{{ addslashes(\App\Models\Category::class) }}')">
                        <i class="fa-solid fa-trash"></i>
                        {{ __('messages.move_to_trash') }}
                    </button>
                </div>
            @endif
        </div>
    </form>

    <livewire:components.delete-modal />
</div>