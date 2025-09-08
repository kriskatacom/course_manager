@extends('layouts.app')

@section('content')
    <div class="flex">
        <x-admin.sidebar />

        <div class="bg-white border border-gray-200 flex-1 rounded shadow m-5">
            <h1 class="text-2xl font-extrabold border-b border-gray-200 p-5 mb-5">
                @if (!$permission)
                    {{ __("messages.create_new_permission") }}
                @else
                    {{ __("messages.edit_permission") }}
                @endif
            </h1>

            <x-alert-messages />
            <livewire:admin.permissions.edit-permission :permissionId="$permission ? $permission->id : null" />
        </div>
    </div>
@endsection