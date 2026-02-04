
jQuery(document).ready(function () {
    wow = new WOW(
        {
            boxClass: 'wow',      // default
            animateClass: 'animated', // default
            offset: 0,          // default
            mobile: true,       // default
            live: true        // default
        }
    );
    wow.init();
    $('.plus-nClick1').click(function(e){
        e.preventDefault();
        $(this).parents('.level0').toggleClass('opened');
        $(this).parents('.level0').children('ul').slideToggle(200);
    });
    $('.plus-nClick2').click(function(e){
        e.preventDefault();
        $(this).parents('.level1').toggleClass('opened');
        $(this).parents('.level1').children('ul').slideToggle(200);
    });

    window.onscroll = changePos;

    function changePos() {
        var header = $("#header");
        var headerheight = $("#header").height();
        if (window.pageYOffset > headerheight) {
            header.addClass('sticky-header');
        } else {
            header.removeClass('sticky-header');
        }
    }


    jQuery(document).ready(function () {
        var offset = 220;
        var duration = 500;
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('#back-to-top').fadeIn(duration);
            } else {
                jQuery('#back-to-top').fadeOut(duration);
            }
        });

        jQuery('#back-to-top').click(function (event) {
            event.preventDefault();
            jQuery('html, body').animate({
                scrollTop: 0
            }, duration);
            return false;
        });
    });

    $(window).on('load', function () {
        var img_height_max = 0;
        $('.img-resize').each(function () {
            var img_h = $(this).find('img').height();
            if (img_height_max < img_h) {
                img_height_max = img_h;
            }
        });
        $('.img-resize').height(img_height_max);
    });

    $(window).on('load', function () {
        var img_height_max = 0;
        $('.img-resize-2').each(function () {
            if (img_height_max < $(this).height()) {
                img_height_max = $(this).height();
            }
        });
        $('.img-resize-2').height(img_height_max);
    })

});

