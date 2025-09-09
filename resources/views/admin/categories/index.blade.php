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
                        <span>{{ __('messages.categories') }}</span>
                        <span>({{ format_number($categoriesCount) }})</span>
                    </h1>
                    <div>
                        <a href="{{ route("admin.categories.edit", 0) }}" title="{{ __("messages.create_new_category") }}" class="block btn-primary">{{ __("messages.create") }}</a>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <x-alert-messages />
            </div>
            <livewire:admin.categories.categories-table />
        </div>
    </div>
@endsection