
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendors</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">



        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
         alpha/css/bootstrap.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css"
         href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <style>

.ads{
    margin-top: 100px;
    text-align: center;
    scroll-margin-top: -100px;
}
.ads h1 {
    letter-spacing: 12px;
    margin-bottom: 15px;
    font-size: 19px;
}

.ads h3 {
    color: darkred;
    margin-bottom: 100px;
}



.ads p {
	font-size: 1.2rem;
    max-width: 80vw;
    text-align: center;
    margin: auto;
    margin-bottom: 50px;
}

/* .pagination a {
  color: white;
  background-color: #24023f;
  border-radius: 50%;
}
.pagination a:active {
  border: cyan solid 3px;
  color: white;
}
/*------
.pagination a:visited {
  background: red;
  border: cyan solid 2px;
  color: white;
}
------*/
/* .pagination a:hover {
    background:linear-gradient(to right,#6e1eee,#f3f3f3);
  color: white;
}
.pagenumbers{
    margin-top: 70px;
} */
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





    <div class="container ads" id="vendors">

        <h1 data-aos="zoom-in">Your Bookings</h1>
            <h3 data-aos="zoom-in">YOU ARE IN RIGHT PLACE</h3>
            <P><h5>A HANDPICKED COLLECTION OF THE WORLD'S BEST LUXURY WEDDING SUPPLIERS</h5>
               <h5> Featuring The Sri Lankan Best wedding professionals, top wedding planners, and the best magnificent venues.</h5>

                We are here to help your wedding dreams come true with a host of wedding planning tips and recommended suppliers for the discerning bride and groom. Make your wedding and honeymoon one to remember with our amazing collection of dream WEDDING SUPPLIERS.
                From stunning head-turning wedding dresses and dazzling accessories, opulent tableware and floral arrangements, stationery and favours and our amazing wedding venues.</P>

                  </div>




        <div class="row justify-content-center" data-aos="zoom-in" data-aos-duration="3000">
            @forelse ($topadsbookings as $normalAd)
            <div class="col-md-4 cards" >
                <div class="card shadows alert-warning" style="width: 20rem;">
                    {{-- <div class="inner">
                        <img class="card-img-top" src="{{ $normalAd->ad_image ? asset('/storage/'.$normalAd->ad_image) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="Card image cap">
                    </div>
                        <div class="card-body text-center">
                            <div class="carddata">
                            <h5 class="card-title">{{ $normalAd->ad_title }}</h5>
                            <div class="card-text">{{ Str::words(strip_tags(html_entity_decode($normalAd->about)), 15, '...') }}</div>
                            </div>
                            <a href="{{ route('topAds.show', $normalAd->id) }}" class="more-bttn" style="margin-top: 0 !important;">
                                Visit
                            </a>

                        </div> --}}



                        <div class="inner">
                            <img class="card-img-top" src="{{ $normalAd->ad_image ? asset('/storage/'.$normalAd->ad_image) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="Card image cap">
                        </div>
                            <div class="card-body text-center">
                                <div class="carddata">
                                <h5 class="card-title">{{ ucfirst(Str::words($normalAd->ad_title, 8, '...')) }}</h5>
                                {{-- <h5 class="card-title">{{ ucfirst($normalAd->ad_title) }}</h5> --}}
                                <div class="card-text">{{ ucfirst(Str::words(strip_tags(html_entity_decode($normalAd->about)), 15, '...')) }}</div>
                                <div class="bg-dark p-1 text-white mt-3">Main Location: {{ ucfirst($normalAd->v_bus_location)  }}</div>

                                    @if ($normalAd->v_bus_branches)
                                    {{-- <div class="bg-dark p-1 text-white my-1">
                                        Branches : {{ ucfirst(implode(', ', $normalAd->v_bus_branches)) }}<br>
                                    </div> --}}
                                    @endif

                                    <?php
                                    $category_name = DB::table('vendor_categories')
                                        ->select('Category_name')
                                        ->where('id', '=', $normalAd->category_id)
                                        ->value('Category_name');
                                    ?>

                            <div class="bg-secondary p-1 text-white my-1">
                                Category : {{ ucfirst($category_name) }}<br>
                            </div>

                                </div>

                                <div class="card-stats">
                                    <div class="button_container">
                                        <a href="{{ route('topAds.show', $normalAd->id) }}" class="more-bttn" style="margin-top: 20 !important;">
                                            Visit
                                        </a>
                                    </div>
                                </div>
                                </div>



                </div>
            </div>
            @empty
            <div class="alert alert-danger w-100 text-center" role="alert">
                No Vendor Top Ads Available.
            </div>
            @endforelse





            @forelse ($bookings as $normalAd)
            <div class="col-md-4 cards" >
                <div class="card shadows" style="width: 20rem;">
                    <div class="inner">
                        <img class="card-img-top" src="{{ $normalAd->ad_image ? asset('/storage/'.$normalAd->ad_image) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="Card image cap">
                    </div>
                        <div class="card-body text-center">
                            <div class="carddata">
                        <h5 class="card-title">{{ ucfirst(Str::words($normalAd->ad_title, 8, '...')) }}</h5>

                           <div class="card-text">{{ ucfirst(Str::words(strip_tags(html_entity_decode($normalAd->about)), 15, '...')) }}</div>
                            <div class="bg-dark p-1 text-white mt-3">Main Location: {{ ucfirst($normalAd->v_bus_location)  }}</div>

                                {{-- @if ($normalAd->v_bus_branches)
                                <div class="bg-dark p-1 text-white my-1">
                                    Branches : {{ ucfirst(implode(', ', $normalAd->v_bus_branches)) }}<br>
                                </div>
                                @endif --}}


                                <?php
                                    $category_name = DB::table('vendor_categories')
                                        ->select('Category_name')
                                        ->where('id', '=', $normalAd->category_id)
                                        ->value('Category_name');
                                ?>

                            <div class="bg-secondary p-1 text-white my-1">
                                Category : {{ ucfirst($category_name) }}<br>
                            </div>

                            </div>

                            <div class="card-stats">
                                <div class="button_container">
                                    <a href="{{ route('advertistments.show', $normalAd->id) }}" class="more-bttn" style="margin-top: 20 !important;">
                                        Visit
                                    </a>
                                </div>
                            </div>
                            </div>
                        </div>
                </div>
            {{-- </div> --}}
            @empty
            <div class="alert alert-danger w-100 text-center" role="alert">
                No Vendor Ads Available.
            </div>
            @endforelse











        </div>

    </div>



    <div class="clearfix"></div>


    {{-- @if ($allAds== null)
    <div class="paginationa my-5"></div>
    @else
    <div class="paginationa my-5">{{ $allAds->links('pagination::bootstrap-5') }}</div>
    @endif --}}

{{-- @if ($allAds == null)
    <div class="paginationa my-5"></div>
@else
    <div class="paginationa my-5">
        {{ $allAds->appends(['category' => $category, 'location' => $location])->links('pagination::bootstrap-5') }}
    </div>
@endif --}}




    <!-------------------------------------------Footer Begin---------------------------------------------->
    @include('components.onlyfooter')

      <!-------------------------------------------Footer End---------------------------------------------->
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

</body>
</html>
