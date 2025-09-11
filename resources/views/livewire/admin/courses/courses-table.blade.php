<div>
    @php
        $statuses = \App\Models\Course::STATUSES;
        $statusIcons = [
            'draft' => 'fas fa-pencil-alt',
            'published' => 'fas fa-check-circle',
            'archived' => 'fas fa-archive',
            'deleted' => 'fas fa-trash-alt',
        ];
    @endphp

    <div class="border border-gray-200">
        <div class="flex justify-between items-center gap-5 p-5">
            <div class="flex justify-between items-center gap-5">
                <h1 class="text-2xl font-extrabold">
                    <span>{{ __('messages.courses') }}</span>
                    <span>({{ format_number($coursesCount) }})</span>
                </h1>
                @foreach($statuses as $statusItem)
                    <button wire:click.prevent="$set('status', '{{ $statusItem }}')"
                        class="relative flex items-center space-x-2 border border-gray-200 rounded py-2 px-4 hover:text-white hover:bg-primary {{ $status === $statusItem ? 'text-white bg-primary' : '' }}">
                        <span class="flex items-center space-x-2" wire:loading.remove
                            wire:target="$set('status', '{{ $statusItem }}')">
                            <i class="{{ $statusIcons[$statusItem] ?? 'fas fa-tag' }}"></i>
                            <span>{{ __("messages.$statusItem") }}</span>
                        </span>
                        <span class="flex items-center space-x-2" wire:loading
                            wire:target="$set('status', '{{ $statusItem }}')">
                            <i class="fas fa-spinner fa-spin"></i>
                            <span>{{ __("messages.$statusItem") }}</span>
                        </span>
                    </button>
                @endforeach
            </div>
            <div class="flex items-center gap-5">
                <a href="{{ route("admin.courses.save", 0) }}" title="{{ __("messages.create_new_course") }}"
                    class="block btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    {{ __("messages.create") }}
                </a>
            </div>
        </div>
    </div>

    <x-alert-messages />
    <livewire:components.flash-message />

    <div class="m-5 flex justify-between items-center">
        <input type="text" wire:model.debounce.300ms="search" placeholder="{{ __('messages.search_course') }}..."
            class="form-control">
        <select wire:model="perPage" class="px-4 py-2 border rounded ml-5">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-6 py-3 border-b">ID</th>
                    <th class="px-6 py-3 border-b">{{ __('messages.title') }}</th>
                    <th class="px-6 py-3 border-b">{{ __('messages.category') }}</th>
                    <th class="px-6 py-3 border-b">{{ __('messages.level') }}</th>
                    <th class="px-6 py-3 border-b">{{ __('messages.price') }}</th>
                    <th class="px-6 py-3 border-b">{{ __('messages.status') }}</th>
                    <th class="px-6 py-3 border-b">{{ __('messages.created_at') }}</th>
                    <th class="px-6 py-3 border-b">{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @if ($courses->count() > 0)
                    @foreach($courses as $course)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">{{ $course->id }}</td>
                            <td class="px-6 py-4 border-b">{{ $course->title }}</td>
                            <td class="px-6 py-4 border-b">{{ $course->category?->name ?? '-' }}</td>
                            <td class="px-6 py-4 border-b">{{ __("messages.$course->level") }}</td>
                            <td class="px-6 py-4 border-b">
                                @if($course->is_free)
                                    <span class="text-gray-100 bg-green-600 py-1 px-2 rounded">
                                        {{ __('messages.free') }}
                                    </span>
                                @else
                                    {!! format_price($course->discount_price ? $course->discount_price : $course->price) !!}
                                @endif
                            </td>
                            <td class="px-6 py-4 border-b">
                                <span
                                    class="inline-block {{ \App\Models\Course::STATUS_COLORS[$course->status] ?? 'bg-gray-600 text-gray-100' }} px-2 py-1 rounded mr-1">
                                    {{ __("messages.$course->status") }}
                                </span>
                            </td>
                            <td class="px-6 py-4 border-b">{{ $course->created_at->diffForHumans() }}</td>
                            <td class="px-6 py-4 border-b">
                                @if ($course->status != \App\Models\Course::STATUS_DELETED)
                                    <a href="{{ route('admin.courses.save', $course->id) }}" class="text-blue-600 hover:underline">
                                        {{ __('messages.edit') }}
                                    </a>
                                    <button class="text-red-600 ml-2"
                                        wire:click="$emit('openModal', {{ $course->id }}, '{{ addslashes(\App\Models\Course::class) }}')">
                                        {{ __('messages.delete') }}
                                    </button>
                                @else
                                    <div class="flex items-center gap-5">
                                        <button wire:click="restore({{ $course->id }})" class="text-green-600">{{ __("messages.recovery") }}</button>
                                        <button wire:click="deletePermanently({{ $course->id }})" class="text-red-600">{{ __("messages.delete_permanently") }}</button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="9" class="py-10 text-center">
                        <div class="flex flex-col justify-center items-center gap-5 h-32">
                            <i class="fa-solid fa-graduation-cap text-6xl text-gray-600"></i>
                            <span>{{ __("messages.no_courses_found") }}</span>
                            <a href="{{ route("admin.courses.save", 0) }}"
                                class="btn-primary">{{ __("messages.create") }}</a>
                        </div>
                    </td>
                @endif
            </tbody>
        </table>
    </div>

    <livewire:components.delete-modal />

    @if ($courses->hasPages())
        <div class="p-5">
            {{ $courses->links('livewire.components.pagination') }}
        </div>
    @endif
</div>
