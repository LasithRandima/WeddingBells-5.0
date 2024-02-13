<style>
    #pulseIframe {
        border: none;
        width: 60vw;
        height: 100vh;
        overflow-y: hidden !important;
        overflow: -moz-scrollbars-none;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    #pulseIframe::-webkit-scrollbar {
         display: none;
    }

</style>

<x-filament-panels::page>
    @php
    $app_url = env('APP_URL');
    $pulse_url = config('pulse.path');
    $navUrl = $app_url . $pulse_url;
    @endphp
    {{-- <x-filament::page-header :title="static::$title" :navigation-label="static::$navigationLabel" /> --}}

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <iframe id="pulseIframe" src="{{ $navUrl }}" style="border: none; width: 60vw; height: 100vh; overflow-y: hidden !important;"></iframe>
    </div>

</x-filament-panels::page>
