<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config("app.name", "Laravel") }}</title>

     <style>
    [x-cloak] {
        display: none !important;
    }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body x-transition>
    <x-navbar />

    <main>
        @yield("content")
    </main>

    @livewireScripts
</body>
</html>
