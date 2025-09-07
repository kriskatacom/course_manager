<div>
    <div class="m-5 flex justify-between items-center">
        <input type="text" wire:model.debounce.300ms="search" placeholder="{{ __("messages.search_role") }}..."
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
                    <th class="px-6 py-3 border-b">{{ __("messages.actions") }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 border-b">{{ $role->id }}</td>
                        <td class="px-6 py-4 border-b">{{ $role->name }}</td>
                        <td class="px-6 py-4 border-b">{{ __("messages." . $role->name) }}</td>
                        <td class="px-6 py-4 border-b">{{ $role->created_at->diffForHumans() }}</td>
                        <td class="px-6 py-4 border-b">
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="text-blue-600 hover:underline">
                                {{ __("messages.edit") }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($roles->hasPages())
        <div class="p-5">
            {{ $roles->links() }}
        </div>
    @endif
</div>