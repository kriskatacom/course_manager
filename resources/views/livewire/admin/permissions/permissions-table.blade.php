<div>
    <livewire:components.flash-message />

    <div class="m-5 flex justify-between items-center">
        <input type="text" wire:model.debounce.300ms="search" placeholder="{{ __("messages.search_permission") }}..."
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
                    <th class="px-6 py-3 border-b">{{ __("messages.name") }}</th>
                    <th class="px-6 py-3 border-b">{{ __("messages.label") }}</th>
                    <th class="px-6 py-3 border-b">{{ __("messages.created_at") }}</th>
                    <th class="px-6 py-3 border-b">{{ __("messages.updated_at") }}</th>
                    <th class="px-6 py-3 border-b">{{ __("messages.actions") }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 border-b">{{ $permission->id }}</td>
                        <td class="px-6 py-4 border-b">{{ $permission->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $permission->label }}</td>
                        <td class="px-6 py-4 border-b">{{ $permission->created_at->diffForHumans() }}</td>
                        <td class="px-6 py-4 border-b">{{ $permission->updated_at->diffForHumans() }}</td>
                        <td class="px-6 py-4 border-b">
                            <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="text-blue-600 hover:underline">
                                {{ __("messages.edit") }}
                            </a>
                            @if (Auth::user()->hasRole("admin") && $permission->name != "access-admin")
                                 <button class="text-red-600 ml-2" wire:click="$emit('openModal', {{ $permission->id }}, '{{ addslashes(\App\Models\Permission::class) }}')">Изтрий</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <livewire:components.delete-modal />

    @if ($permissions->hasPages())
        <div class="p-5">
            {{ $permissions->links('livewire.components.pagination') }}
        </div>
    @endif
</div>