
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon 01 (Copy).png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
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

    <x-slider></x-slider>

<!-- -------------------------------------------------- end of slider-------------------------------------------------------------------------- -->

<section class="contacts" id="contactus">
    <div class="contents">
        <h2 data-aos="zoom-in">Drop Us a Line</h2>
        <P data-aos="zoom-in" data-aos-duration="2000">Your thoughts matter to us. Feel free to reach out through the contact form below for any questions or ideas. We're open to hearing what you'd like to see more of, as well as any suggestions or concerns.

          With your support, we aim to make Wedding Bells a cherished resource, guiding couples towards their dream union in this enchanting paradise
    <div class="container-contact">
        <div class="contactInfo">
          <div class="row">
            <div class="box">
                <div class="icon-c"><i class="fas fa-map-marker" aria-hidden="true"></i></div>
                <div class="text">
                    <h3>Address</h3>
                    <P>456,<br>Panhida Road,<br>Kaduwela,Sri Lanka</P>
                </div>
            </div>
            <div class="box">
                <div class="icon-c"><i class="fas fa-phone" aria-hidden="true"></i></div>
                <div class="text">
                    <h3>Phone</h3>
                    <P>0711234567</P>
                </div>
            </div>
            <div class="box">
                <div class="icon-c"><i class="fas fa-envelope-open" aria-hidden="true"></i></div>
                <div class="text">
                    <h3></i>Email</h3>
                    <P>weddingbells@slt.lk</P>
                </div>
            </div>
          </div>
        </div>
            <div class="contactForm" data-aos="fade-up-left">
                <form id="contact-form" name="contact-form" method="POST" action="{{ route('contact.send') }}" enctype="multipart/form-data">
                    @csrf
                    <h3 data-aos="zoom-in">Please fill out the form below and we will get back to you as soon as possible.</h3>
                    <div class="inputBox">
                    <input type="text" name="name" id="fname" placeholder="" required=required>
                    <span>Name</span>
                    </div>
                    {{-- <div class="inputBox">
                    <input type="text" name="lname" id="lname" placeholder="" required=required>
                    <span>Last Name</span>
                    </div> --}}
                    <div class="inputBox">
                    <input type="number" name="phone" id="phone" placeholder="" required=required>
                    <span>Phone</span>
                    </div>
                    <div class="inputBox">
                    <input type="Email" name="email" id="email" placeholder="" required=required>
                    <span>Email</span>
                    </div>
                    <div class="inputBox">
                    <textarea name="message" id="message"  required=required></textarea>
                    <span>Type your Message</span>
                    </div>
                    <div class="inputBox">
                      <button type="submit" class="btn-grad btn-md">Send</button>
                    <div class="status" style="text-align: center;color: red;"></div>
                    <div class="status" style="text-align: center;color: green;">
                        @if(Session::has('message_sent'))
                        {{Session::get('message_sent')}}
                        @endif
                    </div>
                    </div>
                </form>


                <div class="social">
                    <a href="https://facebook.com/weddingbells" target="_blank"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="https://twitter.com/weddingbells" target="_blank"><i class="fab fa-twitter fa-2x"></i></a>
                    <a href="https://googleplus.com/weddingbells" target="_blank"><i class="fab fa-google-plus-g fa-2x"></i></a>
                    <a href="https://www.instagram.com/in/weddingbells" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
                </div>
            </div>
        </div>
    </section>


    <!-------------------------------------------Footer Begin---------------------------------------------->
    <div class="map" >
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4745.027985058492!2d79.94732771592962!3d6.846012384230547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25044e7acf683%3A0x6513c1923579a890!2sStudio%20X!5e0!3m2!1sen!2slk!4v1603480566808!5m2!1sen!2slk" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </div>

        @include('components.onlyfooter')

      <!-------------------------------------------Footer End---------------------------------------------->

      <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
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
