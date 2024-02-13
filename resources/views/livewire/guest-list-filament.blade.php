@php
    use App\Models\AllGuest;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    $guestlistcount = AllGuest::where('c_id', Auth::id())->count();
    $guestlistcountwithemail = AllGuest::where('c_id', Auth::id())->whereNotNull('email')->count();
    $guestInvited = AllGuest::where('c_id', Auth::id())->where('is_invited', 1)->count();
    $guestpending = AllGuest::where('c_id', Auth::id())->where('is_invited', 0)->count();
    $guestpendingCeremony = AllGuest::where('c_id', Auth::id())->where('ceremony', 'Pending')->count();
    $guestconfirmedCeremony = AllGuest::where('c_id', Auth::id())->where('ceremony', 'Accept')->count();
    $guestRejectedCeremony = AllGuest::where('c_id', Auth::id())->where('ceremony', 'Reject')->count();
    $guestpendingReception = AllGuest::where('c_id', Auth::id())->where('evening_reception', 'Pending')->count();
    $guestconfirmedReception = AllGuest::where('c_id', Auth::id())->where('evening_reception', 'Accept')->count();
    $guestRejectedReception = AllGuest::where('c_id', Auth::id())->where('evening_reception', 'Reject')->count();
    $guestpendingBreakfast = AllGuest::where('c_id', Auth::id())->where('wedding_breakfast', 'Pending')->count();
    $guestconfirmedBreakfast = AllGuest::where('c_id', Auth::id())->where('wedding_breakfast', 'Accept')->count();
    $guestRejectedBreakfast = AllGuest::where('c_id', Auth::id())->where('wedding_breakfast', 'Reject')->count();

    $guestpendingOther = AllGuest::where('c_id', Auth::id())->where('other', 'Pending')->count();
    $guestconfirmedOther = AllGuest::where('c_id', Auth::id())->where('other', 'Accept')->count();
    $guestRejectedOther = AllGuest::where('c_id', Auth::id())->where('other', 'Reject')->count();
@endphp




{{--

.cardbox{
    background-color: #D8BFD8
}



.about h1, .about h3, .about p {
    text-align: center;
    padding: 10px;
	font-family: 'Montserrat-SemiBold', sans-serif;
    color: #333;
}

.about h1 {
    letter-spacing: 12px;
	text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    font-size: 24px; /* Increase font size for emphasis */
    margin-bottom: 20px; /* Adjust margin for spacing */
}

.about h3 {
    color: #B76E79;
    font-size: 28px; /* Adjust font size */
    margin-bottom: 10px; /* Adjust margin for spacing */
}

.about p {
    padding: 10px 120px;
    text-align: center;
    font-size: 16px;
    line-height: 1.6;
}

 --}}




    <div class="wrapper w-full md;max-w-5xl mx-auto pt-10 px-10">

        <style>
            body {
                background-image: url({{ asset('/images/bgImages/pentagon.png') }});
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }
            </style>

        {{-- <div class="about text-center p-10 font-montserrat-semibold text-gray-800">
            <h3 data-aos="zoom-in" class="text-4xl text-pink-500 mb-10">Your Guest List Haven</h3>
            <h1 data-aos="zoom-in" class="text-6xl text-gray-800 font-montserrat-semibold tracking-wider leading-tight mb-20 text-shadow-md">Cherished Connections: Your Wedding Guestlist Oasis</h1>
            <p data-aos="zoom-in" class="text-lg leading-6 px-20 mb-8">
                Welcome to the heart of your celebration! Dive into the joy of crafting your perfect guestlist, where every name holds a special place in your love story. Manage, invite, and embrace the cherished connections that will make your wedding day an unforgettable journey of shared laughter, love, and lifelong memories. Let the magic of your guestlist unfold in the enchanting realm of Wedding Bells."
            </p>
        </div> --}}

        <div style="text-align: center; padding: 10px; font-family: 'Montserrat-SemiBold', sans-serif; color: #333;">
            <h3 data-aos="zoom-in" style="color: #B76E79; font-size: 28px; margin-bottom: 10px; font-weight:500;">Your Guest List Haven</h3>
            <h1 data-aos="zoom-in" style="letter-spacing: 12px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); font-size: 24px; margin-bottom: 20px;">Cherished Connections <br>Your Wedding Guestlist Oasis</h1>
            <p data-aos="zoom-in" style="padding: 30px 120px; text-align: justify; font-size: 16px; line-height: 1.6; width: 75%; margin-left: auto;
            margin-right: auto;">
                Welcome to the heart of your celebration! Dive into the joy of crafting your perfect guestlist, where every name holds a special place in your love story. Manage, invite, and embrace the cherished connections that will make your wedding day an unforgettable journey of shared laughter, love, and lifelong memories. Let the magic of your guestlist unfold in the enchanting realm of Wedding Bells.
            </p>
        </div>

        <div class="w-full" style="background-color: #D8BFD8">
            <div class="grid gap-4 lg:gap-8 md:grid-cols-3 p-8 pt-10">
                <div class="relative p-6 rounded-2xl bg-white shadow dark:bg-gray-800">
                    <div class="space-y-2">
                        <div
                            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-200">
                            <span>All Guests</span>
                        </div>

                        <div class="text-3xl">
                            {{ $guestlistcount }}
                        </div>

                        <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-green-600">

                            <span>{{ $guestlistcountwithemail }} email connected guests</span>


                        </div>
                    </div>
                </div>

                <div class="relative p-6 rounded-2xl bg-white shadow dark:bg-gray-800">
                    <div class="space-y-2">
                        <div
                            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-200">
                            <span>All Invited Guests</span>
                        </div>

                        <div class="text-3xl">
                            {{ $guestInvited }}
                        </div>

                        <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-red-600">

                            <span>{{ $guestlistcount - $guestInvited }} not invited</span>


                        </div>
                    </div>

                </div>

                <div class="relative p-6 rounded-2xl bg-white shadow dark:bg-gray-800">
                    <div class="space-y-2">
                        <div
                            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-200">

                            <span>Total Ceremony Accept</span>
                        </div>

                        <div class="text-3xl">
                           {{ $guestconfirmedCeremony }}
                        </div>

                        <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-green-600">

                            <span>{{ $guestpendingCeremony }} Pendings / </span>
                            <span class="text-red-600">{{ $guestRejectedCeremony }} Rejected</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="grid gap-4 lg:gap-8 md:grid-cols-3 p-8 pt-1">
                <div class="relative p-6 rounded-2xl bg-white shadow dark:bg-gray-800">
                    <div class="space-y-2">
                        <div
                            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-200">
                            <span>Total Reception Accept</span>
                        </div>

                        <div class="text-3xl">
                            {{ $guestconfirmedReception }}
                        </div>

                        <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-green-600">

                            <span>{{ $guestpendingReception }} Pendings / </span>
                            <span class="text-red-600">{{ $guestRejectedReception }} Rejected</span>


                        </div>
                    </div>
                </div>

                <div class="relative p-6 rounded-2xl bg-white shadow dark:bg-gray-800">
                    <div class="space-y-2">
                        <div
                            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-200">
                            <span>Total Breakfast Accept</span>
                        </div>

                        <div class="text-3xl">
                            {{ $guestconfirmedBreakfast }}
                        </div>

                        <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-red-600">

                            <span>{{ $guestpendingBreakfast }} Pendings / </span>
                            <span class="text-red-600">{{ $guestRejectedBreakfast }} Rejected</span>

                        </div>
                    </div>

                </div>

                <div class="relative p-6 rounded-2xl bg-white shadow dark:bg-gray-800">
                    <div class="space-y-2">
                        <div
                            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-200">

                            <span>Total Other Accept</span>
                        </div>

                        <div class="text-3xl">
                           {{ $guestconfirmedOther}}
                        </div>

                        <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-green-600">

                            <span>{{ $guestpendingOther }} Pendings / </span>
                            <span class="text-red-600">{{ $guestRejectedOther }} Rejected</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>





        <section class="pt-10">
            {{ $this->table }}
        </section>

    </div>


    {{-- <div class="wrapper w-full md;max-w-5xl mx-auto pt-20 px-10" >
        <h1 class="text-xl font-medium mb-5">Guest List</h1>
        <section class="pt-4">
            {{ $this->table }}
        </section>

    </div> --}}






