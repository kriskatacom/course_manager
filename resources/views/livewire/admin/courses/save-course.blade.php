<div class="px-5 mb-5 space-y-5">
    <form wire:submit.prevent="save" class="border border-gray-200 rounded shadow">
        <div class="space-y-5 p-5">
            <div>
                <label for="title" class="form-label">{{ __("messages.course_title") }}</label>
                <input type="text" wire:model.defer="course.title" class="form-control" placeholder="{{ __("messages.enter_course_title") }}" wire:loading.attr="disabled"  wire:target="save">
                @error('course.title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid lg:grid-cols-3 gap-5">
                <div>
                    <label for="price" class="form-label">{{ __("messages.course_price") }}</label>
                    <input type="text" wire:model.defer="course.price" class="form-control" placeholder="{{ __("messages.enter_course_price") }}" wire:loading.attr="disabled"  wire:target="save">
                    @error('course.price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="discount_price" class="form-label">{{ __("messages.course_discount_price") }}</label>
                    <input type="text" wire:model.defer="discount_price" class="form-control" placeholder="{{ __("messages.enter_course_discount_price") }}" wire:loading.attr="disabled"  wire:target="save">
                    @error('discount_price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                @if ($categories->count())
                    <div>
                        <label for="category" class="form-label">{{ __("messages.category") }}</label>
                        <select wire:model.defer="course.category_id" class="form-control">
                            <option value="" selected>{{ __('messages.no_category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('course.category_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                @endif
            </div>

            <div>
                <label for="short_description" class="form-label">{{ __("messages.short_description") }}</label>
                <textarea wire:model.defer="course.short_description" id="short_description" class="form-control" rows="5" wire:loading.attr="disabled"  wire:target="save"></textarea>
                @error('course.short_description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="description" class="form-label">{{ __("messages.description") }}</label>
                <textarea wire:model.defer="course.description" id="description" class="form-control" rows="10" wire:loading.attr="disabled"  wire:target="save"></textarea>
                @error('course.description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="status" class="form-label">{{ __("messages.status") }}</label>
                <select wire:model="course.status" id="status" class="form-control">
                    @foreach(\App\Models\Course::STATUSES as $status)
                        <option value="{{ $status }}">{{ __("messages.$status") }}</option>
                    @endforeach
                </select>
                @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="space-x-5 flex items-center">
                <x-button-loading type="submit" icon="fas fa-save" target="save">
                    {{ __('messages.save_changes') }}
                </x-button-loading>
                <a href="{{ route("admin.courses.index") }}" class="page-link">
                    {{ __("messages.back") }}
                </a>
            </div>
        </div>
    </form>
</div>
