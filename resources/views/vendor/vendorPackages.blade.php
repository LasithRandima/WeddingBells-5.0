<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertise With Us</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
</head>

<body>

    @include('components.onlynav')
    <div class="container" style="padding: 20 100px; margin-top:100px;">

        <!-- Jumbotron -->
        <div class="p-5 text-center bg-image rounded-3" style="
        background-image: url('https://mdbcdn.b-cdn.net/img/new/slides/041.webp');
        height: 400px;
        ">
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
        <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
            <h1 class="mb-3">Heading</h1>
            <h4 class="mb-3">Subheading</h4>
            <a class="btn btn-outline-light btn-lg" href="#!" role="button">Call to action</a>
        </div>
        </div>
        </div>
        </div>
        <!-- Jumbotron -->

        <!--Accordion wrapper-->
        <div class="accordion md-accordion mt-5" id="accordionEx" role="tablist" aria-multiselectable="true">

          <!-- Accordion card -->
          <div class="card">

            <!-- Card header -->
            <div class="card-header" role="tab" id="headingOne1">
              <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                aria-controls="collapseOne1">
                <h5 class="mb-0" id="pkg_name">
                  Package #1 - Premier Package <i class="fas fa-angle-down rotate-icon"></i>
                </h5>
              </a>
            </div>

            <!-- Card body -->
            <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
              data-parent="#accordionEx">
              <div class="card-body" id="pkg_des">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                squid. 3
                wolf moon officia aute,
                non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
              </div>
            </div>

          </div>
          <!-- Accordion card -->


            <!-- Accordion card -->
            <div class="card">

                <!-- Card header -->
                <div class="card-header" role="tab" id="headingTwo2">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
                    aria-expanded="false" aria-controls="collapseTwo2">
                    <h5 class="mb-0">
                      Package #2 - Preferred Package <i class="fas fa-angle-down rotate-icon"></i>
                    </h5>
                  </a>
                </div>

                <!-- Card body -->
                <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                  data-parent="#accordionEx">
                  <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                    squid. 3
                    wolf moon officia aute,
                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                  </div>
                </div>

              </div>
              <!-- Accordion card -->

              <!-- Accordion card -->
              <div class="card">

                <!-- Card header -->
                <div class="card-header" role="tab" id="headingThree3">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
                    aria-expanded="false" aria-controls="collapseThree3">
                    <h5 class="mb-0">
                      Package #3 - Basic Package <i class="fas fa-angle-down rotate-icon"></i>
                    </h5>
                  </a>
                </div>

                <!-- Card body -->
                <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                  data-parent="#accordionEx">
                  <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                    squid. 3
                    wolf moon officia aute,
                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                  </div>
                </div>

              </div>
            <!-- Accordion card -->



        </div>
        <!-- Accordion wrapper -->


        <form style="margin: 80px 0 20px 0">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row mb-4">
              <div class="col">
                <div class="form-outline">
                    <label for="exampleFormControlSelect1">Select Package</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option value="1">Package 01</option>
                        <option value="2">Package 02</option>
                        <option value="3">Package 03</option>
                    </select>
                  </div>
              </div>
              <div class="col">
                <div class="form-outline">
                    <label class="form-label" for="form6Example2">Event Date</label>
                  <input type="Date" id="form6Example2" class="form-control" />
                </div>
              </div>
            </div>

            <div class="row mb-4">
            <div class="form-outline col-6">
                <label class="form-label" for="form6Example2">Event Time</label>
              <input type="time" id="form6Example2" class="form-control" />
            </div>
          </div>


            <div class="form-outline mb-4">
                <label class="form-label" for="form6Example7">Message</label>
                <textarea class="form-control" id="form6Example7" rows="4"></textarea>
              </div>


            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Place order</button>
          </form>


    </div>





    @include('components.onlyfooter')



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
    <script src="{{ asset('js/contact.js') }}"></script>


</body>
</html>

```
