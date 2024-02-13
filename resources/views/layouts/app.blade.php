<?php
use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

$allCategories= DB::table('vendor_categories')->get();

$initials ='';

if (Auth::user()) {
    $name = Auth::user()->name; // replace this with the actual name from the database
    $parts = explode(' ', $name); // split the name into parts using the space character as the separator
    $first_letter = strtoupper(substr($parts[0], 0, 1)); // get the first letter of the first name and convert it to uppercase
    $second_letter = isset($parts[1]) ? strtoupper(substr($parts[1], 0, 1)) : ''; // get the first letter of the second name and convert it to uppercase if it exists
    $initials = $first_letter . $second_letter; // concatenate the two initials
}


?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('css/appfooternav.css') }}">

        <style>[x-cloak] { display: none !important; }</style>
        @filamentStyles
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        @vite('resources/css/app.css')
        @livewireStyles
        @livewireScripts
        @stack('scripts')
    </head>

    <body class="antialiased" style="background-color: #E9DFF0;">
        {{-- @include('components.onlynav') --}}
        @include('components.apponlynav')
        <div class="mt-16 h-auto">
            {{ $slot }}
        </div>


        @livewire('notifications')
        @filamentScripts
        @vite('resources/js/app.js')

        @include('components.apponlyfooter')
    </body>
</html>
