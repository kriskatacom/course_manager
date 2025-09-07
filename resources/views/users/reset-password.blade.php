@extends('layouts.app')

@section('content')
    <div class="text-center my-10 mx-auto max-w-md space-y-5">
        <h1 class="text-3xl font-semibold text-center">Смяна на паролата</h1>
    </div>

    <livewire:users.reset-password-form :token="$token" />
@endsection
