<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


$gallery3 = DB::table('vendor_galleries')
    ->where('v_id', '=', Auth::id())
    ->where('image_order', '>=', (int) Auth::id() . '1')
    ->where('image_order', '<=', (int) Auth::id() . '5')
    ->limit(5)
    ->orderBy('image_order', 'asc')
    ->get();

$gallerycount = DB::table('vendor_galleries')
    ->where('v_id', '=', Auth::id())
    ->where('image_order', '>=', (int) Auth::id() . '1')
    ->where('image_order', '<=', (int) Auth::id() . '5')
    ->count();


$galleryallimagescount= DB::table('vendor_galleries')->where('v_id', '=', Auth::id())->count();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Photo Collage Demo</title>
    <link rel="shortcut icon" href="images/favicon/favicon 01 (Copy).png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/footernavheader.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/template2.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="{{ url('css/vendor_detail.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>

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
                    <div class="img_card" style="background-image: url('{{ $gimage->image_path ? asset('/storage/'.$gimage->image_path) : asset('/storage/default_images/default_category_thumb.jpg') }}')"></div>
                    @php $counter++; @endphp
                    @else
                        @break
                    @endif
                    @empty
                    <div class="d-flex justify-content-center align-items-center h-100 w-100">
                        <div><h3>No Images Found. Please Add Images To Your Vendor Gallery Section.</h3></div>
                    </div>
                    @endforelse


                    @if ($gallerycount >= 5)
                    <div class="img_card" style="background-image: url('{{ $gallery3[4]->image_path ? asset('/storage/'.$gallery3[4]->image_path) : asset('/storage/default_images/default_category_thumb.jpg') }}')">
                    <div class="d-flex flex-column justify-content-end align-items-end justify-items-end" style="height: 100%;">
                    <!-- Your Bootstrap button goes here -->
                    <a class="btn btn-light btn-lg mb-3 me-3 gallery-btn" href="#gallery"><span><i class="fas fa-images"></i>  See All ({{ $galleryallimagescount }})</span></a>
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
                                <div class="img_card" style="background-image: url('{{ $gimage->image_path ? asset('/storage/'.$gimage->image_path) : asset('/storage/default_images/default_category_thumb.jpg') }}')"></div>
                                @php $counter++; @endphp
                                @else
                                    @break
                                @endif
                            @endforeach

                            @if ($gallerycount >= 5)
                            <div class="img_card" style="background-image: url('{{ $gallery3[4]->image_path ? asset('/storage/'.$gallery3[4]->image_path) : asset('/storage/default_images/default_category_thumb.jpg') }}')">
                            <div class="d-flex flex-column justify-content-end align-items-end justify-items-end" style="height: 100%;">
                            <!-- Your Bootstrap button goes here -->
                            <a class="btn btn-light btn-lg mb-3 me-3 gallery-btn" href="#gallery"><span><i class="fas fa-images"></i>  See All ({{ $galleryallimagescount }})</span></a>
                            {{-- <button type="button" class="btn btn-primary mb-3"></button> --}}
                            </div>
                            </div>
                            @endif
                        </section>
                    </div>
@endif
@endauth


<div class="container-fluid px-5 mt-5">
    <div class="alert alert-info" role="alert">
        <h4>If You want to set images in the collage properly like in below you have to follow this way.</h4>
    <ol class="mx-3">
        <li>Go to your dashboard again</li>
        <li>Select the vendor galleries section</li>
        <li>select the image you want to crop or ordered in the table view</li>
        <li>click on the edit button</li>
        <li>Set the Image order from 1 to 5</li>
        <li>click on the edit image button on edit vendor gallaries view.</li>
        <li>crop the image and save it.</li>
    </ol>
      </div>
</div>


<div class="container-fluid px-5 mt-5">
    <section class="padding-bottom bg-light">
        <div class="header_container" data-container>

        <div class="img_card" style="background-image: url('{{ asset('images/photoCollageDemoPics/1.jpg') }}')"><h1 class="px-3 py-1" style="background-color: rgba(0,0,0,0.5)">1</h1></div>
        <div class="img_card" style="background-image: url('{{ asset('images/photoCollageDemoPics/2.jpg') }}')"><h1 class="px-3 py-1" style="background-color: rgba(0,0,0,0.5)">2</h1></div>
        <div class="img_card" style="background-image: url('{{ asset('images/photoCollageDemoPics/3.jpg') }}')"><h1 class="px-3 py-1" style="background-color: rgba(0,0,0,0.5)">3</h1></div>
        <div class="img_card" style="background-image: url('{{ asset('images/photoCollageDemoPics/4.jpg') }}')"><h1 class="px-3 py-1" style="background-color: rgba(0,0,0,0.5)">4</h1></div>
        <div class="img_card" style="background-image: url('{{ asset('images/photoCollageDemoPics/5.jpg') }}')"><h1 class="px-3 py-1" style="background-color: rgba(0,0,0,0.5)">5</h1>
        <div class="d-flex flex-column justify-content-end align-items-end justify-items-end" style="height: 100%;">
        <a class="btn btn-light btn-lg mb-3 mx-1 gallery-btn" href="#gallery"><span><i class="fas fa-images"></i>  See All</span></a>
        </div>
        </div>
    </section>
</div>


    @include('components.onlyfooter')
</body>
</html>
