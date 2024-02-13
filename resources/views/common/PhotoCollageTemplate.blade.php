<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// $gallery= DB::table('media')->where('v_id', '=', $topAd->v_id)->limit(8)->get();


// $wedding_date = DB::table('clients')
//         ->select('wed_date')
//         ->where('user_id', '=', Auth::id())
//         ->value('wed_date');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Photo Collage Demo</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/footernavheader.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/template2.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="{{ url('css/vendor_detail.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>

    @include('components.onlynav')


    <div class="container-fluid px-5 navheight">
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
