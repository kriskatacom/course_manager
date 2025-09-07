@extends('layouts.app')

@section('content')
    <div class="flex">
        <x-admin.sidebar />

        <div class="bg-white border border-gray-200 flex-1 rounded shadow m-5">
            <h1 class="text-2xl font-extrabold border-b border-gray-200 p-5">
                {{ __("messages.user_details") }}
            </h1>

            <div class="mx-5 mt-5">
                <livewire:admin.alert-messages />
            </div>
            
            <livewire:admin.users.edit-user :userId="$user->id" />
        </div>
    </div>
@endsection
