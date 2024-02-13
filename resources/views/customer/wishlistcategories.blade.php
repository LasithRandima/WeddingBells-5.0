<?php
use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

$categories= DB::table('vendor_categories')->limit(6)->get();
$allCategories= DB::table('vendor_categories')->get();
$topAds= DB::table('advertisements')->where('ad_type', '=', '1')->limit(8)->get();

// $website_url = DB::scalar('vendors')->select('v_website_url')->where('c_id', '=', AUTH::id());


$initials ='';

if (Auth::user()) {
    $name = Auth::user()->name; // replace this with the actual name from the database
    $parts = explode(' ', $name); // split the name into parts using the space character as the separator
    $first_letter = strtoupper(substr($parts[0], 0, 1)); // get the first letter of the first name and convert it to uppercase
    $second_letter = isset($parts[1]) ? strtoupper(substr($parts[1], 0, 1)) : ''; // get the first letter of the second name and convert it to uppercase if it exists
    $initials = $first_letter . $second_letter; // concatenate the two initials
}

// $categories= DB::table('vendor_categories')->limit(6)->get();
// $topAds= DB::table('advertisements')->limit(8)->get();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Bells</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/jquery.bxslider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footernav.css') }}">


    <style>
        .card {
    border: 1px solid #ccc;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.card:hover {
    transform: translateY(-5px); /* Add a slight lift effect on hover */
}


.card-body {
    display: flex;
    justify-content: center;
	flex-direction: column;
    align-items: center;
}
.card-img-top {
    max-height: 60px; /* Adjust the height to your preference */
    width: auto;
	display: block;
    margin:10px;


}


.about_grid {
	text-align: center;
	padding: 20px;
	width: 30%;
	transition: 0.5 all;
	-webkit-transition: 0.5 all;
	-moz-transition: 0.5 all;
	-o-transition: 0.5 all;
	-ms-transition: 0.5 all;
	margin-top: 50px;
	margin-right: 10px;
	margin-bottom: 0px;
	border: 8px solid white;
	box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}
.about_grid:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5); /* Adjust the opacity to your preference */
    z-index: -1;
}

.about_grid h4 {
	color: #f2f2f2;

}

.about_grid h4, .about_grid p {
    color: #fff;
}

.about_grid .cat-pargraph {
	font-size: 16px;
}
.about_grid p {
	padding: 0px;
	color: #fff;
	margin-bottom: 15px;
	visibility: hidden;
	text-align: justify;
}

.about_grid i {
	font-size: 24px;
	color: #fff;
	margin-bottom: 10px;

}

.about_grid i:hover {
	color: rgb(208, 148, 234)1678;
	transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.about_grid:hover {
	box-shadow: 2px 15px 70px rgba(0, 0, 0, 0.75);
	-webkit-box-shadow: 2px 15px 70px rgba(0, 0, 0, 0.75);
	-o-box-shadow: 2px 15px 70px rgba(0, 0, 0, 0.75);
	-moz-box-shadow: 2px 15px 70px rgba(0, 0, 0, 0.75);
	-ms-box-shadow: 2px 15px 70px rgba(0, 0, 0, 0.75);
	transform: translateY(-5px); /* Add a slight lift effect */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.container.d-flex.justify-content-center.mt-2 {
    margin-top: 0.5rem !important;
  }
  .more-bttn {
    display: inline-block !important;
    margin: 10px 0 !important;
    padding: 10px 20px !important;
    border: 3px solid #D4AF37 !important;
    border-radius: 8px !important;
    font-weight: bold !important;
    background: transparent !important;
    color: #fff !important;
    text-decoration: none !important;
    cursor: pointer !important;
    text-align: center !important;
    transition: background 0.3s, color 0.3s, border-color 0.3s !important;
}

.more-bttn:hover {
    background: #C0C0C0 !important;
    color: #000 !important;
}


  .more-dark-bttn {
    display: inline-block;
    margin-top: 10px;
	margin-bottom: 10px;
    padding: 10px 20px;
	border: none;
	font-weight: bold;
	background: #000;
	color: #fff;
	text-decoration: none;
	cursor: pointer;
	text-align: center;
	transition: background 0.3s, color 0.3s;
}

.more-dark-bttn:hover {
    color:#D4AF37 ;
	background: #6f3b97;
    text-decoration: none;
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
    font-size: 22px; /* Adjust font size */
    margin-bottom: 10px; /* Adjust margin for spacing */
}


.about p {
    padding: 10px 30px;
    text-align: justify;
    font-size: 18px;
    line-height: 1.6;
}
    </style>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

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


    <div class="container" style="margin-top: 130px; margin-bottom:130px">
        <div class="about">
            <h1 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50" class="text-center">Sweet Wishlist Where Heart's Desires Reside</h1>

            <h3 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50" class="text-center">Capture Your Dreams, Store cherished favorites from all wedding categories<br> in one place</h3>

            <p data-aos="zoom-in" class="text-center lead mb-5">
                Step into 'Sweet Wishlist,' where every heartbeat finds a cherished place. Save and savor your dream wedding details—vendors, jewelry, dresses, photographers—all in one enchanting space. Begin crafting your perfect day with us!.
            </p>
        </div>


           <div class="row" >


                    @foreach ($wishlistAds as $wishlistAd)
                    @php
                    $ad_id = DB::Table('client_wishlists')->select('ad_id')->where('c_id', Auth::id())->get();
                    $category_ad = DB::Table('advertisements')->select('category_id')->where('id', $wishlistAd->ad_id)->value('category_id');
                    @endphp
                    @endforeach

                    @foreach ($allCategories as $category)
                    @php
                        $imagePath = public_path("images/categories/Category_image/{$category->Category_image}");
                        $iconPath = public_path("images/categories/Category_icon/{$category->Category_icon}");

                        $imageUrl = file_exists($imagePath) ? asset("images/categories/Category_image/{$category->Category_image}") : asset("images/categories/Category_image/default_category_image.jpg");
                        $iconUrl = file_exists($iconPath) ? asset("images/categories/Category_icon/{$category->Category_icon}") : asset("images/categories/Category_icon/default_category_icon.png");

                        $iconClass = $category->Category_icon ? '' : 'fa fa-heart'; // Default icon class if not specified client_wishlists

                        // $adCategory = DB::Table('advertisements')->where('ad_category', '=', $category->Category_name)->get();

                        $ad_count = DB::Table('client_wishlists')->where('cat_id', $category->id)->where('c_id', Auth::id())->count();
                    @endphp

                    <div class="col-md-4 mb-4">
                        <div class="about_grid position-relative category_tiles_image" style="background-color: rgb(213, 122, 252); background-image: url('{{ $imageUrl }}'); background-size: cover; background-position: center center; width:100%; height: 300px; opacity: 1; visibility: inherit; z-index: 20; border: 2px solid #fff; box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.5);" data-aos="zoom-in" data-aos-duration="2000">
                            <div class="position-absolute" style="top: 20px; left: 50%; transform: translateX(-50%); background-color: #fff; border-radius: 50%; padding: 5px;">
                                @if ($category->Category_icon)
                                    <img src="{{ $iconUrl }}" alt="Category Icon" style="width: 40px; height: 40px;">
                                @else
                                    <i class="{{ $iconClass }}" style="font-size: 36px; color: #ff5722;"></i>
                                @endif
                            </div>
                            <h4 class="mb-3 mt-2" style="position: absolute; top: 65px; left: 50%; transform: translateX(-50%);">{{ $category->Category_name }}</h4>
                            <p class="cat-pargraph" style="position: absolute; top: 50px; left: 10px;">{{ $category->Category_description }}</p>
                            @if ($ad_count > 0)
                            <div class="position-absolute" style="bottom: 30px; left: 50%; transform: translateX(-50%);">
                                <a href="{{ route('wishlist.categoryfavourites', $category->id) }}" class="more-dark-bttn" style="color:#fff; text-decoration: none; border-radius: 25px;">
                                    <i class="fas fa-heart me-2 mt-1 pt-2" style="color: #fff; font-size:1.1em;"></i> {{ $ad_count }}
                                </a>
                            </div>
                            @else
                            <div class="position-absolute" style="bottom: 30px; left: 50%; transform: translateX(-50%);">
                                <a href="{{ route('vendorCategories.show', $category->id) }}" class="more-bttn" style="color:#000; text-decoration: none; border-radius: 20px;">
                                    <i class="fas fa-search me-2" style="color: #000; font-size:0.9em;"></i> Search
                                </a>
                            </div>
                            @endif
                            {{-- <div class="position-absolute" style="bottom: 30px; left: 50%; transform: translateX(-50%);">
                                <a href="{{ route('vendorCategories.show', $category->id) }}" class="more-bttn" style="color:#000; text-decoration: none; border-radius: 20px;">
                                    <i class="fas fa-search me-2" style="color: #000; font-size:0.9em;"></i> Search
                                </a>
                            </div> --}}
                        </div>
                    </div>
                @endforeach

                 <div class="container d-flex justify-content-center">
                    <a  href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-block" style="margin-top: 5rem !important">
                        Home
                      </a>
                 </div>





           </div>
      </div>
    </div>


    @include('components.onlyfooter')

<script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/calendar.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dropdown.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>

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

<script src="{{ asset('js/smooth-scroll.js') }}"></script>
<script>
	var scroll = new SmoothScroll('a[href*="#"]');
</script>

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


</body>
</html>

