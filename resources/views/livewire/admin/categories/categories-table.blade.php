<div>
    @php
        $statuses = \App\Models\Category::STATUSES;
        $statusIcons = [
            'draft' => 'fas fa-pencil-alt',
            'published' => 'fas fa-check-circle',
            'archived' => 'fas fa-archive',
            'hidden' => 'fas fa-eye-slash',
            'pending' => 'fas fa-clock',
            'deleted' => 'fas fa-trash-alt',
        ];
    @endphp

    <div class="border border-gray-200">
        <div class="flex justify-between items-center gap-5 p-5">
            <h1 class="text-2xl font-extrabold">
                <span>{{ __('messages.categories') }}</span>
                <span>({{ format_number($categoriesCount) }})</span>
            </h1>
            <div>
                <x-link href="{{ route('admin.categories.edit', 0) }}" :title="__('messages.create_new_category')" icon="fa-plus" variant="primary">
                    {{ __('messages.create') }}
                </x-link>
            </div>
        </div>
    </div>

    <x-alert-messages />
    <livewire:components.flash-message />

    <div class="m-5 flex items-center gap-2">
        @foreach($statuses as $statusItem)
            <button wire:click.prevent="$set('status', '{{ $statusItem }}')"
                class="relative flex items-center space-x-2 border border-gray-200 rounded py-2 px-4 hover:text-white hover:bg-primary {{ $status === $statusItem ? 'text-white bg-primary' : '' }}">

                <span class="flex items-center space-x-2" wire:loading.remove
                    wire:target="$set('status', '{{ $statusItem }}')">
                    <i class="{{ $statusIcons[$statusItem] ?? 'fas fa-tag' }}"></i>
                    <span>{{ __("messages.$statusItem") }}</span>
                </span>

                <span class="flex items-center space-x-2" wire:loading wire:target="$set('status', '{{ $statusItem }}')">
                    <i class="fas fa-spinner fa-spin"></i>
                    <span>{{ __("messages.$statusItem") }}</span>
                </span>
            </button>
        @endforeach
    </div>

    <div class="overflow-x-auto">
        <ul>
            @if (count($categories) > 0)
                <div class="px-5 space-y-2">
                    @foreach(collect($categories)->where('parent_id', null) as $category)
                        @include('livewire.admin.categories.category-children', ['category' => $category, 'level' => 0])
                    @endforeach
                </div>
            @else
                <div class="mx-5 bg-gray-100 py-5 border border-gray-300 rounded text-center">
                    {{ __("messages.no_categories_found") }}
                </div>
            @endif
        </ul>
    </div>

    <livewire:components.delete-modal />
</div>