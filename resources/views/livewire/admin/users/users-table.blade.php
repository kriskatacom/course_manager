<div>
    <div class="m-5 flex justify-between items-center">
        <input type="text" wire:model.debounce.300ms="search" placeholder="Търси потребител..."
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
                    <th class="px-6 py-3 border-b">Име</th>
                    <th class="px-6 py-3 border-b">Имейл</th>
                    <th class="px-6 py-3 border-b">Роли</th>
                    <th class="px-6 py-3 border-b">Създадено на</th>
                    <th class="px-6 py-3 border-b">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 border-b">{{ $user->id }}</td>
                        <td class="px-6 py-4 border-b">{{ $user->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $user->email }}</td>
                        <td class="px-6 py-4 border-b">
                            @foreach($user->roles as $role)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 border-b">{{ $user->created_at->diffForHumans() }}</td>
                        <td class="px-6 py-4 border-b">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:underline">Редактирай</a>
                            <button wire:click="delete({{ $user->id }})" class="text-red-600 hover:underline ml-2"
                                    onclick="confirm('Сигурни ли сте, че искате да изтриете потребителя?') || event.stopImmediatePropagation()">
                                Изтрий
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
