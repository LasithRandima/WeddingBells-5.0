
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Client Checklist</title>

    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- <link rel="stylesheet" type="text/css" href="css/mdb.min.css"> --}}
    {{-- <link rel="stylesheet" href="css/mk_charts.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="loading-bar.min.css"/> --}}

    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    <style>


        .todo_cat{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: start !important;
        }

        .gradient-custom-2 {
            background:rgb(233, 223, 240,0.4);
          /*  background: #AA076B;
background: -webkit-linear-gradient(to right, #61045F, #AA076B);
/* background: linear-gradient(to right, #61045F, #AA076B); */

/* background-image: linear-gradient(to top, lightgrey 0%, lightgrey 1%, #e0e0e0 26%, #efefef 48%, #d9d9d9 75%, #bcbcbc 100%); */
}


.gradient-custom-3 {
            /* fallback for old browsers */
            background: #7e40f6;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(
                to right,
                rgba(126, 64, 246, 1),
                rgba(80, 139, 252, 1)
            );

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(
                to right,
                rgba(126, 64, 246, 1),
                rgba(80, 139, 252, 1)
            );

}

.mask-custom {
    background: linear-gradient(to bottom right, rgba(255, 182, 193, 0.5), rgba(173, 216, 230, 0.5));
    border-radius: 2em;
    backdrop-filter: blur(25px);
    border: 2px solid rgba(255, 255, 255, 0.1);
    background-clip: padding-box;
    box-shadow: 10px 10px 10px rgba(173, 216, 230, 0.3); /* Light Blue */
}



.butt {
	background-color: transparent;
	border-radius:11px;
	border:0px;
	display:inline-block;
	cursor:pointer;
	padding:8px 18px;
}

.essentialbg{
    background-color: #fbeec1 !important;
}

.taskcolor{
    background-color: #f4f6f7 !important;
}

.catHeadings{
    color: #7e40f6;
}


.btn-rose-gold {
    color: #ffffff; /* Adjusted Rose Gold Text Color to White */
    background-color: #e58e99; /* Adjusted Rose Gold Background Color */
    border-color: #e58e99; /* Adjusted Rose Gold Border Color */
}

.btn-rose-gold:hover {
    background-color: #c77d87; /* Darker Rose Gold Hover Background Color */
    border-color: #c77d87; /* Darker Rose Gold Hover Border Color */
}

body {
  margin: 0;
  padding: 0;
  position: relative;
  background: linear-gradient(to bottom right, rgba(241, 156, 230, 0.7), rgba(194, 227, 238, 0.5)), #f8f8f8 url('/images/bgImages/checklist.jpg') no-repeat fixed center center;
  background-size: cover; /* Ensure the background image covers the entire background area */
  background-attachment: fixed;
}


.div-with-background {
  position: relative;
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2)), /* Gradient Overlay */
              #fff; /* Solid Background Color (replace with your desired color) */
}


/* Additional styles for the rest of your content */
.container {
  /* Adjust styles for your content container */
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  /* color: #000; */
}

.text-warning{
    color: #7e40f6 !important;
}


    </style>

@livewireStyles

</head>
<body>

    @include('components.onlynav');


<div class="container checklist">
    <div class="checklists" >
        <div class="text-center pt-3 pb-2">
            <img src="images/favicon/check1.webp"
              alt="Check" width="60">
          </div>
          <h2 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50">Heartfelt Wedding Checklist</h2>
          <h3 data-aos="zoom-in" data-aos-duration="3000" data-aos-delay="50">Craft Your Dream Wedding with Ease</h3>
    </div>
</div>



   <!-- Main Container -->
   <div class="container mt-5 pt-3">





    <div class="row pt-1 ">
        <!-- Sidebar -->
        <div class="col-lg-3 pt-4">

            <div class="">
                <!-- Grid row -->
                <div class="row">
                    <!-- by current status -->
                    <livewire:checklist-current-status />
                    <!-- by current status -->


                </div>
                <!-- /Grid row -->

                <!-- Grid row -->
                <div class="row">

                    <!-- by time-period -->
                    <livewire:checklist-status />
                    <!-- by time-period -->




                    <!--  by catagory -->
                    <livewire:checklist-category-status />
                    <!--  by catagory -->





                </div>



                <!-- /Grid row -->
            </div>

        </div>
        <!-- /.Sidebar -->

        <!-- Content -->
        <div class="col-lg-9 gradient-custom-2">

            <!-- Filter Area -->

            <!-- /.Filter Area -->

            <!-- Products Grid -->
            <section class="section pt-4">

                <!-- Grid row -->
                <div class="row">




                    <livewire:progress-bar />




                    <section class="">
                        <div class="container pb-5 h-100 px-0">
                          <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col col-xl-12 col-md-10">

                              <div class="card gradient-custom-2" style="border-radius: 2em;">
                                <div class="card-body p-5 mask-custom">

                                    <livewire:add-tasks />



                                  <!-- Tabs navs -->
                                  <ul class="nav nav-tabs mb-4 pb-2" id="ex1" role="tablist">
                                    <li class="nav-item" role="presentation">
                                      <a class="nav-link active me-1" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab"
                                        aria-controls="ex1-tabs-1" aria-selected="true">All</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                      <a class="nav-link me-1" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab"
                                        aria-controls="ex1-tabs-2" aria-selected="false">Done</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                      <a class="nav-link me-1" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3" role="tab"
                                        aria-controls="ex1-tabs-3" aria-selected="false">To Do</a>
                                    </li>
                                  </ul>
                                  <!-- Tabs navs -->

                                  <!-- Tabs content -->
                                  <div class="tab-content" id="ex1-content">



                                    <!----------------------------------------ALL tab---------------------------------------------- -->
                                    <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel"
                                      aria-labelledby="ex1-tab-1">



                                      <livewire:wedding-checklist />





                                    </div>

<!----------------------------------------Done tab---------------------------------------------- -->
                                    <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                        <livewire:done-checklist />
                                    </div>

<!----------------------------------------To Do tab---------------------------------------------- -->
                                    <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                                        <livewire:todo-checklist />
                                    </div>


                                  </div>
                                  <!-- Tabs content -->

                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </section>

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-12 mb-4">



                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->


            </section>
            <!-- /.Products Grid -->

        </div>
        <!-- /.Content -->

    </div>

</div>
<!-- /.Main Container -->



<!-------------------------------------------Footer Begin---------------------------------------------->

@include('components.onlyfooter')

  <!-------------------------------------------Footer End---------------------------------------------->


  <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  <script src="{{ asset('js/mdb.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>

  <script src="{{ asset('js/smooth-scroll.js') }}"></script>
<script>
  var scroll = new SmoothScroll('a[href*="#"]');
</script>


@livewireScripts
{{-- <script type="text/javascript" src="js/loading-bar.min.js"></script> --}}


{{-- <script>
    $(document).ready(function() {
    $('.tags').select2({
        placeholder:'Select'
        allowClear: true,
    });

    $("#tags").select2({
        ajax:{
            url:"{{ route('get-category') }}",
            type:"post"
            delay:250,
            dataType:'json',
            data:function(params){
                return{
                    name:params.term,
                    "_token":"{{ csrf_token() }}",

                };
        },

        processResults:function(data){
            return{
                results: $.map(data, function (item) {
                    return {
                        id:item.id,
                        text:item.Category_name,
                    }
              })
           };
        },
    },
});
});
</script> --}}
{{-- <script src="js/mk_charts.js"></script> --}}

</body>
</html>
