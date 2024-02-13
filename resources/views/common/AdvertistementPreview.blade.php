<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

$gallery= DB::table('media')->where('v_id', '=', $topAd->v_id)->limit(8)->get();
// var_dump($gallery);
$website_url = DB::table('vendors')
     ->select('v_website_url')
     ->where('user_id', '=', $topAd->v_id)
     ->value('v_website_url');

$wedding_date = DB::table('clients')
        ->select('wed_date')
        ->where('user_id', '=', Auth::id())
        ->value('wed_date');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Listings</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">

    <link rel="stylesheet" href="{{ asset('css/template2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
     alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <style>
      .readbtn:hover{
        text-decoration: none;
        letter-spacing: 1.4px;
        font-weight: 600;
        color: rgb(60, 39, 115);
      }
      .vendorLogo img{
        object-fit: cover;
        width: 100%;
        height: auto;
      }

      .item:hover{
        filter: brightness(75%);
      }

      .item{
        transition: .5s ease-in-out;
      }

      .gallery h1 {
      letter-spacing: 12px;
      margin-bottom: 15px;
      font-size: 19px;
      text-align: center;
    }

    .gallery h3 {
      color: darkred;
      margin-bottom: 100px;
      text-align: center;
    }

    .card-header{
        background: rgb(232, 182, 249);
    }

    .card-header a:link{
      color: #fff;
    }

    .btn-purple{
      background-color: blueviolet;
    }


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

  @include('components.onlynav')






<div class="container my-5">

  <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
    <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
      <h2 class="display-5 fw-bold lh-1">{{ $topAd->ad_title }}</h2>
      <p class="lead">{!! html_entity_decode($topAd->about) !!}</p>
      <p class="lead">{!! html_entity_decode($topAd->service_offered) !!}</p>
      <p class="lead">{!! html_entity_decode($topAd->v_package_details) !!}</p>
      <p class="lead" style="font-size: 19px">Packages Start From : Rs.{{ $topAd->start_price }}</p>
      <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">


        @if (Auth::user())
            @if($wedding_date)
            <a href="{{ route('clientVendorBookings.show', $topAd->id) }}" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Ask For Date</a>
            @else
            <a href="{{ route('customerreg') }}" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Complete registernation for Booking Process</a>
            @endif
        @else
            @php
                $redirectUrl = route('clientVendorBookings.show', $topAd->id);
                Session::put('redirectUrl', $redirectUrl);
            @endphp

            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Ask For Date</a>
@endif


        <button type="button" class="btn btn-outline-secondary btn-lg px-4 mx-2">Add To Wish List</button>
        {{-- <p>{{ Session::get('redirectUrl') }}</p> --}}
      </div>
    </div>
    <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg vendorLogo">
        <img class="rounded-lg-3" src="{{ $topAd->ad_image ? asset('/storage/'.$topAd->ad_image) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="" width="720">
    </div>
  </div>
</div>

<!--
  --------------------------------------------------Modals For Booking-------------------------------------------------------------------------------
 -->




<div class="container my-5">

  <div class="swiper mySwiper">
    <div class="swiper-wrapper mb-3">

        @foreach ($vendorAds as $vendorAd)
        <?php
        $category = DB::table('vendor_categories')
             ->select('Category_name')
             ->where('id', '=', $vendorAd->category_id)
             ->value('Category_name');
        ?>

        <div class="col-md-6 swiper-slide">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
              <div class="col p-4 d-flex flex-column position-static">


                <strong class="d-inline-block mb-2 text-primary">{{ $category  }}</strong>
                <h2 class="mb-0">{{ $vendorAd->ad_title }}</h2>
                <div class="mb-1 text-muted">Price Range : {{ $vendorAd->start_price }}</div>
                {{-- <p class="card-text mb-auto">{!! html_entity_decode($vendorAd->about) !!}</p> --}}
                {{-- <a href="{{ route('topAds.show', $vendorAd->id) }}" class="stretched-link readbtn">Read More</a> --}}

                @if(Route::currentRouteName() === 'topAds.show')
                <a href="{{ route('topAds.show', $vendorAd->id) }}" class="stretched-link readbtn">Read More</a>
                @elseif(Route::currentRouteName() === 'advertistments.show')
                <a href="{{ route('advertistments.show', $vendorAd->id) }}" class="stretched-link readbtn">Read More</a>
                @endif


              </div>
              <div class="col-auto d-none d-lg-block">
                <img src="{{ $vendorAd->ad_image ? asset('/storage/'.$vendorAd->ad_image) : asset('/storage/default_images/default_category_thumb.jpg')  }}" class="rounded-start" alt="..." width="200" height="250px">

              </div>
            </div>
          </div>



        @endforeach



    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>


  <div class="container my-5 gallery">
    <h1 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50">See our Works </h1>
    <h3 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50" >Gallery</h3>
    <div class="row mt-4">

        @forelse ($gallery as $gimage)
        <div class="item col-sm-6 col-md-4 mb-3">
            <a href="{{ $gimage->path ? asset('/storage/'.$gimage->path) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="{{ $gimage->path }}" class="fancybox" data-fancybox="gallery1">
              <img src="{{ $gimage->path ? asset('/storage/'.$gimage->path) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="{{ $gimage->path }}" width="100%" height="100%">
            </a>
          </div>
        @empty
        <div class="alert alert-danger w-100 text-center" role="alert">
            Gallery is empty.
          </div>
        @endforelse





  </div>
  </div>


</div>


    <!-------------------------------------------Footer Begin---------------------------------------------->


    @include('components.onlyfooter')

      <script>
        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
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

      <!-------------------------------------------Footer End---------------------------------------------->



      <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/aos.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/swiper-bundle.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
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
