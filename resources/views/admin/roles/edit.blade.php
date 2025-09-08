@extends('layouts.app')

@section('content')
    <div class="flex">
        <x-admin.sidebar />

        <div class="bg-white border border-gray-200 flex-1 rounded shadow m-5">
            <h1 class="text-2xl font-extrabold border-b border-gray-200 p-5 mb-5">
                @if (!$role)
                    {{ __("messages.create_new_role") }}
                @else
                    {{ __("messages.edit_role") }}
                @endif
            </h1>

            <x-alert-messages />
            <livewire:admin.roles.edit-role :roleId="$role ? $role->id : null" />
        </div>
    </div>
@endsection