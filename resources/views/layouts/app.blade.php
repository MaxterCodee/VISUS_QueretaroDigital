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
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/9b5954a8ea.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />


    {{-- BARRA DE NAVEGACION --}}
    <x-nav />

    {{-- SIDEBAR --}}
    <x-side />

    {{-- CONTENIDO --}}
    <div class="p-2 sm:ml-64">
        <div class="rounded-lg mt-14">
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>


    @stack('modals')

    @livewireScripts
</body>

</html>
