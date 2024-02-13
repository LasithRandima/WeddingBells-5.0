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

  <header>
    <nav class="mynav">
      <a href="{{ url('/') }}"><img src="{{ asset('images/logo/WB_logo_1.svg') }}" alt="logo" class="logo"></a>
        <label for="btn" class="icon">
            <span class="fa fa-bars"></span>
        </label>
        <input type="checkbox"id="btn">
        <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>
                <label for="btn-1" class="shows ">Vendors <span><i class="fa fa-caret-down" aria-hidden="true"></i></span></label>
                <a href="{{ route('advertistments.index') }}">Vendors</a>
                <input type="checkbox" id="btn-1">
                <ul>
                  <li class="itemhidden"><a href="#">Vendors</a></li>
                  @foreach ($allCategories as $category)
                      <li><a href="{{ route('vendorCategories.show', $category->id) }}">{{ $category->Category_name }}</a></li>
                 @endforeach

               </ul>
           </li>




            <li><a href="#quicksearch">Quick Search</a></li>
            @if (Auth::user())
            <li><a href="{{ route('sitePackages.index') }}">Advertise</a></li>
            @else
                @php
                    $redirectUrl = route('sitePackages.index');
                    Session::put('redirectUrl', $redirectUrl);
                @endphp
                <li><a href="{{ route('login') }}">Advertise</a></li>
            @endif




            <li><a href="{{ route('contact') }}">Contact</a></li>
            {{-- <li><a href="{{ route('clientVendorBookings.index') }}">Bookings</a></li> --}}
            {{-- <li><a href="{{ route('clientBookings.index') }}">Booking</a></li> --}}
            @if (auth()->id())
            <li>
                {{-- <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit(); " role="button">
                            Logout
                        </a>
                </form> --}}
                <li><a href="{{ route('clientBookings.index') }}">Booking</a></li>
                <li>
                    <a href="{{ route('wishlist.categories') }}"><i class="fas fa-heart"></i></a>
                </li>
                <li><a href="{{ route('chatify') }}">Chatify</a></li>
                {{-- <li>
                    <a href="{{ route('dashboard') }}"><i class="fas fa-heart"></i></a>
                </li> --}}
                <li>
                    <label for="btn-22" class="shows ">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                        <img class="rounded-circle"
                        height="25" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" loading="lazy" />

                @else
                <span class="bg-light text-secondary border border-danger rounded-circle p-1">{{ $initials }}</span>
                {{-- <div class="user_avatar">{{ $initials }}</div> --}}
                @endif
                      <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                    </label>


                    <!-- large screen avater -->
                    <a>
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                        <img class="rounded-circle"
                        height="25" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" loading="lazy" />

                    @else
                    <span class="bg-light text-secondary border border-danger rounded-circle px-2 py-1" style="width: 25px; height:25px;">{{ $initials }}</span>
                    {{-- <div class="profile_avatar">{{ $initials }}</div> --}}
                    @endif

                  </a>

                  <!-- end large screen avater -->

                    <input type="checkbox" id="btn-22">
                    <ul class="u_avatar">
                      <li class="itemhidden">

                        <a href="#">
                        <span>
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                            <img class="rounded-circle"
                            height="25px" width="25px" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" loading="lazy" />

                            @else
                            <span class="bg-light text-secondary border border-danger rounded-circle px-2 py-1" style="width: 25px; height:25px;">{{ $initials }}</span>
                            {{-- <div class="user_avatar">{{ $initials }}</div> --}}
                            @endif

                        </span>
                        <span> Hi, User {{ Auth::user()->name }}!</span>
                        </a>


                      </li>
                      <li><a href="{{ url('/user/profile') }}">Manage Profile</a></li>
                      @if (auth()->user()->role_id == '3')
                      <li><a href="{{ route('clients.index') }}">Dashboard</a></li>
                      @elseif (auth()->user()->role_id == '2')
                      <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                      @elseif (auth()->user()->role_id == '1')
                      <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                      @endif
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <li>
                              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                              this.closest('form').submit(); " role="button">
                          Signout
                          </a>
                          </li>
                      </form>




                   </ul>
               </li>

            </li>
            @else
                <li>
                    <a href="{{ route('login') }}" role="button">
                        Login
                    </a>
                </li>
                <li>
                    <a href="{{ route('register') }}" role="button">
                        Register
                    </a>
                </li>
            @endif



        </ul>
    </nav>
</header>


<!-- --------------------------------------------------slider---------------------------------------------------------------------------- -->

<main>
    {{ $slot }}
</main>


  <!-------------------------------------------Footer Begin---------------------------------------------->

<div class="map" >
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4745.027985058492!2d79.94732771592962!3d6.846012384230547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25044e7acf683%3A0x6513c1923579a890!2sStudio%20X!5e0!3m2!1sen!2slk!4v1603480566808!5m2!1sen!2slk" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- Follow Us Section -->

                <h4 class="follow-us" style="color: #B76E79;">Follow Us</h4>

                <p style="text-align: justify">Embrace Wedding Bells, Where Love Rings True! For Wedding Experts: Showcase your skills to couples seeking perfection. Lovebirds on the Marriage Journey: Find top-notch vendors, plan stress-free, and turn dreams into cherished memories. Craft Your Unforgettable Moments with Us! Join in creating a timeless love story.</p>

                <div class="social-icon">
                    <!-- Add your social media links/icons here -->
                  <a href="0701234567"><i class="fas fa-phone"></i></a>
                  <a href="https://www.facebook.com/pages/weddingbells/"><i class="fab fa-facebook-f"></i></a>
                  <a href="https://www.twitter.com/pages/weddingbells/"><i class="fab fa-twitter"></i></a>
                  <a href="https://www.instagram.com/pages/weddingbells/"><i class="fab fa-instagram"></i></a>
                  <a href="weddingbells@gmail.com "><i class="fas fa-envelope"></i></a>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Logo and Contact Section -->

              <a href="#"><img src="{{ asset('images/logo/WB_logo_1.svg') }}" class="footerlogo"></a>
              <div class="contact-items">
              <p><i class="fas fa-map-marker-alt"></i> Wedding Bells<span class="number"></span></p>
              <p><i class="fas fa-phone"></i> Call Us: <span class="number"><a href=""> 0711234567 </a>/<a href=""> 0771234567 </a></span></p>
              <p><i class="fas fa-envelope-open"></i> Email us: <span class="number"><a href="weddingbells.lk@gmail.com" class="info">weddingbells.lk@gmail.com </a></span></p>
            </div>
            </div>

            <div class="col-md-4">
                <!-- Image Section -->
                <div class="right-image">
                    <img src="{{ asset('images/bgImages/Footer_img.png') }}" alt="Wedding Couple">
                </div>
            </div>
        </div>
        <section id="footer">
            <div class="copyright">
                Copyright © 2023 Wedding Bells. All Rights Reserved. | Design and Developed by UNIVOTEC
            </div>

        </section>
    </div>
</footer>


   <!-------------------------------------------Footer End---------------------------------------------->


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
