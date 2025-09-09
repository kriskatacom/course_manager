<ul class="ml-4 list-disc">
    @foreach($children as $child)
        <li class="py-1">
            <div class="flex items-center justify-between">
                <span>{{ $child->name }}</span>

                <div class="flex gap-2">
                    <a href="{{ route('admin.categories.edit', $child->id) }}"
                        class="text-blue-600 hover:underline text-sm">Редактирай</a>
                    <a href="{{ route('admin.categories.delete', $child->id) }}"
                        class="text-red-600 hover:underline text-sm">Изтрий</a>
                </div>
            </div>

            @if($child->childrenRecursive->isNotEmpty())
                @include('livewire.admin.categories.category-children', [
                    'children' => $child->childrenRecursive
                ])
            @endif
            </li>
    @endforeach
</ul>