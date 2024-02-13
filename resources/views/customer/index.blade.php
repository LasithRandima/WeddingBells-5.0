<?php
use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

$categories= DB::table('vendor_categories')->limit(6)->get();
$allCategories= DB::table('vendor_categories')->get();
$topAds= DB::table('advertisements')->where('ad_type', '=', '1')->where('approrval_status', '=', 'published')->limit(8)->get();

$wedding_date = DB::table('clients')
        ->select('wed_date')
        ->where('user_id', '=', Auth::id())
        ->value('wed_date');



// $website_url = DB::scalar('vendors')->select('v_website_url')->where('c_id', '=', AUTH::id());


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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wedding Bells</title>

    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastify.min.css') }}" type="text/css" />
    <script type="text/javascript" src="{{ asset('js/toastify-js.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



    <style>
        .heart-position {
            position: relative;
        }

        .heartIcon {
            position: absolute;
            top: 10px; /* Adjust the top position as needed */
            right: 10px; /* Adjust the right position as needed */
            z-index: 100;
            cursor: pointer;
        }
        .testimonial .description {
          height: 200px; /* Adjust the height as needed */
          overflow: hidden;
        }



        .inner{
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                min-height: 320px !important;
                max-height: 320px !important;
                overflow: hidden;
                }

        .inner img{
                min-height: 320px !important;
                max-height: 320px !important;
                width: auto;
                object-fit: scale-down;
                /* background-position: center;
                background-repeat: no-repeat;
                background-size: contain; */
                transition: all 1.5s ease;
                }

        .inner:hover img{
                transform:scale(1.5);
                }

      </style>

@livewireStyles



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




  <!-- --------------------------------------------------navbar---------------------------------------------------------------------------- -->

@include('components.onlynav');



<!-- --------------------------------------------------slider---------------------------------------------------------------------------- -->

<x-slider></x-slider>


<!-- ----------------------------------------------------------modal----------------------------------------------------- -->
<!-- Modal slider 1  -->
<div class="modal fade" id="slider1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Welcome To WeddingBells</h5>                                                                                                                                          z</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
              <img  src="images/slider/Index/1.png" alt="">
              <p>Step into a world of dreams and love with Wedding Bells. Our warm modal slider invites you to explore the magic of planning your perfect celebration. From enchanting decor to top-notch vendors, we're here to turn your unique love story into an extraordinary reality. Welcome to Wedding Bells, where the joyous adventure of wedding planning begins.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>



<!-- Modal slider 2  -->
<div class="modal fade" id="slider2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Find Vendors</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
              <img  src="images/slider/Index/2.png" alt="">
              <p>Discover your dream team of wedding vendors with Wedding Bells. Our modal slider introduces you to a world of top-notch professionals ready to bring your vision to life. Explore a curated selection of venues, photographers, and more, all in one place. Begin your journey to a flawless celebration – find your perfect vendors with Wedding Bells</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>






<!-- Modal slider 3  -->
<div class="modal fade" id="slider3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADVERTISE WITH US</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                  <img  src="images/slider/Index/3.jpg" alt="">
                  <p>Elevate your brand and connect with a community of joyous celebrations. Advertise with Wedding Bells and showcase your services to couples seeking the finest for their special day. Reach a captivated audience of soon-to-be-weds and industry enthusiasts. Join us in making every celebration extraordinary – advertise with Wedding Bells today</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
        </div>
      </div>
</div>


<!-- Modal slider 4  -->
<div class="modal fade" id="slider4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">CONTACT US</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
              <img  src="images/slider/Index/4.jpg" alt="">
              <p> Have questions or want to explore partnership opportunities? Contact us at Wedding Bells! Our team is here to assist you with any inquiries, collaborations, or support you may need. We value your connection and are dedicated to making your experience with Wedding Bells seamless. Reach out and let’s create magic together!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>


<!-- Modal slider 5  -->
<div class="modal fade" id="slider5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">WHO WE ARE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
              <img  src="images/slider/Index/5.png" alt="">
              <p>At Wedding Bells, we are more than just a platform – we are your dedicated companions on the journey to your dream wedding. Our passion lies in crafting unforgettable moments, ensuring that every detail is as special as your love story. Discover the essence of elegance, creativity, and seamless planning with Wedding Bells. Let's embark on this enchanting adventure together!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>


<!-- Modal slider 6  -->
<div class="modal fade" id="slider6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Sri Lanka's Premier Wedding Planning Hub and Ultimate Resource Directory</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
              <img  src="images/slider/Index/6.png" alt="">
              <p>"Unveiling Sri Lanka's Premier Wedding Planning Hub and Ultimate Resource Directory. Beyond a comprehensive directory, we provide essential digital tools to streamline your wedding planning chaos. Elevate your celebration effortlessly – discover top-tier vendors, exquisite venues, and invaluable resources. Let us simplify your journey to marital bliss with cutting-edge digital solutions, ensuring every detail is as seamless as your love story. Your dream wedding starts here, where innovation meets elegance in the heart of Sri Lanka's vibrant wedding scene</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>




<!----------------------------------- services---------------------------------------------->

<div class="container">
<div class="partners">


    <h1 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50">Enjoy Effortless Wedding Planning, Anytime, Anywhere!</h1>
    <h3 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50" >Sign up for Wedding Bells, plan your dream day, all for free!.</h3>
  {{-- <p>{{ Session::get('homePageRedirectUrl') }}</p> --}}
</div>

<!-- Card deck -->
<div class="card-deck main-ser">

  <!-- Card -->
  <div class="card mb-3">

    <!--Card image-->
    <div class="view overlay">
      <img class="card-img-top" src="images/icons/budgetplanner.png"
        alt="Card image cap">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <!--Card content-->
    <div class="card-body card-body-cascade text-center pb-0">

      <!--Title-->
      <h4 class="card-title">Budget Planner</h4>
      <!--Text-->
      <p class="card-text">Let us run the numbers and keep your spending under control.</p>
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->

    @if (Auth::user())
      @if($wedding_date)
      <a href="{{ route('budgetplanner') }}" class="more-bttns">Read more</a>
      @else
      <a href="{{ route('customerreg') }}" class="more-bttns">Complete Registeration to Begin</a>
      @endif
    @else
      @php
          $homePageRedirectUrl = route('budgetplanner');
          Session::put('homePageRedirectUrl', $homePageRedirectUrl);
      @endphp

      <a href="{{ route('login') }}" class="more-bttns">Read more</a>
    @endif




    </div>

  </div>
  <!-- Card -->

  <!-- Card -->
  <div class="card mb-3">

    <!--Card image-->
    <div class="view overlay">
      <img class="card-img-top" src="images/icons/guestlist.png"
        alt="Card image cap">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <!--Card content-->
    <div class="card-body card-body-cascade text-center pb-0">

     <!--Title-->
     <h4 class="card-title">Guest List</h4>
     <!--Text-->
     <p class="card-text">Create and manage your Guest List and receive RSVPs, all in one spot.</p>
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
    @if (Auth::user())
      @if($wedding_date)
      <a href="{{ route('guestlistnew') }}" class="more-bttns">Read more</a>
      @else
      <a href="{{ route('customerreg') }}" class="more-bttns">Complete Registeration to Begin</a>
      @endif
    @else
      @php
          $homePageRedirectUrl =route('guestlist');
          Session::put('homePageRedirectUrl', $homePageRedirectUrl);
      @endphp

      <a href="{{ route('login') }}" class="more-bttns">Read more</a>
    @endif


    </div>

  </div>
  <!-- Card -->

  <!-- Card -->
  <div class="card mb-3">

    <!--Card image-->
    <div class="view overlay">
      <img class="card-img-top" src="images/icons/Checklist.png"
        alt="Card image cap">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <!--Card content-->
    <div class="card-body card-body card-body-cascade text-center pb-0">

     <!--Title-->
     <h4 class="card-title">Check List</h4>
     <!--Text-->
     <p class="card-text">The ultimate wedding checklist to make sure everything gets done.</p>
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->

    @if (Auth::user())
      @if($wedding_date)
      <a href="{{ url('/checklist') }}" class="more-bttns">Read more</a>
      @else
      <a href="{{ route('customerreg') }}" class="more-bttns">Complete Registeration to Begin</a>
      @endif
    @else
      @php
          $homePageRedirectUrl = url('/checklist');
          Session::put('homePageRedirectUrl', $homePageRedirectUrl);
      @endphp

      <a href="{{ route('login') }}" class="more-bttns">Read more</a>
    @endif


    </div>

  </div>
  <!-- Card -->

  <div class="card mb-3">

    <!--Card image-->
    <div class="view overlay">
      <img class="card-img-top" src="images/icons/eventplanner.png"
        alt="Card image cap">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <!--Card content-->
    <div class="card-body card-body card-body-cascade text-center pb-0">

      <!--Title-->
      <h4 class="card-title">Event Planner</h4>
      <!--Text-->
      <p class="card-text">Craft a dream team of wedding vendors, all in one place..</p>
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
    @if (Auth::user())
      @if($wedding_date)
      <a href="{{ route('customer.calendar.index') }}" class="more-bttns">Read more</a>
      @else
      <a href="{{ route('customerreg') }}" class="more-bttns">Complete Registeration to Begin</a>
      @endif
    @else
      @php
          $homePageRedirectUrl = route('customer.calendar.index');
          Session::put('homePageRedirectUrl', $homePageRedirectUrl);
      @endphp

      <a href="{{ route('login') }}" class="more-bttns">Read more</a>
    @endif


    </div>

  </div>
  <!-- Card -->

</div>
<!-- Card deck -->

</div>



<!-- -------------------------------------------------------------about------------------------------------------------------- -->


<div class="container ">


<!------------------------------------------Searchbar---------------------------------------->
<section class="search-bar">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-sm-12 col-md-12 mx-auto">
            <div class="p-1 bg-light shadow-sm">

                <form action="{{ route('ads.index') }}" method="GET">
                    <div class="input-group">
                    <input type="search" name="vendorName" placeholder="search by vendor Name" class="form-control searchbarz">
                    <input type="hidden" name="vCategory">
                    <div class="input-group-append mt-1">
                      <!-- Example single danger button -->
                        <div class="btn-group">
                          <button type="button" class="btn btn-outline-secondary ven_cat_btn dropdown-toggle searchdropbtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-tag mr-2"></i> </i>Vendor category
                          </button>
                          <div class="dropdown-menu layer">


                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="fas fa-user-friends"></i> All Vendors</a>
                            @forelse ($allCategories as $category)
                            <a class="dropdown-item" data-value="{{ $category->id }}">{{ $category->Category_name }}</a>
                            @empty
                            <a class="dropdown-item">No Categories</a>
                            @endforelse
                          </div>
                        </div>
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-link"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    </div>
                </form>

              </div>

        </div>


    </div>
  </div>
</section>



  <div class="about" id="about">
    <h1 data-aos="zoom-in">Every Love Story Begins with a Dream,<br> Let Us Bring Yours to Life</h1>
    <h3 data-aos="zoom-in">POPULAR WEDDING SERVICE CATEGORIES</h3>
    <p data-aos="zoom-in">
      "Crafting your dream wedding? Let us be your guide! Discover a world of ideas and essentials in one place. Elevate your celebration with ease and magic. Your journey starts here." </p>
       <div class="row" >

             @foreach ($categories as $category)
                    @php
                    $imagePath = public_path("images/categories/Category_image/{$category->Category_image}");
                    $iconPath = public_path("images/categories/Category_icon/{$category->Category_icon}");

                    $imageUrl = file_exists($imagePath) ? asset("images/categories/Category_image/{$category->Category_image}") : asset('storage/default_images/default_category_image.jpg');
                    $iconUrl = file_exists($iconPath) ? asset("images/categories/Category_icon/{$category->Category_icon}") : asset('storage/default_images/default_category_icon.png');

                    $iconClass = $category->Category_icon ? '' : 'fa fa-heart'; // Default icon class if not specified
                    @endphp

                    <div class="col-md-4 mb-4">
                        <div class="about_grid position-relative category_tiles_image" style="background-color: #b5a0d5; background-image: url({{ $imageUrl }} ); background-size: cover; background-position: center center; width:100%; height: 500px; opacity: 1; visibility: inherit; z-index: 20; border: 2px solid #fff; box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.5);" data-aos="zoom-in" data-aos-duration="2000">
                            <div class="position-absolute" style="top: 10px; left: 10px; background-color: #fff; border-radius: 50%; padding: 5px;">
                                @if ($category->Category_icon)
                                    <img src="{{ $iconUrl }}" alt="Category Icon" style="width: 50px; height: 50px;">
                                @else
                                    <i class="{{ $iconClass }}" style="font-size: 36px; color: #ff5722;"></i>
                                @endif
                            </div>
                            <h4 class="mb-3 mt-4" style="position: absolute; top: 10px; left: 70px;">{{$category->Category_name}}</h4>
                            <p class="cat-pargraph" style="position: absolute; top: 50px; left: 10px;">{{$category->Category_description}}</p>
                            <div class="position-absolute" style="bottom: 30px; left: 50%; transform: translateX(-50%);">
                                <a href="{{ route('vendorCategories.show', $category->id) }}" class="more-bttn">
                                    View More
                                </a>
                            </div>
                        </div>
                    </div>

             @endforeach

             <div class="container d-flex justify-content-center">
                <a href="{{ route('vendorCategories.index') }}" class="btn btn-outline-secondary btn-block" style="margin-top: 3rem !important; margin-bottom: 3rem !important">
                    View All Categories
                  </a>
             </div>





       </div>
  </div>
</div>





<!-- ----------------------------------------------------------Partners Advertistment------------------------------------------------------------------------ -->
<br><br><br><br><br><br><br><br>
<div class="clr"></div>
@if($topAds)
<section class="Parner_ads_area_v2" style="padding-top: 20px !important; ">
<div class="container partnerads" id="partner">
  <div class="partners_v2" >

    <h1 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50">FEATURED ADVERTISEMENTS </h1>
    <h3 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50" >Our Quality Partners</h3>
  </div>
  <div class="row" data-aos="zoom-in" data-aos-duration="1000">
    <div class="col-md-12">

      <div id="product-slider" class="owl-carousel">

        @foreach ($topAds as $topAd)

        <div class="post-slide">
            <ul class="post-info">
           <?php
            $website_url = DB::table('vendors')
                 ->select('v_website_url')
                 ->where('user_id', '=', $topAd->v_id)
                 ->value('v_website_url');
            ?>


              <div class="d-flex justify-content-between align-content-center">
                <li><i class="fa fa-tag"></i><a href="{{ $website_url }}">Visit</a></li>

                {{-- <li>

                </li> --}}

                @auth

                    @livewire('TopAdWishlist', ['adId' => $topAd->id, 'clientId' => $topAd->actual_v_id])

                @endauth




              </div>



            </ul>

            {{-- <div class="post-img" >
              <img src="{{ $topAd->ad_image ? asset('/storage/'.$topAd->ad_image) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="">
              <a href="" class="read">read more</a>
            </div> --}}

            <div class="inner">
                <img src="{{ $topAd->ad_image ? asset('/storage/'.$topAd->ad_image) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="">
                {{-- <a href="" class="read">read more</a> --}}
              </div>

            {{-- <div class="inner">
                <img class="card-img-top" src="{{ $normalAd->ad_image ? asset('/storage/'.$normalAd->ad_image) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="Card image cap">
            </div> --}}

            <div class="post-content">
              <span class="post-author">
                <a href=""><img src="{{ $topAd->logo_image ? asset('/storage/'.$topAd->logo_image) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="" class="post-author-img"></a>
              </span>
              <a href="{{ route('advertistments.show', $topAd->id) }}" class="btn btn-outline-secondary btn-block my-1">
                View More
              </a>
              <h3 class="post-title">{{ $topAd->ad_title }}</h3>

              {{-- <p class="post-description"> {!! html_entity_decode($topAd->about) !!}</p> --}}
            </div>
          </div>
        @endforeach



      </div>
    </div>
  </div>
</div>
</section>
@endif


<!-- -----------------------------------------------------Full Screen Video Banner--------------------------------------------------------- -->
<br>

<section class="showcase">
    <div class="video-container">
        <video src="{{ asset('videos/Wb Promo Video Web Size 2.mp4') }}" autoplay muted loop></video>
    </div>
    {{-- <div class="content">
        <h1 class="videoh1">Experience Something Extraordinary</h1>
        <h3 data-aos="zoom-in">We bring your ideas to life</h3>
        <a href="#quicksearch" class="btn2" data-aos="flip-left" data-aos-duration="2000">Find</a>
    </div> --}}

    <!------------------------------------------Searchbar
<section class="search-bar" data-aos="fade-up" data-aos-duration="3000">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
          <form>
            <div class="p-1 bg-light shadow-sm">
              <div class="input-group">
                <input type="search" placeholder="search by vendor name" class="form-control">
                <div class="input-group-append">

                    <div class="btn-group">
                      <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-tag mr-2"></i>Vendor category
                      </button>
                      <div class="dropdown-menu layer">
                        <a class="dropdown-item" href="#"><i class="fas fa-female mr-2"></i>Bridal Wear</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-user-secret mr-2"></i>Grooms wear</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-user-circle mr-2"></i>Beauticians/Saloons</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-camera-retro mr-2"></i>Studios</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-hotel  mr-2"></i>Wedding Venues</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-birthday-cake mr-2"></i>Cake & Cake Structures</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="fas fa-user-friends"></i>All Vendors</a>
                      </div>
                    </div>
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-link"><i class="fas fa-search"></i></button>
                    </div>
                </div>
              </div>
            </div>
          </form>
      </div>

    </div>
  </div>
</section>
---------------------------------------->
</section>


<div class="searchbarheader" id="quicksearch">
    <form action="{{ route('advertistments.index') }}" method="GET">
    <h1 class="searchh1" data-aos="fade-up" data-aos-duration="2000">Find <span class="searcher">VENDORS</span> THAT YOU <span class="searcher">WANT</span></h1>
    <div class="form-box">


            <select class="search-field vendor" name="category" id="select">
              <option disable hidden value="">Vendor Categories</option>
              @forelse ($allCategories as $category)
              <option value="{{ $category->id }}">{{ $category->Category_name }}</option>
              @empty
              <option value="">No Categories Available</option>
              @endforelse
                </select>
      <input class="search-field location" name="location" type="text" placeholder="Location"/>
      <button type="submit" class="search-btn">Find</button>

    </div>
  </form>
</div>


<!-- -----------------------------------------------------About US--------------------------------------------------------- -->


<section id="aboutx">
    <div class="abouts" >

      <h1 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50">ABOUT US</h1>
      <h3 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50">Who We Are</h3>
      <p data-aos="zoom-in">
        Begin your extraordinary journey with Wedding Bells Resource Directory. We're here to transform your special day into an unforgettable celebration of love. Discover everything you need, from bridal attire to stunning venues, all in one place. Take your time, explore, and let the magic unfold. Your dream wedding awaits!
      </p>
    </div>
  </section>

  <section id="aboutus">
    <div class="about-left-col">
      <img src="images/about/24.png" alt="About BG" class="services-img" data-aos="fade-up" data-aos-duration="3000" style="object-fit: contain;">
    </div>

    <div class="about-right-col">
      <div class="about-text">

        <h1 class="mainheader" data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50">WHAT WE OFFER</h1>
        <div class="square"></div>
        <div class="square"></div>
        <div class="square"></div>
        <span class="square"></span>

        <p class="blogpost"  data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50" style="text-align: justify;">
          <strong>Curate your dream team with top-notch wedding experts.</strong><br>
          Discover the crème de la crème for your special day: top professionals, stunning venues, exquisite dresses, and unforgettable honeymoons. We've done the legwork to bring you only the most trusted and recommended suppliers.
        </p>

        <h2 class="blogpost" data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50">A Multitude of Vendors Await Across Diverse Categories</h2>

        <div class="list" data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50">
          <ul class="sideul">
            <li>Bridal Wear</li>
            <li>Groom Wear</li>
            <li>Bridal Saloons</li>
            <li >Wedding Jewelry</li>
            <li >Favours & Gifts</li>
            <li >Wedding Planner</li>
            <li >Wedding Venues</li>
            <li >Wedding Decors</li>
            <li >catering</li>
            <li >Ceremony</li>
            <li >Wedding Cakes</li>
            <li >Stationary</li>
            <li >Music & DJ</li>
            <li >cars & Travel</li>
            <li >Hotel Room Blocks</li>
            <li >Photographers</li>
            <li >Vidographers</li>
            <li >Event Planners</li>
          </ul>
        </div>

        <div class="line">
          <span class="line1"></span><br>
          <span class="line2"></span><br>
          <span class="line3"></span><br>
        </div>
      </div>
    </div>
  </section>



<!------------------------------------ Section: reviews------------------------------------------->







<div class="clearfix"></div>

<div class="partners" >

  <h1 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50">Words from Happy Custormers </h1>
  <h3 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50" >Reviews</h3>
</div>


<div class="demo">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div id="testimonial-slider" class="owl-carousel">
                  <div class="testimonial">
                      <span class="icon fas fa-quote-left"></span>
                      <p class="description">
                        Wedding Bells is fantastic! Looks so beautiful and modern, there was no contest between this and the other registries out there. Easy for me and my partner.".
                      </p>
                      <div class="testimonial-content">
                          <div class="pic"><img src="images/reviews/img 1.jpg" alt=""></div>
                          <h3 class="title"><b>Akash</b></h3>
                          <span class="post"></span>
                      </div>
                  </div>
                  <div class="testimonial">
                      <span class="icon fa fa-quote-left"></span>
                      <p class="description">
                        "Wedding Bells saved us time, stress, and debt! Can't recommend it enough.".
                      </p>
                      <div class="testimonial-content">
                          <div class="pic"><img src="images/reviews/img 2.jpg" alt=""></div>
                          <h3 class="title">Amanda</h3>
                          <span class="post"></span>
                      </div>
                  </div>
                  <div class="testimonial">
                      <span class="icon fa fa-quote-left"></span>
                      <p class="description">
                        "I loved it! The interface was easy and just straight to the point. It also has a very clean look."
                      </p>
                      <div class="testimonial-content">
                          <div class="pic"><img src="images/reviews/img 6.jpg" alt=""></div>
                          <h3 class="title">Anindya</h3>
                          <span class="post"></span>
                      </div>
                  </div>

                  <div class="testimonial">
                    <span class="icon fa fa-quote-left"></span>
                    <p class="description">
                        This Wedding Bells made evrything easy..Keeping track of guests, vendors and managing the rgistry. Super helpful and website has really cute website options
                    </p>
                    <div class="testimonial-content">
                        <div class="pic"><img src="images/reviews/img 4.jpg" alt=""></div>
                        <h3 class="title">Thehas</h3>
                        <span class="post"></span>
                    </div>
                </div>
                <div class="testimonial">
                    <span class="icon fa fa-quote-left"></span>
                    <p class="description">
                      Wedding Bells was so easy to use and seamless throughout! The aesthetic of the app is beautiful, either on mobile or desktop, the personalization is easy, and the payment set up was a breeze! Finally something that looks good, is easy to use, and actually works! I would definitely recommend using Wedding Bells!.
                    </p>
                    <div class="testimonial-content">
                        <div class="pic"><img src="images/reviews/img 5.jpg" alt=""></div>
                        <h3 class="title">Sehara</h3>
                        <span class="post"></span>
                    </div>
                </div>
                <div class="testimonial">
                    <span class="icon fa fa-quote-left "></span>
                    <p class="description">
                      Hitchd has been an absolute breeze to use. We've had such a positive experience - it essentially does all the work for you.Very intuitive and simple to use interface.10/10 would recommend.
                    </p>

                    <div class="testimonial-content">
                        <div class="pic"><img src="images/reviews/img 7.jpg" alt=""></div>
                        <h3 class="title">Methsara</h3>
                        <span class="post"></span>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
</div>


<div id="calendar"></div>





<div class="section">
  <div class="container">
    <div class="comment">
      <div id="disqus_thread"></div>
    </div>

  </div>

</div>


  <!-------------------------------------------Footer Begin---------------------------------------------->


@include('components.onlyfooter')


   <!-------------------------------------------Footer End---------------------------------------------->
   @livewireScripts

   <script>
    window.addEventListener('toastrtopad:info', event => {
       toastr.info(event.detail[0].message);

    })

    window.addEventListener('toastrtopad:error', event => {
        toastr.error(event.detail[0].message);

    })
</script>




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

   {{-- <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script> --}}
   <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/jquery.counterup.min.js') }}"></script>
   {{-- <script type="text/javascript" src="{{ asset('js/calendar.js') }}"></script> --}}
   <script src="{{ asset('js/main.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/dropdown.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>

<script>
    $(document).ready(function() {
      $(".dropdown-item").click(function() {
        var selectedValue = $(this).attr('data-value');
        $("input[name='vCategory']").val(selectedValue);
      });
    });
  </script>

<script>
  $(document).ready(function(){
     $('.dropdown-toggle').dropdown()
 });
</script>

<script type="text/javascript">
  $('.carousel').carousel({
    interval: 4000,

  })
</script>

<script src="js/smooth-scroll.js"></script>
<script>
	var scroll = new SmoothScroll('a[href*="#"]');
</script>

<script type="text/javascript" src="js/aos.js"></script>
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



</body>
</html>
