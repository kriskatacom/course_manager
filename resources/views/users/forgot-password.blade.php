@extends("layouts.app")

@section("content")
    <div class="text-center my-10 mx-auto max-w-md space-y-5">
        <h1 class="text-3xl font-semibold text-center">Забравена парола</h1>

        <p class="text-gray-600">
            Въведете своя имейл адрес и ще ви изпратим линк за смяна на паролата. 
            Проверете и папката „Спам“, ако не получите писмото до няколко минути.
        </p>
    </div>

    <livewire:users.forgot-password-form />
@endsection