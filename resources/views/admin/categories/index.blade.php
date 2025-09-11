@extends('layouts.app')

@php
    $currentHash = request()->getRequestUri();
@endphp

@section('content')
    <div class="flex">
        <x-admin.sidebar />

        <div class="bg-white flex-1 rounded shadow m-5">
            <livewire:admin.categories.categories-table />
        </div>
    </div>
@endsection
