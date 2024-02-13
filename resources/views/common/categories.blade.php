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
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


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
        <h1 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50" class="display-5 text-center mb-3">Every Love Journey Starts with a Dream, <br> Let Us Turn Yours into a Romantic Symphony.</h1>

        <h3 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50" class="text-center mb-5" style="color: #B76E79">Highly Sought-After Wedding Service Categories</h3>

        <p data-aos="zoom-in" class="text-center lead mb-5">
            "Dive into wedding planning – a wild ride of love and chaos! But fear not, our perfect wedding directory is here to turn chaos into charm. Find everything in one place – from wild ideas to must-have details. Because who needs stress when you've got a one-stop shop for wedding magic? Let the fun begin!".
        </p>

           <div class="row" >

                    @foreach ($allCategories as $category)
                    @php
                        $imagePath = public_path("images/categories/Category_image/{$category->Category_image}");
                        $iconPath = public_path("images/categories/Category_icon/{$category->Category_icon}");

                        $imageUrl = file_exists($imagePath) ? asset("images/categories/Category_image/{$category->Category_image}") : asset("images/categories/Category_image/default_category_image.jpg");
                        $iconUrl = file_exists($iconPath) ? asset("images/categories/Category_icon/{$category->Category_icon}") : asset("images/categories/Category_icon/default_category_icon.png");

                        $iconClass = $category->Category_icon ? '' : 'fa fa-heart'; // Default icon class if not specified
                    @endphp

                    <div class="col-md-4 mb-4">
                        <div class="about_grid position-relative category_tiles_image" style="background-color: rgb(216, 100, 245); background-image: url('{{ $imageUrl }}'); background-size: cover; background-position: center center; width:100%; height: 500px; opacity: 1; visibility: inherit; z-index: 20; border: 2px solid #fff; box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.5);" data-aos="zoom-in" data-aos-duration="2000">
                            <div class="position-absolute" style="top: 10px; left: 10px; background-color: #fff; border-radius: 50%; padding: 5px;">
                                @if ($category->Category_icon)
                                    <img src="{{ $iconUrl }}" alt="Category Icon" style="width: 50px; height: 50px;">
                                @else
                                    <i class="{{ $iconClass }}" style="font-size: 36px; color: #ff5722;"></i>
                                @endif
                            </div>
                            <h4 class="mb-3 mt-4" style="position: absolute; top: 10px; left: 70px;">{{ $category->Category_name }}</h4>
                            <p class="cat-pargraph" style="position: absolute; top: 50px; left: 10px;">{{ $category->Category_description }}</p>
                            <div class="position-absolute" style="bottom: 30px; left: 50%; transform: translateX(-50%);">
                                <a href="{{ route('vendorCategories.show', $category->id) }}" class="more-bttn">
                                    View More
                                </a>
                            </div>
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

