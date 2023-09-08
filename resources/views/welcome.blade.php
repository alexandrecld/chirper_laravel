<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Chirper') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <style>
        /* Styles personnalisés pour ressembler à Twitter */
        body {
            background-color: #15202B;
            color: #E1E8ED;
        }

        header {
            background-color: #192734;
            border-bottom: 1px solid #38444D;
        }

        main {
            background-color: #192734;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        a, a:hover {
            color: #1DA1F2;
            text-decoration: none;
        }

    </style>
</head>

<body class="font-sans antialiased">
<x-jet-banner />

<div class="min-h-screen">
    @livewire('navigation-menu')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-semibold">
                    {{ $header }}
                </h1>
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
</div>

@stack('modals')

@livewireScripts
</body>

</html>
