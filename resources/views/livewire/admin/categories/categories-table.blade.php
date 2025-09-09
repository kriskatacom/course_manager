<div>
    <livewire:components.flash-message />

    <div class="m-5 flex justify-between items-center">
        <input type="text" wire:model.debounce.300ms="search" placeholder="{{ __("messages.search_category") }}..."
            class="form-control">
    </div>

    <div class="overflow-x-auto">
        <ul class="space-y-2">
            @if ($categories->count() > 0)
                @foreach($categories as $category)
                    <li class="py-3 px-5 mx-5 border border-gray-200 rounded">
                        <div class="flex items-center justify-between">
                            <span>{{ $category->name }}</span>

                            <div class="flex gap-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="text-blue-600 hover:underline">Редактирай</a>
                                @if (Auth::user()->hasRole("admin"))
                                    <button class="text-red-600 ml-2" wire:click="$emit('openModal', {{ $category->id }}, '{{ addslashes(\App\Models\Category::class) }}')">Изтрий</button>
                                @endif
                            </div>
                        </div>

                        @if($category->childrenRecursive->isNotEmpty())
                            @include('livewire.admin.categories.category-children', [
                                'children' => $category->childrenRecursive
                            ])
                        @endif
                    </li>
                @endforeach
            @else
                <div class="mx-5 bg-gray-100 py-5 border border-gray-300 rounded text-center">{{ __("messages.no_categories_found") }}</div>
            @endif
        </ul>
    </div>

    <livewire:components.delete-modal />
</div>