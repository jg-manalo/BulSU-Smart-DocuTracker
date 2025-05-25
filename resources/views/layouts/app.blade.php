<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid Serif">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css',
         'resources/js/script.js', 'resources/css/modal.css'])
    </head>
    <body class="font-sans antialiased">
        <div class="dark:bg-gray-900 min-h-screen bg-gray-100" id="guess-body">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="dark:bg-gray-800 bg-white shadow">
                    <div class="max-w-7xl sm:px-6 lg:px-8 px-4 py-3 mx-auto">
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
