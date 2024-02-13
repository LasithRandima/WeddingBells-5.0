
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Planner</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/budgetform.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <style>
        .modal-form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
            align-items: center;
        }
        .modal-form label{
            color: #000 !important;
        }
        .modal-form input{
            border-color: #6c757d ;
            color: #000;
        }

        .modal-form select{
            border-color: #6c757d ;
            color: #000;
        }

            .modal-form form{
            width: 90%;
            max-width: 600px;
            /* margin-bottom: -40px;
            margin-top: 20px; */

        }
        .card-body {

      background-color: #B08BDF;

    }
        .card-container {
            display: flex;
            justify-content: space-between;
            margin: 20px; /* Adjust the margin as needed */
            background-color: #C0C0C0;
        }


        .dash_cards{
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-content: center !important;
            background-color: #fff;
            border: 2px solid #B87333; /* Copper color */
            border-radius: 10px; /* Adjust the border radius as needed */
            padding: 15px; /* Adjust the padding as needed */
            min-width: 200px; /* Adjust the minimum width as needed */
            text-align: center;

        }
    </style>



    @livewireStyles

    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.min.css') }}">
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

    <x-slider>  </x-slider>

    <!-- -------------------------------------------------- end of slider-------------------------------------------------------------------------- -->


    <livewire:budget-planner />


    <livewire:budget-data />

    {{-- <livewire:budget-table /> --}}

    {{-- <livewire:budget-modal /> --}}

    {{-- <livewire:list-budget /> --}}


    @include('components.onlyfooter')

    @livewireScripts

    <script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/aos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>


{{-------------------------Livewire Toastr Notifications-------------------------------- --}}
<script>
    window.addEventListener('close-modal', event => {
        $('#budgetModal').modal('hide');
        $('#deleteBudgetModal').modal('hide');
    })


    window.addEventListener('toastr:info', event => {
        toastr.info(event.detail.message);
    })
</script>

<script>
    toastr.options =
    {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
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
  </script>

{{-------------------------End of Livewire Toastr Notifications-------------------------------- --}}

         <script>
          AOS.init({
              offset: 180,
              delay: 0,
              duration: 800,
              easing: 'ease',
              once: false,
              mirror: false,
              anchorPlacement: 'top-bottom',

          })
          </script>

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/smooth-scroll.js') }}"></script>

      <script>
          var scroll = new SmoothScroll('a[href*="#"]');
      </script>

@livewireScripts
</body>
</html>
