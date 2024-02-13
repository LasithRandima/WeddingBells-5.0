<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

$gallery = DB::table('vendor_galleries')
    ->where('v_id', '=', $topAd->v_id)
    ->inRandomOrder()
    ->get();
$gallery2 = DB::table('vendor_galleries')
    ->where('v_id', '=', $topAd->v_id)
    ->inRandomOrder()
    ->get();

$gallery3 = DB::table('vendor_galleries')
    ->where('v_id', '=', $topAd->v_id)
    ->where('image_order', '>=', (int) $topAd->v_id . '1')
    ->where('image_order', '<=', (int) $topAd->v_id . '5')
    ->limit(5)
    ->orderBy('image_order', 'asc')
    ->get();

$gallerycount = DB::table('vendor_galleries')
    ->where('v_id', '=', $topAd->v_id)
    ->where('image_order', '>=', (int) $topAd->v_id . '1')
    ->where('image_order', '<=', (int) $topAd->v_id . '5')
    ->count();

$galleryallimagescount = DB::table('vendor_galleries')
    ->where('v_id', '=', $topAd->v_id)
    ->count();
// var_dump($vendor);
$website_url = DB::table('vendors')
    ->select('v_website_url')
    ->where('user_id', '=', $topAd->v_id)
    ->value('v_website_url');

$wedding_date = DB::table('clients')
    ->select('wed_date')
    ->where('user_id', '=', Auth::id())
    ->value('wed_date');

$category_name = DB::table('vendor_categories')
    ->select('Category_name')
    ->where('id', '=', $topAd->category_id)
    ->value('Category_name');

$wedding_date = DB::table('clients')
    ->select('wed_date')
    ->where('user_id', '=', Auth::id())
    ->value('wed_date');

$wedding_start_time = DB::table('clients')
    ->select('wed_start_time')
    ->where('user_id', '=', Auth::id())
    ->value('wed_start_time');

$wedding_end_time = DB::table('clients')
    ->select('wed_end_time')
    ->where('user_id', '=', Auth::id())
    ->value('wed_end_time');

$wishlist = DB::table('client_wishlists')
    ->where('ad_id', '=', $topAd->id)
    ->where('c_id', '=', Auth::id())
    ->first();

$phone = DB::table('clients')
    ->select('c_tpno')
    ->where('user_id', '=', Auth::id())
    ->value('c_tpno');

// Decode the JSON string into a PHP array
$data = json_decode($phone, true);

// Check if the array is not empty and has the "c_tpno" key
if (!empty($data) && isset($data[0]['c_tpno'])) {
    $c_tpno = $data[0]['c_tpno'];
    // echo $c_tpno;
} else {
    // echo "No 'c_tpno' found in the JSON array.";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="title"
        content="{{ $topAd->meta_title ? 'Wedding Bells - ' . $topAd->meta_title : 'Wedding Bells - ' . $topAd->vBusinessName }}">
    <meta name="description"
        content="{{ $topAd->meta_des ?: 'Embrace Wedding Bells, Where Love Rings True! For Wedding Experts: Showcase your skills to couples seeking perfection. Lovebirds on the Marriage Journey: Find top-notch vendors, plan stress-free, and turn dreams into cherished memories. Craft Your Unforgettable Moments with Us! Join in creating a timeless love story.' }}">
    @if ($topAd->meta_tags)
        <meta name="keywords"
            content="Weddingbells, weddingbells - {{ $category_name }}, weddingbells - {{ $topAd->vBusinessName }} , {{ $topAd->vBusinessName }}, {{ implode(', ', $topAd->meta_tags) }}">
    @else
        <meta name="keywords"
            content="Weddingbells, weddingbells - {{ $category_name }}, weddingbells - {{ $topAd->vBusinessName }} , {{ $topAd->vBusinessName }}, wedding, wedding directory, wedding bells, sri lanka, no 1 wedding directory, no 1 wedding directory in sri lanka">
    @endif
    <title>Vendor Details</title>

    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/imagegallery.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footernavheader.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="{{ url('css/bootstrap5.2.3.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
    <link href="{{ url('css/ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('fonts/fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ url('css/vendor_detail.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/toastify.min.css') }}" type="text/css" />
    <script type="text/javascript" src="{{ asset('js/toastify-js.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
    alpha/css/bootstrap.css"
        rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @livewireStyles

    <style>
        div#social-links {
            margin: 0 auto;
            max-width: 500px;
        }

        div#social-links ul li {
            display: inline-block;
        }

        div#social-links ul li a {
            padding: 10px;
            border: 1px solid #ccc;
            margin: 1px;
            font-size: 30px;
            color: #333;
            background-color: #efeded;
        }

        .gallery-btn:hover,
        .gallery-btn:hover i {
            color: #6A0DAD;
            /* Set the desired hover color for the text and icon */
        }

        .wishlist-btn:hover {
            background-color: #D4AF37 !important;
            color: #000000 !important;
        }
    </style>

    @livewireStyles

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










    @auth
        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)

            <div class="container-fluid px-5 navheight">
                <section class="padding-bottom bg-light">
                    <div class="header_container" data-container>
                        @php
                            $counter = 0;
                        @endphp


                        @forelse ($gallery3 as $gimage)
                            @if ($counter < 4)
                                <div class="img_card"
                                    style="background-image: url('{{ $gimage->image_path ? asset('/storage/' . $gimage->image_path) : asset('/storage/default_images/default_category_thumb.jpg') }}')">
                                </div>
                                @php $counter++; @endphp
                            @else
                            @break
                        @endif
                    @empty
                        <div class="d-flex justify-content-center align-items-center h-100 w-100">
                            <div>
                                <h3>No Images Found. Please Add Images To Your Vendor Gallery Section.</h3>
                            </div>
                        </div>
                    @endforelse


                    @if ($gallerycount >= 5)
                        <div class="img_card"
                            style="background-image: url('{{ $gallery3[4]->image_path ? asset('/storage/' . $gallery3[4]->image_path) : asset('/storage/default_images/default_category_thumb.jpg') }}')">
                            <div class="d-flex flex-column justify-content-end align-items-end justify-items-end"
                                style="height: 100%;">
                                <!-- Your Bootstrap button goes here -->
                                <a class="btn btn-light btn-lg mb-3 me-3 gallery-btn" href="#gallery"><span><i
                                            class="fas fa-images"></i> See All
                                        ({{ $galleryallimagescount }})</span></a>
                                {{-- <button type="button" class="btn btn-primary mb-3"></button> --}}
                            </div>
                        </div>
                    @endif
            </section>
        </div>
    @else
        <div class="container-fluid px-5 navheight">
            <section class="padding-bottom bg-light">
                <div class="header_container" data-container>
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($gallery3 as $gimage)
                        @if ($counter < 4)
                            <div class="img_card"
                                style="background-image: url('{{ $gimage->image_path ? asset('/storage/' . $gimage->image_path) : asset('/storage/default_images/default_category_thumb.jpg') }}')">
                            </div>
                            @php $counter++; @endphp
                        @else
                        @break
                    @endif
                @endforeach

                @if ($gallerycount >= 5)
                    <div class="img_card"
                        style="background-image: url('{{ $gallery3[4]->image_path ? asset('/storage/' . $gallery3[4]->image_path) : asset('/storage/default_images/default_category_thumb.jpg') }}')">
                        <div class="d-flex flex-column justify-content-end align-items-end justify-items-end"
                            style="height: 100%;">
                            <!-- Your Bootstrap button goes here -->
                            <a class="btn btn-light btn-lg mb-3 me-3 gallery-btn" href="#gallery"><span><i
                                        class="fas fa-images"></i> See All
                                    ({{ $galleryallimagescount }})</span></a>
                            {{-- <button type="button" class="btn btn-primary mb-3"></button> --}}
                        </div>
                    </div>
                @endif
        </section>
    </div>
@endif
@endauth


@guest
<div class="container-fluid px-5 navheight">
    <section class="padding-bottom bg-light">
        <div class="header_container" data-container>
            @php
                $counter = 0;
            @endphp
            @foreach ($gallery3 as $gimage)
                @if ($counter < 4)
                    <div class="img_card"
                        style="background-image: url('{{ $gimage->image_path ? asset('/storage/' . $gimage->image_path) : asset('/storage/default_images/default_category_thumb.jpg') }}')">
                    </div>
                    @php $counter++; @endphp
                @else
                @break
            @endif
        @endforeach

        @if ($gallerycount >= 5)
            <div class="img_card"
                style="background-image: url('{{ $gallery3[4]->image_path ? asset('/storage/' . $gallery3[4]->image_path) : asset('/storage/default_images/default_category_thumb.jpg') }}')">
                <div class="d-flex flex-column justify-content-end align-items-end justify-items-end"
                    style="height: 100%;">
                    <!-- Your Bootstrap button goes here -->
                    <a class="btn btn-light btn-lg mb-3 me-3 gallery-btn" href="#gallery"><span><i
                                class="fas fa-images"></i> See All ({{ $galleryallimagescount }})</span></a>
                    {{-- <button type="button" class="btn btn-primary mb-3"></button> --}}
                </div>
            </div>
        @endif
</section>
</div>
@endguest






<div class="container-fluid mt-4">
<div class="row">

<!-- Main Content Column (8/12) -->
<div class="col-lg-8 pe-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-4 sticky-top second_nav">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <div>


        <div class="container">

            <hr class="mb-4">
            <h1 class="card-title mb-2" style="font-weight: 600; color: #000;">
                {{ ucfirst($vendor->v_bus_name) }}


                @if ($wishlist)
                    <i class="bi bi-suit-heart-fill ms-2 text-danger wishlist-toggle"
                        data-ad-id="{{ $topAd->id }}" data-client-id="{{ $topAd->actual_v_id }}"
                        style="font-size: 0.8em; font-weight:200;"></i>
                @else
                    <i class="bi bi-suit-heart-fill ms-2 text-secondary wishlist-toggle"
                        data-ad-id="{{ $topAd->id }}" data-client-id="{{ $topAd->actual_v_id }}"
                        style="font-size: 0.8em; font-weight:200;"></i>
                @endif

                {{-- <span style="font-size: 0.8em; font-weight:200;">
                                    @livewire('wishlist', ['adId' => $topAd->id, 'clientId' => $topAd->actual_v_id])
                                </span> --}}



            </h1>
            <p class="mb-0 text-muted my-1" style="font-size: 1.1rem; color:#000; font-style:italic">
                {{ ucfirst($vendor->slogan) }}</p>
            <p class="mb-0 text-muted my-1" style="font-size: 1.1rem"><a
                    href="{{ $vendor->v_website_url }}" target="_blank"
                    rel="noopener noreferrer">{{ $vendor->v_website_url }}</a></p>
            <livewire:advertistment-review-average :ad_id="$topAd->id" :avgRating="$topAd->avg_rating" />

            <div class="socials">
                @foreach ($vendorSocials as $social)
                    @if ($social->social_network)
                        <a href="//{{ $social->social_network }}" target="_blank"
                            class="text-dark icon-link" style="text-decoration: none !important;">
                            @if ($social->icon)
                                <span class="me-1"><x-icon name="{{ $social->icon }}"
                                        class="icon-size" /></span>
                            @else
                                <span class="me-1"><i
                                        class="fab fa-{{ $social->name }} default-icon"></i></span>
                            @endif
                        </a>
                    @endif
                @endforeach
            </div>
            <!-- Bootstrap Navbar -->



            <div class="row px-4 pb-0 pe-lg-0 pt-lg-5 align-items-center">
                {{-- <div class="col-lg-12 p-0 overflow-hidden shadow-lg inner">
                                <div class="img-wrapper pe-3">
                                    <img src="{{ asset('/storage/'.$topAd->ad_image) }}" alt="Ad_image" srcset="">
                                </div>
                            </div> --}}

                <div
                    class="col-lg-12 p-0 overflow-hidden shadow-lg img-outer-wrapper d-flex align-items-center justify-content-center">
                    <div class="img-wrapper2">
                        <div class="img_boxs">
                            <img src="{{ asset('/storage/' . $topAd->ad_image) }}" alt="Ad_image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-11 p-3 p-lg-5 pt-lg-3 mt-3">
                    <h5 class="display-7 fw-bold lh-1">{{ $topAd->ad_title }}</h5>
                    {{-- <p class="lead">{!! html_entity_decode($topAd->about) !!}</p> --}}
                    <div class="tiptap-editor">
                        <div class="tiptap-wrapper">
                            <div class="tiptap-prosemirror-wrapper">
                                <div class="tiptap-content">
                                    {!! tiptap_converter()->asHTML($topAd->about) !!}
                                </div>
                            </div>
                        </div>
                    </div>


                    <p class="lead">{!! html_entity_decode($topAd->service_offered) !!}</p>
                    <p class="lead">{!! html_entity_decode($topAd->v_package_details) !!}</p>
                    <p class="lead" style="font-size: 19px">Packages Start From :
                        Rs.{{ $topAd->start_price }}</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                        <div class="my-3">{!! $shareComponent !!}</div>
                    </div>
                    @if (Auth::user())
                        @if ($wedding_date)
                            <a href="{{ route('clientVendorBookings.show', $topAd->id) }}"
                                class="more-bttns">Request Pricing</a>
                        @else
                            <a href="{{ route('customerreg') }}" class="more-bttns">Complete
                                registernation for Booking Process</a>
                        @endif
                    @else
                        {{-- @php
                                      $redirectUrl = route('clientVendorBookings.show', $topAd->id);
                                      Session::put('redirectUrl', $redirectUrl);
                                  @endphp

                                  <a href="{{ route('login') }}" class="more-bttns">Request Pricing</a> --}}
                        <a href="{{ route('login') }}" class="more-bttns" target="_blank">Log Before
                            Booking</a>
                    @endif

                    @auth
                        @if ($wishlist)
                            <button type="button" class="more-bttn text-danger wishlist-toggle wishlist-btn"
                                data-ad-id="{{ $topAd->id }}"
                                data-client-id="{{ $topAd->actual_v_id }}">Remove From Wishlist</button>
                        @else
                            <button type="button" class="more-bttn wishlist-toggle wishlist-btn"
                                data-ad-id="{{ $topAd->id }}" data-client-id="{{ $topAd->actual_v_id }}"
                                style="background-color: #9012f1; color: #FFFFFF;">Add To Wish List</button>
                        @endif
                    @endauth



                    {{-- <p>{{ Session::get('redirectUrl') }}</p> --}}

                </div>

            </div>
        </div>

        <hr class="border border-secondary opacity-55" id="gallery">
        <h4 class="card-title mb-5">Gallery</h4>



        <div class="row">
            <div class="col-xl-12">
                <div class="task-list-box" id="landing-task">
                    <div id="task-item-1">
                        <div class="card task-box rounded-3">
                            <div class="card-body">
                                <div class="row">
                                    @include('components.vendorgallery')
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div>
                </div><!-- end -->
            </div>
        </div>


        <hr class="border border-secondary opacity-50 mt-5" id="about">
        <h4 class="card-title mb-4">About This Vendor</h4>
        <div class="row align-items-center mb-5">

            <div class="col-12">
                <div class="ms-3">
                    <div>
                        <h4 class="card-title mb-2">{{ ucfirst($vendor->v_bus_name) }}</h4>
                        <p class="mb-2 text-muted" style="font-style: italic">
                            {{ ucfirst($vendor->slogan) }}</p>
                        <p class="my-2 text-muted">{!! html_entity_decode($vendor->v_description) !!}</p>

                        <hr>

                        <p class="my-2 text-muted"><i
                                class="fas fa-globe me-2"></i>{{ $vendor->v_website_url }}</p>
                        <p class="text-muted my-2"><i
                                class="fas fa-envelope me-2"></i>{{ $vendor->v_email }}
                        </p>
                        @foreach ($vendor->v_phone as $phone)
                            <p class="text-muted mb-0">
                                <i class="fas fa-phone me-2"></i>{{ $phone['v_phone'] }}
                            </p>
                        @endforeach
                        <livewire:advertistment-review-average :ad_id="$topAd->id" :avgRating="$topAd->avg_rating" />
                    </div>




                </div>
            </div><!-- end col -->
        </div><!-- end row -->

        <hr class="border border-secondary opacity-50 mt-5" id="faq">
        <h4 class="card-title mb-4">Frequent Ask Question</h4>

        <div class="row mb-5">
            @foreach ($vendorFaqs as $faq)
                <div class="accordion accordion-flush mb-5" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="true"
                                aria-controls="flush-collapseOne">
                                {{ $faq->Question }}
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show"
                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">{{ $faq->Answer }}</div>
                        </div>
                    </div>
                </div>
            @endforeach

            <hr class="border border-secondary opacity-50 mt-1">
            <div id="reviews" class="mt-2">
                <livewire:advertistment-reviews-special :advertisement="$topAd" :v_id="$topAd->v_id"
                    :actual_v_id="$topAd->actual_v_id" :ad_id="$topAd->id" :totalReviews="$topAd->total_reviews" />
            </div>

        </div><!-- end tab pane -->








    </div>
</div>




<!-- Form Column (4/12) -->
<div class="col-lg-4 form-column" style="border-left:  #adb5bd solid 1px;">



    <div class="">
        @auth
            <form action="{{ route('clientVendorBookings.store') }}" method="POST"
                enctype="multipart/form-data" class="form-group py-3" data-aos="zoom-in">
                @csrf
                <h2 class="mb-3">Message Vendor</h2>
                @if ($errors->any())
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading" style="font-size: 1.2em">Something is wrong with your
                                input</h4>
                            <hr>
                            <ul class="">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <input type="hidden" name="c_id" value="{{ Auth::id() }}">
                <input type="hidden" name="ad_id" value="{{ $topAd->id }}">
                <input type="hidden" name="ad_vid" value="{{ $topAd->actual_v_id }}">
                <input type="hidden" name="top_ad_vid" value="{{ $topAd->v_id }}">
                <input type="hidden" name="categoryid" value="{{ $topAd->category_id }}">

                <div class="col-md-12">
                    <label class="form-label" for="form6Example3">Your name</label>
                    <input type="text" id="form6Example3" value="{{ Auth::user()->name }}"
                        name="cName" class="form-control" />
                </div>

                <!-- Email input -->
                <div class="col-md-12">
                    <label class="form-label" for="form6Example5">Email</label>
                    <input type="email" id="form6Example5" value="{{ Auth::user()->email }}"
                        name="cEmail" class="form-control" />
                </div>

                <!-- Number input -->
                @if (Auth()->user()->role_id == '3')
                    <div class="col-md-12">
                        <label class="form-label" for="form6Example6">Phone</label>
                        <input type="number" min="0" id="form6Example6" name="cPhone"
                            class="form-control" value="{{ $c_tpno }}" />

                    </div>
                @else
                    <div class="col-md-12">
                        <label class="form-label" for="form6Example6">Phone</label>
                        <input type="number" min="0" id="form6Example6" name="cPhone"
                            class="form-control" />

                    </div>
                @endif





                <!-- Text input -->
                <div class="col-md-12">
                    <label class="form-label" for="form6Example4">Event Date</label>
                  <input type="date" id="form6Example4" name="cEventDate" class="form-control" value="{{ $wedding_date }}" />

                </div>


                <div class="col-md-12">
                    <label class="form-label" for="form6Example4">Event Start Time</label>
                    <input type="time" id="form6Example4" name="cEventStartTime" class="form-control" value="{{ $wedding_start_time }}" />

                </div>

                <div class="col-md-12">
                    <label class="form-label" for="form6Example4">Event End Time</label>
                    <input type="time" id="form6Example4" name="cEventEndTime" class="form-control" value="{{ $wedding_end_time }}" />

                </div>

                <!-- Message input -->
                <div class="col-md-12">
                    <label class="form-label" for="form6Example7">Message</label>
                    <textarea class="form-control" name="cMessage" id="form6Example7" rows="4"></textarea>
                </div>



                <button type="submit" class="more-bttns mt-2 mb-5">Send Inquiry</button>
                <!-- Submit button -->


            </form>
        @endauth


        @guest
            <form action="{{ route('clientVendorBookings.store') }}" method="POST"
                enctype="multipart/form-data" class="form-group py-3" data-aos="zoom-in">
                @csrf
                <h2 class="mb-3">Message Vendor</h2>
                @if ($errors->any())
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading" style="font-size: 1.2em">Something is wrong with your
                                input</h4>
                            <hr>
                            <ul class="">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                @endif

                @guest
                    <div class="alert alert-danger" role="alert">
                        You Have to logged before send Inquiry.
                    </div>
                @endguest

                <input type="hidden" name="c_id" value="">
                <input type="hidden" name="ad_id" value="{{ $topAd->ad_id }}">
                <input type="hidden" name="ad_vid" value="{{ $topAd->v_id }}">
                <input type="hidden" name="top_ad_vid" value="{{ $topAd->v_id }}">

                <div class="col-md-12">
                    <label class="form-label" for="form6Example3">Your name</label>
                    <input type="text" id="form6Example3" value="" name="cName"
                        class="form-control" />
                </div>

                <!-- Email input -->
                <div class="col-md-12">
                    <label class="form-label" for="form6Example5">Email</label>
                    <input type="email" id="form6Example5" value="" name="cEmail"
                        class="form-control" />
                </div>

                <!-- Number input -->
                <div class="col-md-12">
                    <label class="form-label" for="form6Example6">Phone</label>
                    <input type="number" min="0" id="form6Example6" name="cPhone"
                        class="form-control" value="" />

                </div>




                <!-- Text input -->
                <div class="col-md-12">
                    <label class="form-label" for="form6Example4">Event Date</label>
                    <input type="date" id="form6Example4" name="cEventDate" class="form-control"
                        value="" />

                </div>


                <div class="col-md-12">
                    <label class="form-label" for="form6Example4">Event Start Time</label>
                    <input type="time" id="form6Example4" name="cEventStartTime" class="form-control"
                        value="" />

                </div>

                <div class="col-md-12">
                    <label class="form-label" for="form6Example4">Event End Time</label>
                    <input type="time" id="form6Example4" name="cEventEndTime" class="form-control"
                        value="" />

                </div>

                <!-- Message input -->
                <div class="col-md-12">
                    <label class="form-label" for="form6Example7">Message</label>
                    <textarea class="form-control" name="cMessage" id="form6Example7" rows="4"></textarea>
                </div>



                <button type="submit" class="more-bttns mt-2 mb-5">Send Inquiry</button>


            </form>
        @endguest

    </div>

</div>


</div>





</div>



<div class="container-fluid mb-4">

<div class="row">


{{-- <livewire:advertistment-reviews :advertisement="$topAd" :v_id="$topAd->v_id" :actual_v_id="$topAd->actual_v_id" :ad_id="$topAd->id" :totalReviews="$topAd->total_reviews" /> --}}
{{-- @livewire('advertistment-review-general', [
                            'advertisement' => $topAd,
                            'topAd' => $topAd,
                            'v_id' => $topAd->v_id,
                            'actual_v_id' => $topAd->actual_v_id,
                            'ad_id' => $topAd->id,
                            'totalReviews' => $topAd->total_reviews,
                            'avgRating' => $topAd->avg_rating
                        ]) --}}
</div>
</div>








@include('components.onlyfooter')


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
    @if (Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right",
            "progressBar": true,
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

    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var wishlistToggles = document.querySelectorAll('.wishlist-toggle');
        var wishlistToggle; // Define wishlistToggle outside the forEach block

        wishlistToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                var adId = toggle.getAttribute('data-ad-id');
                var clientId = toggle.getAttribute('data-client-id');
                wishlistToggle = toggle; // Assign the current toggle to wishlistToggle
                toggleWishlist(adId, clientId);
            });
        });

        function toggleWishlist(adId, clientId) {
            $.ajax({
                url: '{{ route('wishlist.toggle') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    ad_id: adId,
                    actual_v_id: clientId
                },
                success: function(data) {
                    console.log(data.message);
                    updateWishlistIconColor(adId, clientId);

                    // Update button color
                    wishlistToggles.forEach(function(toggle) {
                        var toggleAdId = toggle.getAttribute('data-ad-id');
                        var toggleClientId = toggle.getAttribute('data-client-id');

                        if (toggleAdId == adId && toggleClientId == clientId) {
                            if (data.in_wishlist) {
                                toggle.classList.remove('text-secondary');
                                toggle.classList.add('text-danger');
                            } else {
                                toggle.classList.remove('text-danger');
                                toggle.classList.add('text-secondary');
                            }
                        }
                    });

                    // Display Toast Notification
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: 'bottom',
                        position: 'center',
                        backgroundColor: data.message ==
                            'Advertisement Added To wishlist Successfully.' ? '#28a745' :
                            '#dc3545',
                    }).showToast();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                }
            });
        }

        function updateWishlistIconColor(adId, client_id) {
            // Check if the advertisement is in the wishlist
            $.ajax({
                url: '{{ route('wishlist.check') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    ad_id: adId,
                    actual_v_id: client_id
                },
                success: function(data) {
                    var wishlistbtn = document.querySelector('.wishlist-btn');
                    console.log("update color trigger");
                    if (data.in_wishlist) {
                        wishlistToggle.classList.remove('text-secondary');
                        wishlistToggle.classList.add('text-danger');
                        wishlistbtn.innerHTML = "Remove From Wishlist";
                    } else {
                        wishlistToggle.classList.remove('text-danger');
                        wishlistToggle.classList.add('text-secondary');
                        wishlistbtn.innerHTML = "Add To Wishlist";
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                }
            });
        }
    });
</script>



{{-- <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/smooth-scroll.js') }}"></script>
<script src="{{ url('plugins/fslightbox.js') }}"></script>
<script src="{{ url('js/script.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/aos.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dropdown.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>




<script>
    var scroll = new SmoothScroll('a[href*="#"]', {
        offset: 65, // Adjust the offset value as needed
    });
</script>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 2,
        freeMode: true,
        pagination: false,
    });

    var swiper = new Swiper(".mySwiper2", {
        slidesPerView: 4,
        spaceBetween: 2,
        freeMode: true,
        pagination: false,
    });
</script>

<script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.querySelector(".mynav").style.top = "0";
            document.querySelector(".second_nav").style.top = "80px";
        } else {
            document.querySelector(".mynav").style.top = "-100px";
            document.querySelector(".second_nav").style.top = "0px";

        }
        prevScrollpos = currentScrollPos;
    }
</script>

</body>

</html>
