<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
$current_date_time = Carbon::now()->toDateTimeString();


$current_guestdata_ceremony = DB::table('guest_confirms')->where('companion_id', '=', $all_guest_id)->where('event', '=', 'ceremony')->get();
$current_guestdata_evening_reception = DB::table('guest_confirms')->where('companion_id', '=', $all_guest_id)->where('event', '=', 'evening_reception')->get();
$current_guestdata_wedding_breakfast = DB::table('guest_confirms')->where('companion_id', '=', $all_guest_id)->where('event', '=', 'wedding_breakfast')->get();
$current_guestdata_other = DB::table('guest_confirms')->where('companion_id', '=', $all_guest_id)->where('event', '=', 'other')->get();

dd($current_guestdata_evening_reception);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RSVP Guest List</title>

    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
    alpha/css/bootstrap.css" rel="stylesheet">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Permanent+Marker&display=swap');

        .monster {
            font-family: 'Montserrat', sans-serif;
        }

        .perment{
            font-size: 120px;
            font-family: 'Permanent Marker', cursive;
        }

        /* Default style for larger screens */
        .checkboxes {
            display: flex;
            justify-content: space-between;
            align-content: center;
            align-items: center;
        }


        @media (max-width: 767px) {
            .checkboxes {
                flex-direction: column;
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

      @include('components.onlynav');


      <section class="position-relative py-4 py-xl-5 monster" style="margin-top: 80px">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="perment">US</h2>
                    <h2>Will you be with us or will you miss it? </h2>
                    <p class="w-lg-50">To confirm your attendance to the wedding, just enter your name and click on Search. Your name will appear and then just tell whether or not you are coming.<br> (leaving a message is optional, but it's always nice) :)</p>
                </div>
            </div>

            @if ($allguestQuery)

            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column align-items-center">


                                <ul class="list-group" style="width: 100%">

                                    <li class="list-group-item">
                                        <h4 class="mb-4">Ceremony</h4>
                                        @php
                                             $ceremony = 'ceremony';
                                        @endphp

                                        @foreach ($allguestQuery as $guest)
                                        <form action="{{ route('guestconfirm.rsvpguestform') }}" class="" method="POST">
                                            @csrf
                                        @php
                                        $invitedEvents = json_decode($guest->invited_to, true);
                                        $eventname = $invitedEvents[$loop->index];
                                        @endphp

                                        @if (in_array('ceremony', $invitedEvents))
                                        <div class="row">
                                            <div class="col-lg-3 col-xl-3 col-sm-10 col-xs-12 col-md-10 content d-flex flex-column align-items-center justify-content-center mb-3">

                                                        <h6>{{ $guest->g_first_name }}</h6>
                                                        <input type="hidden" name="c_id" value="{{ $guest->c_id }}">
                                                        <input type="hidden" name="guest_id" value="{{ $guest->id }}">
                                                        <input type="hidden" name="companion_id" value="{{ $guest->guest_id }}">
                                                        <input type="hidden" name="event" value="{{ $ceremony }}">

                                                        <select name="meal" id="meal">
                                                            <option disabled selected>Choose Menu</option>
                                                            <option value="Beef" {{ $current_guestdata_ceremony[$loop->index]->meal == 'Beef' ? 'selected' : '' }}>Beef</option>
                                                            <option value="Chicken" {{ $current_guestdata_ceremony[$loop->index]->meal == 'Chicken' ? 'selected' : '' }}>Chicken</option>
                                                            <option value="Child Meal" {{ $current_guestdata_ceremony[$loop->index]->meal == 'Child Meal' ? 'selected' : '' }}>Child Meal</option>
                                                            <option value="Fish" {{ $current_guestdata_ceremony[$loop->index]->meal == 'Fish' ? 'selected' : '' }}>Fish</option>
                                                            <option value="Lamb" {{ $current_guestdata_ceremony[$loop->index]->meal == 'Lamb' ? 'selected' : '' }}>Lamb</option>
                                                            <option value="Pork" {{ $current_guestdata_ceremony[$loop->index]->meal == 'Pork' ? 'selected' : '' }}>Pork</option>
                                                            <option value="Vegetarian" {{ $current_guestdata_ceremony[$loop->index]->meal == 'Vegetarian' ? 'selected' : '' }}>Vegetarian</option>
                                                            <option value="Other" {{ $current_guestdata_ceremony[$loop->index]->meal == 'Other' ? 'selected' : '' }}>Other</option>
                                                        </select>




                                                    </div>
                                                    <div class="col-lg-7 col-sm-12 col-xs-12 col-md-12 checkboxes d-flex w-100 justify-content-between align-content-center align-items-center">

                                                        <label class="radio">
                                                            <input name="attendance_status" type="radio" value="Pending" {{ $current_guestdata_ceremony[$loop->index]->attendance_status == 'Pending' ? 'checked' : '' }} />
                                                            <span>Pending</span>
                                                        </label>

                                                        <label class="radio">
                                                            <input name="attendance_status" type="radio" value="Accept" {{ $current_guestdata_ceremony[$loop->index]->attendance_status == 'Accept' ? 'checked' : '' }} />
                                                            <span>I Accept</span>
                                                        </label>

                                                        <label class="radio">
                                                            <input name="attendance_status" type="radio" value="Reject" {{ $current_guestdata_ceremony[$loop->index]->attendance_status == 'Reject' ? 'checked' : '' }} />
                                                            <span>I Don't Accept</span>
                                                        </label>

                                                            <label class="radio">
                                                                <input name="c_is_drink" type="checkbox" {{ $current_guestdata_ceremony[$loop->index]->c_is_drink ? 'checked' : '' }} />
                                                                <span>Have Drinks?</span>
                                                            </label>

                                                    </div>
                                                    <div class="col-md-2 col-lg-2 col-xl-2 col-sm-12 justify-content-between align-content-center align-items-center">
                                                        <div class="mb-3"><button class="btn btn-sm btn-primary d-block w-100" type="submit">Save</button></div>
                                                    </form>
                                                    </div>
                                                </div>
                                                <hr style="#333 1px solid">
                                                @endif
                                        @endforeach

                                    </li>




                                    <li class="list-group-item">
                                        <h4 class="mb-4">Evening Reception</h4>
                                        @php
                                           $eveningreception = 'evening_reception';
                                        @endphp

                                        @foreach ($allguestQuery as $guest)
                                        <form action="{{ route('guestconfirm.rsvpguestform') }}" class="" method="POST">
                                            @csrf
                                        @php
                                        $invitedEvents = json_decode($guest->invited_to, true);
                                        $eventname = $invitedEvents[$loop->index];
                                        @endphp

                                        @if (in_array('evening_reception', $invitedEvents))
                                        <div class="row">
                                            <div class="col-lg-3 col-xl-3 col-sm-10 col-xs-12 col-md-10 content d-flex flex-column align-items-center justify-content-center mb-3">

                                                        <h6>{{ $guest->g_first_name }}</h6>
                                                        <input type="hidden" name="c_id" value="{{ $guest->c_id }}">
                                                        <input type="hidden" name="guest_id" value="{{ $guest->id }}">
                                                        <input type="hidden" name="companion_id" value="{{ $guest->guest_id }}">
                                                        <input type="hidden" name="event" value="{{ $ceremony }}">

                                                        <select name="meal" id="meal">
                                                            <option disabled selected>Choose Menu</option>
                                                            <option value="Beef" {{ $current_guestdata_evening_reception[$loop->index]->meal == 'Beef' ? 'selected' : '' }}>Beef</option>
                                                            <option value="Chicken" {{ $current_guestdata_evening_reception[$loop->index]->meal == 'Chicken' ? 'selected' : '' }}>Chicken</option>
                                                            <option value="Child Meal" {{ $current_guestdata_evening_reception[$loop->index]->meal == 'Child Meal' ? 'selected' : '' }}>Child Meal</option>
                                                            <option value="Fish" {{ $current_guestdata_evening_reception[$loop->index]->meal == 'Fish' ? 'selected' : '' }}>Fish</option>
                                                            <option value="Lamb" {{ $current_guestdata_evening_reception[$loop->index]->meal == 'Lamb' ? 'selected' : '' }}>Lamb</option>
                                                            <option value="Pork" {{ $current_guestdata_evening_reception[$loop->index]->meal == 'Pork' ? 'selected' : '' }}>Pork</option>
                                                            <option value="Vegetarian" {{ $current_guestdata_evening_reception[$loop->index]->meal == 'Vegetarian' ? 'selected' : '' }}>Vegetarian</option>
                                                            <option value="Other" {{ $current_guestdata_evening_reception[$loop->index]->meal == 'Other' ? 'selected' : '' }}>Other</option>
                                                        </select>




                                                    </div>
                                                    <div class="col-lg-7 col-sm-12 col-xs-12 col-md-12 checkboxes d-flex w-100 justify-content-between align-content-center align-items-center">

                                                        <label class="radio">
                                                            <input name="attendance_status" type="radio" value="Pending" {{ $current_guestdata_evening_reception[$loop->index]->attendance_status == 'Pending' ? 'checked' : '' }} />
                                                            <span>Pending</span>
                                                        </label>

                                                        <label class="radio">
                                                            <input name="attendance_status" type="radio" value="Accept" {{ $current_guestdata_evening_reception[$loop->index]->attendance_status == 'Accept' ? 'checked' : '' }} />
                                                            <span>I Accept</span>
                                                        </label>

                                                        <label class="radio">
                                                            <input name="attendance_status" type="radio" value="Reject" {{ $current_guestdata_evening_reception[$loop->index]->attendance_status == 'Reject' ? 'checked' : '' }} />
                                                            <span>I Don't Accept</span>
                                                        </label>

                                                            <label class="radio">
                                                                <input name="c_is_drink" type="checkbox" {{ $current_guestdata_evening_reception[$loop->index]->c_is_drink ? 'checked' : '' }} />
                                                                <span>Have Drinks?</span>
                                                            </label>

                                                    </div>
                                                    <div class="col-md-2 col-lg-2 col-xl-2 col-sm-12 justify-content-between align-content-center align-items-center">
                                                        <div class="mb-3"><button class="btn btn-sm btn-primary d-block w-100" type="submit">Save</button></div>
                                                    </form>
                                                    </div>
                                                </div>
                                                <hr style="#333 1px solid">
                                                @endif
                                        @endforeach
                                    </li>


                                    <li class="list-group-item">
                                        @php
                                           $breakfast = 'wedding_breakfast';
                                        @endphp
                                        <h4 class="mb-4">Wedding Breakfast</h4>

                                        @foreach ($allguestQuery as $guest)
                                        <form action="{{ route('guestconfirm.rsvpguestform') }}" class="" method="POST">
                                            @csrf
                                        @php
                                        $invitedEvents = json_decode($guest->invited_to, true);
                                        $eventname = $invitedEvents[$loop->index];
                                        @endphp

                                        @if (in_array('wedding_breakfast', $invitedEvents))
                                        <div class="row">
                                            <div class="col-lg-3 col-xl-3 col-sm-10 col-xs-12 col-md-10 content d-flex flex-column align-items-center justify-content-center mb-3">

                                                        <h6>{{ $guest->g_first_name }}</h6>
                                                        <input type="hidden" name="c_id" value="{{ $guest->c_id }}">
                                                        <input type="hidden" name="guest_id" value="{{ $guest->id }}">
                                                        <input type="hidden" name="companion_id" value="{{ $guest->guest_id }}">
                                                        <input type="hidden" name="event" value="{{ $ceremony }}">

                                                        <select name="meal" id="meal">
                                                            <option disabled selected>Choose Menu</option>
                                                            <option value="Beef" {{ $current_guestdata_wedding_breakfast[$loop->index]->meal == 'Beef' ? 'selected' : '' }}>Beef</option>
                                                            <option value="Chicken" {{ $current_guestdata_wedding_breakfast[$loop->index]->meal == 'Chicken' ? 'selected' : '' }}>Chicken</option>
                                                            <option value="Child Meal" {{ $current_guestdata_wedding_breakfast[$loop->index]->meal == 'Child Meal' ? 'selected' : '' }}>Child Meal</option>
                                                            <option value="Fish" {{ $current_guestdata_wedding_breakfast[$loop->index]->meal == 'Fish' ? 'selected' : '' }}>Fish</option>
                                                            <option value="Lamb" {{ $current_guestdata_wedding_breakfast[$loop->index]->meal == 'Lamb' ? 'selected' : '' }}>Lamb</option>
                                                            <option value="Pork" {{ $current_guestdata_wedding_breakfast[$loop->index]->meal == 'Pork' ? 'selected' : '' }}>Pork</option>
                                                            <option value="Vegetarian" {{ $current_guestdata_wedding_breakfast[$loop->index]->meal == 'Vegetarian' ? 'selected' : '' }}>Vegetarian</option>
                                                            <option value="Other" {{ $current_guestdata_wedding_breakfast[$loop->index]->meal == 'Other' ? 'selected' : '' }}>Other</option>
                                                        </select>




                                                    </div>
                                                    <div class="col-lg-7 col-sm-12 col-xs-12 col-md-12 checkboxes d-flex w-100 justify-content-between align-content-center align-items-center">

                                                        <label class="radio">
                                                            <input name="attendance_status" type="radio" value="Pending" {{ $current_guestdata_wedding_breakfast[$loop->index]->attendance_status == 'Pending' ? 'checked' : '' }} />
                                                            <span>Pending</span>
                                                        </label>

                                                        <label class="radio">
                                                            <input name="attendance_status" type="radio" value="Accept" {{ $current_guestdata_wedding_breakfast[$loop->index]->attendance_status == 'Accept' ? 'checked' : '' }} />
                                                            <span>I Accept</span>
                                                        </label>

                                                        <label class="radio">
                                                            <input name="attendance_status" type="radio" value="Reject" {{ $current_guestdata_wedding_breakfast[$loop->index]->attendance_status == 'Reject' ? 'checked' : '' }} />
                                                            <span>I Don't Accept</span>
                                                        </label>

                                                            <label class="radio">
                                                                <input name="c_is_drink" type="checkbox" {{ $current_guestdata_wedding_breakfast[$loop->index]->c_is_drink ? 'checked' : '' }} />
                                                                <span>Have Drinks?</span>
                                                            </label>

                                                    </div>
                                                    <div class="col-md-2 col-lg-2 col-xl-2 col-sm-12 justify-content-between align-content-center align-items-center">
                                                        <div class="mb-3"><button class="btn btn-sm btn-primary d-block w-100" type="submit">Save</button></div>
                                                    </form>
                                                    </div>
                                                </div>
                                                <hr style="#333 1px solid">
                                                @endif
                                        @endforeach

                                    </li>
                                    <li class="list-group-item">
                                        <h4 class="mb-4">Other</h4>
                                        @php
                                          $other = 'other';
                                        @endphp

                                        @foreach ($allguestQuery as $guest)
                                        <form action="{{ route('guestconfirm.rsvpguestform') }}" class="" method="POST">
                                            @csrf
                                        @php
                                        $invitedEvents = json_decode($guest->invited_to, true);
                                        $eventname = $invitedEvents[$loop->index];
                                        @endphp

                                        @if (in_array('other', $invitedEvents))
                                        <div class="row">
                                            <div class="col-lg-3 col-xl-3 col-sm-10 col-xs-12 col-md-10 content d-flex flex-column align-items-center justify-content-center mb-3">

                                                        <h6>{{ $guest->g_first_name }}</h6>
                                                        <input type="hidden" name="c_id" value="{{ $guest->c_id }}">
                                                        <input type="hidden" name="guest_id" value="{{ $guest->id }}">
                                                        <input type="hidden" name="companion_id" value="{{ $guest->guest_id }}">
                                                        <input type="hidden" name="event" value="{{ $ceremony }}">

                                                        <select name="meal" id="meal">
                                                            <option disabled selected>Choose Menu</option>
                                                            <option value="Beef" {{ $current_guestdata_other[$loop->index]->meal == 'Beef' ? 'selected' : '' }}>Beef</option>
                                                            <option value="Chicken" {{ $current_guestdata_other[$loop->index]->meal == 'Chicken' ? 'selected' : '' }}>Chicken</option>
                                                            <option value="Child Meal" {{ $current_guestdata_other[$loop->index]->meal == 'Child Meal' ? 'selected' : '' }}>Child Meal</option>
                                                            <option value="Fish" {{ $current_guestdata_other[$loop->index]->meal == 'Fish' ? 'selected' : '' }}>Fish</option>
                                                            <option value="Lamb" {{ $current_guestdata_other[$loop->index]->meal == 'Lamb' ? 'selected' : '' }}>Lamb</option>
                                                            <option value="Pork" {{ $current_guestdata_other[$loop->index]->meal == 'Pork' ? 'selected' : '' }}>Pork</option>
                                                            <option value="Vegetarian" {{ $current_guestdata_other[$loop->index]->meal == 'Vegetarian' ? 'selected' : '' }}>Vegetarian</option>
                                                            <option value="Other" {{ $current_guestdata_other[$loop->index]->meal == 'Other' ? 'selected' : '' }}>Other</option>
                                                        </select>




                                                    </div>
                                                    <div class="col-lg-7 col-sm-12 col-xs-12 col-md-12 checkboxes d-flex w-100 justify-content-between align-content-center align-items-center">

                                                        <label class="radio">
                                                            <input name="attendance_status" type="radio" value="Pending" {{ $current_guestdata_other[$loop->index]->attendance_status == 'Pending' ? 'checked' : '' }} />
                                                            <span>Pending</span>
                                                        </label>

                                                        <label class="radio">
                                                            <input name="attendance_status" type="radio" value="Accept" {{ $current_guestdata_other[$loop->index]->attendance_status == 'Accept' ? 'checked' : '' }} />
                                                            <span>I Accept</span>
                                                        </label>

                                                        <label class="radio">
                                                            <input name="attendance_status" type="radio" value="Reject" {{ $current_guestdata_other[$loop->index]->attendance_status == 'Reject' ? 'checked' : '' }} />
                                                            <span>I Don't Accept</span>
                                                        </label>

                                                            <label class="radio">
                                                                <input name="c_is_drink" type="checkbox" {{ $current_guestdata_other[$loop->index]->c_is_drink ? 'checked' : '' }} />
                                                                <span>Have Drinks?</span>
                                                            </label>

                                                    </div>
                                                    <div class="col-md-2 col-lg-2 col-xl-2 col-sm-12 justify-content-between align-content-center align-items-center">
                                                        <div class="mb-3"><button class="btn btn-sm btn-primary d-block w-100" type="submit">Save</button></div>
                                                    </form>
                                                    </div>
                                                </div>
                                                <hr style="#333 1px solid">
                                                @endif
                                        @endforeach
                                    </li>

                                  </ul>

                        </div>
                    </div>
            @endif



                </div>
            </div>
        </div>
    </section>

         <!-------------------------------------------Footer Begin---------------------------------------------->


    @include('components.onlyfooter')

    <!-------------------------------------------Footer End---------------------------------------------->


    <script>
      @if(Session::has('message'))
      toastr.options =
      {
          "closeButton" : true,
          "newestOnTop": true,
          "positionClass": "toast-top-right",
          "progressBar" : true,
          "preventDuplicates": true,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
      }
              toastr.success("{{ session('message') }}");
      @endif

      @if(Session::has('error'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
              toastr.error("{{ session('error') }}");
      @endif

      @if(Session::has('info'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
              toastr.info("{{ session('info') }}");
      @endif

      @if(Session::has('warning'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
              toastr.warning("{{ session('warning') }}");
      @endif
    </script>


    <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/aos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {

        $("#multiguests").select2({
            placeholder: "Select Guests",
            allowClear: true,
            multiple: true,
        });
    });
    </script>



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
    <script src="{{ asset('js/contact.js') }}"></script>
</body>
</html>
