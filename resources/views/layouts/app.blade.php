<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'PrivBin') }}</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased bg-gray-900 text-gray-100">
        <x-jet-banner />
        <div class="min-h-screen bg-gray-900 text-gray-100">
            @include('layouts.partials.header')
            <main class="container my-6 mx-auto px-4 sm:px-6 lg:px-8">
                @foreach($errors->all() as $error)
                    <x-alert-box type="error" class="w-full mb-4">{{ $error }}</x-alert-box>
                @endforeach

                {{ $slot }}
            </main>
            @include('layouts.partials.footer')
        </div>
        @stack('modals')
        @livewireScripts
    </body>
</html>
