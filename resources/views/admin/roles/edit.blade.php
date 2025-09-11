@extends('layouts.app')

@section('content')
    <div class="flex">
        <x-admin.sidebar />

        <div class="bg-white border border-gray-200 flex-1 rounded shadow m-5">
            <div class="border border-gray-200 mb-5">
                <div class="flex justify-between items-center gap-5 p-5">
                    <h1 class="text-2xl font-extrabold">
                        @if (!$role)
                            {{ __("messages.create_new_role") }}
                        @else
                            {{ __("messages.edit_role") }}
                        @endif
                    </h1>
                    @if ($role)
                        <div>
                            <x-link href="{{ route('admin.roles.edit', 0) }}" :title="__('messages.create_new_role')" icon="fa-plus" variant="primary">
                                {{ __('messages.create') }}
                            </x-link>
                        </div>
                    @endif
                </div>
            </div>

            <x-alert-messages />
            <livewire:admin.roles.edit-role :roleId="$role ? $role->id : null" />
        </div>
    </div>
@endsection
