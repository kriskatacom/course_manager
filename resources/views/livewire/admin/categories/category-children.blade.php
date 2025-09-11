<li>
    <div class="bg-white p-3 rounded border border-gray-200 flex items-center justify-between space-x-2"
        style="margin-left: {{ $level * 2 }}rem;">
        <div class="flex items-center space-x-2">
            @if ($category->image_url)
                <img class="w-14 h-14 max-w-14 max-h-14 object-cover border rounded-full" src="{{ $category->image_url }}" alt="{{ $category->name }}">
            @endif
            <div class="flex items-center gap-5">
                <div class="lg:min-w-[350px]">
                    @if ($category->status == "deleted")
                        <span>{{ $category->name }}</span>
                    @else
                        <a href="{{ route("admin.categories.edit", $category->id) }}">
                            <span class="hover:underline hover:text-primary">{{ $category->name }}</span>
                        </a>
                    @endif

                    @if($category->children->count() > 0)
                        <span class="text-gray-500">({{ $category->children->count() }})</span>
                    @endif
                </div>
                <span class="inline-block {{ \App\Models\Category::STATUS_COLORS[$category->status] ?? 'bg-gray-600 text-gray-100' }} px-2 py-1 rounded mr-1">
                    {{ __("messages.$category->status") }}
                </span>
            </div>
        </div>

        @if ($category->status != "deleted")
            <div class="flex space-x-5">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-600 hover:underline">Редакция</a>
                @if (Auth::user()->hasRole("admin"))
                    <button class="text-red-600 ml-2" wire:click="$emit('openModal', {{ $category->id }}, '{{ addslashes(\App\Models\Category::class) }}')">Изтрий</button>
                @endif
            </div>
        @else
            <div class="flex items-center gap-5">
                <button wire:click="restore({{ $category->id }})" class="text-green-600">{{ __("messages.recovery") }}</button>
                <button wire:click="deletePermanently({{ $category->id }})" class="text-red-600">{{ __("messages.delete_permanently") }}</button>
            </div>
        @endif
    </div>

    @if($category->children->count() > 0)
        <ul class="mt-2 space-y-2">
            @foreach($category->children as $child)
                @include('livewire.admin.categories.category-children', ['category' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>