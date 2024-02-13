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
    <link rel="stylesheet" href="{{ asset('css/template2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .btn-violet {
        background-color: violet;
        color: white; /* Optionally, set text color to contrast with the background */
        }
        .more-bttns, .more-larges {
    border: 2px solid #9012f1; /* Border color */
    background-color: #9012f1;
    color: #fff;
}

.more-bttns:hover, .more-larges:hover {
    background-color: #D4AF37;
    border-color: #D4AF37;
    color: #333;
}


.more-bttns {
    display: inline-block;
    margin-top: 10px;
	margin-bottom: 10px;
    padding: 10px 20px;

    text-align: center;
    text-decoration: none;
    cursor: pointer;
    background-color: #9012f1;
    color: #fff;
    transition: background 0.3s, color 0.3s;
}
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


      <section class="py-4 py-xl-5" style="margin-top: 80px;">
        <form action="{{ route('rsvp.send') }}" method="POST">
            @csrf
            @method('PATCH')
            {{-- {{ method_field('PATCH') }} --}}
        <div class="container-fluid px-5">
            <div class="row justify-content-center align-content-center align-items-stretch">
                <div class="col-md-5 col-sm-10 align-self-center" style="margin-right: 14px; margin-top:15px; border-width: 1.4px; border-style: solid;">
                    <div style="text-align: center;" class="mt-3">
                        <img src="{{ asset('images/logo/requestConfirm-en_GB.gif') }}" width="305" height="129" style="margin-bottom: 31px;">
                        <div class="d-md-flex flex-column justify-content-md-center align-items-md-center">

                                <h4><strong><span style="color: rgb(34, 34, 34);">1. Personalise your message</span></strong><br><br></h4>
                                <input type="hidden" name="mail_sent_at" value="{{ $current_date_time }}">
                                <input type="hidden" name="is_invited" value=1>
                                <textarea name="invite_msg" class="form-controls" rows="10" style="width: 90%">Hello, As you know, on {{ $client[0]->wed_date }}. We are getting married! And you are invited, of course. We'd like you to confirm your mailing address as soon as possible through this link:</textarea>


                        </div>
                    </div>
                    <div class="d-lg-flex justify-content-lg-center align-items-lg-center" style="margin-top: 41px;">
                        <a class="btn btn-primary text-center d-lg-flex align-items-lg-center" href="{{ env('APP_URL') }}/rsvpsearched" type="button" disabled>RSVP</a>
                    </div>
                    <div>
                        <p class="text-center" style="margin-top: 54px; margin-bottom: 30px;">Thank you very much!<br><br>{{ $client[0]->c_name }} & {{ $client[0]->partner_name }}</p>
                    </div>
                </div>
                <div class="col-md-5 col-sm-10" style="margin-left: 14px; margin-top:15px; border-width: 1.4px; border-style: solid;">
                        <div>
                            <h4><br><strong><span style="color: rgb(34, 34, 34);">2. Send it to your guests</span></strong><br><br></h4>
                            <p class="text-muted" style=""><br><strong><span style="">Select your guests:</span></strong><br><br></p>
                            {{-- <div class="mb-3"><label class="form-label" for="multiguests">Search Guests</label></div> --}}
                            <select name="guestids[]" id="multiguests" class="form-control" style="width: 100%" multiple="multiple">

                                @foreach ($clientGuests as $guest)
                                    <option class="form-control" value="{{ $guest->id }}">{{ $guest->g_first_name  }}  {{ $guest->g_last_name  }}</option>
                                @endforeach
                            </select>
                        </div>

                            {{-- <div class="mb-3"><button class="btn btn-primary" type="submit">Send </button></div> --}}
                            <div class="alert alert-warning mt-5 text-dark" style="background-color: #e9dff0; margin-top:60px;"  role="alert">
                               <p>Kindly be advised that if your name does not appear in the dropdown menu, it may be due to either an invalid email address or the absence of an invitation to any ceremony. To have your name displayed, please ensure that your email is valid and that you have received an invitation.</p>

                               <p>Thank you for your understanding and cooperation.</p>
                              </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container px-5 d-lg-flex justify-content-lg-center align-items-lg-center mt-5"><button class="more-bttns w-100" type="submit">Send</button></div>
    </form>
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
