@extends('layouts.app')

@section('content')
    <div class="flex">
        <x-admin.sidebar />

        <div class="bg-white border border-gray-200 flex-1 rounded shadow m-5">
            <h1 class="text-2xl font-extrabold border-b border-gray-200 p-5">
                <span>{{ __('messages.users') }}</span>
                <span>({{ format_number($usersCount) }})</span>
            </h1>
            
            <livewire:admin.users.users-table />
        </div>
    </div>
@endsection
