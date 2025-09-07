@extends('layouts.app')

@section('content')
    <div class="flex">
        <x-admin.sidebar />

        <div class="bg-white border border-gray-200 flex-1 rounded shadow m-5">
            <h1 class="text-2xl font-extrabold border-b border-gray-200 p-5">Табло</h1>

            <ul class="p-5 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                <x-admin.dashboard.sidebar-item title="{{ __('messages.administration') }}" :count="$usersCount" icon="fa-solid fa-users" :route="route('admin.users.index')" />
            </ul>
        </div>
    </div>
@endsection
