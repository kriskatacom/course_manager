@extends('layouts.app')

@php
    $currentHash = request()->getRequestUri();
@endphp

@section('content')
    <div class="flex">
        <x-admin.sidebar />

        <div class="bg-white flex-1 rounded shadow m-5">
            <div class="border border-gray-200">
                <div class="flex justify-between items-center gap-5 p-5">
                    <h1 class="text-2xl font-extrabold">
                        <span>{{ __('messages.roles') }}</span>
                        <span>({{ format_number($rolesCount) }})</span>
                    </h1>
                    <div>
                        <x-link href="{{ route('admin.roles.edit', 0) }}" :title="__('messages.create_new_role')" icon="fa-plus" variant="primary">
                            {{ __('messages.create') }}
                        </x-link>
                    </div>
                </div>
            </div>

            <div class="mx-5 mt-5">
                <a href="{{ route("admin.users.index") }}" class="border border-gray-200 rounded py-2 px-4 hover:text-white hover:bg-primary {{ str_contains($currentHash, 'users') ? 'text-white bg-primary' : '' }}">{{ __("messages.users") }}</a>
                <a href="{{ route("admin.roles.index") }}" class="border border-gray-200 rounded py-2 px-4 hover:text-white hover:bg-primary {{ str_contains($currentHash, 'roles') ? 'text-white bg-primary' : '' }}">{{ __("messages.roles") }}</a>
                <a href="{{ route("admin.permissions.index") }}" class="border border-gray-200 rounded py-2 px-4 hover:text-white hover:bg-primary {{ str_contains($currentHash, 'permissions') ? 'text-white bg-primary' : '' }}">{{ __("messages.permissions") }}</a>
            </div>

            <div class="mt-5">
                <x-alert-messages />
            </div>
            <livewire:admin.roles.roles-table />
        </div>
    </div>
@endsection
