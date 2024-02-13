<?php
use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;






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

    {{-- <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    {{-- <script>
        var jQ = jQuery.noConflict();
    </script> --}}

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

  @include('components.onlynav');



    <!-- --------------------------------------------------slider---------------------------------------------------------------------------- -->

<x-slider></x-slider>

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
            <?php
            $pkg_name = DB::table('adpackages')->where('id', $normalAd->pkg_id)->value('pkg_name');
            $pkg_id = DB::table('client_vendor_bookings')->where('pkg_id', $normalAd->pkg_id)->value('pkg_id');
            ?>
            <div class="card-text"><small class="text-muted">Package : {{ $pkg_name ? $pkg_name : 'No Package Selected Yet' }}</small></div>
            <div class="card-text"><span class="badge badge-info">Booking Status : {{ $normalAd->booking_status }}</span></div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">


        <div class="d-flex justify-content-center btn-flex">
            @if ($normalAd->booking_status == 'approved')
            {{-- $topAdId = $normalAd->id; --}}

            {{-- <button type="button" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3" data-toggle="modal" data-target="#modalQuickView" data-top-ad-id="{{ $normalAd->id }}">Books</button> --}}
                    @if ($pkg_name == null || $pkg_id == 0)
                    <form action="{{ route('bookings.book', $normalAd->id) }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3">Book</button>
                    </form>
                    @else
                    <button type="button" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3" data-toggle="modal" data-target="#modalQuickView" data-top-ad-id="{{ $normalAd->ad_id }}" data-booking-id="{{ $normalAd->id }}" data-booking-eventdate="{{ $normalAd->event_date }}" data-booking-eventstarttime="{{ $normalAd->event_start_time }}" data-booking-eventendtime="{{ $normalAd->event_end_time }}" data-booking-package="{{ $normalAd->pkg_id }}" data-url="{{ route('cusbookings.packages', $normalAd->ad_id) }}">Book</button>
                    @endif

            {{-- <a class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3" href="{{ route('cusbookings.packages', $normalAd->ad_id) }}">Book</a> --}}
            {{-- <a
            href="javascript:void(0)"
            id="show-user"
            data-url="{{ route('cusbookings.packages', $normalAd->id-1) }}"
            class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3"
            >Show</a> --}}

            @endif

            @if ($normalAd->booking_status == 'booked')
            <?php

            ?>
                @if ($pkg_name == null)
                    <button type="button" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3" data-toggle="modal" data-target="#modalQuickView" data-top-ad-id="{{ $normalAd->ad_id }}" data-booking-id="{{ $normalAd->id }}" data-booking-eventdate="{{ $normalAd->event_date }}" data-booking-eventstarttime="{{ $normalAd->event_start_time }}" data-booking-eventendtime="{{ $normalAd->event_end_time }}" data-booking-package="{{ $normalAd->pkg_id }}" data-url="{{ route('cusbookings.bookingdata', $normalAd->ad_id) }}">Change Booking</button>
                @else
                    <button type="button" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3" data-toggle="modal" data-target="#modalQuickView" data-top-ad-id="{{ $normalAd->ad_id }}" data-booking-id="{{ $normalAd->id }}" data-booking-eventdate="{{ $normalAd->event_date }}" data-booking-eventstarttime="{{ $normalAd->event_start_time }}" data-booking-eventendtime="{{ $normalAd->event_end_time }}" data-booking-package="{{ $normalAd->pkg_id }}" data-url="{{ route('cusbookings.packages', $normalAd->ad_id) }}">Change Booking</button>
                @endif

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
            <?php
            $pkg_name = DB::table('adpackages')->where('id', $normalAd->pkg_id)->value('pkg_name');
            $pkg_id = DB::table('client_vendor_bookings')->where('pkg_id', $normalAd->pkg_id)->value('pkg_id');
            ?>
            <div class="card-text"><small class="text-muted">Package : {{ $pkg_name ? $pkg_name : 'No Package Selected Yet' }}</small></div>

            <div class="card-text"><span class="badge badge-info">Booking Status : {{ $normalAd->booking_status }}</span></div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">

                            <!-- Cancel or Delete Form -->

        <div class="d-flex justify-content-center btn-flex">
            @if ($normalAd->booking_status == 'approved')
            {{-- <button type="button" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3" data-toggle="modal" data-target="#modalQuickView" data-top-ad-id="{{ $normalAd->id }}">Books</button> --}}


            @if ($pkg_name== null ||  $pkg_id == 0)
            <form action="{{ route('bookings.book', $normalAd->id) }}" method="post">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3">Book</button>
            </form>
            @else
            <button type="button" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3" data-toggle="modal" data-target="#modalQuickView" data-top-ad-id="{{ $normalAd->ad_id }}" data-booking-id="{{ $normalAd->id }}" data-booking-eventdate="{{ $normalAd->event_date }}" data-booking-eventstarttime="{{ $normalAd->event_start_time }}" data-booking-eventendtime="{{ $normalAd->event_end_time }}" data-booking-package="{{ $normalAd->pkg_id }}" data-url="{{ route('cusbookings.packages', $normalAd->ad_id) }}">Book</button>
            @endif

            @endif

            @if ($normalAd->booking_status == 'booked')
            <?php
              $pkg_name = DB::table('adpackages')->where('id', $normalAd->pkg_id)->value('pkg_name');

            ?>
                @if ($pkg_name== null)
                    <button type="button" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3" data-toggle="modal" data-target="#modalQuickView" data-top-ad-id="{{ $normalAd->ad_id }}" data-booking-id="{{ $normalAd->id }}" data-booking-eventdate="{{ $normalAd->event_date }}" data-booking-eventstarttime="{{ $normalAd->event_start_time }}" data-booking-eventendtime="{{ $normalAd->event_end_time }}" data-booking-package="{{ $normalAd->pkg_id }}" data-url="{{ route('cusbookings.bookingdata', $normalAd->ad_id) }}">Change Booking</button>
                @else
                <button type="button" class="btn btn-primary btn-sm px-4 me-md-2 fw-bold mt-3" data-toggle="modal" data-target="#modalQuickView" data-top-ad-id="{{ $normalAd->ad_id }}" data-booking-id="{{ $normalAd->id }}" data-booking-eventdate="{{ $normalAd->event_date }}" data-booking-eventstarttime="{{ $normalAd->event_start_time }}" data-booking-eventendtime="{{ $normalAd->event_end_time }}" data-booking-package="{{ $normalAd->pkg_id }}" data-url="{{ route('cusbookings.packages', $normalAd->ad_id) }}">Change Booking</button>
                @endif

            @endif

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
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">




            <script>
                function capitalizeWords(str) {
                    return str.replace(/\b\w/g, function(match) {
                        return match.toUpperCase();
                    });
                }

                $(document).ready(function() {
        $('#modalQuickView').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var AdId = button.data('top-ad-id');
            var BookingId = button.data('booking-id');
            var adTitle = button.data('ad-title');
            var eventDate = button.data('booking-eventdate');
            var eventStartTime = button.data('booking-eventstarttime');
            var eventEndTime = button.data('booking-eventendtime');
            var eventPackage = button.data('booking-package');
            var url = button.data('url');

            console.log('URL: ',url); // Check if this prints the value
            console.log('AdId: ',AdId); // Check if this prints the value
            console.log('BookingId: ',BookingId); // Check if this prints the value
            console.log(eventDate); // Check if this prints the value
            console.log(eventStartTime); // Check if this prints the value
            console.log(eventEndTime); // Check if this prints the value
            console.log(eventPackage); // Check if this prints the value

        // Collapse all accordion items when modal is shown
        $('.collapse').removeClass('show'); // Close all accordions

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var pkgSelect = $('#pkg');
                    pkgSelect.empty();
                    pkgSelect.append($('<option>', {
                        value: '',
                        text: 'Choose your option',
                        disabled: true,
                        selected: true
                    }));
                    pkgSelect.append($('<option>', {
                        value: '0',
                        text: 'No Specific Package'
                    }));

                    if (response.length === 0) {
                        $('#modalHeaderTitle').text('');
                        $('#modalPriceTitle').text('');
                        $('#modalImage').attr('src', '');
                        $('#modalImage').attr('alt', '');
                        $('#modalContent').empty();
                    } else {
                        var capitalizedAdTitle = capitalizeWords(response[1].ad_title);
                        $('#modalHeaderTitle').text(capitalizedAdTitle);
                        $('#modalPriceTitle').text(response[0].price);
                        $('#modalImage').attr('src', '/storage/' + response[1].ad_image);
                        $('#modalContent').empty();

                       // Set form action attribute with the retrieved BookingId
                    $('#bookmodalform').attr('action', '{{ route("cusbookings.updatebooking", "") }}/' + BookingId);

                    $('#formday').attr('value', eventDate);
                    $('#formstime').attr('value', eventStartTime);
                    $('#formetime').attr('value', eventEndTime);
                    // $('#formpkg').attr('value', eventPackage);

                        $.each(response, function(index, data) {
                            console.log(data);
                            if (data.pkg_description == null && pkg_id == 0 ) {
                                var card = '<div class="card">';
                            card += '<div class="card-header" role="tab" id="heading' + index + '">';
                            card += '<a data-toggle="collapse" href="#collapse' + index + '" aria-expanded="false" aria-controls="collapse' + index + '">';
                            card += '<h5 class="mb-0">';
                            card += data.pkg_name + ' <i class="fas fa-angle-down rotate-icon"></i>';
                            card += '</h5></a></div>';
                            card += '<div id="collapse' + index + '" class="collapse" role="tabpanel" aria-labelledby="heading' + index + '">';
                            card += '<div class="card-body">';
                            card += '<p>Event Date: ' + data.event_date + '</p>';
                            card += '<p>Event Time: ' + data.event_start_time + ' - ' + data.event_end_time + '</p>';
                            card += '</div></div></div>';

                            }else{
                                var card = '<div class="card">';
                            card += '<div class="card-header" role="tab" id="heading' + index + '">';
                            card += '<a data-toggle="collapse" href="#collapse' + index + '" aria-expanded="false" aria-controls="collapse' + index + '">';
                            card += '<h5 class="mb-0">';
                            card += data.pkg_name + ' <i class="fas fa-angle-down rotate-icon"></i>';
                            card += '</h5></a></div>';
                            card += '<div id="collapse' + index + '" class="collapse" role="tabpanel" aria-labelledby="heading' + index + '">';
                            card += '<div class="card-body">';
                            card += '<p>' + data.pkg_description + '</p>';
                            card += '<p>Price: ' + data.price + '</p>';
                            card += '</div></div></div>';
                            }


                            $('#modalContent').append(card);

                            pkgSelect.append($('<option>', {
                                value: data.id,
                                text: data.pkg_name
                            }));

                        });

                       // Remove 'show' class from all accordions
                    $('.collapse').removeClass('show');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Request Error:', error);
                }
            });
        });
    });
            </script>







          <div class="row">
            <div class="col-lg-5">
              <!--Carousel Wrapper-->
                    <img class="d-block w-100" id="modalImage" alt="AD image">
                </div>
                <!--/.Slides-->

              {{-- </div> --}}
              <!--/.Carousel Wrapper-->
            {{-- </div> --}}
            <div class="col-lg-7">
              <h2 class="h2-responsive product-name">
                <strong id="modalHeaderTitle"></strong>
              </h2>
              {{-- <div id="modalHeaderContent"></div> --}}
              {{-- <h5 class="h4-responsive">
                <span class="green-text">
                  <strong>Price Start From : </strong>
                </span>
                <span class="green-text">
                    <strong id="modalPriceTitle"></strong>
                  </span>
                </span>
              </h5> --}}



            <div id="modalContent"></div>



              <!-- Add to Cart -->
              <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="bookmodalform" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                <div class="row" style="padding: 0px 50px 0px 0px">
                  <div class="col-md-6">
                    <label for="pkg" class="mdb-main-label">Select Package</label>
                    {{-- <p id="packages"></p> --}}
                    <select class="md-form mdb-select colorful-select dropdown-primary" name="package" id="pkg">
                      {{-- <option value="" disabled selected>Choose your option</option>
                      <option id="packages" value="1">Package 01</option> --}}
                    </select>


                  </div>
                  <div class="col-md-6">
                    <label class="mdb-main-label" for="formday">Event Date</label>
                    <input type="date" name="event_date" id="formday">
                  </div>

                  <div class="card-body">
                  <div class="row" style="padding: 0px 0px 0px 0px">
                    <div class="col-md-6">
                        <label class="mdb-main-label" for="formstime">Select Event Start Time</label>
                        <input type="time" name="event_start_time" id="formstime">
                    </div>

                    <div class="col-md-6">
                        <label class="mdb-main-label" for="formetime">Select Event End Time</label>
                        <input type="time" name="event_end_time" id="formetime">
                    </div>
                </div>
                </div>

                {{-- <div class="col-12">
                    <label class="mdb-main-label" for="msg">Message</label>
                    <textarea class="form-control" id="msg" rows="4"></textarea>
                </div> --}}

                <div class="text-center">

                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Book Now
                    <i class="fas fa-book"></i>
                  </button>
                </div>
            </form>
              </div>
              <!-- /.Add to Cart -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



</section>



<script type="text/javascript">

       $(document).ready(function () {

           $('body').on('click', '#show-user', function () {
             var userURL = $(this).data('url');
             $.get(userURL, function (data) {
                 $('#modalQuickView').modal('show');
                 $('#pkg_name').text(data.pkg_name);
                 $('#pkg_description').text(data.name);
                //  $('#user-email').text(data.email);
             })
          });

       });

   </script>

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
