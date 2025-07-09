<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('images/Logsemfundo.png') }}" type="image/x-icon">
        <title>{{ config('app.name', 'Porangue') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="min-h-screen bg-gradient-to-r from-green-400 via-lime-300 to-yellow-300 flex items-center justify-center">
    <div class="w-full h-full max-w-xl p-6 sm:p-8 bg-yellow-300 rounded-xl shadow-lg text-center border border-black">
        <img src="{{ asset('images/Logsemfundo.png') }}" alt="Logo" class="mx-auto mb-4 w-16 h-16">
        {{ $slot }}
    </div>
</body>


</html>
