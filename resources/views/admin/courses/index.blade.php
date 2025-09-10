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
                        <span>{{ __('messages.courses') }}</span>
                        <span>({{ format_number($coursesCount) }})</span>
                    </h1>
                    <div>
                        <a href="{{ route("admin.courses.save", 0) }}" title="{{ __("messages.create_new_course") }}" class="block btn-primary">{{ __("messages.create") }}</a>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <x-alert-messages />
            </div>
            <livewire:admin.courses.courses-table />
        </div>
    </div>
@endsection