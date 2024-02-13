<div>


    <div class="col-md-6 col-lg-12 mb-5">
        <h5 class="font-weight-bold dark-grey-text"><strong>By Time Period</strong></h3>
            <div class="divider"></div>
            <div class="row ml-1">
                <!-- time-period -->
                <ul class="rating mb-0">
                    @foreach ($byTiming as $timing)
                    <li>{{ $timing->timing_period }} <span class="badge rounded-pill bg-secondary ms-3">{{ $timing->timingCount }}</span></li>
                    @endforeach
                </ul>
                <div class="mkCharts" data-percent="94" data-color="rgb(0,100,200)" data-size="155" data-stroke="3"></div>
            </div>
    </div>



</div>
