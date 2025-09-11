@extends('layouts.app')

@section('content')
    <div class="flex">
        <x-admin.sidebar />

        <div class="bg-white border border-gray-200 flex-1 rounded shadow m-5">
            <div class="flex justify-between items-center gap-5 p-5">
                <h1 class="text-2xl font-extrabold">
                    @if (!$permission)
                        {{ __("messages.create_new_permission") }}
                    @else
                        {{ __("messages.edit_permission") }}
                    @endif
                </h1>
                @if ($permission)
                    <div>
                        <x-link href="{{ route('admin.permissions.edit', 0) }}" :title="__('messages.create_new_permission')" icon="fa-plus" variant="primary">
                            {{ __('messages.create') }}
                        </x-link>
                    </div>
                @endif
            </div>

            <x-alert-messages />
            <livewire:admin.permissions.edit-permission :permissionId="$permission ? $permission->id : null" />
        </div>
    </div>
@endsection