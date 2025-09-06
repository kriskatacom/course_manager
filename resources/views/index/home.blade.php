@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gray-100">
    <!-- Background image -->
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Обучение">
        <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-4">Развий уменията си с нашите курсове</h1>
        <p class="text-lg sm:text-2xl text-gray-200 mb-8">Онлайн и присъствено обучение за програмиране, дизайн, маркетинг и още.</p>
        <a href="#courses" class="inline-block bg-primary hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition">Разгледай курсовете
        </a>
    </div>
</section>
@endsection
