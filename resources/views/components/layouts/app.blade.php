<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <link rel="stylesheet" href="{{ asset('css/appfooternav.css') }}"> --}}

        <title>{{ config('app.name') }}</title>
        <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">

        <style>[x-cloak] { display: none !important; }</style>
        @filamentStyles
        @vite('resources/css/app.css')
        @livewireStyles
        @livewireScripts
        @stack('scripts')
    </head>

    <body class="antialiased" style="background-color: #E9DFF0;">
        {{ $slot }}

        @livewire('notifications');

        @filamentScripts
        @vite('resources/js/app.js')

    </body>
</html>
