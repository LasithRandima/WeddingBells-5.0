<?php
use App\Models\Advertisement;
use App\Models\ClientVendorBooking;
use App\Models\ClientGuestList;
use App\Models\ClientCapital;
use App\Models\ClientBudget;
use App\Models\ClientChecklist;
use App\Models\AllGuest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

// $guestlistcount= DB::select('select sum(no_of_family_members) as GuestListCount from client_guest_lists where c_id = ?', [Auth::id()]);


$currentDate = Carbon::now()->toDateString();


// $guestlistcount = ClientGuestList::where('c_id', Auth::id())->sum('no_of_family_members');
$guestlistcount = AllGuest::where('c_id', Auth::id())->count();
$pendingBooking = ClientVendorBooking::where('c_id', Auth::id())->where('booking_status', 'pending')->count();
$totalBooked = ClientVendorBooking::where('c_id', Auth::id())->where('booking_status', 'Booked')->count();
$TodayBooking = ClientVendorBooking::where('c_id', Auth::id())->whereDate('created_at', $currentDate)->count();

$estimatedBudget = ClientCapital::where('c_id', Auth::id())->value('budget');
$currentBudget = ClientBudget::where('c_id', Auth::id())->sum('final_cost');

$allEventscount = DB::table('client_event_planners')->where('c_id', Auth::id())->count();
$allupcomingEventscount = DB::table('client_event_planners')->where('c_id', Auth::id())->whereDate('event_start_date','>=', $currentDate)->count();


$todoCount = ClientChecklist::where('c_id', Auth::id())->where('task_status', 0)->count();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendors</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min_2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



    <style>
        @import url('https://fonts.googleapis.com/css2?family=Petit+Formal+Script&family=Sacramento&family=Work+Sans&display=swap');

        /* Welcome Section Styling */
        .welcome h2 {
            font-size: 3rem;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            line-height: 1.5;
            font-weight: bold;
            color: #B76E79;
        }

        .welcome_couple {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            line-height: 1.5;
            font-weight: bold;
        }

        .welcome h4 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            line-height: 1.5;
            font-weight: bold;
            color: #18070e;
            font-family: 'Petit Formal Script', Arial, serif;
        }


        .couple-header {
            font-family: 'Sacramento';
        }

        .couple-header h2 {
            font-size: 6.5rem;

        }

        .couple-header .nums {
            display: block;
            background-color: rgba(216, 82, 137, 0.8);
            font-family: 'Work Sans';
            font-size: 38px;
            line-height: 65px;
            animation-iteration-count: infinite;
            animation-duration: 1s;
        }

        .couple-header .desc {
            display: block;
            font-family: 'Work Sans';
            font-size: 15px;
            line-height: 10px;
        }

        .wedding_date {
            font-size: 30px;
            font-family: 'Petit Formal Script', sans-serif;
        }

        .welcome h2 {
            margin-top: 3rem;
            font-size: 60px;
            margin-bottom: 10px;
            line-height: 1.5;
            font-weight: bold;
            color: #B76E79;
            font-family: "Sacramento", Arial, serif;
        }

        .welcome_couple {
            font-size: 40px;
            margin-bottom: 10px;
            line-height: 1.5;
            font-weight: bold;
            color: #4e4e4e;
            font-family: "Sacramento", Arial, serif;
        }


        .welcome h4 {
            font-size: 25px;
            margin-bottom: 10px;
            line-height: 1.5;
            font-weight: bold;
            color: #18070e;
            font-family: "Petit Formal Script", Arial, serif;
        }


        .heart-container {
            flex-grow: 1;
            /* Allow the heart container to grow and take available space */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .heart {
            color: #D4AF37;
            /* Champagne Gold */
            cursor: pointer;
            position: absolute;
            top: 4em;
            left: -80px;
            right: 0;
            z-index: 99;
            animation: pulse 0.5s ease infinite;
            transition: transform 0.3s ease;
            /* Add this line for the scaling effect */
        }

        .heart:hover {
            transform: scale(1.5);
            /* Adjust the scaling factor as needed */
        }

        .profile_img {
            animation-iteration-count: 5;
            animation-delay: 3s;
            animation-duration: 4s;
        }

        .dash_cards {
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-content: center !important;
        }

        .ser_gallery {
            display: flex;
            align-items: center;
            justify-content: center;
            /* width:320px !important;
        Height:240px !important; */
        }

        .ser_tile {
            display: grid !important;
            justify-content: center !important;
            align-content: center !important;
        }

        @media screen and (max-width: 991px) {
            .profile_img {
                width: 120px;
                height: auto;
            }

            .heart {
                display: none;
            }

        }

        @media screen and (max-width: 768px) {
            .heart {
                display: none;
            }
        }



        /*-----------------------------Count Down Timer Begins Here----------------------------------------------- */

        .simply-countdown {
            /* The countdown */
            margin-bottom: 2em;
        }

        .simply-countdown .simply-section {
            /* coutndown blocks */
            display: inline-block;
            width: 100px;
            height: 100px;
            background: rgba(241, 78, 149, 0.8);
            margin: 0 4px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            border-radius: 50%;
            position: relative;
            animation: pulse 1s ease infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .simply-countdown>.simply-section>div {
            /* countdown block inner div */
            display: table-cell;
            vertical-align: middle;
            height: 100px;
            width: 100px;
        }

        .simply-countdown>.simply-section .simply-amount,
        .simply-countdown>.simply-section .simply-word {
            display: block;
            color: white;
            /* amounts and words */
        }

        .simply-countdown>.simply-section .simply-amount {
            font-size: 30px;
            /* amounts */
        }

        .simply-countdown>.simply-section .simply-word {
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            font-size: 12px;
            /* words */
        }

        /*-----------------------------Count Down Timer Ends Here----------------------------------------------- */

        .ads {
            margin-top: 100px;
            text-align: center;
            scroll-margin-top: -100px;
        }

        .ads h1 {
            letter-spacing: 12px;
            margin-bottom: 15px;
            font-size: 19px;
        }

        .ads h3 {
            color: #B76E79;
            margin-bottom: 100px;
        }



        .ads p {
            font-size: 1.2rem;
            max-width: 80vw;
            text-align: center;
            margin: auto;
            margin-bottom: 50px;
        }

        .pagination a {
            color: white;
            background-color: #24023f;
            border-radius: 50%;
        }

        .pagination a:active {
            border: cyan solid 3px;
            color: white;
        }

        /*-----
.pagination a:visited {
  background:  #440479;
  border: cyan solid 2px;
  color: white;
}
-------*/
        .pagination a:hover {
            background: linear-gradient(to right, #6e1eee, #f3f3f3);
            color: white;
        }

        .pagenumbers {
            margin-top: 70px;
        }





        /*-------------------------Vendor category Gallery------------------------ */

        .cat_wrapper {
            /* width: 22%; */
            min-height: 237px;
            /* position: absolute;
    top:50%;
    left: 50%;
    transform: translate(-50%, -50%); */
            background: rgba(246, 241, 238, 1);
            box-shadow: 0 10px 20px rgb(40, 40, 40);

        }

        .vendor_cat_img {
            height: 100%;
            Width: 100%
        }

        .vendor_icon {
            display: block;
        }

        .overlay {
            position: absolute;
            top: 0%;
            left: 0%;
            right: 0%;
            bottom: 0%;
            opacity: 0%;
            transition: opacity 0.4s;
            background-color: rgba(255, 255, 255, 1);
            cursor: pointer;
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #000;
            font-family: sans-serif;
            font-size: 25px;
            text-align: center;

        }

        .content p {
            font-size: 0.6em;
        }

        .buttonfont {
            font-size: 15px !important;
        }

        .cat_wrapper:hover .overlay {
            /* background-color: rgba(255, 255, 255, 0.5); */
            opacity: 0.95;
        }

        /*-------------------------Card styling------------------------ */

        .card {
            border: none;
            background-color: #B19CD9;
            /* Pastel Purple */
            ;
            transition: background-color 0.3s ease;
        }

        .card:hover {
            background-color: #E0D4A3;
            /* Pastel Gold */
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: var(--mdb-card-spacer-y) var(--mdb-card-spacer-x);
            color: white;
        }

        .dash_cards .card-title{
            color: #333;
        }


        .col-xl-3,
        .col-sm-6,
        .col-12 {
            max-width: 100%;
        }
        .custom-card {
        background-color: #B19CD9;
        transition: background-color 0.3s ease;
    }

    .custom-card:hover {
        background-color: #E0D4A3;
    }
    </style>

</head>

<body>

    <div class="spinner-container">
        <div class="circles">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    @include ('components.onlynav2');






    <!-- ----------------------------------------------------numbers------------------------------------------------ -->
    @if ($clientdata == null)
        <div class="container-fluid d-flex justify-content-center align-items-center"
            style="background-image: url('images/bgImages/Complete_register_1.svg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; min-height: 100vh;">
            <div class="text-center">
                <h2>Welcome to Your Dashboard</h2>
                <p><b>We're thrilled to have you here! To unlock the full potential of your dashboard, please log in and
                        complete your registration.</b></p>

                <div class="mt-4">
                    <a href="{{ route('login') }}" class="btn btn-primary"
                        style="background-color: #6e1eee; color: #fff;">
                        Log In
                    </a>

                    <a href="{{ route('customerreg') }}" class="btn btn-primary"
                        style="background-color: #6e1eee; color: #fff;">
                        Complete Registration
                    </a>
                </div>
            </div>
        </div>
    @else
        <section class="numberss text-center" id="testimonials">
            <br><br>
            <div class="container">
                <div class="row" data-aos="zoom-in" data-aos-duration="2000">


                    <div
                        class="col-md-12 d-flex justify-content-center animate__animated animate__bounceInDown animate__delay-1.5s animate_duration-2s">
                        <div class="col-md-6 col-sm-12 d-flex justify-content-between">

                            <img class="rounded-circle shadow-4-strong" alt="avatar1"
                                src="images/cus_dashboard/Female-Icon_01.png" width="220px" />

                            <img class="rounded-circle shadow-4-strong" alt="avatar2"
                                src="images/cus_dashboard/Male-Icon_01.png" width="220px" />
                        </div>
                    </div>
                    <div
                        class="col-md-12 couple-header d-flex justify-content-center animate__animated animate__bounceInDown animate__delay-1.5s">
                        <h2>{{ ucfirst(strtok($clientdata->c_name, ' ')) }} &
                            {{ ucfirst(strtok($clientdata->partner_name, ' ')) }}</h2>
                    </div>

                    <div class="col-md-12 d-flex justify-content-center align-content-center mb-3">
                        <div class="wedding_date">{{ $clientdata->wed_date }}</div>
                    </div>

                    <div class="col-md-12 d-flex justify-content-center align-content-center">
                        <div class="simply-countdown simply-countdown-one"></div>
                    </div>





                </div>
                <!-- <div class="row">
        <div class="clock-header">
        <div class="badge">
            <h2>FOR NOW!</h2>
        </div>
        <div class="clock">
            <span id="hour"></span> :
            <span id="minute"></span> :
            <span id="second"></span><br>
            <span id="date"> </span> -
            <span id="month"> </span> -
            <span id="year"></span>

        </div> -->
            </div>
            </div>
            </div>
            </div>
        </section>



        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-offset-2 text-center fh5co-heading welcome">
                    <h2>Hello!</h2>
                    <h4>Your Love Nest's Dashboard</h4>
                    <p>Where every moment is a celebration of your love. Cherish the journey together.</p>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-content-center my-5">

                <div class="col-md-3 col-sm-12 pt-5">
                    <h3 class="welcome_couple">
                        {{ ucfirst(strtok($clientdata->c_name, ' ')) }}
                    </h3>
                </div>

                <div class="col-md-5 d-flex justify-content-between align-items-center">
                    @if ($clientdata->gender == 'female')
                        <img class="rounded-circle animate__animated animate__pulse profile_img" alt="avatar1"
                            src="images/cus_dashboard/Female-Icon_01.png" width="100px" />
                    @else
                        <img class="rounded-circle animate__animated animate__pulse profile_img" alt="avatar1"
                            src="images/cus_dashboard/Male-Icon_01.png" width="100px" />
                    @endif

                    <div class="heart-container">
                        <p class="heart text-center"><i class="fa-solid fa-shield-heart fa-beat"
                                style="color: #F7B6C2;"></i></p>
                    </div>

                    @if ($clientdata->gender == 'female')
                        <img class="rounded-circle animate__animated animate__pulse profile_img" alt="avatar2"
                            src="images/cus_dashboard/Male-Icon_01.png" width="100px" />
                    @else
                        <img class="rounded-circle animate__animated animate__pulse profile_img" alt="avatar2"
                            src="images/cus_dashboard/Female-Icon_01.png" width="100px" />
                    @endif
                </div>


                <div class="col-md-3 col-sm-12 py-5">
                    <h3 class="welcome_couple">{{ ucfirst(strtok($clientdata->partner_name, ' ')) }}</h3>
                </div>

            </div>
        </div>



        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-heart text-primary fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>{{ $clientdata->guest_count }}</h3>
                                    <p class="mb-0"> Estimated Guest Count</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-heart text-primary fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>{{ 2 + $guestlistcount }}</h3>
                                    <p class="mb-0">Current Guests</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-heart text-primary fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>{{ $TodayBooking }}</h3>
                                    <p class="mb-0">Today Bookings</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-heart text-primary fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>{{ $pendingBooking }}</h3>
                                    <p class="mb-0">Pending Bookings</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-heart text-primary fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>{{ $totalBooked }}</h3>
                                    <p class="mb-0">Services Hired</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>









        {{-- <div class="container">
<div class="card border-success mb-3" style="max-width: 18rem;">
    <div class="card-body bg-transparent border-success text-secondary">
      <h5 class="card-title">Success card title</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
  </div>

</div> --}}


<div class="container">
  <div class="card-deck">
      <div class="card bg-light mb-3 custom-card" style="max-width: 20rem;">
        <div class="card-header" style="background-color: #B19CD9;">Guest List</div>
                    <div class="card-body dash_cards">
                        <div class="d-flex justify-content-center">
                            <img src="images/categories/Category_icon/icons8-queue-50.png" alt="" width="60px">
                        </div>
                        <div class="mt-4">
                            @if ($guestlistcount == 0)
                                <h6 class="card-title ms-4 text-center" style="color: darkgrey;"> You haven't added any guests yet</h6>
                            @endif

                            <h6 class="card-title ms-4 text-center">Current Guests : {{ 2 + $guestlistcount }}</h6>
                        </div>
                        <a href="{{ route('guestlistnew') }}" class="btn btn-outline-secondary" style="border-color: #ffd700;">Add Guests</a>
                      </div>
                </div>


                <div class="card bg-light mb-3 custom-card" style="max-width: 24rem;">
                  <div class="card-header" style="background-color: #B19CD9;">Budget Planner</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-content-center">
                            <div class="dash_cards">
                                <img src="images/categories/Category_icon/icons8-coin-in-hand-64.png" alt="" width="60px">
                                <h6 class="card-title mt-2" style="color: darkgrey;"> Estimated Cost</h6>
                                <p class="card-text">Rs. {{ $estimatedBudget }}</p>

                            </div><br>

                            <div class="dash_cards">
                                <img src="images/categories/Category_icon/icons8-estimate-64.png" alt="" width="60px">
                                <h6 class="card-title mt-2" style="color: darkgrey;">Final Cost</h6>
                                <p class="card-text">Rs. {{ $currentBudget }}</p>
                            </div>
                        </div>
                        <div class="dash_cards">
                          <a href="{{ route('budgetplanner') }}" class="btn btn-outline-secondary mt-3" style="border-color: #ffd700;">Manage Expenses</a>
                        </div>

                    </div>

                </div>


                <div class="card bg-light mb-3 custom-card" style="max-width: 20rem;">
                    <div class="card-header" style="background-color: #B19CD9;">Event Planner</div>
                                <div class="card-body dash_cards">
                                    <div class="d-flex justify-content-center">
                                        <img src="images/categories/Category_icon/icons8-queue-50.png" alt="" width="60px">
                                    </div>
                                    <div class="mt-4">
                                        @if ($allEventscount == 0)
                                            <h6 class="card-title ms-4 text-center" style="color: darkgrey;"> You haven't added any Events yet</h6>
                                        @endif

                                        <h6 class="card-title ms-4 text-center">Current Events : {{  $allupcomingEventscount }}</h6>
                                    </div>
                                    <a href="{{ route('customer.calendar.index') }}" class="btn btn-outline-secondary" style="border-color: #ffd700;">Manage Events</a>
                                  </div>
                </div>

                <div class="card bg-light mb-3 custom-card" style="max-width: 20rem;">
                  <div class="card-header" style="background-color: #B19CD9;">Check List</div>
                    <div class="card-body dash_cards">
                        <div class="d-flex justify-content-center">
                            <img src="images/categories/Category_icon/icons8-checkmark-64.png" alt="" width="60px">
                        </div>
                        <div class="mt-4">
                            @if ($todoCount == 0)
                                <h6 class="card-title ms-4 text-center" style="color: darkgrey;">You haven't Create Your Checklist yet</h6>
                            @endif

                            <h6 class="card-title ms-4 text-center" style="color: darkgrey;">Upcoming Tasks : {{ $todoCount }}</h6>
                        </div>
                        <a href="{{ route('checklist.index') }}" class="btn btn-outline-secondary" style="border-color: #ffd700;">Manage Checklist</a>
                      </div>
                  </div>
              </div>
        </div>




        <!-------------------------------------------Footer Begin---------------------------------------------->
        @include('components.onlyfooter')


        @php
            // Combine wedding date and start time into a single string
            $dateTimeString = $clientdata->wed_date . ' ' . $clientdata->wed_start_time;

            // Convert the combined string to a JavaScript Date object
            $jsDate = \Carbon\Carbon::parse($dateTimeString)->toISOString();
        @endphp

    @endif

    <?php
    if ($clientdata == null) {
        $jsDate = \Carbon\Carbon::now()->toISOString();
    }

    ?>
    <!-------------------------------------------Footer End---------------------------------------------->


<script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/simplyCountdown.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/aos.js') }}"></script>



    <script>
        AOS.init({
            offset: 180,
            delay: 0,
            duration: 800,
            easing: 'ease',
            once: false,
            mirror: false,
            anchorPlacement: 'top-bottom',

        });
    </script>
   <script src="{{ asset('js/main.js') }}"></script>
   <script src="{{ asset('js/smooth-scroll.js') }}"></script>
    <script>
        var scroll = new SmoothScroll('a[href*="#"]');
    </script>

    <!-- Count down -->
    <script>
        var d = new Date('{{ $jsDate }}');


        // default example
        simplyCountdown('.simply-countdown-one', {
            year: d.getFullYear(),
            month: d.getMonth() + 1,
            day: d.getDate(),
            hours: d.getHours(),
            minutes: d.getMinutes()
        });

        //jQuery example
        $('#simply-countdown-losange').simplyCountdown({
            year: d.getFullYear(),
            month: d.getMonth() + 1,
            day: d.getDate(),
            hours: d.getHours(),
            minutes: d.getMinutes(),
            enableUtc: false
        });
    </script>
    <!--End of Count down -->
    <script src="{{ asset('js/clock.js') }}" charset="utf-8"></script>
</body>

</html>
