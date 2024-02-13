@guest
<a href="{{ url('/') }}"><img src="{{ asset('images/logo/WB_logo_1.svg') }}" alt="logo" class="logo" style="max-height: 70px"></a>
@endguest


@auth
<a href="{{ url('/') }}"><img src="{{ asset('images/logo/WB_logo_12.png') }}" alt="logo" class="logo" style="max-height: 65px"></a>
@endauth

