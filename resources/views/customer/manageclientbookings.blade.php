
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

    @media only screen and (min-width: 769px) and (max-width: 991px){
      .btn-flex{
        flex-direction: column;
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

  @include('components.onlynav')



    <!-- --------------------------------------------------slider---------------------------------------------------------------------------- -->

<div id="slider">
    <div id="headerSlider" class="carousel slide carousel-fade" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#headerSlider" data-slide-to="0" class="active"></li>
        <li data-target="#headerSlider" data-slide-to="1"></li>
        <li data-target="#headerSlider" data-slide-to="2"></li>
        <li data-target="#headerSlider" data-slide-to="3"></li>
        <li data-target="#headerSlider" data-slide-to="4"></li>
        <li data-target="#headerSlider" data-slide-to="5"></li>
        <!-- <li data-target="#headerSlider" data-slide-to="3"></li> -->



      </ol>
      <div class="carousel-inner">

        <div class="carousel-item active">
          <img class="img-fluid" src="images/slider/Contact/1.png" >
          <div class="carousel-caption">
            <h1>Welcome To Wedding Bells</h1>
            <p>The Sri Lankan Premium Wedding Resource Directory.</p>

            <button type="button"  id="vidBtn" class="more-bttn" data-toggle="modal" data-target="#slider1">
              Read more
            </button>
          </div>
        </div>

        <div class="carousel-item">
          <img class="img-fluid" src="images/slider/Contact/2.png">
          <div class="carousel-caption">
            <h1>Browse Suppliers</h1>
            <p>Search over thousands of professionals in everywhere specialized in different kinds
              of Wedding Services.</p>

            <button type="button"  id="vidBtn" class="more-bttn" data-toggle="modal" data-target="#slider2">
              Read more
            </button>
          </div>
        </div>


        <div class="carousel-item">
          <img class="img-fluid" src="images/slider/Contact/3.png">
          <div class="carousel-caption">
            <h1>Are you A Vendor?</h1>
            <p>We are here to help your grow your business. Come join with us to advertise</p>

            <button type="button"  id="vidBtn" class="more-bttn" data-toggle="modal" data-target="#slider3">
              Read more
            </button>
          </div>
        </div>

        <div class="carousel-item">
          <img class="img-fluid" src="images/slider/Contact/4.png">
          <div class="carousel-caption">
            <h1>Contact Us </h1>
            <P>Build your team with the best wedding professionals</p>

            <button type="button" id="vidBtn" class="more-bttn" data-toggle="modal" data-target="#slider4">
              Read more
            </button>
          </div>
        </div>


        <div class="carousel-item">
          <img class="img-fluid" src="images/slider/Contact/5.png">
          <div class="carousel-caption">
            <h1>Who We Are</h1>
            <p >Begin Planning Your Dream Wedding Day at Wedding Bells & Make Your Big Day Shine.</p>

            <button type="button" id="vidBtn" class="more-bttn" data-toggle="modal" data-target="#slider5">
              Read more
            </button>
          </div>
        </div>


        <div class="carousel-item">
          <img class="img-fluid" src="images/slider/Contact/6.jpg">
          <div class="carousel-caption">
            <h1>Your Supreme Wedding Planning Solution </h1>
            <p >A Handpicked Collection Of The Local'S Best Luxary Wedding Suppliers</p>

            <button type="button" id="vidBtn" class="more-bttn" data-toggle="modal" data-target="#slider6">
              Read more
            </button>
          </div>
        </div>

      </div>
      <a class="carousel-control-prev" href="#headerSlider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#headerSlider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    </div>

<!-- -------------------------------------------------- end of slider-------------------------------------------------------------------------- -->


<div class="container py-5">

<div class="row row-cols-1 row-cols-md-2 g-4">
    @forelse ($topadsbookings as $normalAd)
  <div class="col">
    <div class="card mb-3 rounded-3 border shadow-lg" style="max-width: 540px;">
      <div class="row g-0">
        <div class="col-md-4 vendorLogo">

          <img src="{{ $normalAd->ad_image ? asset('/storage/'.$normalAd->ad_image) : asset('/storage/default_images/default_category_thumb.jpg')  }}" class="rounded-start" alt="Card image">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">{{ ucfirst(Str::words($normalAd->ad_title, 8, '...')) }}</h5>
            <h6 class="card-title">{{ ucfirst(Str::words($normalAd->vBusinessName, 8, '...')) }}</h6>
            <div class="card-text">{{ ucfirst(Str::words(strip_tags(html_entity_decode($normalAd->about)), 20, '...')) }}</div>
            <div class="card-text mt-3"><small class="text-muted">Booked Date : {{ $normalAd->event_date }}</small></div>
            <div class="card-text"><small class="text-muted">Booked Time : {{ $normalAd->event_start_time }} - {{ $normalAd->event_end_time }}</small></div>
            <div class="card-text"><span class="badge badge-info">Booking Status : {{ $normalAd->booking_status }}</span></div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">


        <div class="d-flex justify-content-center btn-flex">
            <form action="{{ route('bookings.book', $normalAd->id) }}" method="post">
                @csrf
                @method('put')
            @if ($normalAd->booking_status == 'approved')
            {{-- <a href="{{ route('topAds.show', $normalAd->id) }}" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3" data-toggle="modal" data-target="#modalQuickView">Book</a> --}}
            <button type="submit" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3">Book</button>
            @endif

            </form>

                <!-- Cancel or Delete Form -->
            <form action="{{ route('bookings.requestcancel', $normalAd->id) }}" method="post">
                    @csrf
                    @method('put')

            @if ($normalAd->booking_status == 'cancelled')
                <!-- Show Delete Button -->
                <button type="button" class="btn btn-outline-danger btn-sm px-4 mx-2 mt-3" onclick="deleteTopBooking({{ $normalAd->id }})">Delete Request</button>
                @elseif($normalAd->booking_status !== 'booked')
                <!-- Show Cancel Button -->
                <button type="submit" class="btn btn-outline-danger btn-sm px-4 mx-2 mt-3">Cancel Request</button>
                @elseif($normalAd->booking_status == 'booked')
                <!-- Show Cancel Button -->
                <button type="button" class="btn btn-outline-danger btn-sm px-4 mx-2 mt-3" onclick="deleteBooking({{ $normalAd->id }})">Cancel Booking</button>

            @endif

        </form>

        </div>

    <!-- Form for Delete Button (Hidden) -->
    <form id="delete-form-{{ $normalAd->id }}" action="{{ route('clientVendorBookings.destroy', $normalAd->id) }}" method="post" style="display: none;">
        @csrf
        @method('delete')
    </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  @empty
  <div class="alert alert-danger w-100 text-center" role="alert">
      No Bookings Available.
  </div>
  @endforelse



  @forelse ($bookings as $normalAd)
  <div class="col">
    <div class="card mb-3 rounded-3 border shadow-lg" style="max-width: 540px;">
      <div class="row g-0">
        <div class="col-md-4 vendorLogo">

          <img src="{{ $normalAd->ad_image ? asset('/storage/'.$normalAd->ad_image) : asset('/storage/default_images/default_category_thumb.jpg')  }}" class="rounded-start" alt="Card image">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">{{ ucfirst(Str::words($normalAd->ad_title, 8, '...')) }}</h5>
            <h6 class="card-title">{{ ucfirst(Str::words($normalAd->vBusinessName, 8, '...')) }}</h6>
            <div class="card-text">{{ ucfirst(Str::words(strip_tags(html_entity_decode($normalAd->about)), 20, '...')) }}</div>
            <div class="card-text mt-3"><small class="text-muted">Booked Date : {{ $normalAd->event_date }}</small></div>
            <div class="card-text"><small class="text-muted">Booked Time : {{ $normalAd->event_start_time }} - {{ $normalAd->event_end_time }}</small></div>
            <div class="card-text"><span class="badge badge-info">Booking Status : {{ $normalAd->booking_status }}</span></div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">

                            <!-- Cancel or Delete Form -->

        <div class="d-flex justify-content-center btn-flex">
            <form action="{{ route('bookings.book', $normalAd->id) }}" method="post">
                @csrf
                @method('put')
            {{-- <a href="{{ route('topAds.show', $normalAd->id) }}" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3" data-toggle="modal" data-target="#modalQuickView">Book</a> --}}

            @if ($normalAd->booking_status == 'approved')
            {{-- <a href="{{ route('topAds.show', $normalAd->id) }}" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3" data-toggle="modal" data-target="#modalQuickView">Book</a> --}}
            <button type="submit" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3">Book</button>
            @endif
            </form>
            <form action="{{ route('bookings.requestcancel', $normalAd->id) }}" method="post">
                @csrf
                @method('put')
            @if ($normalAd->booking_status == 'cancelled')
                <!-- Show Delete Button -->
                <button type="button" class="btn btn-outline-danger btn-sm px-4 mx-2 mt-3" onclick="deleteBookingRequest({{ $normalAd->id }})">Delete Request</button>
            @elseif($normalAd->booking_status !== 'booked')
                <!-- Show Cancel Button -->
                <button type="submit" class="btn btn-outline-danger btn-sm px-4 mx-2 mt-3">Cancel Request</button>
            @elseif($normalAd->booking_status == 'booked')
                <!-- Show Cancel Button -->
                <button type="button" class="btn btn-outline-danger btn-sm px-4 mx-2 mt-3" onclick="deleteBooking({{ $normalAd->id }})">Cancel Booking</button>
            @endif
        </form>
        </div>


    <!-- Form for Delete Button (Hidden) -->
    <form id="delete-form-{{ $normalAd->id }}" action="{{ route('clientVendorBookings.destroy', $normalAd->id) }}" method="post" style="display: none;">
        @csrf
        @method('delete')
    </form>

    <!-- Form for Delete Button (Hidden) -->
    <form id="delete-booking-form-{{ $normalAd->id }}" action="{{ route('clientVendorBookings.destroy', $normalAd->id) }}" method="post" style="display: none;">
        @csrf
        @method('delete')
    </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  @empty
  <div class="alert alert-danger w-100 text-center" role="alert">
      No current Bookings Available.
  </div>
  @endforelse




</div>


</div>


<!-------------------------------------Modal Section For Change Bookings----------------------------------------------------->


<section class="p-1">
  <!-- Modal: modalQuickView -->
  <div class="modal fade" id="modalQuickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-5">
              <!--Carousel Wrapper-->
              <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails"
                data-ride="carousel">
                <!--Slides-->
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <img class="d-block w-100"
                      src="./images/WC_DB/Categories/1. Bridal Wear/1_Salon Manali (Pvt) Ltd/ven001_4.jpg"
                      alt="First slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100"
                      src="./images/WC_DB/Categories/1. Bridal Wear/1_Salon Manali (Pvt) Ltd/ven001_5.jpg"
                      alt="Second slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100"
                      src="./images/WC_DB/Categories/1. Bridal Wear/1_Salon Manali (Pvt) Ltd/ven001_6.jpg"
                      alt="Third slide">
                  </div>
                </div>
                <!--/.Slides-->
                <!--Controls-->
                <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
                <!--/.Controls-->
                <ol class="carousel-indicators">
                  <li data-target="#carousel-thumb" data-slide-to="0" class="active">
                    <img src="./images/WC_DB/Categories/1. Bridal Wear/1_Salon Manali (Pvt) Ltd/ven001_4.jpg" width="60">
                  </li>
                  <li data-target="#carousel-thumb" data-slide-to="1">
                    <img src="./images/WC_DB/Categories/1. Bridal Wear/1_Salon Manali (Pvt) Ltd/ven001_5.jpg" width="60">
                  </li>
                  <li data-target="#carousel-thumb" data-slide-to="2">
                    <img src="./images/WC_DB/Categories/1. Bridal Wear/1_Salon Manali (Pvt) Ltd/ven001_6.jpg" width="60">
                  </li>
                </ol>
              </div>
              <!--/.Carousel Wrapper-->
            </div>
            <div class="col-lg-7">
              <h2 class="h2-responsive product-name">
                <strong>Vendor Post Title</strong>
              </h2>
              <h4 class="h4-responsive">
                <span class="green-text">
                  <strong>Price range: </strong>
                </span>
                <span class="green-text">
                    <strong>Rs.10000 - Rs.50000</strong>
                  </span>
                </span>
              </h4>

              <!--Accordion wrapper-->
              <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                <!-- Accordion card -->
                <div class="card">

                  <!-- Card header -->
                  <div class="card-header" role="tab" id="headingOne1">
                    <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                      aria-controls="collapseOne1">
                      <h5 class="mb-0">
                        Package #1 - Premier Package <i class="fas fa-angle-down rotate-icon"></i>
                      </h5>
                    </a>
                  </div>

                  <!-- Card body -->
                  <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
                    data-parent="#accordionEx">
                    <div class="card-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                      squid. 3
                      wolf moon officia aute,
                      non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                    </div>
                  </div>

                </div>
                <!-- Accordion card -->

                <!-- Accordion card -->
                <div class="card">

                  <!-- Card header -->
                  <div class="card-header" role="tab" id="headingTwo2">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
                      aria-expanded="false" aria-controls="collapseTwo2">
                      <h5 class="mb-0">
                        Package #2 - Preferred Package <i class="fas fa-angle-down rotate-icon"></i>
                      </h5>
                    </a>
                  </div>

                  <!-- Card body -->
                  <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                    data-parent="#accordionEx">
                    <div class="card-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                      squid. 3
                      wolf moon officia aute,
                      non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                    </div>
                  </div>

                </div>
                <!-- Accordion card -->

                <!-- Accordion card -->
                <div class="card">

                  <!-- Card header -->
                  <div class="card-header" role="tab" id="headingThree3">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
                      aria-expanded="false" aria-controls="collapseThree3">
                      <h5 class="mb-0">
                        Package #3 - Basic Package <i class="fas fa-angle-down rotate-icon"></i>
                      </h5>
                    </a>
                  </div>

                  <!-- Card body -->
                  <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                    data-parent="#accordionEx">
                    <div class="card-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                      squid. 3
                      wolf moon officia aute,
                      non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                    </div>
                  </div>

                </div>
                <!-- Accordion card -->

              </div>
              <!-- Accordion wrapper -->


              <!-- Add to Cart -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">

                    <select class="md-form mdb-select colorful-select dropdown-primary" id="pkg">
                      <option value="" disabled selected>Choose your option</option>
                      <option value="1">Package 01</option>
                      <option value="2">Package 02</option>
                      <option value="3">Package 03</option>
                    </select>
                    <label for="pkg" class="mdb-main-label">Select Package</label>

                  </div>
                  <div class="col-md-6">

                    <input type="datetime-local" name="" id="day">
                    <label class="mdb-main-label" for="day">Select Date & Time</label>

                  </div>
                </div>
                <div class="text-center">

                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary">Book Now
                    <i class="fas fa-book"></i>
                  </button>
                </div>
              </div>
              <!-- /.Add to Cart -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



</section>

<!-------------------------------------End of Modal Section For Change Bookings----------------------------------------------------->


    <!-------------------------------------------Footer Begin---------------------------------------------->


    @include('components.onlyfooter')

      <!-------------------------------------------Footer End---------------------------------------------->
      <script>
        function deleteTopBookingRequest(bookingId) {
            if (confirm('Are you sure you want to delete this booking request?')) {
                document.getElementById('delete-booking-form-' + bookingId).submit();
            }
        }

        function deleteBookingRequest(bookingId) {
            if (confirm('Are you sure you want to delete this booking request?')) {
                document.getElementById('delete-booking-form-' + bookingId).submit();
            }
        }

        function deleteTopBooking(bookingId) {
            if (confirm('Are you sure you want to delete this booking?')) {
                document.getElementById('delete-form-' + bookingId).submit();
            }
        }

        function deleteBooking(bookingId) {
            if (confirm('Are you sure you want to delete this booking?')) {
                document.getElementById('delete-form-' + bookingId).submit();
            }
        }
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
