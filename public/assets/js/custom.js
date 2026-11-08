jQuery( document ).ready(function( $ ) {
	"use strict";

    $(function() {
        $( "#tabs" ).tabs();
    });

    $("#preloader").animate({
        'opacity': '0'
    }, 600, function(){
        setTimeout(function(){
            $("#preloader").css("visibility", "hidden").fadeOut();
        }, 300);
    });
    
    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      var box = $('.header-text').height();
      var header = $('header').height();

      if (scroll >= box - header) {
        $("header").addClass("background-header");
      } else {
        $("header").removeClass("background-header");
      }
    });

	if ($('.owl-testimonials').length) {
        $('.owl-testimonials').owlCarousel({
            loop: true,
            nav: false,
            dots: true,
            items: 2,
            margin: 30,
            autoplay: true,
            autoplayTimeout: 4500,
            autoplayHoverPause: true,
            smartSpeed: 800,
            responsive: {
                0: {
                    items: 1,
                    margin: 15
                },
                576: {
                    items: 1,
                    margin: 20
                },
                768: {
                    items: 2,
                    margin: 25
                },
                992: {
                    items: 2,
                    margin: 30
                }
            }
        });
    }

    // Keyboard support for clickable team profile cards
    $(document).on('keydown', '.team-profile-card', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            var targetModal = $(this).attr('data-target');
            if (targetModal) {
                $(targetModal).modal('show');
            }
        }
    });

    $(".Modern-Slider").slick({
        autoplay:true,
        autoplaySpeed:10000,
        speed:600,
        slidesToShow:1,
        slidesToScroll:1,
        pauseOnHover:false,
        dots:true,
        pauseOnDotsHover:true,
        cssEase:'linear',
       // fade:true,
        draggable:false,
        prevArrow:'<button class="PrevArrow"></button>',
        nextArrow:'<button class="NextArrow"></button>', 
    });
});