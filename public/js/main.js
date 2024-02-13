

$(document).ready(function(){

    $('.count').counterUp({
      delay: 30,
      time: 2000
    });


    $("#product-slider").owlCarousel({
      items:4,
      smartSpeed:300,
      itemsDekstop:[1199,3],
      itemsDekstopSmall:[1000,1],
      itemsMObile:[599,1],
      pagination:false,
      navigationText:false,
      autoplay:true,
      loop:true,
      autoplayTimeout:2000,
      responsiveClass:true,
      responsive:{
        0:{
            items:1,
            loop:true
        },
        600:{
            items:2,
            loop:true
        },
        800:{
          items:3,
          loop:true
      },
        1199:{
            items:4,
            loop:true
        }
      }
      });

  });



  var prevScrollpos = window.pageYOffset;
  window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
      document.querySelector(".mynav").style.top = "0";
    } else {
      document.querySelector(".mynav").style.top = "-100px";
    }
    prevScrollpos = currentScrollPos;
  }



window.onload = ()=> {
  setTimeout(() =>{
    document.querySelector('body').classList.add('display');
  }, 100);

  let bars = document.querySelectorAll('.barr');
  bars.forEach((progress) => {
  let value = progress.getAttribute('data-value');
  progress.style.width = `${value}%`;
  let count = 0;
  let progressAnimation = setInterval(() => {
    count++;
    progress.setAttribute('data-text', `${count}%`);
    if (count >= value) {
      clearInterval(progressAnimation);
    }
  }, 15);
});
}


$(function(){
    $(".dropdown-item").click(function(){
          var icon_text =$(this).html();
          $(".dropdown-toggle").html(icon_text)
    })
})



$(document).ready(function(){
  $("#testimonial-slider").owlCarousel({
    items:3,
      loop:true,
      smartSpeed:300,
      // itemsDekstop:[1199,3],
      // itemsDekstopSmall:[1000,1],
      // itemsMObile:[599,1],
      pagination:false,
      navigationText:false,
      autoplay:true,
      autoplayTimeout:2000,
      responsiveClass:true,
      responsive:{
        0:{
            items:1,
            loop:true
        },
        600:{
            items:2,
            loop:true
        },
        1000:{
            items:3,
            loop:true
        }
      }
  });
});


var swiper = new Swiper(".mySwiper", {
  slidesPerView: 2,
  spaceBetween: 30,
  slidesPerGroup: 2,
  loop: true,
  loopFillGroupWithBlank: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});



// var swiper = new Swiper(".mySwiper", {
//   direction: "horizontal",
//   slidesPerView: 3,
//   spaceBetween: 30,
//   slidesPerGroup: 3,
//   spaceBetween: 30,
//   grabCursor: true,
//   loop: true,
//   shortSwipes: false,
//   longSwipes: false,
//   allowTouchMove: true,
//   autoplay: {
//   delay: 1,
//   },
//   pagination: {
//     el: ".swiper-pagination",
//     clickable: true,
//   },
//   navigation: {
//     nextEl: ".swiper-button-next",
//     prevEl: ".swiper-button-prev",
//   },
//   freeMode: true,
//   speed: 8000,
//   disableOnInteraction: true
//   });
//   $(".mySwiper").hover(function() {
//       (this).swiper.autoplay.stop();
//   }, function() {
//       (this).swiper.autoplay.start();
//   });





