
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

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

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
    color: #B76E79;
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
          <img class="img-fluid" src="images/slider/vendors/v1.jpg" >
          <div class="carousel-caption">
            <h1>Welcome To Wedding Bells</h1>
            <p>The Sri Lankan Premium Wedding Resource Directory.</p>

            <button type="button"  id="vidBtn" class="more-bttn" data-toggle="modal" data-target="#slider1">
              Read more
            </button>
          </div>
        </div>

        <div class="carousel-item">
          <img class="img-fluid" src="images/slider/vendors/v2.jpg">
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
          <img class="img-fluid" src="images/slider/vendors/v3.jpg">
          <div class="carousel-caption">
            <h1>Are you A Vendor?</h1>
            <p>We are here to help your grow your business.Come join with us to advertise</p>

            <button type="button"  id="vidBtn" class="more-bttn" data-toggle="modal" data-target="#slider3">
              Read more
            </button>
          </div>
        </div>

        <div class="carousel-item">
          <img class="img-fluid" src="images/slider/vendors/v4.jpg">
          <div class="carousel-caption">
            <h1>Contact Us </h1>
            <P>Build your team with the best wedding professionals</p>

            <button type="button" id="vidBtn" class="more-bttn" data-toggle="modal" data-target="#slider4">
              Read more
            </button>
          </div>
        </div>


        <div class="carousel-item">
          <img class="img-fluid" src="images/slider/vendors/v5.jpg">
          <div class="carousel-caption">
            <h1>Who We Are</h1>
            <p >Begin Planning Your Dream Wedding Day at Wedding Bells & Make Your Big Day Shine</p>

            <button type="button" id="vidBtn" class="more-bttn" data-toggle="modal" data-target="#slider5">
              Read more
            </button>
          </div>
        </div>


        <div class="carousel-item">
          <img class="img-fluid" src="images/slider/vendors/v6.jpg">
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

    <div class="container ads" id="vendors">

        <h1 data-aos="zoom-in">Looking For Vendors?</h1>
            <h3 data-aos="zoom-in">YOU ARE IN RIGHT PLACE</h3>
            <P><h5>A HANDPICKED COLLECTION OF THE WORLD'S BEST LUXURY WEDDING SUPPLIERS</h5>
               <h5> Featuring The Sri Lankan Best wedding professionals, top wedding planners, and the best magnificent venues.</h5>

                We are here to help your wedding dreams come true with a host of wedding planning tips and recommended suppliers for the discerning bride and groom. Make your wedding and honeymoon one to remember with our amazing collection of dream WEDDING SUPPLIERS.
                From stunning head-turning wedding dresses and dazzling accessories, opulent tableware and floral arrangements, stationery and favours and our amazing wedding venues.</P>
                 <div class="searchbarheader" id="quicksearch" data-aos="fade-up" data-aos-duration="2000">
                    <h1 class="searchh1">Find <span class="searcher">VENDORS</span> THAT YOU <span class="searcher">WANT</span></h1>
                    {{-- <form>
                      <div class="form-box">
                        <form action="{{ route('advertistments.index') }}" method="GET">
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
                    </form> --}}
                  </div>



                  <section class="search-bar">
                    <div class="container">
                      <div class="row">
                        <div class="col-lg-10 mx-auto">
                              <div class="p-1 bg-light shadow-sm">

                                  <form action="{{ route('ads.index') }}" method="GET">
                                      <div class="input-group">
                                      <input type="search" name="vendorName" placeholder="search by vendor Name" class="form-control searchbarz">
                                      <input type="hidden" name="vCategory">
                                      <div class="input-group-append">
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
                                  </form>

                                </div>
                              </div>
                          </div>


                      </div>
                    </div>
                  </section>



        <div class="row justify-content-center" data-aos="zoom-in" data-aos-duration="3000">
            @forelse ($vendorTopAds as $normalAd)
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
                                    <div class="bg-dark p-1 text-white my-1">
                                        Branches : {{ ucfirst(implode(', ', $normalAd->v_bus_branches)) }}<br>
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

                                    <div class="bg-secondary p-1 text-white my-1">
                                        Buisness : {{ ucfirst($normalAd->vBusinessName) }}<br>
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
                No Vendor Posts Available.
            </div>
            @endforelse











            @forelse ($vendorNormalAds as $normalAd)
            <div class="col-md-4 cards" >
                <div class="card shadows" style="width: 20rem;">
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
                                <div class="bg-dark p-1 text-white my-1">
                                    Branches : {{ ucfirst(implode(', ', $normalAd->v_bus_branches)) }}<br>
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

                            <div class="bg-secondary p-1 text-white my-1">
                                Buisness : {{ ucfirst($normalAd->vBusinessName) }}<br>
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
                No Vendor Posts Available.
            </div>
            @endforelse





        </div>

    </div>



    <div class="clearfix"></div>

    @if ($paginator== null)
    <div class="paginationa my-5"></div>
    @else
    <div class="paginationa my-5">{{ $paginator->links('pagination::bootstrap-5') }}</div>
    @endif

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


@if ($allAds == null)
    <div class="paginationa my-5"></div>
@else
    <div class="paginationa my-5">
        {{ $allAds->appends(['vCategory' => $request->input('vCategory'), 'vendorName' => $request->input('vendorName')])->links('pagination::bootstrap-5') }}
    </div>
@endif

    <!-------------------------------------------Footer Begin---------------------------------------------->
    @include('components.onlyfooter')

      <!-------------------------------------------Footer End---------------------------------------------->


        <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/aos.js') }}"></script>
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
