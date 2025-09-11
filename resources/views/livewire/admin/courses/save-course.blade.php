<div class="px-5 mb-5 space-y-5">
    <livewire:components.flash-message />

    <form wire:submit.prevent="save" class="border border-gray-200 rounded shadow">
        <div class="space-y-5 p-5">

            <!-- Основна информация -->
            <h3 class="text-2xl font-semibold">{{ __("messages.general_information") }}</h3>
            <div>
                <label for="title" class="form-label">{{ __("messages.course_title") }}</label>
                <input type="text" wire:model.defer="course.title" class="form-control" placeholder="{{ __("messages.enter_course_title") }}" wire:loading.attr="disabled" wire:target="save">
                @error('course.title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="short_description" class="form-label">{{ __("messages.short_description") }}</label>
                <textarea wire:model.defer="course.short_description" id="short_description" class="form-control" rows="5" wire:loading.attr="disabled" wire:target="save"></textarea>
                @error('course.short_description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Цена -->
            <h3 class="text-2xl font-semibold">{{ __("messages.price") }}</h3>
                <div>
                    <label for="price" class="form-label">{{ __("messages.course_price") }}</label>
                    <input type="text" wire:model.defer="course.price" class="form-control" placeholder="{{ __("messages.enter_course_price") }}" wire:loading.attr="disabled" wire:target="save" @disabled($course->is_free)>
                    @error('course.price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="discount_price" class="form-label">{{ __("messages.course_discount_price") }}</label>
                    <input type="text" wire:model.defer="discount_price" class="form-control" placeholder="{{ __("messages.enter_course_discount_price") }}" wire:loading.attr="disabled" wire:target="save" @disabled($course->is_free)>
                    @error('discount_price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            <div class="roles-container">
                <label class="role-checkbox">
                    <input type="checkbox" wire:model="course.is_free" value="1">
                    <span class="checkmark">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="role-text">{{ __("messages.free") }}</span>
                </label>
            </div>

            @php
                $categories = \App\Models\Category::getCategoryOptions(null, '', null);
            @endphp

            <!-- Категория -->
            <h3 class="text-2xl font-semibold">{{ __("messages.category") }}</h3>
            @if (count($categories) > 0)
                <div>
                    <label for="category" class="form-label">{{ __("messages.category") }}</label>
                    <select wire:model.defer="course.category_id" class="form-control">
                        <option value="" selected>{{ __('messages.no_category') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category["id"] }}">{{ $category["name"] }}</option>
                        @endforeach
                    </select>
                    @error('course.category_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            @else
                <div class="p-5 border border-gray-200 rounded bg-gray-100">{{ __("messages.no_categories_found") }}</div>
            @endif

            <!-- Описание -->
            <h3 class="text-2xl font-semibold">{{ __("messages.description") }}</h3>
            <div>
                <label for="description" class="form-label">{{ __("messages.description") }}</label>
                <textarea wire:model.defer="course.description" id="description" class="form-control" rows="20"
                    wire:loading.attr="disabled" wire:target="save"></textarea>
                @error('course.description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Допълнителни настройки -->
            <h3 class="text-2xl font-semibold">{{ __("messages.additional_settings") }}</h3>
            <div class="grid grid-cols-2 gap-5">
                <div class="space-y-5">
                    <div>
                        <label for="duration" class="form-label">{{ __("messages.course_duration_in_minutes") }}</label>
                        <input type="text" wire:model.defer="duration" class="form-control" placeholder="{{ __("messages.enter_course_duration") }}" wire:loading.attr="disabled" wire:target="save">
                        @error('duration') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="status" class="form-label">{{ __("messages.status") }}</label>
                        <select wire:model="course.status" id="status" class="form-control">
                            @foreach(\App\Models\Course::STATUSES as $status)
                                <option value="{{ $status }}">{{ __("messages.$status") }}</option>
                            @endforeach
                        </select>
                        @error('course.status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Бутони за действие -->
            <div class="space-x-5 flex items-center">
                <x-button-loading type="submit" icon="fas fa-save" target="save">
                    {{ __('messages.save_changes') }}
                </x-button-loading>
                <a href="{{ route("admin.courses.index") }}" class="page-link">
                    {{ __("messages.back") }}
                </a>
            </div>

            <!-- Danger Zone -->
            @if($course->id)
                <h3 class="text-2xl font-semibold text-red-600">{{ __("messages.danger_zone") }}</h3>
                <div class="p-5 border border-red-200 rounded bg-red-50">
                    <p class="mb-5 text-red-700 max-w-md">
                        {{ __("messages.move_to_trash_course_message") }}
                    </p>
                    <x-button-loading type="button" icon="fas fa-trash" target="save" wire:click="$emit('openModal', {{ $course->id }}, '{{ addslashes(\App\Models\Course::class) }}')" class="btn-danger">
                        {{ __('messages.move_to_trash') }}
                    </x-button-loading>
                </div>
            @endif
        </div>
    </form>

    <livewire:components.delete-modal />
</div>