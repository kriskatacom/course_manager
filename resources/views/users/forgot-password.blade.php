@extends("layouts.app")

@section("content")
    <div class="text-center my-10 mx-auto max-w-md space-y-5">
        <h1 class="text-3xl font-semibold text-center">{{ __("messages.forgot_password") }}</h1>

        <p class="text-gray-600">
            {{ __("messages.forgot_password_description") }}
        </p>
    </div>

    <livewire:users.forgot-password-form />
@endsection
