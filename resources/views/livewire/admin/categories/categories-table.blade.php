<div>
    <livewire:components.flash-message />

    <div class="overflow-x-auto">
        <ul>
            @if ($categories->count() > 0)
                <div class="px-5 space-y-2">
                    @foreach($categories->where('parent_id', null) as $category)
                        @include('livewire.admin.categories.category-children', ['category' => $category, 'level' => 0])
                    @endforeach
                </div>
            @else
                <div class="mx-5 bg-gray-100 py-5 border border-gray-300 rounded text-center">{{ __("messages.no_categories_found") }}</div>
            @endif
        </ul>
    </div>

    <livewire:components.delete-modal />
</div>
