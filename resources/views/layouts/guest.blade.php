<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-gradient-to-r from-green-400 via-lime-300 to-yellow-300 flex items-center justify-center">
    <div class="flex w-full max-w-7xl p-6 gap-8">
        <!-- Texto do lado esquerdo -->
        <div class="w-2/3 text-white flex flex-col justify-center">
            <h1 class="text-4xl font-bold mb-4">Produtos Naturais que Conectam Você à Essência da Vida</h1>
            <p class="text-lg font-medium">
                Na Porang, acreditamos que o bem-estar começa com escolhas conscientes. Por isso, oferecemos uma seleção especial de produtos naturais, artesanais e sustentáveis que respeitam seu corpo e o planeta.
            </p>
        </div>

        <!-- Card de login -->
        <div class="w-1/3 bg-yellow-300 p-8 rounded-xl shadow-lg text-center border border-black">
            <img src="/caminho/para/seu/logo.png" class="mx-auto mb-4 w-16 h-16" alt="Logo">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
