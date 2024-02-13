<span>
    <ul class="rating-stars">
        <li style="width:{{ $avgRating * 20 }}%" class="stars-active"> 
            <img src="{{ url('images/misc/stars-active.svg') }}" alt=""> 
        </li>
        <li> 
            <img src="{{ url('images/misc/starts-disable.svg') }}" alt=""> 
        </li>
    </ul>
    <b class="label-rating text-warning"> {{ $avgRating ? round($avgRating, 1) : '' }}</b>
    <i class="dot"></i>
</span>