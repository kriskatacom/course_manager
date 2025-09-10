@extends('layouts.app')

@section('content')
    <div class="flex">
        <x-admin.sidebar />

        <div class="bg-white border border-gray-200 flex-1 rounded shadow m-5">
            <div class="flex items-center justify-between border-b border-gray-200 p-5 mb-5">
                <h1 class="text-2xl font-extrabold">
                    @if (!$course)
                        {{ __("messages.create_new_course") }}
                    @else
                        {{ __("messages.edit_course") }}
                    @endif
                </h1>

                <div>
                    <a href="{{ route("admin.courses.save", 0) }}" title="{{ __("messages.create_new_category") }}" class="block btn-primary">{{ __("messages.create") }}</a>
                </div>
            </div>

            <x-alert-messages />
            <livewire:admin.courses.save-course :courseId="$course ? $course->id : null" />
        </div>
    </div>
@endsection