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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const emprendedoresSelect = document.getElementById('emprendedores');
            if (emprendedoresSelect) {
                new Choices(emprendedoresSelect, {
                    removeItemButton: true,
                    placeholder: true,
                    placeholderValue: 'Seleccionar emprendedores...',
                    noResultsText: 'No se encontró',
                    itemSelectText: '',
                });
            }

            const feriasSelect = document.getElementById('ferias');
            if (feriasSelect) {
                new Choices(feriasSelect, {
                    removeItemButton: true,
                    placeholder: true,
                    placeholderValue: 'Seleccionar ferias...',
                    noResultsText: 'No se encontró',
                    itemSelectText: '',
                });
            }
        });
    </script>



    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
