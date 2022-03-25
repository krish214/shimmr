
jQuery(window).ready(function ($) {
    "use strict";

    // Preloader
    // ------------------------------------------------------
    $(window).on('load', function () {
        anime.timeline({
                targets: '.preloader',
                easing: 'easeOutExpo',
            })
            .add({
                height: ['100vh', '0vh'],
                duration: 700,
                delay: 2000,
            })
            .add({
                offset: '-=400',
                complete: function (anim) {
                    document.querySelector('.preloader').remove();
                }
            })
            .add({
                offset: '-=1300',
                targets: '#site-wrapper',
                top: 0,
                duration: 700,
            })

        anime.timeline({
                easing: 'easeOutExpo',
            })
            .add({
                targets: '.preloader .txt',
                delay: 100,
                opacity: 1,
                duration: 700,
                translateY: ["30px", "0px"],
            })
            .add({
                targets: '.preloader .progress',
                offset: '-=400',
                opacity: 1,
                duration: 700,
            })
            .add({
                targets: ".preloader .progress .bar-loading",
                offset: '-=400',
                duration: 2000,
                width: ["0", "100%"],
            })
            .add({
                targets: '.preloader .loading',
                offset: '-=900',
                opacity: 0,
                duration: 1000,
                translateY: ["0", "-100px"],
            })
    });
    // Main Sliders
    // ------------------------------------------------------

     $(".owl-carousel").each(function (index) {
        var items = $(this).data('items'),
            autoplay = $(this).data('autoplay'),
            margin = $(this).data('margin'),
            loop = $(this).data('loop'),
            center = $(this).data('center'),
            dots = $(this).data('dots'),
            cid=$(this).attr('id'),
            nav = $(this).data('nav');
         if(cid=="clientele-testimonials"){
            $(this).owlCarousel({
                items: items,
                autoplay: autoplay,
                margin: margin,
                autoplayHoverPause: true,
                smartSpeed: 450,
                loop: loop,
                background:true,
                center: center,
                dots: dots,
                dotsEach: true,
                nav: nav,
                // responsive: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    640: {
                        items: 1
                    },
                    960: {
                        items: 1
                    },
                    1200: {
                        items: 1
                    },
                    1600: {
                        items: items
                    }
                }
            });
         }
        else{
            $(this).owlCarousel({
                items: items,
                autoplay: autoplay,
                margin: margin,
                autoplayHoverPause: true,
                smartSpeed: 450,
                background:true,
                loop: loop,
                center: center,
                dots: dots,
                dotsEach: true,
                nav: nav,
                // responsive: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    640: {
                        items: 1
                    },
                    960: {
                        items: 2
                    },
                    1200: {
                        items: 3
                    },
                    1600: {
                        items: items
                    }
                }
                
            });
        }
    }); 
    
    if ($('.pr__contact').length) {
        $('.pr__contact').validate({ // Initialize the plugin
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                subject: {
                    required: true
                },
                message: {
                    required: true
                }
            },
            submitHandler: function (element) {
                $.ajax({
            type:"POST",
            url: $(element).attr('action'),
            data: $(element).serialize(),
            beforeSend:function(jqXHR,settings){
            $("button[type=submit]").text('Loading...');
            },
            complete:function(jqXHR,textStatus){
                $("button[type=submit]").text('Send message');
            },
            success: function(data){
                $("#err").empty().html('<div class="alert alert-success alert-dismissable">\
                        <p>Successfully Submitted</p>\
                    </div>').show().fadeOut(3000);
                    $('#contact__form')[0].reset();
            },
            error:function(jqXHR,textStatus,errorThrown ){
                $("#err").empty().html('<div class="alert alert-danger alert-dismissable">\
                        <p>Sorry Error <a class="alert-link" href="javascript:void(0)">occured</a>!</p>\
                    </div>').show().fadeOut(3000);
                    
            }
            
            });
                        return false;
                    }
                });
    }

   
});


