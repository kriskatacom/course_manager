<div>
    <div class="m-5 flex justify-between items-center">
        <input type="text" wire:model.debounce.300ms="search" placeholder="{{ __("messages.search_user") }}..."
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
                    <th class="px-6 py-3 border-b">{{ __("messages.email") }}</th>
                    <th class="px-6 py-3 border-b">{{ __("messages.roles") }}</th>
                    <th class="px-6 py-3 border-b">{{ __("messages.created_at") }}</th>
                    <th class="px-6 py-3 border-b">{{ __("messages.updated_at") }}</th>
                    <th class="px-6 py-3 border-b">{{ __("messages.actions") }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 border-b">{{ $user->id }}</td>
                        <td class="px-6 py-4 border-b">{{ $user->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $user->email }}</td>
                        <td class="px-6 py-4 border-b">
                            @if ($user->roles && $user->roles->isNotEmpty())
                                @foreach($user->roles as $role)
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1">
                                        {{ $role->label }}
                                    </span>
                                @endforeach
                            @else
                                <span class="ml-5">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 border-b">{{ $user->created_at->diffForHumans() }}</td>
                        <td class="px-6 py-4 border-b">{{ $user->updated_at->diffForHumans() }}</td>
                        <td class="px-6 py-4 border-b">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:underline">
                                {{ __("messages.edit") }}
                            </a>
                            @if (Auth::user()->id != $user->id && !$user->hasRole("admin"))
                                <button wire:click="confirmDelete({{ $user->id }})" class="text-red-600 ml-2">Изтрий</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($showDeleteModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded shadow-lg w-1/3">
                <h2 class="p-5 text-xl font-semibold pb-5 border-b border-gray-200">Потвърждение за изтриване</h2>
                <p class="p-5">
                    Сигурни ли сте, че искате да изтриете <strong>{{ $userToDelete->name }}</strong>?
                </p>

                <div class="p-5 border-t border-gray-200 flex justify-end space-x-5">
                    <button wire:click="cancelDelete" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                        Откажи
                    </button>

                    <button wire:click="deleteUser" wire:loading.attr="disabled" class="btn-danger">
                        <span wire:loading.remove>Изтрий</span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin"></i> Зареждане...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if ($users->hasPages())
        <div class="p-5">
            {{ $users->links() }}
        </div>
    @endif
</div>
