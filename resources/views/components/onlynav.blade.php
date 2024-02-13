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


?>

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




            {{-- <li><a href="#quicksearch">Quick Search</a></li> --}}
            @if (Auth::user())
            <li><a href="{{ route('sitePackages.index') }}">Advertise</a></li>
            {{-- <li><a href="{{ route('sitePackages.index') }}">Wishlist</a></li> --}}
            @else
                @php
                    $redirectUrl = route('sitePackages.index');
                    Session::put('homePageRedirectUrl', $redirectUrl);
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
                <li>
                    <a href="{{ route('chatify') }}"><i class="fas fa-comment-alt"></i></a>
                </li>
                <li>
                    <label for="btn-22" class="shows ">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                        <img class=""
                        height="25" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" loading="lazy" />



                @else
                <span class="bg-silver text-secondary border border-danger rounded-circle px-2 py-1" style="width: 25px; height: 25px;">{{ $initials }}</span>

                {{-- <div class="user_avatar">{{ $initials }}</div> --}}
                @endif
                      <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                    </label>


                    <!-- large screen avater -->
                    <a>
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())


                    <img class=""
                    height="25" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" loading="lazy" />



                    @else
                    <span class="bg-silver text-secondary border border-danger rounded-circle px-2 py-1" style="width: 25px; height: 25px;">{{ $initials }}</span>

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

                            <img class="rounded-circle" height="25px" width="25px" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" loading="lazy" />


                            @else
                            <span class="bg-silver text-secondary border border-danger rounded-circle px-2 py-1" style="width: 25px; height: 25px;">{{ $initials }}</span>

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
