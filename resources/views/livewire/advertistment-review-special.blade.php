<div class="col-lg-12">
    <article class="card">
        <div class="card-body"> <a href="#" class="btn w-100 btn-grad">Write review</a>
            <div class="rating-wrap mt-3">
                <ul class="rating-stars stars-lg">
                    <li style="width:{{ $avgRating * 20 }}%" class="stars-active">
                        <img src="{{ url('images/misc/stars-active.svg') }}" alt="">
                    </li>
                    <li>
                        <img src="{{ url('images/misc/starts-disable.svg') }}" alt="">
                    </li>
                </ul>
                <b class="label-rating text-lg"> {{ round($avgRating, 1) }} out of 5 </b>
            </div>
            <p class="mt-1 text-muted"> {{ $totalReviews }} reviews </p>
            <table class="table table-borderless table-sm">
                @foreach ($ratings as $star => $percent)
                    <tr valign="middle">
                        <td width="50"> {{ $star}} star </td>
                        <td>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percent }}%;"></div>
                            </div>
                        </td>
                        <td width="50"> {{ $percent }} % </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </article>
</div>
