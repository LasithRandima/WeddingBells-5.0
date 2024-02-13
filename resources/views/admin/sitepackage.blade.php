<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



$actual_vendor_id = DB::table('vendors')
        ->select('id')
        ->where('user_id', '=', Auth::id())
        ->value('id');

$actual_vendor_email = DB::table('vendors')
        ->select('v_email')
        ->where('user_id', '=', Auth::id())
        ->value('v_email');

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
    <title>Advertise With Us</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">



    <style>
    .abouts h1, h3{
    text-align: center;

}

.container-fluid{
    background-image: url({{ asset('images/Advertisement/White_bg.jpg') }});
    background-size: cover;
    margin-top: -80px;
    margin-bottom: -80px;

}
.container{
    margin-top: 100px;
    background-size: cover;
    text-align: center;
    scroll-margin-top: -2vh;
    width: 100vw;
    z-index: 2;

}
.ads h1 {
    letter-spacing: 12px;
    margin-bottom: 15px;
    font-size: 19px;
    margin-top: 5%;

}

.ads h3 {
    color:  #B76E79;
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
	  background-color:#e6e6fa;
}
.btn:hover{
	background:#ffd700;
	opacity:0.8;
}
.Form_container{
  background:rgb(233, 223, 240,0.4);
  z-index: 3;
}

@media screen and (max-width:484px) {
  .btn{
    font-size: 0.7em;
    text-align: center;
    padding:1% ;
  }
}

/*---------------------------------------Membership Plan--------------------------------------*/

@import url('http://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');

{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: block;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-image: url('{{ asset('images/bgImages/00004.jpg') }}');
    background-size: cover;/* Ensures the image covers the entire background */
    background-position:fullscreen;/* Centers the image horizontally and vertically */
    background-repeat:no-repeat; /* Prevents the image from repeating */
    background-attachment:fixed;
}


h6 {
    text-align: center;
}

.vendor h1,
h3 {
    text-align: center;
}
.vendor p {
  text-align: justify;
  line-height: 1.6; /* Adjust the line height based on your preference */
  margin-bottom: 15px; /* Add some bottom margin for separation */
  padding: 0 25px; /* Add padding to the left and right sides */
}
.vendor h1 {
    letter-spacing: 12px;
    margin-bottom: 15px;
    font-size: 19px;
}

.vendor h3 {
    color: #B76E79;
    margin-bottom: 30px;
}

.wrapperpac {
    display: block;
}

.containerm {
    display: flex;
    justify-content: center;
    align-items: center;
    max-width: 100vw;
    flex-wrap: wrap;
    padding: 40px 0;
}

.containerm .card {
    position: relative;
    min-width: 320px;
    height: 760px;
    box-shadow: inset 5px 5px 5px rgba(0, 0, 0, 0.05),
        inset -5px -5px 5px rgba(255, 255, 255, 0.5),
        5px 5px 5px rgba(0, 0, 0, 0.05),
        -5px -5px 5px rgba(255, 255, 255, 0.5);
    border-radius: 15px;
    margin: 30px;
    background: #ebf5fc; /* Adjust the background color */
}

.containerm .card .box {
    position: absolute;
    top: 20px;
    left: 20px;
    right: 20px;
    bottom: 20px;
    background: #fff; /* Adjust the background color */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: 0.5s;
}

.containerm .card:hover .box {
    transform: translateY(-50px);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    background: linear-gradient(45deg, #b95ce4, #4f29cd);
}

.containerm .card .box .content {
    padding: 20px;
    text-align: center;
}

.containerm .card .box .content h2 {
    text-align: center;
    font-size: 2.4em;
    color: rgba(0, 0, 0, 0.25);
    transition: 0.5s;
    pointer-events: none;
}

.containerm .card .box .content .free {
    position: absolute;
    top: 0px;
    left: 28%;
    text-align: center;
    font-size: 2.4em;
    color: rgba(0, 0, 0, 0.15);
    transition: 0.5s;
    pointer-events: none;
}

.containerm .card:hover .box .content h2 {
     color: #ffd700;;
}

.containerm .card .box .content h3 {
    font-size: 1.8em;
    color: #555555;
    transition: 0.5s;
}
.containerm .card:hover .box .content h3{
  color: #ffd700;
}

.containerm .card .box .content p,
.containerm .card .box .content ul,
.containerm .card .box .content li {
    font-size: 1em;
    font-weight: 300;
    color: #777;
    transition: 0.5s;
}

.containerm .card .box .content ul {
    margin-top: 10px;
    list-style-type: square;
    margin-left: 5px;
    text-align: left;
}

.containerm .card:hover .box .content ul {
    margin-top: 10px;
    list-style-type: square;
    margin-left: 5px;
    text-align: left;
}


.containerm .card:hover .box .content p,
.containerm .card:hover .box .content ul,
.containerm .card:hover .box .content li {
    color: #fff;
}

.payment_btn {
    position: relative;
    display: inline-block;
    padding: 8px 20px;
    background: #6A0DAD;
    margin-top: 15px;

    color: #fff;
    text-decoration: none;
    font-weight: 400;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.containerm .card:hover .payment_btn {
    background: #636363;
    color: #fff;
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


    <!-- --------------------------------------------------slider---------------------------------------------------------------------------- -->

    <x-slider></x-slider>



<!----------------------------------Membership Plan Section Begin--------------------------------------------->
<div class="clearfix"></div>

<div class="vendor">
    <h1 class="vendor-heading" style="padding-top: 80px">Captivate the Digital Wedding Realm</h1>
    <h3 class="vendor-subheading">Discover Your Enchanting Package</h3>

    <p class="vendor-description">Embark on an exciting journey with WeddingBells, your exclusive wedding directory designed to streamline your online presence in Sri Lanka. As search engines become the focal point for brides-to-be, we proudly claim the highest search engine exposure in the country. Elevate your visibility and connect with potential clients through our meticulously crafted platform.</p>

<p class="vendor-description">At the core of successful advertising lies the art of capturing attention amidst the competition. Our flexible advertising packages, tailored to suit your budget, offer unparalleled versatility. Above all, we curate advertising that not only captures but celebrates your unique essence, ensuring your business stands out in the wedding industry.</p>

<p class="vendor-description">Welcome to My Wedding Guide, the pinnacle of wedding directories in Sri Lanka, dedicated to guiding couples in crafting their special day. Explore a range of advertising packages, from Basic Listings to Premium Listings, each promising exposure to your desired audience. Connect with us for detailed insights and personalized pricing options tailored to your business needs.</p>

</div>

<div class="wrapperpac">
    <div class="containerm">

        @foreach ($sitePackages as $sitePackage)
        <div class="card">
            <div class="box">
                <div class="content">
                    @if ($sitePackage->pkg_name == 'Basic')
                        <h2>Free<span style="font-size:0.4em"> / month</span></h2>
                        <h3>{{ $sitePackage->pkg_name }} </h3>
                        <p>{!! $sitePackage->pkg_description !!}</p>

                        @php
                        $payment = DB::table('payments')->where('v_id', '=', Auth::id())->first();
                        @endphp

                        @if ($payment)
                        @php
                              $package_name = DB::table('site_packages')->where('id', '=', $payment->package_id)->value('pkg_name');
                        @endphp
                        <div class="alert alert-secondary" role="alert">
                            {{ 'Already subscribed to ' .$package_name .  ' package.'}}
                            <form action="{{ route('freepayment') }}" method="POST">
                                @csrf
                                <input type="hidden" name="package_id" value="{{ $sitePackage->id }}">
                                <input type="hidden" name="amount" value="1">
                                <input type="hidden" name="v_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="actual_v_id" value="{{ $actual_vendor_id }}">
                                <input type="hidden" name="v_email" value="{{ $actual_vendor_email }}">
                                <input type="hidden" name="image_count" value="{{ $sitePackage->image_limit }}">
                                <input type="hidden" name="ads_count" value="{{ $sitePackage->ads_limit }}">
                                <input type="hidden" name="top_ads_count" value="{{ $sitePackage->top_ad_count }}">

                                <button type="submit" class="payment_btn">Upgrade Subscription</button>
                            </form>
                        </div>
                        @else
                            <form action="{{ route('freepayment') }}" method="POST">
                                @csrf
                                <input type="hidden" name="package_id" value="{{ $sitePackage->id }}">
                                <input type="hidden" name="amount" value="1">
                                <input type="hidden" name="v_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="actual_v_id" value="{{ $actual_vendor_id }}">
                                <input type="hidden" name="v_email" value="{{ $actual_vendor_email }}">
                                <input type="hidden" name="image_count" value="{{ $sitePackage->image_limit }}">
                                <input type="hidden" name="ads_count" value="{{ $sitePackage->ads_limit }}">
                                <input type="hidden" name="top_ads_count" value="{{ $sitePackage->top_ad_count }}">

                                <button type="submit" class="payment_btn">Get Started</button>
                            </form>
                        @endif


                    @else
                        <h2>{{ $sitePackage->pkg_price }}<span style="font-size:0.4em"> / year</span></h2>
                        <h3>{{ $sitePackage->pkg_name }} </h3>
                        <p>{!! $sitePackage->pkg_description !!}</p>


                            @php
                            $payment = DB::table('payments')->where('v_id', '=', Auth::id())->first();
                            @endphp

                            @if ($payment)
                            @php
                            $package_name = DB::table('site_packages')->where('id', '=', $payment->package_id)->value('pkg_name');
                            @endphp
                                <div class="alert alert-secondary" role="alert">
                                    {{ 'Already subscribed to ' .$package_name .  ' package.'}}
                                    <form action="{{ route('payment') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="package_id" value="{{ $sitePackage->id }}">
                                        <input type="hidden" name="amount" value="{{ $sitePackage->pkg_price }}">
                                        <input type="hidden" name="v_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="actual_v_id" value="{{ $actual_vendor_id }}">
                                        <input type="hidden" name="v_email" value="{{ $actual_vendor_email }}">
                                        <input type="hidden" name="image_count" value="{{ $sitePackage->image_limit }}">
                                        <input type="hidden" name="ads_count" value="{{ $sitePackage->ads_limit }}">
                                        <input type="hidden" name="top_ads_count" value="{{ $sitePackage->top_ad_count }}">

                                        <button type="submit" class="payment_btn">Upgrade Subscription</button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('payment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="package_id" value="{{ $sitePackage->id }}">
                                    <input type="hidden" name="amount" value="{{ $sitePackage->pkg_price }}">
                                    <input type="hidden" name="v_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="actual_v_id" value="{{ $actual_vendor_id }}">
                                    <input type="hidden" name="v_email" value="{{ $actual_vendor_email }}">
                                    <input type="hidden" name="image_count" value="{{ $sitePackage->image_limit }}">
                                    <input type="hidden" name="ads_count" value="{{ $sitePackage->ads_limit }}">
                                    <input type="hidden" name="top_ads_count" value="{{ $sitePackage->top_ad_count }}">

                                    <button type="submit" class="payment_btn">Get Started</button>
                                </form>
                            @endif

                    @endif




                </div>
            </div>
        </div>
    @endforeach


          </div>
      </div>




</div>
</div>

<!----------------------------------Membership Plan Section end--------------------------------------------->



    {{-- <div class="container-fluid ads" id="advertise">
      <div class="container">
        <form action="" name="myform" class="form-group" data-aos="zoom-in">
            <h1 style="padding-top: 100px;">Are You a vendor?</h1>
            <h3>Advertise With Us</h3>
            <P>Grow your business by becoming a valued member of the  Wedding Bells Resource Directory and we’ll work with you to creatively promote your products and services to ensure you reach and attract the right clientele.</P>
            <div class="row jumbotron Form_container">
                <div class="col-md-6">
                    <label for="inputname">First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" required="required">
                </div>

                <div class="col-md-6">
                    <label for="inputname">Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" required="required">
                </div>

                <div class="col-md-6">
                    <label for="phoneno">Phone No</label>
                    <input type="number" class="form-control" placeholder="Phone Number">
                </div>

                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" placeholder="Email Address" required="required">
                </div>

                <div class="col-md-6">
                    <label for="buisnessname">Buisness Name</label>
                    <input type="text" class="form-control" placeholder="Buisness name" required="required">
                </div>

                <div class="col-md-6">
                    <label for="addr">Address Line 1</label>
                    <input type="text" class="form-control" placeholder="Address Line 1" required="required">
                </div>

                <div class="col-md-6">
                    <label for="inputname">Category</label>
                    <select name="categories" id="cat" class="form-control">
                      <option value="">Bridal Wear</option>
                      <option value="">Grooms Wear</option>
                      <option value="">Beauticians/Saloons</option>
                      <option value="">Wedding Jewelry</option>
                      <option value="">Shoes</option>
                      <option value="">Wedding  Planner</option>
                      <option value="">Wedding Venues</option>
                      <option value="">Wedding Decors</option>
                      <option value="">Studio</option>
                      <option value="">Ashtaka</option>
                      <option value="">Wedding Cakes</option>
                      <option value="">Stationary</option>
                      <option value="">Entertainment</option>
                      <option value="">Vehicle Hire</option>
                      <option value="">Honeymoon Venues</option>
                  </select>
                </div>

                <div class="col-md-6">
                    <label for="addr">Address Line 2</label>
                    <input type="text" class="form-control" placeholder="Address Line 2" required="required">
                </div>

                <div class="col-md-6">
                    <label for="addr">Description</label>
                    <textarea name="" id="" cols="30" rows="4" class="form-control">
                    </textarea>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
  </div> --}}


    <!-------------------------------------------Footer Begin---------------------------------------------->

    @include('components.onlyfooter')

      <!-------------------------------------------Footer End---------------------------------------------->

      <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('js/main.js') }}"></script>
      <script type="text/javascript">
          $(document).ready(function() {
              $('.carousel').carousel({
                  interval: 4000,
              });
          });
      </script>

      <script src="{{ asset('js/smooth-scroll.js') }}"></script>
      <script>
          var scroll = new SmoothScroll('a[href*="#"]', {
              speed: 100
          });
      </script>

      <script type="text/javascript" src="{{ asset('js/aos.js') }}"></script>

      <script>
          $(document).ready(function() {
              AOS.init({
                  offset: 180,
                  delay: 0,
                  duration: 800,
                  easing: 'ease',
                  once: false,
                  mirror: false,
                  anchorPlacement: 'top-bottom',
              });
          });
      </script>


</body>
</html>
