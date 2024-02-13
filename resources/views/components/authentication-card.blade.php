{{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div> --}}


<div class="flex flex-col sm:flex-row min-h-screen">

    <!-- Colorful Side with Image -->
    <div class="w-full sm:w-1/2 flex items-center justify-center" style="background-color: #b3b4ced0;">
        <!-- Add your beautiful image here -->
        <img src="{{ asset('images/bgImages/login_bg.png') }}" alt="Beautiful Image" class="h-full w-full object-cover">
    </div>

    <div class="w-full sm:w-1/2 flex flex-col items-center justify-center p-8" style="background-color: #b3b4ced0; overflow-y: auto;">

        <!-- Separate div for form area -->
        <div class="w-full sm:max-w-md mt-6 p-4 shadow-lg rounded-lg" style="background-color: #D58393;"> <!-- Adjust padding -->
            <!-- Centered logo -->
            <div class="flex items-center justify-center mb-2"> <!-- Adjust margin -->
                <img src="{{ asset('images/logo/WB_logo_1.svg') }}" alt="Logo" class="w-25 h-20">
            </div>

            <!-- Form content -->
            {{ $slot }}
        </div>

    </div>
</div>

