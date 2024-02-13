
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">


        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
         alpha/css/bootstrap.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css"
         href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


        @livewireStyles

    <style>

        .ads{
            margin-top: 100px;
            text-align: center;
            scroll-margin-top: -100px;
            background-color: #fff; /* Add a background color */
            border-radius: 10px; /* Add a border radius for a neater look */
            padding: 20px; /* Add some padding for spacing */
        }

        .ads h1 {
            letter-spacing: 12px;
            margin-bottom: 15px;
            font-size: 19px;
            font-weight: bold;
        }

        .ads h3 {
            color: #B76E79;
            margin-bottom: 20px; /* Reduce margin for better spacing */
        }

        .ads p {
            font-size: 1.2rem;
            max-width: 80vw;
            text-align: center;
            margin: auto;
            margin-bottom: 30px; /* Adjust margin for better spacing */
            line-height: 1.6; /* Increase line height for better readability */
        }



/* .pagination a {
  color: white;
  background-color: #6A0DAD;
  border-radius: 50%;
}
.pagination a:active {
  border: cyan solid 3px;
  border-radius: 50%;
  color: white;
}

.pagination a:hover {
    background:linear-gradient(to right,#6e1eee,#f3f3f3);
  color: white;
}
.pagenumbers{
    margin-top: 70px;
} */



/* .pagination a:hover {
    background:linear-gradient(to right,#6e1eee,#f3f3f3);
  color: white;
}
.pagenumbers{
    margin-top: 70px;
}------*/
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

    <div class="container ads" id="vendors">

        <h1 data-aos="zoom-in">{{ $category_name }} Favourites</h1>
              {{-- <h3 data-aos="zoom-in">Find Your Ideal Matches Here</h3>
              <h5 data-aos="zoom-in">Explore the Finest Local Luxury Wedding Suppliers</h5>

              <P><h6>Turning Wedding Dreams into Reality!</h6>
                Discover Expert Tips and Trusted Suppliers for Your Special Day. Elevate Your Wedding and Honeymoon Experience with Our Exquisite Selection of Suppliers.
                Explore Breathtaking Wedding Dresses, Elegant Accessories, Luxurious Tableware, Stunning Floral Arrangements, Inviting Stationery, and Unique Favours, Alongside our Exceptional Wedding Venues.".</P> --}}


            <div class="row justify-content-center" data-aos="zoom-in" data-aos-duration="3000">
                @forelse ($categorywishlistAds as $categorywishlistAd)
                @php
                    $categoryFavouriteTopAd = DB::table('advertisements')->where('id', '=', $categorywishlistAd->ad_id)->where('ad_type', 1)->first();
                    $normalAd = DB::table('advertisements')->where('id', '=', $categorywishlistAd->ad_id)->where('ad_type', 0)->first();

                @endphp

                        @if ($categoryFavouriteTopAd)
                        <div class="col-md-4 cards" >
                            <div class="card shadows alert-warning" style="width: 20rem;">




                                    <div class="inner">
                                        <div class="heart-position">
                                            @auth
                                            <button type="button" class="btn btn-sm btn-light heartIcon">
                                                @livewire('wishlist', ['adId' => $categoryFavouriteTopAd->id, 'clientId' => $categoryFavouriteTopAd->actual_v_id])
                                            </button>
                                            @endauth
                                        </div>

                                        <img class="card-img-top" src="{{ $categoryFavouriteTopAd->ad_image ? asset('/storage/'.$categoryFavouriteTopAd->ad_image) : asset('/storage/default_images/default_category_thumb.jpg') }}" alt="Card image cap">
                                    </div>
                                        <div class="card-body text-center">
                                            <div class="carddata">
                                            <h5 class="card-title">{{ ucfirst(Str::words($categoryFavouriteTopAd->ad_title, 8, '...')) }}</h5>
                                            {{-- <h5 class="card-title">{{ ucfirst($categoryFavouriteTopAd->ad_title) }}</h5> --}}
                                            <div class="card-text">{{ ucfirst(Str::words(strip_tags(html_entity_decode($categoryFavouriteTopAd->about)), 15, '...')) }}</div>
                                            <div class="bg-dark p-1 text-white mt-3">Main Location: {{ ucfirst($categoryFavouriteTopAd->v_bus_location)  }}</div>

                                                {{-- @if ($categoryFavouriteTopAd->v_bus_branches)
                                                <div class="bg-dark p-1 text-white my-1">
                                                    Branches : {{ ucfirst(implode(', ', $categoryFavouriteTopAd->v_bus_branches)) }}<br>
                                                </div>
                                                @endif --}}

                                                <?php
                                                $category_name = DB::table('vendor_categories')
                                                    ->select('Category_name')
                                                    ->where('id', '=', $categoryFavouriteTopAd->category_id)
                                                    ->value('Category_name');
                                                ?>

                                                <div class="bg-secondary p-1 text-white my-1">
                                                    Category : {{ ucfirst($category_name) }}<br>
                                                </div>

                                                <div class="bg-dark p-1 text-white mt-2">Start From : Rs.{{ $categoryFavouriteTopAd->start_price  }}</div>
                                            </div>

                                            <div class="card-stats">
                                                <div class="button_container">
                                                    <a href="{{ route('advertistments.show', $categoryFavouriteTopAd->id) }}" class="more-bttn" style="margin-top: 20 !important;">
                                                        Visit
                                                    </a>
                                                </div>
                                            </div>
                                            </div>



                            </div>
                        </div>
                        @else
                        <div class="col-md-4 cards" >
                            <div class="card shadows" style="width: 20rem;">
                                <div class="inner">
                                    <div class="heart-position">
                                        @auth
                                        <button type="button" class="btn btn-sm btn-light heartIcon">
                                            @livewire('wishlist', ['adId' => $normalAd->id, 'clientId' => $normalAd->actual_v_id])
                                        </button>
                                        @endauth
                                    </div>
                                    <img class="card-img-top" src="{{ $normalAd->ad_image ? asset('/storage/'.$normalAd->ad_image) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="Card image cap">
                                </div>
                                    <div class="card-body text-center">
                                        <div class="carddata">
                                        <h5 class="card-title">{{ ucfirst(Str::words($normalAd->ad_title, 8, '...')) }}</h5>
                                        {{-- <h5 class="card-title">{{ ucfirst($normalAd->ad_title) }}</h5> --}}
                                        <div class="card-text">{{ ucfirst(Str::words(strip_tags(html_entity_decode($normalAd->about)), 15, '...')) }}</div>
                                        <div class="bg-dark p-1 text-white mt-3">Main Location: {{ ucfirst($normalAd->v_bus_location)  }}</div>

                                        @if ($normalAd->v_bus_branches)
                                        <div class="bg-dark p-1 text-white my-1">
                                            @if (is_array($normalAd->v_bus_branches))
                                                Branches : {{ ucfirst(implode(', ', $normalAd->v_bus_branches)) }}<br>
                                            @else
                                                Branches : {{ ucfirst($normalAd->v_bus_branches) }}<br>
                                            @endif
                                        </div>
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

                                        <div class="bg-dark p-1 text-white mt-3">Start From : Rs.{{ $normalAd->start_price  }}</div>

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
                        @endif

                @empty
                <div class="alert alert-danger w-100 text-center" role="alert">
                    No Favourites Ads Available For This Category.
                </div>
                @endforelse





        </div>

    </div>



    <div class="clearfix"></div>

    {{-- @if ($paginator== null)
    <div class="paginationa my-5"></div>
    @else
    <div class="paginationa my-5">{{ $paginator->links('pagination::bootstrap-5') }}</div>
    @endif --}}

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




{{-- @if ($allAds == null)
    <div class="paginationa my-5"></div>
@else
    <div class="paginationa my-5">
        {{ $allAds->appends(['category' => $request->input('category'), 'location' => $request->input('location')])->links('pagination::bootstrap-5') }}
    </div>
@endif --}}

    <!-------------------------------------------Footer Begin---------------------------------------------->
    @include('components.onlyfooter')

      <!-------------------------------------------Footer End---------------------------------------------->


      @livewireScripts

<script>
    window.addEventListener('toastr:info', event => {
       toastr.info(event.detail[0].message);

    })

    window.addEventListener('toastr:error', event => {
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
