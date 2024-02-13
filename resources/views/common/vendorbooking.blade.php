

<?php
$category_name = DB::table('vendor_categories')
    ->select('Category_name')
    ->where('id', '=', 1)
    ->value('Category_name');

$wedding_date = DB::table('clients')
    ->select('wed_date')
    ->where('user_id', '=', Auth::id())
    ->value('wed_date');

$wedding_start_time = DB::table('clients')
    ->select('wed_start_time')
    ->where('user_id', '=', Auth::id())
    ->value('wed_start_time');

$wedding_end_time = DB::table('clients')
    ->select('wed_end_time')
    ->where('user_id', '=', Auth::id())
    ->value('wed_end_time');

$phone = DB::table('clients')
    ->select('c_tpno')
    ->where('user_id', '=', Auth::id())
    ->value('c_tpno');

// Decode the JSON string into a PHP array
$data = json_decode($phone, true);

// Check if the array is not empty and has the "c_tpno" key
if (!empty($data) && isset($data[0]['c_tpno'])) {
    $c_tpno = $data[0]['c_tpno'];
    // echo $c_tpno;
} else {
    // echo "No 'c_tpno' found in the JSON array.";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wedding Bells - Request pricing</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
    {{-- <link rel="stylesheet" href="{{ asset('css/footernav.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link href="{{ url('css/bootstrap5.2.3.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}"> --}}
    <link href="{{ url('fonts/fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet">

    <style>
        .btn-grad {
            background-image: linear-gradient(to right, #6a3093 0%, #a044ff  51%, #6a3093  100%);
            margin: 10px;
            padding: 8px 15px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            display: inline-block;
            width: 100%;
          }

          .btn-grad:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }


          .btn-grad-red {
            background-image: linear-gradient(to right, #e53935 0%, #e35d5b  51%, #e53935  100%);
            margin: 10px;
            padding: 8px 15px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;

          }

          .btn-grad-red:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }

          body{
            /* background-image:url("{{ asset('images/bgImages/21529687_6475926.jpg') }}"); */
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
          }


          .abouts h1, h3{
    text-align: center;

}

        .ads{
            background-image:url("{{ asset('images/bgImages/00003.jpg') }}") ;
            background-size: cover;
            margin-top: -80px;
            /* margin-bottom: -80px; */
            height: auto;

        }

        .form-wrapper{
            padding-left: 180px;
            padding-right: 180px;
            padding-bottom: 80px;
        }

        .ads .container{
            margin-top: 100px;
            background-size: cover;
            text-align: center;
            scroll-margin-top: -2vh;
            width: 100vw;
            /* z-index: 2; */
        }
        .ads h1 {
            letter-spacing: 12px;
            margin-bottom: 15px;
            font-size: 19px;
            margin-top: 5%;

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

        .btn{
            margin-top: 30px;
            text-align: center;
            width: 15vw;
            height: 6vh;
            font-size: 1.2em;
            background-color:#501678;
        }
        .btn:hover{
            background:#501678;
            opacity:0.8;
        }
        .Form_container{
        background:rgb(233, 223, 240,0.9);
        /* z-index: 3; */
        }

        @media screen and (max-width:484px) {
        .btn{
            font-size: 0.7em;
            text-align: center;
            padding:1% ;
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

    @include('components.onlynav2')


    <div class="container-fluid ads">
        <div class="container form-wrapper">

            <form action="{{ route('clientVendorBookings.store') }}" method="POST" enctype="multipart/form-data" class="form-group" data-aos="zoom-in">
                @csrf
                <h3 style="padding-top: 80px;"><b>Begin Your Love Story - Submit Your Booking Request</b></h3>
                <p style="color: #000; text-align: justify;">
                  Your reservation with Wedding Bells is a promise of an enchanting celebration. Our team is crafting a personalized experience just for you. Anticipate a magical journey as we work to bring your dream wedding to life. Stay tuned!
              </p>
              <div class="row jumbotron Form_container">
                @if ($errors->any())
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Something is wrong with your input</h4>
                        <hr>
                        <ul class="">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                @endif

                <input type="hidden" name="c_id" value="{{ Auth::id() }}">
                <input type="hidden" name="ad_id" value="{{ $clientVendorBooking }}">
                <input type="hidden" name="ad_vid" value="{{ $advertisementsVendorId }}">
                <input type="hidden" name="top_ad_vid" value="{{  $topAdsVendorId }}">
                {{-- <input type="hidden" name="cat_id" value="{{ $ad_category }}"> --}}
                <input type="hidden" name="categoryid" value="{{  $ad_category }}">

                <div class="col-md-6">
                    <label class="form-label" for="form6Example3">Customer name</label>
                    <input type="text" id="form6Example3" value="{{ Auth::user()->name }}" name="cName" class="form-control" />
                </div>

                <!-- Email input -->
                <div class="col-md-6">
                    <label class="form-label" for="form6Example5">Email</label>
                    <input type="email" id="form6Example5" value="{{ Auth::user()->email }}" name="cEmail" class="form-control" />
                </div>

                <!-- Number input -->
                <div class="col-md-6">
                    <label class="form-label" for="form6Example6">Phone</label>
                
                    <input type="text"  id="form6Example6" name="cPhone" class="form-control" value="{{ $c_tpno  }}" />

                  </div>




                <!-- Text input -->
                <div class="col-md-6">
                    <label class="form-label" for="form6Example4">Event Date</label>
                  <input type="date" id="form6Example4" name="cEventDate" class="form-control" value="{{ $wedding_date }}" />

                </div>


                <div class="col-md-6">
                    <label class="form-label" for="form6Example4">Event Start Time</label>
                    <input type="time" id="form6Example4" name="cEventStartTime" class="form-control" value="{{ $wedding_start_time }}" />

                </div>

                <div class="col-md-6">
                    <label class="form-label" for="form6Example4">Event End Time</label>
                    <input type="time" id="form6Example4" name="cEventEndTime" class="form-control" value="{{ $wedding_end_time }}" />

                </div>

                 <!-- Message input -->
                <div class="col-md-12">
                    <label class="form-label" for="form6Example7">Message</label>
                    <textarea class="form-control" name="cMessage" id="form6Example7" rows="4"></textarea>
                </div>



                <!-- Submit button -->
                <button type="submit" class="btn-grad my-3">Send Inquiry</button>

              </div>
          </form>
      </div>
    </div>





  @include('components.onlyfooter')


    <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/smooth-scroll.js') }}"></script>
    <script src="{{ url('plugins/fslightbox.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>
    <script>
        var scroll = new SmoothScroll('a[href*="#"]');
    </script>

    <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      spaceBetween: 2,
      freeMode: true,
      pagination: false,
    });

    var swiper = new Swiper(".mySwiper2", {
      slidesPerView: 4,
      spaceBetween: 2,
      freeMode: true,
      pagination: false,
    });
      </script>

@livewireScripts
</body>
</html>











