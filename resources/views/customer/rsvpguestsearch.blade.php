<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
$current_date_time = Carbon::now()->toDateTimeString();

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
    <link rel="stylesheet" href="{{ asset('css/fullsearchbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
       @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Permanent+Marker&display=swap');

        .monster {
            font-family: 'Montserrat', sans-serif;
        }

        .perment{
            font-size: 120px;
            font-family: 'Permanent Marker', cursive;
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
                    <p class="w-lg-50">To confirm your attendance to the wedding, just enter your name and click on Search. Your name will appear and then just tell whether or not you are coming.</p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column align-items-center">

                            {{-- <form class="" method="post" style="width: 100%">
                                <div class="input-group">
                                    <div class="form-outline" data-mdb-input-init>
                                      <input type="search" id="form1" class="form-control" />
                                      <label class="form-label" for="form1">Search</label>
                                    </div>
                                    <button type="button" class="btn btn-primary" data-mdb-ripple-init>
                                      <i class="fas fa-search"></i>
                                    </button>
                                  </div>
                            </form> --}}


                            <div class="" id="quicksearch">
                                <form action="{{ route('guestconfirm.rsvpsearch') }}" method="POST">
                                    @csrf
                                {{-- <h1 class="searchh1" data-aos="fade-up" data-aos-duration="2000">Find <span class="searcher">VENDORS</span> THAT YOU <span class="searcher">WANT</span></h1> --}}
                                <div class="form-box">

                                  <input class="search-field location" name="first_name" type="text" placeholder="First Name"/>
                                  <input class="search-field location" name="last_name" type="text" placeholder="Last Name"/>
                                  <button type="submit" class="search-btn">Search</button>

                                </div>
                              </form>

                              <form action="{{ route('guestconfirm.rsvpguestconfirm') }}" method="POST">
                                @csrf
                                <div class="form-box">

                                    @if ($guests !== null)
                                    @forelse ($guests as $guest)
                                        <div class="my-4">
                                            <label class="radio">
                                                <input name="selected_guest" type="radio" value="{{ $guest->id }}"/>
                                                <span>{{ $guest->g_first_name }} {{ $guest->g_last_name }}</span>
                                            </label>
                                        </div>
                                    @empty
                                        <p>No Guest Found</p>
                                    @endforelse
                                @endif

                                @if ($guests !== null)
                                  <button type="submit" class="search-btn mt-3">Continue</button>
                                @endif
                                </div>
                              </form>
                            </div>
                        </div>
                    </div>
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
