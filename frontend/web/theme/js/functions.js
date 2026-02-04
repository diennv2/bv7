var $ = jQuery.noConflict();

$.fn.inlineStyle = function (prop) {
    return this.prop("style")[$.camelCase(prop)];
};

$.fn.doOnce = function (func) {
    this.length && func.apply(this);
    return this;
}

if ($().infinitescroll) {

    $.extend($.infinitescroll.prototype, {
        _setup_portfolioinfiniteitemsloader: function infscr_setup_portfolioinfiniteitemsloader() {
            var opts = this.options,
                instance = this;
            // Bind nextSelector link to retrieve
            $(opts.nextSelector).click(function (e) {
                if (e.which == 1 && !e.metaKey && !e.shiftKey) {
                    e.preventDefault();
                    instance.retrieve();
                }
            });
            // Define loadingStart to never hide pager
            instance.options.loading.start = function (opts) {
                opts.loading.msg
                    .appendTo(opts.loading.selector)
                    .show(opts.loading.speed, function () {
                        instance.beginAjax(opts);
                    });
            }
        },
        _showdonemsg_portfolioinfiniteitemsloader: function infscr_showdonemsg_portfolioinfiniteitemsloader() {
            var opts = this.options,
                instance = this;
            //Do all the usual stuff
            opts.loading.msg
                .find('img')
                .hide()
                .parent()
                .find('div').html(opts.loading.finishedMsg).animate({opacity: 1}, 2000, function () {
                $(this).parent().fadeOut('normal');
            });
            //And also hide the navSelector
            $(opts.navSelector).fadeOut('normal');
            // user provided callback when done
            opts.errorCallback.call($(opts.contentSelector)[0], 'done');
        }
    });

} else {
    console.log('Infinite Scroll not defined.');
}

(function () {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame']
            || window[vendors[x] + 'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function (callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function () {
                    callback(currTime + timeToCall);
                },
                timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function (id) {
            clearTimeout(id);
        };
}());


function debounce(func, wait, immediate) {
    var timeout, args, context, timestamp, result;
    return function () {
        context = this;
        args = arguments;
        timestamp = new Date();
        var later = function () {
            var last = (new Date()) - timestamp;
            if (last < wait) {
                timeout = setTimeout(later, wait - last);
            } else {
                timeout = null;
                if (!immediate) result = func.apply(context, args);
            }
        };
        var callNow = immediate && !timeout;
        if (!timeout) {
            timeout = setTimeout(later, wait);
        }
        if (callNow) result = func.apply(context, args);
        return result;
    };
}


var requesting = false;

var killRequesting = debounce(function () {
    requesting = false;
}, 100);

function onScrollSliderParallax() {
    if (!requesting) {
        requesting = true;
        requestAnimationFrame(function () {
            SEMICOLON.slider.sliderParallax();
            SEMICOLON.slider.sliderElementsFade();
        });
    }
    killRequesting();
}


var SEMICOLON = SEMICOLON || {};

(function ($) {

    // USE STRICT
    "use strict";

    SEMICOLON.initialize = {

        init: function () {

            SEMICOLON.initialize.responsiveClasses();
            SEMICOLON.initialize.imagePreload('.portfolio-item:not(:has(.fslider)) img');
            SEMICOLON.initialize.stickyElements();
            SEMICOLON.initialize.goToTop();
            SEMICOLON.initialize.lazyLoad();
            SEMICOLON.initialize.fullScreen();
            SEMICOLON.initialize.verticalMiddle();
            SEMICOLON.initialize.lightbox();
            SEMICOLON.initialize.resizeVideos();
            SEMICOLON.initialize.imageFade();
            SEMICOLON.initialize.pageTransition();
            SEMICOLON.initialize.dataResponsiveClasses();
            SEMICOLON.initialize.dataResponsiveHeights();

            $('.fslider').addClass('preloader2');

        },

        responsiveClasses: function () {

            if (typeof jRespond === 'undefined') {
                console.log('responsiveClasses: jRespond not Defined.');
                return true;
            }

            var jRes = jRespond([
                {
                    label: 'smallest',
                    enter: 0,
                    exit: 479
                }, {
                    label: 'handheld',
                    enter: 480,
                    exit: 767
                }, {
                    label: 'tablet',
                    enter: 768,
                    exit: 991
                }, {
                    label: 'laptop',
                    enter: 992,
                    exit: 1199
                }, {
                    label: 'desktop',
                    enter: 1200,
                    exit: 10000
                }
            ]);
            jRes.addFunc([
                {
                    breakpoint: 'desktop',
                    enter: function () {
                        $body.addClass('device-lg');
                    },
                    exit: function () {
                        $body.removeClass('device-lg');
                    }
                }, {
                    breakpoint: 'laptop',
                    enter: function () {
                        $body.addClass('device-md');
                    },
                    exit: function () {
                        $body.removeClass('device-md');
                    }
                }, {
                    breakpoint: 'tablet',
                    enter: function () {
                        $body.addClass('device-sm');
                    },
                    exit: function () {
                        $body.removeClass('device-sm');
                    }
                }, {
                    breakpoint: 'handheld',
                    enter: function () {
                        $body.addClass('device-xs');
                    },
                    exit: function () {
                        $body.removeClass('device-xs');
                    }
                }, {
                    breakpoint: 'smallest',
                    enter: function () {
                        $body.addClass('device-xxs');
                    },
                    exit: function () {
                        $body.removeClass('device-xxs');
                    }
                }
            ]);
        },

        imagePreload: function (selector, parameters) {
            var params = {
                delay: 250,
                transition: 400,
                easing: 'linear'
            };
            $.extend(params, parameters);

            $(selector).each(function () {
                var image = $(this);
                image.css({visibility: 'hidden', opacity: 0, display: 'block'});
                image.wrap('<span class="preloader" />');
                image.one("load", function (evt) {
                    $(this).delay(params.delay).css({visibility: 'visible'}).animate({opacity: 1}, params.transition, params.easing, function () {
                        $(this).unwrap('<span class="preloader" />');
                    });
                }).each(function () {
                    if (this.complete) $(this).trigger("load");
                });
            });
        },

        verticalMiddle: function () {
            if ($verticalMiddleEl.length > 0) {
                $verticalMiddleEl.each(function () {
                    var element = $(this),
                        verticalMiddleH = element.outerHeight(),
                        headerHeight = $header.outerHeight();

                    if (element.parents('#slider').length > 0 && !element.hasClass('ignore-header')) {
                        if ($header.hasClass('transparent-header') && ($body.hasClass('device-lg') || $body.hasClass('device-md'))) {
                            verticalMiddleH = verticalMiddleH - 70;
                            if ($slider.next('#header').length > 0) {
                                verticalMiddleH = verticalMiddleH + headerHeight;
                            }
                        }
                    }

                    if ($body.hasClass('device-xs') || $body.hasClass('device-xxs')) {
                        if (element.parents('.full-screen').length && !element.parents('.force-full-screen').length) {
                            if (element.children('.col-padding').length > 0) {
                                element.css({
                                    position: 'relative',
                                    top: '0',
                                    width: 'auto',
                                    marginTop: '0'
                                }).addClass('clearfix');
                            } else {
                                element.css({
                                    position: 'relative',
                                    top: '0',
                                    width: 'auto',
                                    marginTop: '0',
                                    paddingTop: '60px',
                                    paddingBottom: '60px'
                                }).addClass('clearfix');
                            }
                        } else {
                            element.css({
                                position: 'absolute',
                                top: '50%',
                                width: '100%',
                                paddingTop: '0',
                                paddingBottom: '0',
                                marginTop: -(verticalMiddleH / 2) + 'px'
                            });
                        }
                    } else {
                        element.css({
                            position: 'absolute',
                            top: '50%',
                            width: '100%',
                            paddingTop: '0',
                            paddingBottom: '0',
                            marginTop: -(verticalMiddleH / 2) + 'px'
                        });
                    }
                });
            }
        },

        stickyElements: function () {
            if ($siStickyEl.length > 0) {
                var siStickyH = $siStickyEl.outerHeight();
                $siStickyEl.css({marginTop: -(siStickyH / 2) + 'px'});
            }

            if ($dotsMenuEl.length > 0) {
                var opmdStickyH = $dotsMenuEl.outerHeight();
                $dotsMenuEl.css({marginTop: -(opmdStickyH / 2) + 'px'});
            }
        },

        goToTop: function () {
            var elementScrollSpeed = $goToTopEl.attr('data-speed'),
                elementScrollEasing = $goToTopEl.attr('data-easing');

            if (!elementScrollSpeed) {
                elementScrollSpeed = 700;
            }
            if (!elementScrollEasing) {
                elementScrollEasing = 'easeOutQuad';
            }

            $goToTopEl.click(function () {
                $('body,html').stop(true).animate({
                    'scrollTop': 0
                }, Number(elementScrollSpeed), elementScrollEasing);
                return false;
            });
        },

        goToTopScroll: function () {
            var elementMobile = $goToTopEl.attr('data-mobile'),
                elementOffset = $goToTopEl.attr('data-offset');

            if (!elementOffset) {
                elementOffset = 450;
            }

            if (elementMobile != 'true' && ($body.hasClass('device-xs') || $body.hasClass('device-xxs'))) {
                return true;
            }

            if ($window.scrollTop() > Number(elementOffset)) {
                $goToTopEl.fadeIn();
            } else {
                $goToTopEl.fadeOut();
            }
        },

        fullScreen: function () {
            if ($fullScreenEl.length > 0) {
                $fullScreenEl.each(function () {
                    var element = $(this),
                        scrHeight = window.innerHeight ? window.innerHeight : $window.height(),
                        negativeHeight = element.attr('data-negative-height');

                    if (element.attr('id') == 'slider') {
                        var sliderHeightOff = $slider.offset().top;
                        scrHeight = scrHeight - sliderHeightOff;
                        if (element.find('.slider-parallax-inner').length > 0) {
                            var transformVal = element.find('.slider-parallax-inner').css('transform'),
                                transformX = transformVal.match(/-?[\d\.]+/g);
                            if (!transformX) {
                                var transformXvalue = 0;
                            } else {
                                var transformXvalue = transformX[5];
                            }
                            scrHeight = ((window.innerHeight ? window.innerHeight : $window.height()) + Number(transformXvalue)) - sliderHeightOff;
                        }
                        if ($('#slider.with-header').next('#header:not(.transparent-header)').length > 0 && ($body.hasClass('device-lg') || $body.hasClass('device-md'))) {
                            var headerHeightOff = $header.outerHeight();
                            scrHeight = scrHeight - headerHeightOff;
                        }
                    }
                    if (element.parents('.full-screen').length > 0) {
                        scrHeight = element.parents('.full-screen').height();
                    }

                    if ($body.hasClass('device-xs') || $body.hasClass('device-xxs')) {
                        if (!element.hasClass('force-full-screen')) {
                            scrHeight = 'auto';
                        }
                    }

                    if (negativeHeight) {
                        scrHeight = scrHeight - Number(negativeHeight);
                    }

                    element.css('height', scrHeight);
                    if (element.attr('id') == 'slider' && !element.hasClass('canvas-slider-grid')) {
                        if (element.has('.swiper-slide')) {
                            element.find('.swiper-slide').css('height', scrHeight);
                        }
                    }
                });
            }
        },

        maxHeight: function () {
            if ($commonHeightEl.length > 0) {
                if ($commonHeightEl.hasClass('customjs')) {
                    return true;
                }
                $commonHeightEl.each(function () {
                    var element = $(this);
                    if (element.find('.common-height').length > 0) {
                        SEMICOLON.initialize.commonHeight(element.find('.common-height:not(.customjs)'));
                    }

                    SEMICOLON.initialize.commonHeight(element);
                });
            }
        },

        commonHeight: function (element) {
            var maxHeight = 0;
            element.children('[class*=col-]').each(function () {
                var element = $(this).children();
                if (element.hasClass('max-height')) {
                    maxHeight = element.outerHeight();
                } else {
                    if (element.outerHeight() > maxHeight)
                        maxHeight = element.outerHeight();
                }
            });

            element.children('[class*=col-]').each(function () {
                $(this).height(maxHeight);
            });
        },

        testimonialsGrid: function () {
            if ($testimonialsGridEl.length > 0) {
                if ($body.hasClass('device-sm') || $body.hasClass('device-md') || $body.hasClass('device-lg')) {
                    var maxHeight = 0;
                    $testimonialsGridEl.each(function () {
                        $(this).find("li > .testimonial").each(function () {
                            if ($(this).height() > maxHeight) {
                                maxHeight = $(this).height();
                            }
                        });
                        $(this).find("li").height(maxHeight);
                        maxHeight = 0;
                    });
                } else {
                    $testimonialsGridEl.find("li").css({'height': 'auto'});
                }
            }
        },

        lightbox: function () {

            if (!$().magnificPopup) {
                console.log('lightbox: Magnific Popup not Defined.');
                return true;
            }

            var $lightboxImageEl = $('[data-lightbox="image"]'),
                $lightboxGalleryEl = $('[data-lightbox="gallery"]'),
                $lightboxIframeEl = $('[data-lightbox="iframe"]'),
                $lightboxInlineEl = $('[data-lightbox="inline"]'),
                $lightboxAjaxEl = $('[data-lightbox="ajax"]'),
                $lightboxAjaxGalleryEl = $('[data-lightbox="ajax-gallery"]');

            if ($lightboxImageEl.length > 0) {
                $lightboxImageEl.magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    closeBtnInside: false,
                    fixedContentPos: true,
                    mainClass: 'mfp-no-margins mfp-fade', // class to remove default margin from left and right side
                    image: {
                        verticalFit: true
                    }
                });
            }

            if ($lightboxGalleryEl.length > 0) {
                $lightboxGalleryEl.each(function () {
                    var element = $(this);

                    if (element.find('a[data-lightbox="gallery-item"]').parent('.clone').hasClass('clone')) {
                        element.find('a[data-lightbox="gallery-item"]').parent('.clone').find('a[data-lightbox="gallery-item"]').attr('data-lightbox', '');
                    }

                    if (element.find('a[data-lightbox="gallery-item"]').parents('.cloned').hasClass('cloned')) {
                        element.find('a[data-lightbox="gallery-item"]').parents('.cloned').find('a[data-lightbox="gallery-item"]').attr('data-lightbox', '');
                    }

                    element.magnificPopup({
                        delegate: 'a[data-lightbox="gallery-item"]',
                        type: 'image',
                        closeOnContentClick: true,
                        closeBtnInside: false,
                        fixedContentPos: true,
                        mainClass: 'mfp-no-margins mfp-fade', // class to remove default margin from left and right side
                        image: {
                            verticalFit: true
                        },
                        gallery: {
                            enabled: true,
                            navigateByImgClick: true,
                            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                        }
                    });
                });
            }

            if ($lightboxIframeEl.length > 0) {
                $lightboxIframeEl.magnificPopup({
                    disableOn: 600,
                    type: 'iframe',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false
                });
            }

            if ($lightboxInlineEl.length > 0) {
                $lightboxInlineEl.magnificPopup({
                    type: 'inline',
                    mainClass: 'mfp-no-margins mfp-fade',
                    closeBtnInside: false,
                    fixedContentPos: true,
                    overflowY: 'scroll'
                });
            }

            if ($lightboxAjaxEl.length > 0) {
                $lightboxAjaxEl.magnificPopup({
                    type: 'ajax',
                    closeBtnInside: false,
                    callbacks: {
                        ajaxContentAdded: function (mfpResponse) {
                            SEMICOLON.widget.loadFlexSlider();
                            SEMICOLON.initialize.resizeVideos();
                            SEMICOLON.widget.masonryThumbs();
                        },
                        open: function () {
                            $body.addClass('ohidden');
                        },
                        close: function () {
                            $body.removeClass('ohidden');
                        }
                    }
                });
            }

            if ($lightboxAjaxGalleryEl.length > 0) {
                $lightboxAjaxGalleryEl.magnificPopup({
                    delegate: 'a[data-lightbox="ajax-gallery-item"]',
                    type: 'ajax',
                    closeBtnInside: false,
                    gallery: {
                        enabled: true,
                        preload: 0,
                        navigateByImgClick: false
                    },
                    callbacks: {
                        ajaxContentAdded: function (mfpResponse) {
                            SEMICOLON.widget.loadFlexSlider();
                            SEMICOLON.initialize.resizeVideos();
                            SEMICOLON.widget.masonryThumbs();
                        },
                        open: function () {
                            $body.addClass('ohidden');
                        },
                        close: function () {
                            $body.removeClass('ohidden');
                        }
                    }
                });
            }
        },

        modal: function () {

            if (!$().magnificPopup) {
                console.log('modal: Magnific Popup not Defined.');
                return true;
            }

            var $modal = $('.modal-on-load:not(.customjs)');
            if ($modal.length > 0) {
                $modal.each(function () {
                    var element = $(this),
                        elementTarget = element.attr('data-target'),
                        elementTargetValue = elementTarget.split('#')[1],
                        elementDelay = element.attr('data-delay'),
                        elementTimeout = element.attr('data-timeout'),
                        elementAnimateIn = element.attr('data-animate-in'),
                        elementAnimateOut = element.attr('data-animate-out');

                    if (!element.hasClass('enable-cookie')) {
                        $.removeCookie(elementTargetValue);
                    }

                    if (element.hasClass('enable-cookie')) {
                        var elementCookie = $.cookie(elementTargetValue);

                        if (typeof elementCookie !== 'undefined' && elementCookie == '0') {
                            return true;
                        }
                    }

                    if (!elementDelay) {
                        elementDelay = 1500;
                    } else {
                        elementDelay = Number(elementDelay) + 1500;
                    }

                    var t = setTimeout(function () {
                        $.magnificPopup.open({
                            items: {src: elementTarget},
                            type: 'inline',
                            mainClass: 'mfp-no-margins mfp-fade',
                            closeBtnInside: false,
                            fixedContentPos: true,
                            removalDelay: 500,
                            callbacks: {
                                open: function () {
                                    if (elementAnimateIn != '') {
                                        $(elementTarget).addClass(elementAnimateIn + ' animated');
                                    }
                                },
                                beforeClose: function () {
                                    if (elementAnimateOut != '') {
                                        $(elementTarget).removeClass(elementAnimateIn).addClass(elementAnimateOut);
                                    }
                                },
                                afterClose: function () {
                                    if (elementAnimateIn != '' || elementAnimateOut != '') {
                                        $(elementTarget).removeClass(elementAnimateIn + ' ' + elementAnimateOut + ' animated');
                                    }
                                    if (element.hasClass('enable-cookie')) {
                                        $.cookie(elementTargetValue, '0');
                                    }
                                }
                            }
                        }, 0);
                    }, Number(elementDelay));

                    if (elementTimeout != '') {
                        var to = setTimeout(function () {
                            $.magnificPopup.close();
                        }, Number(elementDelay) + Number(elementTimeout));
                    }
                });
            }
        },

        resizeVideos: function () {

            if (!$().fitVids) {
                console.log('resizeVideos: FitVids not Defined.');
                return true;
            }

            $("#content,#footer,#slider:not(.revslider-wrap),.landing-offer-media,.portfolio-ajax-modal,.mega-menu-column").fitVids({
                customSelector: "iframe[src^='http://www.dailymotion.com/embed'], iframe[src*='maps.google.com'], iframe[src*='google.com/maps']",
                ignore: '.no-fv'
            });
        },

        imageFade: function () {
            $('.image_fade').hover(function () {
                $(this).filter(':not(:animated)').animate({opacity: 0.8}, 400);
            }, function () {
                $(this).animate({opacity: 1}, 400);
            });
        },

        blogTimelineEntries: function () {
            $('.post-timeline.grid-2').find('.entry').each(function () {
                var position = $(this).inlineStyle('left');
                if (position == '0px') {
                    $(this).removeClass('alt');
                } else {
                    $(this).addClass('alt');
                }
                $(this).find('.entry-timeline').fadeIn();
            });
        },

        pageTransition: function () {
            if ($body.hasClass('no-transition')) {
                return true;
            }

            if (!$().animsition) {
                $body.addClass('no-transition');
                console.log('pageTransition: Animsition not Defined.');
                return true;
            }

            window.onpageshow = function (event) {
                if (event.persisted) {
                    window.location.reload();
                }
            };

            var animationIn = $body.attr('data-animation-in'),
                animationOut = $body.attr('data-animation-out'),
                durationIn = $body.attr('data-speed-in'),
                durationOut = $body.attr('data-speed-out'),
                loaderTimeOut = $body.attr('data-loader-timeout'),
                loaderStyle = $body.attr('data-loader'),
                loaderColor = $body.attr('data-loader-color'),
                loaderStyleHtml = $body.attr('data-loader-html'),
                loaderBgStyle = '',
                loaderBorderStyle = '',
                loaderBgClass = '',
                loaderBorderClass = '',
                loaderBgClass2 = '',
                loaderBorderClass2 = '';

            if (!animationIn) {
                animationIn = 'fadeIn';
            }
            if (!animationOut) {
                animationOut = 'fadeOut';
            }
            if (!durationIn) {
                durationIn = 1500;
            }
            if (!durationOut) {
                durationOut = 800;
            }
            if (!loaderStyleHtml) {
                loaderStyleHtml = '<div class="css3-spinner-bounce1"></div><div class="css3-spinner-bounce2"></div><div class="css3-spinner-bounce3"></div>';
            }

            if (!loaderTimeOut) {
                loaderTimeOut = false;
            } else {
                loaderTimeOut = Number(loaderTimeOut);
            }

            if (loaderColor) {
                if (loaderColor == 'theme') {
                    loaderBgClass = ' bgcolor';
                    loaderBorderClass = ' border-color';
                    loaderBgClass2 = ' class="bgcolor"';
                    loaderBorderClass2 = ' class="border-color"';
                } else {
                    loaderBgStyle = ' style="background-color:' + loaderColor + ';"';
                    loaderBorderStyle = ' style="border-color:' + loaderColor + ';"';
                }
                loaderStyleHtml = '<div class="css3-spinner-bounce1' + loaderBgClass + '"' + loaderBgStyle + '></div><div class="css3-spinner-bounce2' + loaderBgClass + '"' + loaderBgStyle + '></div><div class="css3-spinner-bounce3' + loaderBgClass + '"' + loaderBgStyle + '></div>'
            }

            if (loaderStyle == '2') {
                loaderStyleHtml = '<div class="css3-spinner-flipper' + loaderBgClass + '"' + loaderBgStyle + '></div>';
            } else if (loaderStyle == '3') {
                loaderStyleHtml = '<div class="css3-spinner-double-bounce1' + loaderBgClass + '"' + loaderBgStyle + '></div><div class="css3-spinner-double-bounce2' + loaderBgClass + '"' + loaderBgStyle + '></div>';
            } else if (loaderStyle == '4') {
                loaderStyleHtml = '<div class="css3-spinner-rect1' + loaderBgClass + '"' + loaderBgStyle + '></div><div class="css3-spinner-rect2' + loaderBgClass + '"' + loaderBgStyle + '></div><div class="css3-spinner-rect3' + loaderBgClass + '"' + loaderBgStyle + '></div><div class="css3-spinner-rect4' + loaderBgClass + '"' + loaderBgStyle + '></div><div class="css3-spinner-rect5' + loaderBgClass + '"' + loaderBgStyle + '></div>';
            } else if (loaderStyle == '5') {
                loaderStyleHtml = '<div class="css3-spinner-cube1' + loaderBgClass + '"' + loaderBgStyle + '></div><div class="css3-spinner-cube2' + loaderBgClass + '"' + loaderBgStyle + '></div>';
            } else if (loaderStyle == '6') {
                loaderStyleHtml = '<div class="css3-spinner-scaler' + loaderBgClass + '"' + loaderBgStyle + '></div>';
            } else if (loaderStyle == '7') {
                loaderStyleHtml = '<div class="css3-spinner-grid-pulse"><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div></div>';
            } else if (loaderStyle == '8') {
                loaderStyleHtml = '<div class="css3-spinner-clip-rotate"><div' + loaderBorderClass2 + loaderBorderStyle + '></div></div>';
            } else if (loaderStyle == '9') {
                loaderStyleHtml = '<div class="css3-spinner-ball-rotate"><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div></div>';
            } else if (loaderStyle == '10') {
                loaderStyleHtml = '<div class="css3-spinner-zig-zag"><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div></div>';
            } else if (loaderStyle == '11') {
                loaderStyleHtml = '<div class="css3-spinner-triangle-path"><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div></div>';
            } else if (loaderStyle == '12') {
                loaderStyleHtml = '<div class="css3-spinner-ball-scale-multiple"><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div></div>';
            } else if (loaderStyle == '13') {
                loaderStyleHtml = '<div class="css3-spinner-ball-pulse-sync"><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div><div' + loaderBgClass2 + loaderBgStyle + '></div></div>';
            } else if (loaderStyle == '14') {
                loaderStyleHtml = '<div class="css3-spinner-scale-ripple"><div' + loaderBorderClass2 + loaderBorderStyle + '></div><div' + loaderBorderClass2 + loaderBorderStyle + '></div><div' + loaderBorderClass2 + loaderBorderStyle + '></div></div>';
            }

            $wrapper.animsition({
                inClass: animationIn,
                outClass: animationOut,
                inDuration: Number(durationIn),
                outDuration: Number(durationOut),
                linkElement: '#primary-menu ul li a:not([target="_blank"]):not([href*="#"]):not([data-lightbox]):not([href^="mailto"]):not([href^="tel"]):not([href^="sms"]):not([href^="call"])',
                loading: true,
                loadingParentElement: 'body',
                loadingClass: 'css3-spinner',
                loadingHtml: loaderStyleHtml,
                unSupportCss: [
                    'animation-duration',
                    '-webkit-animation-duration',
                    '-o-animation-duration'
                ],
                overlay: false,
                overlayClass: 'animsition-overlay-slide',
                overlayParentElement: 'body',
                timeOut: loaderTimeOut
            });
        },

        lazyLoad: function () {
            var lazyLoadEl = $('[data-lazyload]');
            if (lazyLoadEl.length > 0) {
                lazyLoadEl.each(function () {
                    var element = $(this),
                        elementImg = element.attr('data-lazyload');

                    element.attr('src', 'http://hstatic.net/588/1000124588/1000175797/blank.svg?v=2148').css({'background': 'url(http://hstatic.net/588/1000124588/1000175797/preloader.gif?v=2148) no-repeat center center #FFF'});

                    element.appear(function () {
                        element.css({'background': 'none'}).removeAttr('width').removeAttr('height').attr('src', elementImg);
                    }, {accX: 0, accY: 120}, 'easeInCubic');
                });
            }
        },

        topScrollOffset: function () {
            var topOffsetScroll = 0;

            if (($body.hasClass('device-lg') || $body.hasClass('device-md')) && !SEMICOLON.isMobile.any()) {
                if ($header.hasClass('sticky-header')) {
                    if ($pagemenu.hasClass('dots-menu')) {
                        topOffsetScroll = 100;
                    } else {
                        topOffsetScroll = 144;
                    }
                } else {
                    if ($pagemenu.hasClass('dots-menu')) {
                        topOffsetScroll = 140;
                    } else {
                        topOffsetScroll = 184;
                    }
                }

                if (!$pagemenu.length) {
                    if ($header.hasClass('sticky-header')) {
                        topOffsetScroll = 100;
                    } else {
                        topOffsetScroll = 140;
                    }
                }
            } else {
                //topOffsetScroll = 40;
                // Tu.Nguyen 20161017
                topOffsetScroll = 100;
            }

            return topOffsetScroll;
        },

        defineColumns: function (element) {
            var column = 4;

            if (element.hasClass('portfolio-full')) {
                if (element.hasClass('portfolio-3')) column = 3;
                else if (element.hasClass('portfolio-5')) column = 5;
                else if (element.hasClass('portfolio-6')) column = 6;
                else column = 4;

                if ($body.hasClass('device-sm') && (column == 4 || column == 5 || column == 6)) {
                    column = 3;
                } else if ($body.hasClass('device-xs') && (column == 3 || column == 4 || column == 5 || column == 6)) {
                    column = 2;
                } else if ($body.hasClass('device-xxs')) {
                    column = 1;
                }
            } else if (element.hasClass('masonry-thumbs')) {

                var lgCol = element.attr('data-lg-col'),
                    mdCol = element.attr('data-md-col'),
                    smCol = element.attr('data-sm-col'),
                    xsCol = element.attr('data-xs-col'),
                    xxsCol = element.attr('data-xxs-col');

                if (element.hasClass('col-2')) column = 2;
                else if (element.hasClass('col-3')) column = 3;
                else if (element.hasClass('col-5')) column = 5;
                else if (element.hasClass('col-6')) column = 6;
                else column = 4;

                if ($body.hasClass('device-lg')) {
                    if (lgCol) {
                        column = Number(lgCol);
                    }
                } else if ($body.hasClass('device-md')) {
                    if (mdCol) {
                        column = Number(mdCol);
                    }
                } else if ($body.hasClass('device-sm')) {
                    if (smCol) {
                        column = Number(smCol);
                    }
                } else if ($body.hasClass('device-xs')) {
                    if (xsCol) {
                        column = Number(xsCol);
                    }
                } else if ($body.hasClass('device-xxs')) {
                    if (xxsCol) {
                        column = Number(xxsCol);
                    }
                }

            }

            return column;
        },

        setFullColumnWidth: function (element) {

            if (!$().isotope) {
                console.log('setFullColumnWidth: Isotope not Defined.');
                return true;
            }

            element.css({'width': ''});

            if (element.hasClass('portfolio-full')) {
                var columns = SEMICOLON.initialize.defineColumns(element);
                var containerWidth = element.width();
                if (containerWidth == (Math.floor(containerWidth / columns) * columns)) {
                    containerWidth = containerWidth - 1;
                }
                var postWidth = Math.floor(containerWidth / columns);
                if ($body.hasClass('device-xxs')) {
                    var deviceSmallest = 1;
                } else {
                    var deviceSmallest = 0;
                }
                element.find(".portfolio-item").each(function (index) {

                });
            } else if (element.hasClass('masonry-thumbs')) {
                var columns = SEMICOLON.initialize.defineColumns(element),
                    containerWidth = element.innerWidth();

                if (containerWidth == windowWidth) {
                    containerWidth = windowWidth * 1.004;
                    element.css({'width': containerWidth + 'px'});
                }

                var postWidth = (containerWidth / columns);

                postWidth = Math.floor(postWidth);

                if ((postWidth * columns) >= containerWidth) {
                    element.css({'margin-right': '-1px'});
                }

                element.children('a').css({"width": postWidth + "px"});

                var firstElementWidth = element.find('a:eq(0)').outerWidth();

                element.isotope({
                    masonry: {
                        columnWidth: firstElementWidth
                    }
                });

                var bigImageNumbers = element.attr('data-big');
                if (bigImageNumbers) {
                    bigImageNumbers = bigImageNumbers.split(",");
                    var bigImageNumber = '',
                        bigi = '';
                    for (bigi = 0; bigi < bigImageNumbers.length; bigi++) {
                        bigImageNumber = Number(bigImageNumbers[bigi]) - 1;
                        element.find('a:eq(' + bigImageNumber + ')').css({width: firstElementWidth * 2 + 'px'});
                    }
                    var t = setTimeout(function () {
                        element.isotope('layout');
                    }, 1000);
                }
            }

        },

        aspectResizer: function () {
            var $aspectResizerEl = $('.aspect-resizer');
            if ($aspectResizerEl.length > 0) {
                $aspectResizerEl.each(function () {
                    var element = $(this),
                        elementW = element.inlineStyle('width'),
                        elementH = element.inlineStyle('height'),
                        elementPW = element.parent().innerWidth();
                });
            }
        },

        dataResponsiveClasses: function () {
            var $dataClassXxs = $('[data-class-xxs]'),
                $dataClassXs = $('[data-class-xs]'),
                $dataClassSm = $('[data-class-sm]'),
                $dataClassMd = $('[data-class-md]'),
                $dataClassLg = $('[data-class-lg]');

            if ($dataClassXxs.length > 0) {
                $dataClassXxs.each(function () {
                    var element = $(this),
                        elementClass = element.attr('data-class-xxs'),
                        elementClassDelete = element.attr('data-class-xs') + ' ' + element.attr('data-class-sm') + ' ' + element.attr('data-class-md') + ' ' + element.attr('data-class-lg');

                    if ($body.hasClass('device-xxs')) {
                        element.removeClass(elementClassDelete);
                        element.addClass(elementClass);
                    }
                });
            }

            if ($dataClassXs.length > 0) {
                $dataClassXs.each(function () {
                    var element = $(this),
                        elementClass = element.attr('data-class-xs'),
                        elementClassDelete = element.attr('data-class-xxs') + ' ' + element.attr('data-class-sm') + ' ' + element.attr('data-class-md') + ' ' + element.attr('data-class-lg');

                    if ($body.hasClass('device-xs')) {
                        element.removeClass(elementClassDelete);
                        element.addClass(elementClass);
                    }
                });
            }

            if ($dataClassSm.length > 0) {
                $dataClassSm.each(function () {
                    var element = $(this),
                        elementClass = element.attr('data-class-sm'),
                        elementClassDelete = element.attr('data-class-xxs') + ' ' + element.attr('data-class-xs') + ' ' + element.attr('data-class-md') + ' ' + element.attr('data-class-lg');

                    if ($body.hasClass('device-sm')) {
                        element.removeClass(elementClassDelete);
                        element.addClass(elementClass);
                    }
                });
            }

            if ($dataClassMd.length > 0) {
                $dataClassMd.each(function () {
                    var element = $(this),
                        elementClass = element.attr('data-class-md'),
                        elementClassDelete = element.attr('data-class-xxs') + ' ' + element.attr('data-class-xs') + ' ' + element.attr('data-class-sm') + ' ' + element.attr('data-class-lg');

                    if ($body.hasClass('device-md')) {
                        element.removeClass(elementClassDelete);
                        element.addClass(elementClass);
                    }
                });
            }

            if ($dataClassLg.length > 0) {
                $dataClassLg.each(function () {
                    var element = $(this),
                        elementClass = element.attr('data-class-lg'),
                        elementClassDelete = element.attr('data-class-xxs') + ' ' + element.attr('data-class-xs') + ' ' + element.attr('data-class-sm') + ' ' + element.attr('data-class-md');

                    if ($body.hasClass('device-lg')) {
                        element.removeClass(elementClassDelete);
                        element.addClass(elementClass);
                    }
                });
            }
        },

        dataResponsiveHeights: function () {
            var $dataHeightXxs = $('[data-height-xxs]'),
                $dataHeightXs = $('[data-height-xs]'),
                $dataHeightSm = $('[data-height-sm]'),
                $dataHeightMd = $('[data-height-md]'),
                $dataHeightLg = $('[data-height-lg]');

            if ($dataHeightXxs.length > 0) {
                $dataHeightXxs.each(function () {
                    var element = $(this),
                        elementHeight = element.attr('data-height-xxs');

                    if ($body.hasClass('device-xxs')) {
                        if (elementHeight != '') {
                            element.css('height', elementHeight);
                        }
                    }
                });
            }

            if ($dataHeightXs.length > 0) {
                $dataHeightXs.each(function () {
                    var element = $(this),
                        elementHeight = element.attr('data-height-xs');

                    if ($body.hasClass('device-xs')) {
                        if (elementHeight != '') {
                            element.css('height', elementHeight);
                        }
                    }
                });
            }

            if ($dataHeightSm.length > 0) {
                $dataHeightSm.each(function () {
                    var element = $(this),
                        elementHeight = element.attr('data-height-sm');

                    if ($body.hasClass('device-sm')) {
                        if (elementHeight != '') {
                            element.css('height', elementHeight);
                        }
                    }
                });
            }

            if ($dataHeightMd.length > 0) {
                $dataHeightMd.each(function () {
                    var element = $(this),
                        elementHeight = element.attr('data-height-md');

                    if ($body.hasClass('device-md')) {
                        if (elementHeight != '') {
                            element.css('height', elementHeight);
                        }
                    }
                });
            }

            if ($dataHeightLg.length > 0) {
                $dataHeightLg.each(function () {
                    var element = $(this),
                        elementHeight = element.attr('data-height-lg');

                    if ($body.hasClass('device-lg')) {
                        if (elementHeight != '') {
                            element.css('height', elementHeight);
                        }
                    }
                });
            }
        },

        stickFooterOnSmall: function () {
            var windowH = $window.height(),
                wrapperH = $wrapper.height();

            if (!$body.hasClass('sticky-footer') && $footer.length > 0 && $wrapper.has('#footer')) {
                if (windowH > wrapperH) {
                    $footer.css({'margin-top': (windowH - wrapperH)});
                }
            }
        },

        stickyFooter: function () {
            if ($body.hasClass('sticky-footer') && $footer.length > 0 && ($body.hasClass('device-lg') || $body.hasClass('device-md'))) {
                var stickyFooter = $footer.outerHeight();
                $content.css({'margin-bottom': stickyFooter});
            } else {
                $content.css({'margin-bottom': 0});
            }
        }

    };

    SEMICOLON.header = {

        init: function () {

            SEMICOLON.header.superfish();
            SEMICOLON.header.menufunctions();
            SEMICOLON.header.fullWidthMenu();
            SEMICOLON.header.overlayMenu();
            SEMICOLON.header.stickyMenu();
            SEMICOLON.header.stickyPageMenu();
            SEMICOLON.header.sideHeader();
            SEMICOLON.header.sidePanel();
            SEMICOLON.header.onePageScroll();
            SEMICOLON.header.onepageScroller();
            SEMICOLON.header.logo();
            SEMICOLON.header.topsearch();
            SEMICOLON.header.topcart();

        },

        superfish: function () {

            if ($body.hasClass('device-lg') || $body.hasClass('device-md')) {
                $('#primary-menu ul ul, #primary-menu ul .mega-menu-content').css('display', 'block');
                SEMICOLON.header.menuInvert();
                $('#primary-menu ul ul, #primary-menu ul .mega-menu-content').css('display', '');
            }

            if (!$().superfish) {
                $body.addClass('no-superfish');
                console.log('superfish: Superfish not Defined.');
                return true;
            }

            $('body:not(.side-header) #primary-menu > ul, body:not(.side-header) #primary-menu > div > ul:not(.dropdown-menu), .top-links > ul').superfish({
                popUpSelector: 'ul,.mega-menu-content,.top-link-section',
                delay: 250,
                speed: 350,
                animation: {opacity: 'show'},
                animationOut: {opacity: 'hide'},
                cssArrows: false,
                onShow: function () {
                    var megaMenuContent = $(this);
                    if (megaMenuContent.find('.owl-carousel.customjs').length > 0) {
                        megaMenuContent.find('.owl-carousel').removeClass('customjs');
                        SEMICOLON.widget.carousel();
                    }

                    if (megaMenuContent.hasClass('mega-menu-content') && megaMenuContent.find('.widget').length > 0) {
                        if ($body.hasClass('device-lg') || $body.hasClass('device-md')) {
                            setTimeout(function () {
                                SEMICOLON.initialize.commonHeight(megaMenuContent);
                            }, 200);
                        } else {
                            megaMenuContent.children().height('');
                        }
                    }
                }
            });

            $('body.side-header #primary-menu > ul').superfish({
                popUpSelector: 'ul',
                delay: 250,
                speed: 350,
                animation: {opacity: 'show', height: 'show'},
                animationOut: {opacity: 'hide', height: 'hide'},
                cssArrows: false
            });

        },

        menuInvert: function () {

            $('#primary-menu .mega-menu-content, #primary-menu ul ul').each(function (index, element) {
                var $menuChildElement = $(element),
                    menuChildOffset = $menuChildElement.offset(),
                    menuChildWidth = $menuChildElement.width(),
                    menuChildLeft = menuChildOffset.left;

                if (windowWidth - (menuChildWidth + menuChildLeft) < 0) {
                    $menuChildElement.addClass('menu-pos-invert');
                }
            });

        },

        menufunctions: function () {

            $('#primary-menu ul li:has(ul)').addClass('sub-menu');
            $('.top-links ul li:has(ul) > a, #primary-menu.with-arrows > ul > li:has(ul) > a > div, #primary-menu.with-arrows > div > ul > li:has(ul) > a > div, #page-menu nav ul li:has(ul) > a > div').append('<i class="icon-angle-down"></i>');
            $('.top-links > ul').addClass('clearfix');

            if ($body.hasClass('device-lg') || $body.hasClass('device-md')) {
                $('#primary-menu.sub-title > ul > li').hover(function () {
                    $(this).prev().css({backgroundImage: 'none'});
                }, function () {
                    $(this).prev().css({backgroundImage: 'url("images/icons/menu-divider.png")'});
                });

                $('#primary-menu.sub-title').children('ul').children('.current').prev().css({backgroundImage: 'none'});
            }

            // var responsiveThreshold = $header.attr('data-responsive-under');
            // if( !responsiveThreshold ) { responsiveThreshold = 992; }

            // if( windowWidth < Number( responsiveThreshold ) ) {
            // 	$body.addClass('mobile-header-active');
            // } else {
            // 	$body.removeClass('mobile-header-active');
            // }

            if (SEMICOLON.isMobile.Android()) {
                $('#primary-menu ul li.sub-menu').children('a').on('touchstart', function (e) {
                    if (!$(this).parent('li.sub-menu').hasClass('sfHover')) {
                        e.preventDefault();
                    }
                });
            }

            if (SEMICOLON.isMobile.Windows()) {
                if ($().superfish) {
                    $('#primary-menu > ul, #primary-menu > div > ul,.top-links > ul').superfish('destroy').addClass('windows-mobile-menu');
                } else {
                    $('#primary-menu > ul, #primary-menu > div > ul,.top-links > ul').addClass('windows-mobile-menu');
                    console.log('menufunctions: Superfish not defined.');
                }

                $('#primary-menu ul li:has(ul)').append('<a href="#" class="wn-submenu-trigger"><i class="icon-angle-down"></i></a>');

                $('#primary-menu ul li.sub-menu').children('a.wn-submenu-trigger').click(function (e) {
                    $(this).parent().toggleClass('open');
                    $(this).parent().find('> ul, > .mega-menu-content').stop(true, true).toggle();
                    return false;
                });
            }

        },

        fullWidthMenu: function () {
            if ($body.hasClass('stretched')) {
                if ($header.find('.container-fullwidth').length > 0) {
                    $('.mega-menu .mega-menu-content').css({'width': $wrapper.width() - 120});
                }
                if ($header.hasClass('full-header')) {
                    $('.mega-menu .mega-menu-content').css({'width': $wrapper.width() - 60});
                }
            } else {
                if ($header.find('.container-fullwidth').length > 0) {
                    $('.mega-menu .mega-menu-content').css({'width': $wrapper.width() - 120});
                }
                if ($header.hasClass('full-header')) {
                    $('.mega-menu .mega-menu-content').css({'width': $wrapper.width() - 80});
                }
            }
        },

        overlayMenu: function () {
            if ($body.hasClass('overlay-menu')) {
                var overlayMenuItem = $('#primary-menu').children('ul').children('li'),
                    overlayMenuItemHeight = overlayMenuItem.outerHeight(),
                    overlayMenuItemTHeight = overlayMenuItem.length * overlayMenuItemHeight,
                    firstItemOffset = ($window.height() - overlayMenuItemTHeight) / 2;

                $('#primary-menu').children('ul').children('li:first-child').css({'margin-top': firstItemOffset + 'px'});
            }
        },

        stickyMenu: function (headerOffset) {
            if ($window.scrollTop() > headerOffset) {
                if ($body.hasClass('device-lg') || $body.hasClass('device-md')) {
                    $('body:not(.side-header) #header:not(.no-sticky)').addClass('sticky-header');
                    if (!$headerWrap.hasClass('force-not-dark')) {
                        $headerWrap.removeClass('not-dark');
                    }
                    SEMICOLON.header.stickyMenuClass();
                } else if ($body.hasClass('device-xs') || $body.hasClass('device-xxs') || $body.hasClass('device-sm')) {
                    if ($body.hasClass('sticky-responsive-menu')) {
                        $('#header:not(.no-sticky)').addClass('responsive-sticky-header');
                        SEMICOLON.header.stickyMenuClass();
                    }
                }
            } else {
                SEMICOLON.header.removeStickyness();
            }
        },

        stickyPageMenu: function (pageMenuOffset) {
            if ($window.scrollTop() > pageMenuOffset) {
                if ($body.hasClass('device-lg') || $body.hasClass('device-md')) {
                    $('#page-menu:not(.dots-menu,.no-sticky)').addClass('sticky-page-menu');
                } else if ($body.hasClass('device-xs') || $body.hasClass('device-xxs') || $body.hasClass('device-sm')) {
                    if ($body.hasClass('sticky-responsive-pagemenu')) {
                        $('#page-menu:not(.dots-menu,.no-sticky)').addClass('sticky-page-menu');
                    }
                }
            } else {
                $('#page-menu:not(.dots-menu,.no-sticky)').removeClass('sticky-page-menu');
            }
        },

        removeStickyness: function () {
            if ($header.hasClass('sticky-header')) {
                $('body:not(.side-header) #header:not(.no-sticky)').removeClass('sticky-header');
                $header.removeClass().addClass(oldHeaderClasses);
                $headerWrap.removeClass().addClass(oldHeaderWrapClasses);
                if (!$headerWrap.hasClass('force-not-dark')) {
                    $headerWrap.removeClass('not-dark');
                }
                SEMICOLON.slider.swiperSliderMenu();
                SEMICOLON.slider.revolutionSliderMenu();
            }
            if ($header.hasClass('responsive-sticky-header')) {
                $('body.sticky-responsive-menu #header').removeClass('responsive-sticky-header');
            }
            if (($body.hasClass('device-xs') || $body.hasClass('device-xxs') || $body.hasClass('device-sm')) && (typeof responsiveMenuClasses === 'undefined')) {
                $header.removeClass().addClass(oldHeaderClasses);
                $headerWrap.removeClass().addClass(oldHeaderWrapClasses);
                if (!$headerWrap.hasClass('force-not-dark')) {
                    $headerWrap.removeClass('not-dark');
                }
            }
        },

        sideHeader: function () {
            $("#header-trigger").click(function () {
                $('body.open-header').toggleClass("side-header-open");
                return false;
            });
        },

        sidePanel: function () {
            $(".side-panel-trigger").click(function () {
                $body.toggleClass("side-panel-open");
                if ($body.hasClass('device-touch')) {
                    $body.toggleClass("ohidden");
                }
                return false;
            });
        },

        onePageScroll: function () {
            if ($onePageMenuEl.length > 0) {
                var onePageSpeed = $onePageMenuEl.attr('data-speed'),
                    onePageOffset = $onePageMenuEl.attr('data-offset'),
                    onePageEasing = $onePageMenuEl.attr('data-easing');

                if (!onePageSpeed) {
                    onePageSpeed = 1000;
                }
                if (!onePageEasing) {
                    onePageEasing = 'easeOutQuad';
                }

                $onePageMenuEl.find('a[data-href]').click(function () {
                    var element = $(this),
                        divScrollToAnchor = element.attr('data-href'),
                        divScrollSpeed = element.attr('data-speed'),
                        divScrollOffset = element.attr('data-offset'),
                        divScrollEasing = element.attr('data-easing');

                    if ($(divScrollToAnchor).length > 0) {

                        if (!onePageOffset) {
                            var onePageOffsetG = SEMICOLON.initialize.topScrollOffset();
                        } else {
                            var onePageOffsetG = onePageOffset;
                        }

                        if (!divScrollSpeed) {
                            divScrollSpeed = onePageSpeed;
                        }
                        if (!divScrollOffset) {
                            divScrollOffset = onePageOffsetG;
                        }
                        if (!divScrollEasing) {
                            divScrollEasing = onePageEasing;
                        }

                        if ($onePageMenuEl.hasClass('no-offset')) {
                            divScrollOffset = 0;
                        }

                        onePageGlobalOffset = Number(divScrollOffset);

                        $onePageMenuEl.find('li').removeClass('current');
                        $onePageMenuEl.find('a[data-href="' + divScrollToAnchor + '"]').parent('li').addClass('current');

                        if (windowWidth < 768 || $body.hasClass('overlay-menu')) {
                            if ($('#primary-menu').find('ul.mobile-primary-menu').length > 0) {
                                $('#primary-menu > ul.mobile-primary-menu, #primary-menu > div > ul.mobile-primary-menu').toggleClass('show', false);
                            } else {
                                $('#primary-menu > ul, #primary-menu > div > ul').toggleClass('show', false);
                            }
                            $pagemenu.toggleClass('pagemenu-active', false);
                        }

                        $('html,body').stop(true).animate({
                            'scrollTop': $(divScrollToAnchor).offset().top - Number(divScrollOffset)
                        }, Number(divScrollSpeed), divScrollEasing);

                        onePageGlobalOffset = Number(divScrollOffset);
                    }

                    return false;
                });
            }
        },

        onepageScroller: function () {
            $onePageMenuEl.find('li').removeClass('current');
            $onePageMenuEl.find('a[data-href="#' + SEMICOLON.header.onePageCurrentSection() + '"]').parent('li').addClass('current');
        },

        onePageCurrentSection: function () {
            var currentOnePageSection = 'home',
                headerHeight = $headerWrap.outerHeight();

            if ($body.hasClass('side-header')) {
                headerHeight = 0;
            }

            $pageSectionEl.each(function (index) {
                var h = $(this).offset().top;
                var y = $window.scrollTop();

                var offsetScroll = headerHeight + onePageGlobalOffset;

                if (y + offsetScroll >= h && y < h + $(this).height() && $(this).attr('id') != currentOnePageSection) {
                    currentOnePageSection = $(this).attr('id');
                }
            });

            return currentOnePageSection;
        },

        logo: function () {
            if (($header.hasClass('dark') || $body.hasClass('dark')) && !$headerWrap.hasClass('not-dark')) {
                if (defaultDarkLogo) {
                    defaultLogo.find('img').attr('src', defaultDarkLogo);
                }
                if (retinaDarkLogo) {
                    retinaLogo.find('img').attr('src', retinaDarkLogo);
                }
            } else {
                if (defaultLogoImg) {
                    defaultLogo.find('img').attr('src', defaultLogoImg);
                }
                if (retinaLogoImg) {
                    retinaLogo.find('img').attr('src', retinaLogoImg);
                }
            }
            if ($header.hasClass('sticky-header')) {
                if (defaultStickyLogo) {
                    defaultLogo.find('img').attr('src', defaultStickyLogo);
                }
                if (retinaStickyLogo) {
                    retinaLogo.find('img').attr('src', retinaStickyLogo);
                }
            }
            if ($body.hasClass('device-xs') || $body.hasClass('device-xxs')) {
                if (defaultMobileLogo) {
                    defaultLogo.find('img').attr('src', defaultMobileLogo);
                }
                if (retinaMobileLogo) {
                    retinaLogo.find('img').attr('src', retinaMobileLogo);
                }
            }
        },

        stickyMenuClass: function () {
            if (stickyMenuClasses) {
                var newClassesArray = stickyMenuClasses.split(/ +/);
            } else {
                var newClassesArray = '';
            }
            var noOfNewClasses = newClassesArray.length;

            if (noOfNewClasses > 0) {
                var i = 0;
                for (i = 0; i < noOfNewClasses; i++) {
                    if (newClassesArray[i] == 'not-dark') {
                        $header.removeClass('dark');
                        $headerWrap.addClass('not-dark');
                    } else if (newClassesArray[i] == 'dark') {
                        $headerWrap.removeClass('not-dark force-not-dark');
                        if (!$header.hasClass(newClassesArray[i])) {
                            $header.addClass(newClassesArray[i]);
                        }
                    } else if (!$header.hasClass(newClassesArray[i])) {
                        $header.addClass(newClassesArray[i]);
                    }
                }
            }
        },

        responsiveMenuClass: function () {
            if ($body.hasClass('device-xs') || $body.hasClass('device-xxs') || $body.hasClass('device-sm')) {
                if (responsiveMenuClasses) {
                    var newClassesArray = responsiveMenuClasses.split(/ +/);
                } else {
                    var newClassesArray = '';
                }
                var noOfNewClasses = newClassesArray.length;

                if (noOfNewClasses > 0) {
                    var i = 0;
                    for (i = 0; i < noOfNewClasses; i++) {
                        if (newClassesArray[i] == 'not-dark') {
                            $header.removeClass('dark');
                            $headerWrap.addClass('not-dark');
                        } else if (newClassesArray[i] == 'dark') {
                            $headerWrap.removeClass('not-dark force-not-dark');
                            if (!$header.hasClass(newClassesArray[i])) {
                                $header.addClass(newClassesArray[i]);
                            }
                        } else if (!$header.hasClass(newClassesArray[i])) {
                            $header.addClass(newClassesArray[i]);
                        }
                    }
                }
                SEMICOLON.header.logo();
            }
        },

        topsocial: function () {
            if ($topSocialEl.length > 0) {
                if ($body.hasClass('device-md') || $body.hasClass('device-lg')) {
                    $topSocialEl.show();
                    $topSocialEl.find('a').css({width: 40});

                    $topSocialEl.find('.ts-text').each(function () {
                        var $clone = $(this).clone().css({
                                'visibility': 'hidden',
                                'display': 'inline-block',
                                'font-size': '13px',
                                'font-weight': 'bold'
                            }).appendTo($body),
                            cloneWidth = $clone.innerWidth() + 52;
                        $(this).parent('a').attr('data-hover-width', cloneWidth);
                        $clone.remove();
                    });

                    $topSocialEl.find('a').hover(function () {
                        if ($(this).find('.ts-text').length > 0) {
                            $(this).css({width: $(this).attr('data-hover-width')});
                        }
                    }, function () {
                        $(this).css({width: 40});
                    });
                } else {
                    $topSocialEl.show();
                    $topSocialEl.find('a').css({width: 40});

                    $topSocialEl.find('a').each(function () {
                        var topIconTitle = $(this).find('.ts-text').text();
                        $(this).attr('title', topIconTitle);
                    });

                    $topSocialEl.find('a').hover(function () {
                        $(this).css({width: 40});
                    }, function () {
                        $(this).css({width: 40});
                    });

                    if ($body.hasClass('device-xxs')) {
                        $topSocialEl.hide();
                        $topSocialEl.slice(0, 8).show();
                    }
                }
            }
        },

        topsearch: function () {

            $(document).on('click', function (event) {
                if (!$(event.target).closest('#top-search').length) {
                    $body.toggleClass('top-search-open', false);
                }
                if (!$(event.target).closest('#top-cart').length) {
                    $topCart.toggleClass('top-cart-open', false);
                }
                if (!$(event.target).closest('#page-menu').length) {
                    $pagemenu.toggleClass('pagemenu-active', false);
                }
                if (!$(event.target).closest('#side-panel').length) {
                    $body.toggleClass('side-panel-open', false);
                }
                if (!$(event.target).closest('#primary-menu.mobile-menu-off-canvas > ul').length) {
                    $('#primary-menu.mobile-menu-off-canvas > ul').toggleClass('show', false);
                }
                if (!$(event.target).closest('#primary-menu.mobile-menu-off-canvas > div > ul').length) {
                    $('#primary-menu.mobile-menu-off-canvas > div > ul').toggleClass('show', false);
                }
            });

            $("#top-search-trigger").click(function (e) {
                $body.toggleClass('top-search-open');
                $topCart.toggleClass('top-cart-open', false);
                $('#primary-menu > ul, #primary-menu > div > ul').toggleClass("show", false);
                $pagemenu.toggleClass('pagemenu-active', false);
                if ($body.hasClass('top-search-open')) {
                    $topSearch.find('input').focus();
                }
                e.stopPropagation();
                e.preventDefault();
            });

        },

        topcart: function () {

            $("#top-cart-trigger").click(function (e) {
                $pagemenu.toggleClass('pagemenu-active', false);
                $topCart.toggleClass('top-cart-open');
                e.stopPropagation();
                e.preventDefault();
            });

        }

    };

    SEMICOLON.slider = {

        init: function () {

            SEMICOLON.slider.sliderParallaxDimensions();
            SEMICOLON.slider.sliderRun();
            SEMICOLON.slider.sliderParallax();
            SEMICOLON.slider.sliderElementsFade();
            SEMICOLON.slider.captionPosition();

        },

        sliderParallaxDimensions: function () {
            if ($sliderParallaxEl.find('.slider-parallax-inner').length < 1) {
                return true;
            }

            if ($body.hasClass('device-lg') || $body.hasClass('device-md') || $body.hasClass('device-sm')) {
                var parallaxElHeight = $sliderParallaxEl.outerHeight(),
                    parallaxElWidth = $sliderParallaxEl.outerWidth();

                if ($sliderParallaxEl.hasClass('revslider-wrap') || $sliderParallaxEl.find('.carousel-widget').length > 0) {
                    parallaxElHeight = $sliderParallaxEl.find('.slider-parallax-inner').children().first().outerHeight();
                    $sliderParallaxEl.height(parallaxElHeight);
                }

                $sliderParallaxEl.find('.slider-parallax-inner').height(parallaxElHeight);

                if ($body.hasClass('side-header')) {
                    $sliderParallaxEl.find('.slider-parallax-inner').width(parallaxElWidth);
                }

                if (!$body.hasClass('stretched')) {
                    parallaxElWidth = $wrapper.outerWidth();
                    $sliderParallaxEl.find('.slider-parallax-inner').width(parallaxElWidth);
                }
            } else {
                $sliderParallaxEl.find('.slider-parallax-inner').css({'width': '', height: ''});
            }

            if (swiperSlider != '') {
                swiperSlider.update(true);
            }
        },

        sliderRun: function () {

            if (typeof Swiper === 'undefined') {
                console.log('sliderRun: Swiper not Defined.');
                return true;
            }

            if ($slider.hasClass('customjs')) {
                return true;
            }

            if ($slider.hasClass('swiper_wrapper')) {

                var element = $slider.filter('.swiper_wrapper'),
                    elementDirection = element.attr('data-direction'),
                    elementSpeed = element.attr('data-speed'),
                    elementAutoPlay = element.attr('data-autoplay'),
                    elementLoop = element.attr('data-loop'),
                    elementEffect = element.attr('data-effect'),
                    elementGrabCursor = element.attr('data-grab'),
                    slideNumberTotal = element.find('#slide-number-total'),
                    slideNumberCurrent = element.find('#slide-number-current'),
                    sliderVideoAutoPlay = element.attr('data-video-autoplay');

                if (!elementSpeed) {
                    elementSpeed = 300;
                }
                if (!elementDirection) {
                    elementDirection = 'horizontal';
                }
                if (elementAutoPlay) {
                    elementAutoPlay = Number(elementAutoPlay);
                }
                if (elementLoop == 'true') {
                    elementLoop = true;
                } else {
                    elementLoop = false;
                }
                if (!elementEffect) {
                    elementEffect = 'slide';
                }
                if (elementGrabCursor == 'false') {
                    elementGrabCursor = false;
                } else {
                    elementGrabCursor = true;
                }
                if (sliderVideoAutoPlay == 'false') {
                    sliderVideoAutoPlay = false;
                } else {
                    sliderVideoAutoPlay = true;
                }

                if (element.find('.swiper-pagination').length > 0) {
                    var elementPagination = '.swiper-pagination',
                        elementPaginationClickable = true;
                } else {
                    var elementPagination = '',
                        elementPaginationClickable = false;
                }

                var elementNavNext = '#slider-arrow-right',
                    elementNavPrev = '#slider-arrow-left';

                swiperSlider = new Swiper(element.find('.swiper-parent'), {
                    direction: elementDirection,
                    speed: Number(elementSpeed),
                    autoplay: elementAutoPlay,
                    loop: elementLoop,
                    effect: elementEffect,
                    slidesPerView: 1,
                    grabCursor: elementGrabCursor,
                    pagination: elementPagination,
                    paginationClickable: elementPaginationClickable,
                    prevButton: elementNavPrev,
                    nextButton: elementNavNext,
                    onInit: function (swiper) {
                        SEMICOLON.slider.sliderParallaxDimensions();
                        element.find('.yt-bg-player').removeClass('customjs');
                        SEMICOLON.widget.youtubeBgVideo();
                        $('.swiper-slide-active [data-caption-animate]').each(function () {
                            var $toAnimateElement = $(this),
                                toAnimateDelay = $toAnimateElement.attr('data-caption-delay'),
                                toAnimateDelayTime = 0;
                            if (toAnimateDelay) {
                                toAnimateDelayTime = Number(toAnimateDelay) + 750;
                            } else {
                                toAnimateDelayTime = 750;
                            }
                            if (!$toAnimateElement.hasClass('animated')) {
                                $toAnimateElement.addClass('not-animated');
                                var elementAnimation = $toAnimateElement.attr('data-caption-animate');
                                setTimeout(function () {
                                    $toAnimateElement.removeClass('not-animated').addClass(elementAnimation + ' animated');
                                }, toAnimateDelayTime);
                            }
                        });
                        $('[data-caption-animate]').each(function () {
                            var $toAnimateElement = $(this),
                                elementAnimation = $toAnimateElement.attr('data-caption-animate');
                            if ($toAnimateElement.parents('.swiper-slide').hasClass('swiper-slide-active')) {
                                return true;
                            }
                            $toAnimateElement.removeClass('animated').removeClass(elementAnimation).addClass('not-animated');
                        });
                        SEMICOLON.slider.swiperSliderMenu();
                    },
                    onSlideChangeStart: function (swiper) {
                        if (slideNumberCurrent.length > 0) {
                            if (elementLoop == true) {
                                slideNumberCurrent.html(Number(element.find('.swiper-slide.swiper-slide-active').attr('data-swiper-slide-index')) + 1);
                            } else {
                                slideNumberCurrent.html(swiperSlider.activeIndex + 1);
                            }
                        }
                        $('[data-caption-animate]').each(function () {
                            var $toAnimateElement = $(this),
                                elementAnimation = $toAnimateElement.attr('data-caption-animate');
                            if ($toAnimateElement.parents('.swiper-slide').hasClass('swiper-slide-active')) {
                                return true;
                            }
                            $toAnimateElement.removeClass('animated').removeClass(elementAnimation).addClass('not-animated');
                        });
                        SEMICOLON.slider.swiperSliderMenu();
                    },
                    onSlideChangeEnd: function (swiper) {
                        element.find('.swiper-slide').each(function () {
                            var slideEl = $(this);
                            if (slideEl.find('video').length > 0 && sliderVideoAutoPlay == true) {
                                slideEl.find('video').get(0).pause();
                            }
                            if (slideEl.find('.yt-bg-player.mb_YTPlayer:not(.customjs)').length > 0) {
                                slideEl.find('.yt-bg-player.mb_YTPlayer:not(.customjs)').YTPPause();
                            }
                        });
                        element.find('.swiper-slide:not(".swiper-slide-active")').each(function () {
                            var slideEl = $(this);
                            if (slideEl.find('video').length > 0) {
                                if (slideEl.find('video').get(0).currentTime != 0) {
                                    slideEl.find('video').get(0).currentTime = 0;
                                }
                            }
                            if (slideEl.find('.yt-bg-player.mb_YTPlayer:not(.customjs)').length > 0) {
                                slideEl.find('.yt-bg-player.mb_YTPlayer:not(.customjs)').YTPGetPlayer().seekTo(slideEl.find('.yt-bg-player.mb_YTPlayer:not(.customjs)').attr('data-start'));
                            }
                        });
                        if (element.find('.swiper-slide.swiper-slide-active').find('video').length > 0 && sliderVideoAutoPlay == true) {
                            element.find('.swiper-slide.swiper-slide-active').find('video').get(0).play();
                        }
                        if (element.find('.swiper-slide.swiper-slide-active').find('.yt-bg-player.mb_YTPlayer:not(.customjs)').length > 0 && sliderVideoAutoPlay == true) {
                            element.find('.swiper-slide.swiper-slide-active').find('.yt-bg-player.mb_YTPlayer:not(.customjs)').YTPPlay();
                        }

                        element.find('.swiper-slide.swiper-slide-active [data-caption-animate]').each(function () {
                            var $toAnimateElement = $(this),
                                toAnimateDelay = $toAnimateElement.attr('data-caption-delay'),
                                toAnimateDelayTime = 0;
                            if (toAnimateDelay) {
                                toAnimateDelayTime = Number(toAnimateDelay) + 300;
                            } else {
                                toAnimateDelayTime = 300;
                            }
                            if (!$toAnimateElement.hasClass('animated')) {
                                $toAnimateElement.addClass('not-animated');
                                var elementAnimation = $toAnimateElement.attr('data-caption-animate');
                                setTimeout(function () {
                                    $toAnimateElement.removeClass('not-animated').addClass(elementAnimation + ' animated');
                                }, toAnimateDelayTime);
                            }
                        });
                    }
                });

                if (slideNumberCurrent.length > 0) {
                    if (elementLoop == true) {
                        slideNumberCurrent.html(Number(element.find('.swiper-slide.swiper-slide-active').attr('data-swiper-slide-index')) + 1);
                    } else {
                        slideNumberCurrent.html(swiperSlider.activeIndex + 1);
                    }
                }
                if (slideNumberTotal.length > 0) {
                    slideNumberTotal.html(element.find('.swiper-slide:not(.swiper-slide-duplicate)').length);
                }

            }
        },

        sliderParallaxOffset: function () {
            var sliderParallaxOffsetTop = 0;
            var headerHeight = $header.outerHeight();
            if ($body.hasClass('side-header') || $header.hasClass('transparent-header')) {
                headerHeight = 0;
            }
            if ($pageTitle.length > 0) {
                var pageTitleHeight = $pageTitle.outerHeight();
                sliderParallaxOffsetTop = pageTitleHeight + headerHeight;
            } else {
                sliderParallaxOffsetTop = headerHeight;
            }

            if ($slider.next('#header').length > 0) {
                sliderParallaxOffsetTop = 0;
            }

            return sliderParallaxOffsetTop;
        },

        sliderParallax: function () {

            if ($sliderParallaxEl.length < 1) {
                return true;
            }

            var parallaxOffsetTop = SEMICOLON.slider.sliderParallaxOffset(),
                parallaxElHeight = $sliderParallaxEl.outerHeight();

            if (($body.hasClass('device-lg') || $body.hasClass('device-md')) && !SEMICOLON.isMobile.any()) {
//if($body.hasClass('device-lg') || $body.hasClass('device-md') || $body.hasClass('device-xxs')) {
                if ((parallaxElHeight + parallaxOffsetTop + 50) > $window.scrollTop()) {
                    $sliderParallaxEl.addClass('slider-parallax-visible').removeClass('slider-parallax-invisible');
                    if ($window.scrollTop() > parallaxOffsetTop) {
                        if ($sliderParallaxEl.find('.slider-parallax-inner').length > 0) {
                            var tranformAmount = (($window.scrollTop() - parallaxOffsetTop) * -.4).toFixed(0),
                                tranformAmount2 = (($window.scrollTop() - parallaxOffsetTop) * -.15).toFixed(0);
                            $sliderParallaxEl.find('.slider-parallax-inner').css({'transform': 'translateY(' + tranformAmount + 'px)'});
                            $('.slider-parallax .slider-caption,.ei-title').css({'transform': 'translateY(' + tranformAmount2 + 'px)'});
                        } else {
                            var tranformAmount = (($window.scrollTop() - parallaxOffsetTop) / 1.5).toFixed(0),
                                tranformAmount2 = (($window.scrollTop() - parallaxOffsetTop) / 7).toFixed(0);
                            $sliderParallaxEl.css({'transform': 'translateY(' + tranformAmount + 'px)'});
                            $('.slider-parallax .slider-caption,.ei-title').css({'transform': 'translateY(' + -tranformAmount2 + 'px)'});
                        }
                    } else {
                        if ($sliderParallaxEl.find('.slider-parallax-inner').length > 0) {
                            $('.slider-parallax-inner,.slider-parallax .slider-caption,.ei-title').css({'transform': 'translateY(0px)'});
                        } else {
                            $('.slider-parallax,.slider-parallax .slider-caption,.ei-title').css({'transform': 'translateY(0px)'});
                        }
                    }
                } else {
                    $sliderParallaxEl.addClass('slider-parallax-invisible').removeClass('slider-parallax-visible');
                }
                if (requesting) {
                    requestAnimationFrame(function () {
                        SEMICOLON.slider.sliderParallax();
                        SEMICOLON.slider.sliderElementsFade();
                    });
                }
            } else {
                if ($sliderParallaxEl.find('.slider-parallax-inner').length > 0) {
                    $('.slider-parallax-inner,.slider-parallax .slider-caption,.ei-title').css({'transform': 'translateY(0px)'});
                } else {
                    $('.slider-parallax,.slider-parallax .slider-caption,.ei-title').css({'transform': 'translateY(0px)'});
                }
            }
        },

        sliderElementsFade: function () {

            if ($sliderParallaxEl.length > 0) {
                if (($body.hasClass('device-lg') || $body.hasClass('device-md')) && !SEMICOLON.isMobile.any()) {
                    //if($body.hasClass('device-lg') || $body.hasClass('device-md') || $body.hasClass('device-xxs')) {
                    var parallaxOffsetTop = SEMICOLON.slider.sliderParallaxOffset(),
                        parallaxElHeight = $sliderParallaxEl.outerHeight();
                    if ($slider.length > 0) {
                        if ($header.hasClass('transparent-header') || $('body').hasClass('side-header')) {
                            var tHeaderOffset = 100;
                        } else {
                            var tHeaderOffset = 0;
                        }
                        $sliderParallaxEl.find('#slider-arrow-left,#slider-arrow-right,.vertical-middle:not(.no-fade),.slider-caption,.ei-title,.camera_prev,.camera_next').css({'opacity': 1 - ((($window.scrollTop() - tHeaderOffset) * 1.85) / parallaxElHeight)});
                    }
                } else {
                    $sliderParallaxEl.find('#slider-arrow-left,#slider-arrow-right,.vertical-middle:not(.no-fade),.slider-caption,.ei-title,.camera_prev,.camera_next').css({'opacity': 1});
                }
            }
        },

        captionPosition: function () {
            $slider.find('.slider-caption:not(.custom-caption-pos)').each(function () {
                var scapHeight = $(this).outerHeight();
                var scapSliderHeight = $slider.outerHeight();
                if ($(this).parents('#slider').prev('#header').hasClass('transparent-header') && ($body.hasClass('device-lg') || $body.hasClass('device-md'))) {
                    if ($(this).parents('#slider').prev('#header').hasClass('floating-header')) {
                        $(this).css({top: (scapSliderHeight + 160 - scapHeight) / 2 + 'px'});
                    } else {
                        $(this).css({top: (scapSliderHeight + 100 - scapHeight) / 2 + 'px'});
                    }
                } else {
                    $(this).css({top: (scapSliderHeight - scapHeight) / 2 + 'px'});
                }
            });
        },

        swiperSliderMenu: function (onWinLoad) {
            onWinLoad = typeof onWinLoad !== 'undefined' ? onWinLoad : false;
            if ($body.hasClass('device-lg') || $body.hasClass('device-md')) {
                var activeSlide = $slider.find('.swiper-slide.swiper-slide-active');
                SEMICOLON.slider.headerSchemeChanger(activeSlide, onWinLoad);
            }
        },

        revolutionSliderMenu: function (onWinLoad) {
            onWinLoad = typeof onWinLoad !== 'undefined' ? onWinLoad : false;
            if ($body.hasClass('device-lg') || $body.hasClass('device-md')) {
                var activeSlide = $slider.find('.active-revslide');
                SEMICOLON.slider.headerSchemeChanger(activeSlide, onWinLoad);
            }
        },

        headerSchemeChanger: function (activeSlide, onWinLoad) {
            if (activeSlide.length > 0) {
                var darkExists = false;
                if (activeSlide.hasClass('dark')) {
                    if (oldHeaderClasses) {
                        var oldClassesArray = oldHeaderClasses.split(/ +/);
                    } else {
                        var oldClassesArray = '';
                    }
                    var noOfOldClasses = oldClassesArray.length;

                    if (noOfOldClasses > 0) {
                        var i = 0;
                        for (i = 0; i < noOfOldClasses; i++) {
                            if (oldClassesArray[i] == 'dark' && onWinLoad == true) {
                                darkExists = true;
                                break;
                            }
                        }
                    }
                    $('#header.transparent-header:not(.sticky-header,.semi-transparent,.floating-header)').addClass('dark');
                    if (!darkExists) {
                        $('#header.transparent-header.sticky-header,#header.transparent-header.semi-transparent.sticky-header,#header.transparent-header.floating-header.sticky-header').removeClass('dark');
                    }
                    $headerWrap.removeClass('not-dark');
                } else {
                    if ($body.hasClass('dark')) {
                        activeSlide.addClass('not-dark');
                        $('#header.transparent-header:not(.semi-transparent,.floating-header)').removeClass('dark');
                        $('#header.transparent-header:not(.sticky-header,.semi-transparent,.floating-header)').find('#header-wrap').addClass('not-dark');
                    } else {
                        $('#header.transparent-header:not(.semi-transparent,.floating-header)').removeClass('dark');
                        $headerWrap.removeClass('not-dark');
                    }
                }
                if ($header.hasClass('sticky-header')) {
                    SEMICOLON.header.stickyMenuClass();
                }
                SEMICOLON.header.logo();
            }
        },

        owlCaptionInit: function () {
            if ($owlCarouselEl.length > 0) {
                $owlCarouselEl.each(function () {
                    var element = $(this);
                    if (element.find('.owl-dot').length > 0) {
                        element.addClass('with-carousel-dots');
                    }
                });
            }
        }

    };

    SEMICOLON.portfolio = {

        init: function () {

            SEMICOLON.portfolio.ajaxload();

        },

        gridInit: function ($container) {

            if (!$().isotope) {
                console.log('gridInit: Isotope not Defined.');
                return true;
            }

            if ($container.length < 1) {
                return true;
            }
            if ($container.hasClass('customjs')) {
                return true;
            }

            $container.each(function () {
                var element = $(this),
                    elementTransition = element.attr('data-transition'),
                    elementLayoutMode = element.attr('data-layout'),
                    elementStagger = element.attr('data-stagger');

                if (!elementTransition) {
                    elementTransition = '0.65s';
                }
                if (!elementLayoutMode) {
                    elementLayoutMode = 'masonry';
                }
                if (!elementStagger) {
                    elementStagger = 0;
                }

                setTimeout(function () {
                    if (element.hasClass('portfolio')) {
                        element.isotope({
                            layoutMode: elementLayoutMode,
                            transitionDuration: elementTransition,
                            stagger: Number(elementStagger),
                            masonry: {
                                columnWidth: element.find('.portfolio-item:not(.wide)')[0]
                            }
                        });
                    } else {
                        element.isotope({
                            layoutMode: elementLayoutMode,
                            transitionDuration: elementTransition
                        });
                    }
                }, 300);
            });
        },

        filterInit: function () {

            if (!$().isotope) {
                console.log('filterInit: Isotope not Defined.');
                return true;
            }

            if ($portfolioFilter.length < 1) {
                return true;
            }
            if ($portfolioFilter.hasClass('customjs')) {
                return true;
            }

            $portfolioFilter.each(function () {
                var element = $(this),
                    elementContainer = element.attr('data-container'),
                    elementActiveClass = element.attr('data-active-class'),
                    elementDefaultFilter = element.attr('data-default');

                if (!elementActiveClass) {
                    elementActiveClass = 'activeFilter';
                }

                element.find('a').click(function () {
                    element.find('li').removeClass(elementActiveClass);
                    $(this).parent('li').addClass(elementActiveClass);
                    var selector = $(this).attr('data-filter');
                    $(elementContainer).isotope({filter: selector});
                    return false;
                });

                if (elementDefaultFilter) {
                    element.find('li').removeClass(elementActiveClass);
                    element.find('[data-filter="' + elementDefaultFilter + '"]').parent('li').addClass(elementActiveClass);
                    $(elementContainer).isotope({filter: elementDefaultFilter});
                }
            });
        },

        shuffleInit: function () {

            if (!$().isotope) {
                console.log('shuffleInit: Isotope not Defined.');
                return true;
            }

            if ($('.portfolio-shuffle').length < 1) {
                return true;
            }

            $('.portfolio-shuffle').click(function () {
                var element = $(this),
                    elementContainer = element.attr('data-container');

                $(elementContainer).isotope('shuffle');
            });
        },

        portfolioDescMargin: function () {
            var $portfolioOverlayEl = $('.portfolio-overlay');
            if ($portfolioOverlayEl.length > 0) {
                $portfolioOverlayEl.each(function () {
                    var element = $(this);
                    if (element.find('.portfolio-desc').length > 0) {
                        var portfolioOverlayHeight = element.outerHeight();
                        var portfolioOverlayDescHeight = element.find('.portfolio-desc').outerHeight();
                        if (element.find('a.left-icon').length > 0 || element.find('a.right-icon').length > 0 || element.find('a.center-icon').length > 0) {
                            var portfolioOverlayIconHeight = 40 + 20;
                        } else {
                            var portfolioOverlayIconHeight = 0;
                        }
                        var portfolioOverlayMiddleAlign = (portfolioOverlayHeight - portfolioOverlayDescHeight - portfolioOverlayIconHeight) / 2
                        element.find('.portfolio-desc').css({'margin-top': portfolioOverlayMiddleAlign});
                    }
                });
            }
        },

        arrange: function () {
            if ($portfolio.length > 0) {
                $portfolio.each(function () {
                    var element = $(this);
                    SEMICOLON.initialize.setFullColumnWidth(element);
                });
            }
        },

        ajaxload: function () {
            $('.portfolio-ajax .portfolio-item a.center-icon').click(function (e) {
                var portPostId = $(this).parents('.portfolio-item').attr('id');
                if (!$(this).parents('.portfolio-item').hasClass('portfolio-active')) {
                    SEMICOLON.portfolio.loadItem(portPostId, prevPostPortId);
                }
                e.preventDefault();
            });
        },

        newNextPrev: function (portPostId) {
            var portNext = SEMICOLON.portfolio.getNextItem(portPostId);
            var portPrev = SEMICOLON.portfolio.getPrevItem(portPostId);
            $('#next-portfolio').attr('data-id', portNext);
            $('#prev-portfolio').attr('data-id', portPrev);
        },

        loadItem: function (portPostId, prevPostPortId, getIt) {
            if (!getIt) {
                getIt = false;
            }
            var portNext = SEMICOLON.portfolio.getNextItem(portPostId);
            var portPrev = SEMICOLON.portfolio.getPrevItem(portPostId);
            if (getIt == false) {
                SEMICOLON.portfolio.closeItem();
                $portfolioAjaxLoader.fadeIn();
                var portfolioDataLoader = $('#' + portPostId).attr('data-loader');
                $portfolioDetailsContainer.load(portfolioDataLoader, {
                        portid: portPostId,
                        portnext: portNext,
                        portprev: portPrev
                    },
                    function () {
                        SEMICOLON.portfolio.initializeAjax(portPostId);
                        SEMICOLON.portfolio.openItem();
                        $portfolioItems.removeClass('portfolio-active');
                        $('#' + portPostId).addClass('portfolio-active');
                    });
            }
        },

        closeItem: function () {
            if ($portfolioDetails && $portfolioDetails.height() > 32) {
                $portfolioAjaxLoader.fadeIn();
                $portfolioDetails.find('#portfolio-ajax-single').fadeOut('600', function () {
                    $(this).remove();
                });
                $portfolioDetails.removeClass('portfolio-ajax-opened');
            }
        },

        openItem: function () {
            var noOfImages = $portfolioDetails.find('img').length;
            var noLoaded = 0;

            if (noOfImages > 0) {
                $portfolioDetails.find('img').on('load', function () {
                    noLoaded++;
                    var topOffsetScroll = SEMICOLON.initialize.topScrollOffset();
                    if (noOfImages === noLoaded) {
                        $portfolioDetailsContainer.css({'display': 'block'});
                        $portfolioDetails.addClass('portfolio-ajax-opened');
                        $portfolioAjaxLoader.fadeOut();
                        var t = setTimeout(function () {
                            SEMICOLON.widget.loadFlexSlider();
                            SEMICOLON.initialize.lightbox();
                            SEMICOLON.initialize.resizeVideos();
                            SEMICOLON.widget.masonryThumbs();
                            $('html,body').stop(true).animate({
                                'scrollTop': $portfolioDetails.offset().top - topOffsetScroll
                            }, 900, 'easeOutQuad');
                        }, 500);
                    }
                });
            } else {
                var topOffsetScroll = SEMICOLON.initialize.topScrollOffset();
                $portfolioDetailsContainer.css({'display': 'block'});
                $portfolioDetails.addClass('portfolio-ajax-opened');
                $portfolioAjaxLoader.fadeOut();
                var t = setTimeout(function () {
                    SEMICOLON.widget.loadFlexSlider();
                    SEMICOLON.initialize.lightbox();
                    SEMICOLON.initialize.resizeVideos();
                    SEMICOLON.widget.masonryThumbs();
                    $('html,body').stop(true).animate({
                        'scrollTop': $portfolioDetails.offset().top - topOffsetScroll
                    }, 900, 'easeOutQuad');
                }, 500);
            }
        },

        getNextItem: function (portPostId) {
            var portNext = '';
            var hasNext = $('#' + portPostId).next();
            if (hasNext.length != 0) {
                portNext = hasNext.attr('id');
            }
            return portNext;
        },

        getPrevItem: function (portPostId) {
            var portPrev = '';
            var hasPrev = $('#' + portPostId).prev();
            if (hasPrev.length != 0) {
                portPrev = hasPrev.attr('id');
            }
            return portPrev;
        },

        initializeAjax: function (portPostId) {
            prevPostPortId = $('#' + portPostId);

            $('#next-portfolio, #prev-portfolio').click(function () {
                var portPostId = $(this).attr('data-id');
                $portfolioItems.removeClass('portfolio-active');
                $('#' + portPostId).addClass('portfolio-active');
                SEMICOLON.portfolio.loadItem(portPostId, prevPostPortId);
                return false;
            });

            $('#close-portfolio').click(function () {
                $portfolioDetailsContainer.fadeOut('600', function () {
                    $portfolioDetails.find('#portfolio-ajax-single').remove();
                });
                $portfolioDetails.removeClass('portfolio-ajax-opened');
                $portfolioItems.removeClass('portfolio-active');
                return false;
            });
        }

    };

    SEMICOLON.widget = {

        init: function () {

            SEMICOLON.widget.animations();
            SEMICOLON.widget.youtubeBgVideo();
            SEMICOLON.widget.tabs();
            SEMICOLON.widget.tabsJustify();
            SEMICOLON.widget.tabsResponsive();
            SEMICOLON.widget.tabsResponsiveResize();
            SEMICOLON.widget.toggles();
            SEMICOLON.widget.accordions();
            SEMICOLON.widget.counter();
            SEMICOLON.widget.roundedSkill();
            SEMICOLON.widget.progress();
            SEMICOLON.widget.twitterFeed();
            SEMICOLON.widget.flickrFeed();
            SEMICOLON.widget.instagramPhotos('36286274.b9e559e.4824cbc1d0c94c23827dc4a2267a9f6b', 'b9e559ec7c284375bf41e9a9fb72ae01');
            SEMICOLON.widget.dribbbleShots('01530280af335d298e756ed8ef786c8c4e92a50b88e53a185531b1a639e768b8');
            SEMICOLON.widget.navTree();
            SEMICOLON.widget.textRotater();
            SEMICOLON.widget.carousel();
            SEMICOLON.widget.linkScroll();
            SEMICOLON.widget.contactForm();
            SEMICOLON.widget.subscription();
            SEMICOLON.widget.quickContact();
            SEMICOLON.widget.cookieNotify();
            SEMICOLON.widget.extras();

        },

        parallax: function () {

            if (!$.stellar) {
                console.log('parallax: Stellar not Defined.');
                return true;
            }

            if ($parallaxEl.length > 0 || $parallaxPageTitleEl.length > 0 || $parallaxPortfolioEl.length > 0) {
                if (!SEMICOLON.isMobile.any()) {
                    $.stellar({
                        horizontalScrolling: false,
                        verticalOffset: 150
                    });
                } else {
                    $parallaxEl.addClass('mobile-parallax');
                    $parallaxPageTitleEl.addClass('mobile-parallax');
                    $parallaxPortfolioEl.addClass('mobile-parallax');
                }
            }
        },

        animations: function () {

            if (!$().appear) {
                console.log('animations: Appear not Defined.');
                return true;
            }

            var $dataAnimateEl = $('[data-animate]');
            if ($dataAnimateEl.length > 0) {
                if ($body.hasClass('device-lg') || $body.hasClass('device-md') || $body.hasClass('device-sm')) {
                    $dataAnimateEl.each(function () {
                        var element = $(this),
                            animationOut = element.attr('data-animate-out'),
                            animationDelay = element.attr('data-delay'),
                            animationDelayOut = element.attr('data-delay-out'),
                            animationDelayTime = 0,
                            animationDelayOutTime = 3000;

                        if (element.parents('.fslider.no-thumbs-animate').length > 0) {
                            return true;
                        }

                        if (animationDelay) {
                            animationDelayTime = Number(animationDelay) + 500;
                        } else {
                            animationDelayTime = 500;
                        }
                        if (animationOut && animationDelayOut) {
                            animationDelayOutTime = Number(animationDelayOut) + animationDelayTime;
                        }

                        if (!element.hasClass('animated')) {
                            element.addClass('not-animated');
                            var elementAnimation = element.attr('data-animate');
                            element.appear(function () {
                                setTimeout(function () {
                                    element.removeClass('not-animated').addClass(elementAnimation + ' animated');
                                }, animationDelayTime);

                                if (animationOut) {
                                    setTimeout(function () {
                                        element.removeClass(elementAnimation).addClass(animationOut);
                                    }, animationDelayOutTime);
                                }
                            }, {accX: 0, accY: -120}, 'easeInCubic');
                        }
                    });
                }
            }
        },

        loadFlexSlider: function () {

            if (!$().flexslider) {
                console.log('loadFlexSlider: FlexSlider not Defined.');
                return true;
            }

            var $flexSliderEl = $('.fslider:not(.customjs)').find('.flexslider');
            if ($flexSliderEl.length > 0) {
                $flexSliderEl.each(function () {
                    var $flexsSlider = $(this),
                        flexsAnimation = $flexsSlider.parent('.fslider').attr('data-animation'),
                        flexsEasing = $flexsSlider.parent('.fslider').attr('data-easing'),
                        flexsDirection = $flexsSlider.parent('.fslider').attr('data-direction'),
                        flexsReverse = $flexsSlider.parent('.fslider').attr('data-reverse'),
                        flexsSlideshow = $flexsSlider.parent('.fslider').attr('data-slideshow'),
                        flexsPause = $flexsSlider.parent('.fslider').attr('data-pause'),
                        flexsSpeed = $flexsSlider.parent('.fslider').attr('data-speed'),
                        flexsVideo = $flexsSlider.parent('.fslider').attr('data-video'),
                        flexsPagi = $flexsSlider.parent('.fslider').attr('data-pagi'),
                        flexsArrows = $flexsSlider.parent('.fslider').attr('data-arrows'),
                        flexsThumbs = $flexsSlider.parent('.fslider').attr('data-thumbs'),
                        flexsHover = $flexsSlider.parent('.fslider').attr('data-hover'),
                        flexsSheight = $flexsSlider.parent('.fslider').attr('data-smooth-height'),
                        flexsTouch = $flexsSlider.parent('.fslider').attr('data-touch'),
                        flexsUseCSS = false;

                    if (!flexsAnimation) {
                        flexsAnimation = 'slide';
                    }
                    if (!flexsEasing || flexsEasing == 'swing') {
                        flexsEasing = 'swing';
                        flexsUseCSS = true;
                    }
                    if (!flexsDirection) {
                        flexsDirection = 'horizontal';
                    }
                    if (flexsReverse == 'true') {
                        flexsReverse = true;
                    } else {
                        flexsReverse = false;
                    }
                    if (!flexsSlideshow) {
                        flexsSlideshow = true;
                    } else {
                        flexsSlideshow = false;
                    }
                    if (!flexsPause) {
                        flexsPause = 5000;
                    }
                    if (!flexsSpeed) {
                        flexsSpeed = 600;
                    }
                    if (!flexsVideo) {
                        flexsVideo = false;
                    }
                    if (flexsSheight == 'false') {
                        flexsSheight = false;
                    } else {
                        flexsSheight = true;
                    }
                    if (flexsDirection == 'vertical') {
                        flexsSheight = false;
                    }
                    if (flexsPagi == 'false') {
                        flexsPagi = false;
                    } else {
                        flexsPagi = true;
                    }
                    if (flexsThumbs == 'true') {
                        flexsPagi = 'thumbnails';
                    } else {
                        flexsPagi = flexsPagi;
                    }
                    if (flexsArrows == 'false') {
                        flexsArrows = false;
                    } else {
                        flexsArrows = true;
                    }
                    if (flexsHover == 'false') {
                        flexsHover = false;
                    } else {
                        flexsHover = true;
                    }
                    if (flexsTouch == 'false') {
                        flexsTouch = false;
                    } else {
                        flexsTouch = true;
                    }

                    $flexsSlider.flexslider({
                        selector: ".slider-wrap > .slide",
                        animation: flexsAnimation,
                        easing: flexsEasing,
                        direction: flexsDirection,
                        reverse: flexsReverse,
                        slideshow: flexsSlideshow,
                        slideshowSpeed: Number(flexsPause),
                        animationSpeed: Number(flexsSpeed),
                        pauseOnHover: flexsHover,
                        video: flexsVideo,
                        controlNav: flexsPagi,
                        directionNav: flexsArrows,
                        smoothHeight: flexsSheight,
                        useCSS: flexsUseCSS,
                        touch: flexsTouch,
                        start: function (slider) {
                            SEMICOLON.widget.animations();
                            SEMICOLON.initialize.verticalMiddle();
                            slider.parent().removeClass('preloader2');
                            var t = setTimeout(function () {
                                $('.grid-container').isotope('layout');
                            }, 1200);
                            SEMICOLON.initialize.lightbox();
                            $('.flex-prev').html('<i class="icon-angle-left"></i>');
                            $('.flex-next').html('<i class="icon-angle-right"></i>');
                            SEMICOLON.portfolio.portfolioDescMargin();
                        },
                        after: function () {
                            if ($('.grid-container').hasClass('portfolio-full')) {
                                $('.grid-container.portfolio-full').isotope('layout');
                                SEMICOLON.portfolio.portfolioDescMargin();
                            }
                        }
                    });
                });
            }
        },

        html5Video: function () {
            var videoEl = $('.video-wrap:has(video)');
            if (videoEl.length > 0) {
                videoEl.each(function () {
                    var element = $(this),
                        elementVideo = element.find('video'),
                        outerContainerWidth = element.outerWidth(),
                        outerContainerHeight = element.outerHeight(),
                        innerVideoWidth = elementVideo.outerWidth(),
                        innerVideoHeight = elementVideo.outerHeight();

                    if (innerVideoHeight < outerContainerHeight) {
                        var videoAspectRatio = innerVideoWidth / innerVideoHeight,
                            newVideoWidth = outerContainerHeight * videoAspectRatio,
                            innerVideoPosition = (newVideoWidth - outerContainerWidth) / 2;
                        elementVideo.css({
                            'width': newVideoWidth + 'px',
                            'height': outerContainerHeight + 'px',
                            'left': -innerVideoPosition + 'px'
                        });
                    } else {
                        var innerVideoPosition = (innerVideoHeight - outerContainerHeight) / 2;
                        elementVideo.css({
                            'width': innerVideoWidth + 'px',
                            'height': innerVideoHeight + 'px',
                            'top': -innerVideoPosition + 'px'
                        });
                    }

                    if (SEMICOLON.isMobile.any()) {
                        var placeholderImg = elementVideo.attr('poster');

                        if (placeholderImg != '') {
                            element.append('<div class="video-placeholder" style="background-image: url(' + placeholderImg + ');"></div>')
                        }
                    }
                });
            }
        },

        youtubeBgVideo: function () {

            if (!$().mb_YTPlayer) {
                console.log('youtubeBgVideo: YoutubeBG Plugin not Defined.');
                return true;
            }

            var $youtubeBgPlayerEl = $('.yt-bg-player');
            if ($youtubeBgPlayerEl.hasClass('customjs')) {
                return true;
            }

            if ($youtubeBgPlayerEl.length > 0) {
                $youtubeBgPlayerEl.each(function () {
                    var element = $(this),
                        ytbgVideo = element.attr('data-video'),
                        ytbgMute = element.attr('data-mute'),
                        ytbgRatio = element.attr('data-ratio'),
                        ytbgQuality = element.attr('data-quality'),
                        ytbgOpacity = element.attr('data-opacity'),
                        ytbgContainer = element.attr('data-container'),
                        ytbgOptimize = element.attr('data-optimize'),
                        ytbgLoop = element.attr('data-loop'),
                        ytbgVolume = element.attr('data-volume'),
                        ytbgStart = element.attr('data-start'),
                        ytbgStop = element.attr('data-stop'),
                        ytbgAutoPlay = element.attr('data-autoplay'),
                        ytbgFullScreen = element.attr('data-fullscreen');

                    if (ytbgMute == 'false') {
                        ytbgMute = false;
                    } else {
                        ytbgMute = true;
                    }
                    if (!ytbgRatio) {
                        ytbgRatio = '16/9';
                    }
                    if (!ytbgQuality) {
                        ytbgQuality = 'hd720';
                    }
                    if (!ytbgOpacity) {
                        ytbgOpacity = 1;
                    }
                    if (!ytbgContainer) {
                        ytbgContainer = 'self';
                    }
                    if (ytbgOptimize == 'false') {
                        ytbgOptimize = false;
                    } else {
                        ytbgOptimize = true;
                    }
                    if (ytbgLoop == 'false') {
                        ytbgLoop = false;
                    } else {
                        ytbgLoop = true;
                    }
                    if (!ytbgVolume) {
                        ytbgVolume = 1;
                    }
                    if (!ytbgStart) {
                        ytbgStart = 0;
                    }
                    if (!ytbgStop) {
                        ytbgStop = 0;
                    }
                    if (ytbgAutoPlay == 'false') {
                        ytbgAutoPlay = false;
                    } else {
                        ytbgAutoPlay = true;
                    }
                    if (ytbgFullScreen == 'true') {
                        ytbgFullScreen = true;
                    } else {
                        ytbgFullScreen = false;
                    }

                    element.mb_YTPlayer({
                        videoURL: ytbgVideo,
                        mute: ytbgMute,
                        ratio: ytbgRatio,
                        quality: ytbgQuality,
                        opacity: Number(ytbgOpacity),
                        containment: ytbgContainer,
                        optimizeDisplay: ytbgOptimize,
                        loop: ytbgLoop,
                        vol: Number(ytbgVolume),
                        startAt: Number(ytbgStart),
                        stopAt: Number(ytbgStop),
                        autoplay: ytbgAutoPlay,
                        realfullscreen: ytbgFullScreen,
                        showYTLogo: false,
                        showControls: false
                    });
                });
            }
        },

        tabs: function () {

            if (!$().tabs) {
                console.log('tabs: Tabs not Defined.');
                return true;
            }

            var $tabs = $('.tabs:not(.customjs)');
            if ($tabs.length > 0) {
                $tabs.each(function () {
                    var element = $(this),
                        elementSpeed = element.attr('data-speed'),
                        tabActive = element.attr('data-active');

                    if (!elementSpeed) {
                        elementSpeed = 400;
                    }
                    if (!tabActive) {
                        tabActive = 0;
                    } else {
                        tabActive = tabActive - 1;
                    }

                    element.tabs({
                        active: Number(tabActive),
                        show: {
                            effect: "fade",
                            duration: Number(elementSpeed)
                        }
                    });
                });
            }
        },

        tabsJustify: function () {
            if (!$('body').hasClass('device-xxs') && !$('body').hasClass('device-xs')) {
                var $tabsJustify = $('.tabs.tabs-justify');
                if ($tabsJustify.length > 0) {
                    $tabsJustify.each(function () {
                        var element = $(this),
                            elementTabs = element.find('.tab-nav > li'),
                            elementTabsNo = elementTabs.length,
                            elementContainer = 0,
                            elementWidth = 0;

                        if (element.hasClass('tabs-bordered') || element.hasClass('tabs-bb')) {
                            elementContainer = element.find('.tab-nav').outerWidth();
                        } else {
                            if (element.find('tab-nav').hasClass('tab-nav2')) {
                                elementContainer = element.find('.tab-nav').outerWidth() - (elementTabsNo * 10);
                            } else {
                                elementContainer = element.find('.tab-nav').outerWidth() - 30;
                            }
                        }

                        elementWidth = Math.floor(elementContainer / elementTabsNo);
                        elementTabs.css({'width': elementWidth + 'px'});

                    });
                }
            } else {
                $('.tabs.tabs-justify').find('.tab-nav > li').css({'width': ''});
            }
        },

        tabsResponsive: function () {

            if (!$().tabs) {
                console.log('tabs: Tabs not Defined.');
                return true;
            }

            var $tabsResponsive = $('.tabs.tabs-responsive');
            if ($tabsResponsive.length < 1) {
                return true;
            }

            $tabsResponsive.each(function () {
                var element = $(this),
                    elementNav = $(this).find('.tab-nav'),
                    elementContent = $(this).find('.tab-container');

                elementNav.children('li').each(function () {
                    var navEl = $(this),
                        navElAnchor = navEl.children('a'),
                        navElTarget = navElAnchor.attr('href'),
                        navElContent = navElAnchor.html();

                    elementContent.find(navElTarget).before('<div class="acctitle hide"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>' + navElContent + '</div>');
                });
            });
        },

        tabsResponsiveResize: function () {

            if (!$().tabs) {
                console.log('tabs: Tabs not Defined.');
                return true;
            }

            var $tabsResponsive = $('.tabs.tabs-responsive');
            if ($tabsResponsive.length < 1) {
                return true;
            }

            $tabsResponsive.each(function () {
                var element = $(this),
                    elementAccStyle = element.attr('data-accordion-style');

                if ($('body').hasClass('device-xs') || $('body').hasClass('device-xxs')) {

                    element.find('.tab-nav').addClass('hide');
                    element.find('.tab-container').addClass('accordion ' + elementAccStyle + ' clearfix');
                    element.find('.tab-content').addClass('acc_content');
                    element.find('.acctitle').removeClass('hide');
                    SEMICOLON.widget.accordions();

                } else if ($('body').hasClass('device-sm') || $('body').hasClass('device-md') || $('body').hasClass('device-lg')) {

                    element.find('.tab-nav').removeClass('hide');
                    element.find('.tab-container').removeClass('accordion ' + elementAccStyle + ' clearfix');
                    element.find('.tab-content').removeClass('acc_content');
                    element.find('.acctitle').addClass('hide');
                    element.tabs("refresh");

                }
            });
        },

        toggles: function () {
            var $toggle = $('.toggle');
            if ($toggle.length > 0) {
                $toggle.each(function () {
                    var element = $(this),
                        elementState = element.attr('data-state');

                    if (elementState != 'open') {
                        element.children('.togglec').hide();
                    } else {
                        element.children('.togglet').addClass("toggleta");
                    }

                    element.children('.togglet').click(function () {
                        $(this).toggleClass('toggleta').next('.togglec').slideToggle(300);
                        return true;
                    });
                });
            }
        },

        accordions: function () {
            var $accordionEl = $('.accordion');
            if ($accordionEl.length > 0) {
                $accordionEl.each(function () {
                    var element = $(this),
                        elementState = element.attr('data-state'),
                        accordionActive = element.attr('data-active');

                    if (!accordionActive) {
                        accordionActive = 0;
                    } else {
                        accordionActive = accordionActive - 1;
                    }

                    element.find('.acc_content').hide();

                    if (elementState != 'closed') {
                        element.find('.acctitle:eq(' + Number(accordionActive) + ')').addClass('acctitlec').next().show();
                    }

                    element.find('.acctitle').click(function () {
                        if ($(this).next().is(':hidden')) {
                            element.find('.acctitle').removeClass('acctitlec').next().slideUp("normal");
                            $(this).toggleClass('acctitlec').next().slideDown("normal");
                        }
                        return false;
                    });
                });
            }
        },

        counter: function () {

            if (!$().appear) {
                console.log('counter: Appear not Defined.');
                return true;
            }

            if (!$().countTo) {
                console.log('counter: countTo not Defined.');
                return true;
            }

            var $counterEl = $('.counter:not(.counter-instant)');
            if ($counterEl.length > 0) {
                $counterEl.each(function () {
                    var element = $(this);
                    var counterElementComma = $(this).find('span').attr('data-comma');
                    if (!counterElementComma) {
                        counterElementComma = false;
                    } else {
                        counterElementComma = true;
                    }
                    if ($body.hasClass('device-lg') || $body.hasClass('device-md')) {
                        element.appear(function () {
                            SEMICOLON.widget.runCounter(element, counterElementComma);
                            if (element.parents('.common-height')) {
                                SEMICOLON.initialize.maxHeight();
                            }
                        }, {accX: 0, accY: -120}, 'easeInCubic');
                    } else {
                        SEMICOLON.widget.runCounter(element, counterElementComma);
                    }
                });
            }
        },

        runCounter: function (counterElement, counterElementComma) {
            if (counterElementComma == true) {
                counterElement.find('span').countTo({
                    formatter: function (value, options) {
                        value = value.toFixed(options.decimals);
                        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        return value;
                    }
                });
            } else {
                counterElement.find('span').countTo();
            }
        },

        roundedSkill: function () {

            if (!$().appear) {
                console.log('roundedSkill: Appear not Defined.');
                return true;
            }

            if (!$().easyPieChart) {
                console.log('roundedSkill: EasyPieChart not Defined.');
                return true;
            }

            var $roundedSkillEl = $('.rounded-skill');
            if ($roundedSkillEl.length > 0) {
                $roundedSkillEl.each(function () {
                    var element = $(this);

                    var roundSkillSize = element.attr('data-size');
                    var roundSkillSpeed = element.attr('data-speed');
                    var roundSkillWidth = element.attr('data-width');
                    var roundSkillColor = element.attr('data-color');
                    var roundSkillTrackColor = element.attr('data-trackcolor');

                    if (!roundSkillSize) {
                        roundSkillSize = 140;
                    }
                    if (!roundSkillSpeed) {
                        roundSkillSpeed = 2000;
                    }
                    if (!roundSkillWidth) {
                        roundSkillWidth = 8;
                    }
                    if (!roundSkillColor) {
                        roundSkillColor = '#0093BF';
                    }
                    if (!roundSkillTrackColor) {
                        roundSkillTrackColor = 'rgba(0,0,0,0.04)';
                    }

                    var properties = {
                        roundSkillSize: roundSkillSize,
                        roundSkillSpeed: roundSkillSpeed,
                        roundSkillWidth: roundSkillWidth,
                        roundSkillColor: roundSkillColor,
                        roundSkillTrackColor: roundSkillTrackColor
                    };

                    if ($body.hasClass('device-lg') || $body.hasClass('device-md')) {
                        element.css({
                            'width': roundSkillSize + 'px',
                            'height': roundSkillSize + 'px',
                            'line-height': roundSkillSize + 'px'
                        }).animate({opacity: 0}, 10);
                        element.appear(function () {
                            if (!element.hasClass('skills-animated')) {
                                var t = setTimeout(function () {
                                    element.css({opacity: 1});
                                }, 100);
                                SEMICOLON.widget.runRoundedSkills(element, properties);
                                element.addClass('skills-animated');
                            }
                        }, {accX: 0, accY: -120}, 'easeInCubic');
                    } else {
                        SEMICOLON.widget.runRoundedSkills(element, properties);
                    }
                });
            }
        },

        runRoundedSkills: function (element, properties) {
            element.easyPieChart({
                size: Number(properties.roundSkillSize),
                animate: Number(properties.roundSkillSpeed),
                scaleColor: false,
                trackColor: properties.roundSkillTrackColor,
                lineWidth: Number(properties.roundSkillWidth),
                lineCap: 'square',
                barColor: properties.roundSkillColor
            });
        },

        progress: function () {

            if (!$().appear) {
                console.log('progress: Appear not Defined.');
                return true;
            }

            var $progressEl = $('.progress');
            if ($progressEl.length > 0) {
                $progressEl.each(function () {
                    var element = $(this),
                        skillsBar = element.parent('li'),
                        skillValue = skillsBar.attr('data-percent');

                    if ($body.hasClass('device-lg') || $body.hasClass('device-md')) {
                        element.appear(function () {
                            if (!skillsBar.hasClass('skills-animated')) {
                                element.find('.counter-instant span').countTo();
                                skillsBar.find('.progress').css({width: skillValue + "%"}).addClass('skills-animated');
                            }
                        }, {accX: 0, accY: -120}, 'easeInCubic');
                    } else {
                        element.find('.counter-instant span').countTo();
                        skillsBar.find('.progress').css({width: skillValue + "%"});
                    }
                });
            }
        },

        twitterFeed: function () {

            if (typeof sm_format_twitter === 'undefined') {
                console.log('twitterFeed: sm_format_twitter() not Defined.');
                return true;
            }

            if (typeof sm_format_twitter3 === 'undefined') {
                console.log('twitterFeed: sm_format_twitter3() not Defined.');
                return true;
            }

            var $twitterFeedEl = $('.twitter-feed');
            if ($twitterFeedEl.length > 0) {
                $twitterFeedEl.each(function () {
                    var element = $(this),
                        twitterFeedUser = element.attr('data-username'),
                        twitterFeedCount = element.attr('data-count'),
                        twitterFeedLoader = element.attr('data-loader');

                    if (!twitterFeedUser) {
                        twitterFeedUser = 'twitter'
                    }
                    if (!twitterFeedCount) {
                        twitterFeedCount = 3
                    }
                    if (!twitterFeedLoader) {
                        twitterFeedLoader = 'include/twitter/tweets.php';
                    }

                    $.getJSON(twitterFeedLoader + '?username=' + twitterFeedUser + '&count=' + twitterFeedCount, function (tweets) {
                        if (element.hasClass('fslider')) {
                            element.find(".slider-wrap").html(sm_format_twitter3(tweets)).promise().done(function () {
                                var timer = setInterval(function () {
                                    if (element.find('.slide').length > 1) {
                                        element.removeClass('customjs');
                                        var t = setTimeout(function () {
                                            SEMICOLON.widget.loadFlexSlider();
                                        }, 500);
                                        clearInterval(timer);
                                    }
                                }, 500);
                            });
                        } else {
                            element.html(sm_format_twitter(tweets));
                        }
                    });
                });
            }
        },

        flickrFeed: function () {

            if (!$().jflickrfeed) {
                console.log('flickrFeed: jflickrfeed not Defined.');
                return true;
            }

            var $flickrFeedEl = $('.flickr-feed');
            if ($flickrFeedEl.length > 0) {
                $flickrFeedEl.each(function () {
                    var element = $(this),
                        flickrFeedID = element.attr('data-id'),
                        flickrFeedCount = element.attr('data-count'),
                        flickrFeedType = element.attr('data-type'),
                        flickrFeedTypeGet = 'photos_public.gne';

                    if (flickrFeedType == 'group') {
                        flickrFeedTypeGet = 'groups_pool.gne';
                    }
                    if (!flickrFeedCount) {
                        flickrFeedCount = 9;
                    }

                    element.jflickrfeed({
                        feedapi: flickrFeedTypeGet,
                        limit: Number(flickrFeedCount),
                        qstrings: {
                            id: flickrFeedID
                        },
                        itemTemplate: '<a href="" title="" data-lightbox="gallery-item">' +
                            '<img src="" alt="" />' +
                            '</a>'
                    }, function (data) {
                        SEMICOLON.initialize.lightbox();
                    });
                });
            }
        },

        instagramPhotos: function (c_accessToken, c_clientID) {

            if (typeof Instafeed === 'undefined') {
                console.log('Instafeed not Defined.');
                return true;
            }

            var $instagramPhotosEl = $('.instagram-photos');
            if ($instagramPhotosEl.length > 0) {

                $instagramPhotosEl.each(function () {
                    var element = $(this),
                        instaGramTarget = element.attr('id'),
                        instaGramUserId = element.attr('data-user'),
                        instaGramTag = element.attr('data-tag'),
                        instaGramLocation = element.attr('data-location'),
                        instaGramCount = element.attr('data-count'),
                        instaGramType = element.attr('data-type'),
                        instaGramSortBy = element.attr('data-sortBy'),
                        instaGramRes = element.attr('data-resolution');

                    if (!instaGramCount) {
                        instaGramCount = 9;
                    }
                    if (!instaGramSortBy) {
                        instaGramSortBy = 'none';
                    }
                    if (!instaGramRes) {
                        instaGramRes = 'thumbnail';
                    }

                    if (instaGramType == 'user') {

                        var feed = new Instafeed({
                            target: instaGramTarget,
                            get: instaGramType,
                            userId: Number(instaGramUserId),
                            limit: Number(instaGramCount),
                            sortBy: instaGramSortBy,
                            resolution: instaGramRes,
                            accessToken: c_accessToken,
                            clientId: c_clientID
                        });

                    } else if (instaGramType == 'tagged') {

                        var feed = new Instafeed({
                            target: instaGramTarget,
                            get: instaGramType,
                            tagName: instaGramTag,
                            limit: Number(instaGramCount),
                            sortBy: instaGramSortBy,
                            resolution: instaGramRes,
                            clientId: c_clientID
                        });

                    } else if (instaGramType == 'location') {

                        var feed = new Instafeed({
                            target: instaGramTarget,
                            get: instaGramType,
                            locationId: Number(instaGramUserId),
                            limit: Number(instaGramCount),
                            sortBy: instaGramSortBy,
                            resolution: instaGramRes,
                            clientId: c_clientID
                        });

                    } else {

                        var feed = new Instafeed({
                            target: instaGramTarget,
                            get: 'popular',
                            limit: Number(instaGramCount),
                            sortBy: instaGramSortBy,
                            resolution: instaGramRes,
                            clientId: c_clientID
                        });

                    }

                    feed.run();
                });
            }
        },

        dribbbleShots: function (c_accessToken) {

            if (!$.jribbble) {
                console.log('dribbbleShots: Jribbble not Defined.');
                return true;
            }

            if (!$().imagesLoaded) {
                console.log('dribbbleShots: imagesLoaded not Defined.');
                return true;
            }

            var $dribbbleShotsEl = $('.dribbble-shots');
            if ($dribbbleShotsEl.length > 0) {

                $.jribbble.setToken(c_accessToken);

                $dribbbleShotsEl.each(function () {
                    var element = $(this),
                        dribbbleUsername = element.attr('data-user'),
                        dribbbleCount = element.attr('data-count'),
                        dribbbleList = element.attr('data-list'),
                        dribbbleType = element.attr('data-type');

                    element.addClass('customjs');

                    if (!dribbbleCount) {
                        dribbbleCount = 9;
                    }

                    if (dribbbleType == 'user') {

                        $.jribbble.users(dribbbleUsername).shots({
                            'sort': 'recent',
                            'page': 1,
                            'per_page': Number(dribbbleCount)
                        }).then(function (res) {
                            var html = [];
                            res.forEach(function (shot) {
                                html.push('<a href="' + shot.html_url + '" target="_blank">');
                                html.push('<img src="' + shot.images.teaser + '" ');
                                html.push('alt="' + shot.title + '"></a>');
                            });
                            element.html(html.join(''));

                            element.imagesLoaded().done(function () {
                                element.removeClass('customjs');
                                SEMICOLON.widget.masonryThumbs();
                            });
                        });

                    } else if (dribbbleType == 'list') {

                        $.jribbble.shots(dribbbleList, {
                            'sort': 'recent',
                            'page': 1,
                            'per_page': Number(dribbbleCount)
                        }).then(function (res) {
                            var html = [];
                            res.forEach(function (shot) {
                                html.push('<a href="' + shot.html_url + '" target="_blank">');
                                html.push('<img src="' + shot.images.teaser + '" ');
                                html.push('alt="' + shot.title + '"></a>');
                            });
                            element.html(html.join(''));

                            element.imagesLoaded().done(function () {
                                element.removeClass('customjs');
                                SEMICOLON.widget.masonryThumbs();
                            });
                        });
                    }

                });
            }
        },

        navTree: function () {
            var $navTreeEl = $('.nav-tree');
            if ($navTreeEl.length > 0) {
                $navTreeEl.each(function () {
                    var element = $(this),
                        elementSpeed = element.attr('data-speed'),
                        elementEasing = element.attr('data-easing');

                    if (!elementSpeed) {
                        elementSpeed = 250;
                    }
                    if (!elementEasing) {
                        elementEasing = 'swing';
                    }

                    element.find('ul li:has(ul)').addClass('sub-menu');
                    element.find('ul li:has(ul) > a').append(' <i class="icon-angle-down"></i>');

                    if (element.hasClass('on-hover')) {
                        element.find('ul li:has(ul):not(.active)').hover(function (e) {
                            $(this).children('ul').stop(true, true).slideDown(Number(elementSpeed), elementEasing);
                        }, function () {
                            $(this).children('ul').delay(250).slideUp(Number(elementSpeed), elementEasing);
                        });
                    } else {
                        element.find('ul li:has(ul) > a').click(function (e) {
                            var childElement = $(this);
                            element.find('ul li').not(childElement.parents()).removeClass('active');
                            childElement.parent().children('ul').slideToggle(Number(elementSpeed), elementEasing, function () {
                                $(this).find('ul').hide();
                                $(this).find('li.active').removeClass('active');
                            });
                            element.find('ul li > ul').not(childElement.parent().children('ul')).not(childElement.parents('ul')).slideUp(Number(elementSpeed), elementEasing);
                            childElement.parent('li:has(ul)').toggleClass('active');
                            e.preventDefault();
                        });
                    }
                });
            }
        },

        carousel: function () {

            if (!$().owlCarousel) {
                console.log('carousel: Owl Carousel not Defined.');
                return true;
            }

            var $carousel = $('.carousel-widget:not(.customjs)');
            if ($carousel.length < 1) {
                return true;
            }

            $carousel.each(function () {
                var element = $(this),
                    elementItems = element.attr('data-items'),
                    elementItemsLg = element.attr('data-items-lg'),
                    elementItemsMd = element.attr('data-items-md'),
                    elementItemsSm = element.attr('data-items-sm'),
                    elementItemsXs = element.attr('data-items-xs'),
                    elementItemsXxs = element.attr('data-items-xxs'),
                    elementLoop = element.attr('data-loop'),
                    elementAutoPlay = element.attr('data-autoplay'),
                    elementSpeed = element.attr('data-speed'),
                    elementAnimateIn = element.attr('data-animate-in'),
                    elementAnimateOut = element.attr('data-animate-out'),
                    elementNav = element.attr('data-nav'),
                    elementPagi = element.attr('data-pagi'),
                    elementMargin = element.attr('data-margin'),
                    elementStage = element.attr('data-stage-padding'),
                    elementMerge = element.attr('data-merge'),
                    elementStart = element.attr('data-start'),
                    elementRewind = element.attr('data-rewind'),
                    elementSlideBy = element.attr('data-slideby'),
                    elementCenter = element.attr('data-center'),
                    elementLazy = element.attr('data-lazyload'),
                    elementVideo = element.attr('data-video'),
                    elementRTL = element.attr('data-rtl');

                if (!elementItems) {
                    elementItems = 4;
                }
                if (!elementItemsLg) {
                    elementItemsLg = Number(elementItems);
                }
                if (!elementItemsMd) {
                    elementItemsMd = Number(elementItemsLg);
                }
                if (!elementItemsSm) {
                    elementItemsSm = Number(elementItemsMd);
                }
                if (!elementItemsXs) {
                    elementItemsXs = Number(elementItemsSm);
                }
                if (!elementItemsXxs) {
                    elementItemsXxs = Number(elementItemsXs);
                }
                if (!elementSpeed) {
                    elementSpeed = 250;
                }
                if (!elementMargin) {
                    elementMargin = 20;
                }
                if (!elementStage) {
                    elementStage = 0;
                }
                if (!elementStart) {
                    elementStart = 0;
                }

                if (!elementSlideBy) {
                    elementSlideBy = 1;
                }
                if (elementSlideBy == 'page') {
                    elementSlideBy = 'page';
                } else {
                    elementSlideBy = Number(elementSlideBy);
                }

                if (elementLoop == 'true') {
                    elementLoop = true;
                } else {
                    elementLoop = false;
                }
                if (!elementAutoPlay) {
                    elementAutoPlay = false;
                    var elementAutoPlayTime = 0;
                } else {
                    var elementAutoPlayTime = Number(elementAutoPlay);
                    elementAutoPlay = true;
                }
                if (!elementAnimateIn) {
                    elementAnimateIn = false;
                }
                if (!elementAnimateOut) {
                    elementAnimateOut = false;
                }
                if (elementNav == 'false') {
                    elementNav = false;
                } else {
                    elementNav = true;
                }
                if (elementPagi == 'false') {
                    elementPagi = false;
                } else {
                    elementPagi = true;
                }
                if (elementRewind == 'true') {
                    elementRewind = true;
                } else {
                    elementRewind = false;
                }
                if (elementMerge == 'true') {
                    elementMerge = true;
                } else {
                    elementMerge = false;
                }
                if (elementCenter == 'true') {
                    elementCenter = true;
                } else {
                    elementCenter = false;
                }
                if (elementLazy == 'true') {
                    elementLazy = true;
                } else {
                    elementLazy = false;
                }
                if (elementVideo == 'true') {
                    elementVideo = true;
                } else {
                    elementVideo = false;
                }
                if (elementRTL == 'true' || $body.hasClass('rtl')) {
                    elementRTL = true;
                } else {
                    elementRTL = false;
                }

                element.owlCarousel({
                    margin: Number(elementMargin),
                    loop: elementLoop,
                    stagePadding: Number(elementStage),
                    merge: elementMerge,
                    startPosition: Number(elementStart),
                    rewind: elementRewind,
                    slideBy: elementSlideBy,
                    center: elementCenter,
                    lazyLoad: elementLazy,
                    nav: elementNav,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    autoplay: elementAutoPlay,
                    autoplayTimeout: elementAutoPlayTime,
                    autoplayHoverPause: true,
                    dots: elementPagi,
                    smartSpeed: Number(elementSpeed),
                    fluidSpeed: Number(elementSpeed),
                    video: elementVideo,
                    animateIn: elementAnimateIn,
                    animateOut: elementAnimateOut,
                    rtl: elementRTL,
                    responsive: {
                        0: {items: Number(elementItemsXxs)},
                        480: {items: Number(elementItemsXs)},
                        768: {items: Number(elementItemsSm)},
                        992: {items: Number(elementItemsMd)},
                        1200: {items: Number(elementItemsLg)}
                    },
                    onInitialized: function () {
                        SEMICOLON.slider.owlCaptionInit();
                        SEMICOLON.slider.sliderParallaxDimensions();
                        SEMICOLON.initialize.lightbox();
                    }
                });
            });
        },

        masonryThumbs: function () {
            var $masonryThumbsEl = $('.masonry-thumbs:not(.customjs)');
            if ($masonryThumbsEl.length > 0) {
                $masonryThumbsEl.each(function () {
                    var masonryItemContainer = $(this);
                    SEMICOLON.widget.masonryThumbsArrange(masonryItemContainer);
                });
            }
        },

        masonryThumbsArrange: function (element) {

            if (!$().isotope) {
                console.log('masonryThumbsArrange: Isotope not Defined.');
                return true;
            }

            SEMICOLON.initialize.setFullColumnWidth(element);
            element.isotope('layout');
        },

        notifications: function (element) {

            if (typeof toastr === 'undefined') {
                console.log('notifications: Toastr not Defined.');
                return true;
            }

            toastr.remove();
            var notifyElement = $(element),
                notifyPosition = notifyElement.attr('data-notify-position'),
                notifyType = notifyElement.attr('data-notify-type'),
                notifyMsg = notifyElement.attr('data-notify-msg'),
                notifyTimeout = notifyElement.attr('data-notify-timeout'),
                notifyCloseButton = notifyElement.attr('data-notify-close');

            if (!notifyPosition) {
                notifyPosition = 'toast-top-right';
            } else {
                notifyPosition = 'toast-' + notifyElement.attr('data-notify-position');
            }
            if (!notifyMsg) {
                notifyMsg = 'Please set a message!';
            }
            if (!notifyTimeout) {
                notifyTimeout = 5000;
            }
            if (notifyCloseButton == 'true') {
                notifyCloseButton = true;
            } else {
                notifyCloseButton = false;
            }

            toastr.options.positionClass = notifyPosition;
            toastr.options.timeOut = Number(notifyTimeout);
            toastr.options.closeButton = notifyCloseButton;
            toastr.options.closeHtml = '<button><i class="icon-remove"></i></button>';

            if (notifyType == 'warning') {
                toastr.warning(notifyMsg);
            } else if (notifyType == 'error') {
                toastr.error(notifyMsg);
            } else if (notifyType == 'success') {
                toastr.success(notifyMsg);
            } else {
                toastr.info(notifyMsg);
            }

            return false;
        },

        textRotater: function () {

            if (!$().Morphext) {
                console.log('textRotater: Morphext not Defined.');
                return true;
            }

            if ($textRotaterEl.length > 0) {
                $textRotaterEl.each(function () {
                    var element = $(this),
                        trRotate = $(this).attr('data-rotate'),
                        trSpeed = $(this).attr('data-speed'),
                        trSeparator = $(this).attr('data-separator');

                    if (!trRotate) {
                        trRotate = "fade";
                    }
                    if (!trSpeed) {
                        trSpeed = 1200;
                    }
                    if (!trSeparator) {
                        trSeparator = ",";
                    }

                    var tRotater = $(this).find('.t-rotate');

                    tRotater.Morphext({
                        animation: trRotate,
                        separator: trSeparator,
                        speed: Number(trSpeed)
                    });
                });
            }
        },

        linkScroll: function () {
            $("a[data-scrollto]").click(function () {
                var element = $(this),
                    divScrollToAnchor = element.attr('data-scrollto'),
                    divScrollSpeed = element.attr('data-speed'),
                    divScrollOffset = element.attr('data-offset'),
                    divScrollEasing = element.attr('data-easing'),
                    divScrollHighlight = element.attr('data-highlight');

                if (!divScrollSpeed) {
                    divScrollSpeed = 750;
                }
                if (!divScrollOffset) {
                    divScrollOffset = SEMICOLON.initialize.topScrollOffset();
                }
                if (!divScrollEasing) {
                    divScrollEasing = 'easeOutQuad';
                }

                $('html,body').stop(true).animate({
                    'scrollTop': $(divScrollToAnchor).offset().top - Number(divScrollOffset)
                }, Number(divScrollSpeed), divScrollEasing, function () {
                    if (divScrollHighlight) {
                        if ($(divScrollToAnchor).find('.highlight-me').length > 0) {
                            $(divScrollToAnchor).find('.highlight-me').animate({'backgroundColor': divScrollHighlight}, 300);
                            var t = setTimeout(function () {
                                $(divScrollToAnchor).find('.highlight-me').animate({'backgroundColor': 'transparent'}, 300);
                            }, 500);
                        } else {
                            $(divScrollToAnchor).animate({'backgroundColor': divScrollHighlight}, 300);
                            var t = setTimeout(function () {
                                $(divScrollToAnchor).animate({'backgroundColor': 'transparent'}, 300);
                            }, 500);
                        }
                    }
                });

                return false;
            });
        },

        contactForm: function () {

            if (!$().validate) {
                console.log('contactForm: Form Validate not Defined.');
                return true;
            }

            if (!$().ajaxSubmit) {
                console.log('contactForm: jQuery Form not Defined.');
                return true;
            }

            var $contactForm = $('.contact-widget:not(.customjs)');
            if ($contactForm.length < 1) {
                return true;
            }

            $contactForm.each(function () {
                var element = $(this),
                    elementAlert = element.attr('data-alert-type'),
                    elementLoader = element.attr('data-loader'),
                    elementResult = element.find('.contact-form-result'),
                    elementRedirect = element.attr('data-redirect');

                element.find('form').validate({
                    submitHandler: function (form) {

                        elementResult.hide();

                        if (elementLoader == 'button') {
                            var defButton = $(form).find('button'),
                                defButtonText = defButton.html();

                            defButton.html('<i class="icon-line-loader icon-spin nomargin"></i>');
                        } else {
                            $(form).find('.form-process').fadeIn();
                        }

                        $(form).ajaxSubmit({
                            target: elementResult,
                            dataType: 'json',
                            success: function (data) {
                                if (elementLoader == 'button') {
                                    defButton.html(defButtonText);
                                } else {
                                    $(form).find('.form-process').fadeOut();
                                }
                                if (data.alert != 'error' && elementRedirect) {
                                    window.location.replace(elementRedirect);
                                    return true;
                                }
                                if (elementAlert == 'inline') {
                                    if (data.alert == 'error') {
                                        var alertType = 'alert-danger';
                                    } else {
                                        var alertType = 'alert-success';
                                    }

                                    elementResult.removeClass('alert-danger alert-success').addClass('alert ' + alertType).html(data.message).slideDown(400);
                                } else {
                                    elementResult.attr('data-notify-type', data.alert).attr('data-notify-msg', data.message).html('');
                                    SEMICOLON.widget.notifications(elementResult);
                                }
                                if ($(form).find('.g-recaptcha').children('div').length > 0) {
                                    grecaptcha.reset();
                                }
                                if (data.alert != 'error') {
                                    $(form).clearForm();
                                }
                            }
                        });
                    }
                });

            });
        },

        subscription: function () {

            if (!$().validate) {
                console.log('subscription: Form Validate not Defined.');
                return true;
            }

            if (!$().ajaxSubmit) {
                console.log('subscription: jQuery Form not Defined.');
                return true;
            }

            var $subscribeForm = $('.subscribe-widget:not(.customjs)');
            if ($subscribeForm.length < 1) {
                return true;
            }

            $subscribeForm.each(function () {
                var element = $(this),
                    elementAlert = element.attr('data-alert-type'),
                    elementLoader = element.attr('data-loader'),
                    elementResult = element.find('.widget-subscribe-form-result'),
                    elementRedirect = element.attr('data-redirect');

                element.find('form').validate({
                    submitHandler: function (form) {

                        elementResult.hide();

                        if (elementLoader == 'button') {
                            var defButton = $(form).find('button'),
                                defButtonText = defButton.html();

                            defButton.html('<i class="icon-line-loader icon-spin nomargin"></i>');
                        } else {
                            $(form).find('.input-group-addon').find('.icon-email2').removeClass('icon-email2').addClass('icon-line-loader icon-spin');
                        }

                        $(form).ajaxSubmit({
                            target: elementResult,
                            dataType: 'json',
                            resetForm: true,
                            success: function (data) {
                                if (elementLoader == 'button') {
                                    defButton.html(defButtonText);
                                } else {
                                    $(form).find('.input-group-addon').find('.icon-line-loader').removeClass('icon-line-loader icon-spin').addClass('icon-email2');
                                }
                                if (data.alert != 'error' && elementRedirect) {
                                    window.location.replace(elementRedirect);
                                    return true;
                                }
                                if (elementAlert == 'inline') {
                                    if (data.alert == 'error') {
                                        var alertType = 'alert-danger';
                                    } else {
                                        var alertType = 'alert-success';
                                    }

                                    elementResult.addClass('alert ' + alertType).html(data.message).slideDown(400);
                                } else {
                                    elementResult.attr('data-notify-type', data.alert).attr('data-notify-msg', data.message).html('');
                                    SEMICOLON.widget.notifications(elementResult);
                                }
                            }
                        });
                    }
                });

            });
        },

        quickContact: function () {

            if (!$().validate) {
                console.log('quickContact: Form Validate not Defined.');
                return true;
            }

            if (!$().ajaxSubmit) {
                console.log('quickContact: jQuery Form not Defined.');
                return true;
            }

            var $quickContact = $('.quick-contact-widget:not(.customjs)');
            if ($quickContact.length < 1) {
                return true;
            }

            $quickContact.each(function () {
                var element = $(this),
                    elementAlert = element.attr('data-alert-type'),
                    elementLoader = element.attr('data-loader'),
                    elementResult = element.find('.quick-contact-form-result'),
                    elementRedirect = element.attr('data-redirect');

                element.find('form').validate({
                    submitHandler: function (form) {

                        elementResult.hide();
                        $(form).animate({opacity: 0.4});

                        if (elementLoader == 'button') {
                            var defButton = $(form).find('button'),
                                defButtonText = defButton.html();

                            defButton.html('<i class="icon-line-loader icon-spin nomargin"></i>');
                        } else {
                            $(form).find('.form-process').fadeIn();
                        }

                        $(form).ajaxSubmit({
                            target: elementResult,
                            dataType: 'json',
                            resetForm: true,
                            success: function (data) {
                                $(form).animate({opacity: 1});
                                if (elementLoader == 'button') {
                                    defButton.html(defButtonText);
                                } else {
                                    $(form).find('.form-process').fadeOut();
                                }
                                if (data.alert != 'error' && elementRedirect) {
                                    window.location.replace(elementRedirect);
                                    return true;
                                }
                                if (elementAlert == 'inline') {
                                    if (data.alert == 'error') {
                                        var alertType = 'alert-danger';
                                    } else {
                                        var alertType = 'alert-success';
                                    }

                                    elementResult.addClass('alert ' + alertType).html(data.message).slideDown(400);
                                } else {
                                    elementResult.attr('data-notify-type', data.alert).attr('data-notify-msg', data.message).html('');
                                    SEMICOLON.widget.notifications(elementResult);
                                }
                                if ($(form).find('.g-recaptcha').children('div').length > 0) {
                                    grecaptcha.reset();
                                }
                            }
                        });
                    }
                });

            });
        },

        cookieNotify: function () {

            if (!$.cookie) {
                console.log('cookieNotify: Cookie Function not defined.');
                return true;
            }

            if ($cookieNotification.length > 0) {
                var cookieNotificationHeight = $cookieNotification.outerHeight();

                $cookieNotification.css({bottom: -cookieNotificationHeight});

                if ($.cookie('websiteUsesCookies') != 'yesConfirmed') {
                    $cookieNotification.css({bottom: 0});
                }

                $('.cookie-accept').click(function () {
                    $cookieNotification.css({bottom: -cookieNotificationHeight});
                    $.cookie('websiteUsesCookies', 'yesConfirmed', {expires: 30});
                    return false;
                });
            }
        },

        extras: function () {

            if ($().tooltip) {
                $('[data-toggle="tooltip"]').tooltip({container: 'body'});
            } else {
                console.log('extras: Bootstrap Tooltip not defined.');
            }

            if ($().popover) {
                $('[data-toggle=popover]').popover();
            } else {
                console.log('extras: Bootstrap Popover not defined.');
            }

            $('.style-msg').on('click', '.close', function (e) {
                $(this).parents('.style-msg').slideUp();
                e.preventDefault();
            });

            $('#primary-menu-trigger,#overlay-menu-close').click(function () {
                if ($('#primary-menu').find('ul.mobile-primary-menu').length > 0) {
                    $('#primary-menu > ul.mobile-primary-menu, #primary-menu > div > ul.mobile-primary-menu').toggleClass("show");
                } else {
                    $('#primary-menu > ul, #primary-menu > div > ul').toggleClass("show");
                }
                $body.toggleClass("primary-menu-open");
                return false;
            });
            $('#page-submenu-trigger').click(function () {
                $body.toggleClass('top-search-open', false);
                $pagemenu.toggleClass("pagemenu-active");
                return false;
            });
            $pagemenu.find('nav').click(function (e) {
                $body.toggleClass('top-search-open', false);
                $topCart.toggleClass('top-cart-open', false);
            });
            if (SEMICOLON.isMobile.any()) {
                $body.addClass('device-touch');
            }
            // var el = {
            //     darkLogo : $("<img>", {src: defaultDarkLogo}),
            //     darkRetinaLogo : $("<img>", {src: retinaDarkLogo})
            // };
            // el.darkLogo.prependTo("body");
            // el.darkRetinaLogo.prependTo("body");
            // el.darkLogo.css({'position':'absolute','z-index':'-100'});
            // el.darkRetinaLogo.css({'position':'absolute','z-index':'-100'});
        }

    };

    SEMICOLON.isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return (SEMICOLON.isMobile.Android() || SEMICOLON.isMobile.BlackBerry() || SEMICOLON.isMobile.iOS() || SEMICOLON.isMobile.Opera() || SEMICOLON.isMobile.Windows());
        }
    };

    SEMICOLON.documentOnResize = {

        init: function () {

            var t = setTimeout(function () {
                SEMICOLON.header.topsocial();
                SEMICOLON.header.fullWidthMenu();
                SEMICOLON.header.overlayMenu();
                SEMICOLON.initialize.fullScreen();
                SEMICOLON.initialize.verticalMiddle();
                SEMICOLON.initialize.maxHeight();
                SEMICOLON.initialize.testimonialsGrid();
                SEMICOLON.initialize.stickyFooter();
                SEMICOLON.slider.sliderParallaxDimensions();
                SEMICOLON.slider.captionPosition();
                SEMICOLON.portfolio.arrange();
                SEMICOLON.portfolio.portfolioDescMargin();
                SEMICOLON.widget.tabsResponsiveResize();
                SEMICOLON.widget.tabsJustify();
                SEMICOLON.widget.html5Video();
                SEMICOLON.widget.masonryThumbs();
                SEMICOLON.initialize.dataResponsiveClasses();
                SEMICOLON.initialize.dataResponsiveHeights();
                if ($gridContainer.length > 0) {
                    if (!$gridContainer.hasClass('.customjs')) {
                        if ($().isotope) {
                            $gridContainer.isotope('layout');
                        } else {
                            console.log('documentOnResize > init: Isotope not defined.');
                        }
                    }
                }
                if ($body.hasClass('device-lg') || $body.hasClass('device-md')) {
                    $('#primary-menu').find('ul.mobile-primary-menu').removeClass('show');
                }
            }, 500);

            windowWidth = $window.width();

        }

    };

    SEMICOLON.documentOnReady = {

        init: function () {
            SEMICOLON.initialize.init();
            SEMICOLON.header.init();
            if ($slider.length > 0) {
                SEMICOLON.slider.init();
            }
            if ($portfolio.length > 0) {
                SEMICOLON.portfolio.init();
            }
            SEMICOLON.widget.init();
            SEMICOLON.documentOnReady.windowscroll();
        },

        windowscroll: function () {

            var headerOffset = 0,
                headerWrapOffset = 0,
                pageMenuOffset = 0;

            if ($header.length > 0) {
                headerOffset = $header.offset().top;
            }
            if ($header.length > 0) {
                headerWrapOffset = $headerWrap.offset().top;
            }
            if ($pagemenu.length > 0) {
                if ($header.length > 0 && !$header.hasClass('no-sticky')) {
                    if ($header.hasClass('sticky-style-2') || $header.hasClass('sticky-style-3')) {
                        pageMenuOffset = $pagemenu.offset().top - $headerWrap.outerHeight();
                    } else {
                        pageMenuOffset = $pagemenu.offset().top - $header.outerHeight();
                    }
                } else {
                    pageMenuOffset = $pagemenu.offset().top;
                }
            }

            var headerDefinedOffset = $header.attr('data-sticky-offset');
            if (typeof headerDefinedOffset !== 'undefined') {
                if (headerDefinedOffset == 'full') {
                    headerWrapOffset = $window.height();
                    var headerOffsetNegative = $header.attr('data-sticky-offset-negative');
                    if (typeof headerOffsetNegative !== 'undefined') {
                        headerWrapOffset = headerWrapOffset - headerOffsetNegative - 1;
                    }
                } else {
                    headerWrapOffset = Number(headerDefinedOffset);
                }
            }

            SEMICOLON.header.stickyMenu(headerWrapOffset);
            SEMICOLON.header.stickyPageMenu(pageMenuOffset);

            $window.on('scroll', function () {

                SEMICOLON.initialize.goToTopScroll();
                $('body.open-header.close-header-on-scroll').removeClass("side-header-open");
                SEMICOLON.header.stickyMenu(headerWrapOffset);
                SEMICOLON.header.stickyPageMenu(pageMenuOffset);
                SEMICOLON.header.logo();

            });

            window.addEventListener('scroll', onScrollSliderParallax, false);

            if ($onePageMenuEl.length > 0) {
                if ($().scrolled) {
                    $window.scrolled(function () {
                        SEMICOLON.header.onepageScroller();
                    });
                } else {
                    console.log('windowscroll: Scrolled Function not defined.');
                }
            }
        }

    };

    SEMICOLON.documentOnLoad = {

        init: function () {
            SEMICOLON.slider.captionPosition();
            SEMICOLON.slider.swiperSliderMenu(true);
            SEMICOLON.slider.revolutionSliderMenu(true);
            SEMICOLON.initialize.maxHeight();
            SEMICOLON.initialize.testimonialsGrid();
            SEMICOLON.initialize.verticalMiddle();
            SEMICOLON.initialize.stickFooterOnSmall();
            SEMICOLON.initialize.stickyFooter();
            SEMICOLON.portfolio.gridInit($gridContainer);
            SEMICOLON.portfolio.filterInit();
            SEMICOLON.portfolio.shuffleInit();
            SEMICOLON.portfolio.arrange();
            SEMICOLON.portfolio.portfolioDescMargin();
            SEMICOLON.widget.parallax();
            SEMICOLON.widget.loadFlexSlider();
            SEMICOLON.widget.html5Video();
            SEMICOLON.widget.masonryThumbs();
            SEMICOLON.header.topsocial();
            SEMICOLON.header.responsiveMenuClass();
            SEMICOLON.initialize.modal();
        }

    };

    var $window = $(window),
        $body = $('body'),
        $wrapper = $('#wrapper'),
        $header = $('#header'),
        $headerWrap = $('#header-wrap'),
        $content = $('#content'),
        $footer = $('#footer'),
        windowWidth = $window.width(),
        oldHeaderClasses = $header.attr('class'),
        oldHeaderWrapClasses = $headerWrap.attr('class'),
        stickyMenuClasses = $header.attr('data-sticky-class'),
        responsiveMenuClasses = $header.attr('data-responsive-class'),
        defaultLogo = $('#logo').find('.standard-logo'),
        defaultLogoWidth = defaultLogo.find('img').outerWidth(),
        retinaLogo = $('#logo').find('.retina-logo'),
        defaultLogoImg = defaultLogo.find('img').attr('src'),
        retinaLogoImg = retinaLogo.find('img').attr('src'),
        defaultDarkLogo = defaultLogo.attr('data-dark-logo'),
        retinaDarkLogo = retinaLogo.attr('data-dark-logo'),
        defaultStickyLogo = defaultLogo.attr('data-sticky-logo'),
        retinaStickyLogo = retinaLogo.attr('data-sticky-logo'),
        defaultMobileLogo = defaultLogo.attr('data-mobile-logo'),
        retinaMobileLogo = retinaLogo.attr('data-mobile-logo'),
        $pagemenu = $('#page-menu'),
        $onePageMenuEl = $('.one-page-menu'),
        onePageGlobalOffset = 0,
        $portfolio = $('.portfolio'),
        $shop = $('.shop'),
        $gridContainer = $('.grid-container'),
        $slider = $('#slider'),
        $sliderParallaxEl = $('.slider-parallax'),
        swiperSlider = '',
        $pageTitle = $('#page-title'),
        $portfolioItems = $('.portfolio-ajax').find('.portfolio-item'),
        $portfolioDetails = $('#portfolio-ajax-wrap'),
        $portfolioDetailsContainer = $('#portfolio-ajax-container'),
        $portfolioAjaxLoader = $('#portfolio-ajax-loader'),
        $portfolioFilter = $('.portfolio-filter,.custom-filter'),
        prevPostPortId = '',
        $topSearch = $('#top-search'),
        $topCart = $('#top-cart'),
        $verticalMiddleEl = $('.vertical-middle'),
        $topSocialEl = $('#top-social').find('li'),
        $siStickyEl = $('.si-sticky'),
        $dotsMenuEl = $('.dots-menu'),
        $goToTopEl = $('#gotoTop'),
        $fullScreenEl = $('.full-screen'),
        $commonHeightEl = $('.common-height'),
        $testimonialsGridEl = $('.testimonials-grid'),
        $pageSectionEl = $('.page-section'),
        $owlCarouselEl = $('.owl-carousel'),
        $parallaxEl = $('.parallax'),
        $parallaxPageTitleEl = $('.page-title-parallax'),
        $parallaxPortfolioEl = $('.portfolio-parallax').find('.portfolio-image'),
        $textRotaterEl = $('.text-rotater'),
        $cookieNotification = $('#cookie-notification');

    $(document).ready(SEMICOLON.documentOnReady.init);
    $window.load(SEMICOLON.documentOnLoad.init);
    $window.on('resize', SEMICOLON.documentOnResize.init);

})(jQuery);


var ega = function () {

    //USE STRICT
    'use strict';

    var $window = $(window);
    // fancy box
    var handleFancyBox = function () {

        //phong 20150702: add fancyBox data 'product_url' & beforeShow
        //ref: http://stackoverflow.com/questions/2961496/fancybox-get-id-of-clicked-anchor-element
        jQuery(".fancybox-fast-view").each(function (e) {
            $(this).fancybox({
                'product_url': $(this).attr('product_url'),
                beforeShow: function () {
                    quickViewProduct(this.product_url); // make-up "#product-pop-up"
                },
            });
        });
    }

    // tooltip
    var handleTooltip = function () {
        $('[data-toggle="tooltip"]').tooltip({
            html: true
        })
    }

    // add class to element
    var addClassToEl = function ($element, $class) {
        $element.addClass($class);
    }
    var removeClassOfEl = function ($element, $class) {
        $element.removeClass($class);
    }
    var handleScroll = function ($options) {
        $options = $options || {};
        var el = (typeof $options.el != undefined) ? $options.el : '';
        var cl = (typeof $options.cl != undefined) ? $options.cl : '';
        var top = (typeof $options.top != undefined) ? $options.top : '';
        var bottom = (typeof $options.bottom != undefined) ? $options.bottom : '';
        $window.on('scroll', function () {
            if ($window.scrollTop() > Number(top)) {
                addClassToEl(el, cl);
            } else {
                removeClassOfEl(el, cl);
            }
        })
    }

    var lazyLoad = function () {
        var lazyLoadEl = $('[data-lazyload]');
        if (lazyLoadEl.length > 0) {
            lazyLoadEl.each(function () {
                var element = $(this),
                    elementImg = element.attr('data-lazyload');

                element.attr('src', '{{ "blank.svg" | asset_url }}').css({'background': 'url({{ "preloader.gif" | asset_url }}) no-repeat center center #FFF'});

                element.appear(function () {
                    element.css({'background': 'none'}).removeAttr('width').removeAttr('height').attr('src', elementImg);
                }, {accX: 0, accY: 120}, 'easeInCubic');
            });
        }
    }
    return {
        init: function () {
            handleFancyBox();
            lazyLoad();
        },
        tooltip: function () {
            handleTooltip();
        },
        addClassToEl: function () {
            addClassToEl();
        },
        handleScroll: function ($options) {
            handleScroll($options)
        }
    }
}();
/***jquery.fancybox.js***/
!function (e, t, n, i) {
    "use strict";
    var o = n("html"), a = n(e), r = n(t), s = n.fancybox = function () {
        s.open.apply(this, arguments)
    }, l = navigator.userAgent.match(/msie/i), c = null, d = t.createTouch !== i, p = function (e) {
        return e && e.hasOwnProperty && e instanceof n
    }, h = function (e) {
        return e && "string" === n.type(e)
    }, f = function (e) {
        return h(e) && e.indexOf("%") > 0
    }, u = function (e) {
        return e && !(e.style.overflow && "hidden" === e.style.overflow) && (e.clientWidth && e.scrollWidth > e.clientWidth || e.clientHeight && e.scrollHeight > e.clientHeight)
    }, g = function (e, t) {
        var n = parseInt(e, 10) || 0;
        return t && f(e) && (n = s.getViewport()[t] / 100 * n), Math.ceil(n)
    }, m = function (e, t) {
        return g(e, t) + "px"
    };
    n.extend(s, {
        version: "2.1.5",
        defaults: {
            padding: 15,
            margin: 20,
            width: 800,
            height: 600,
            minWidth: 100,
            minHeight: 100,
            maxWidth: 9999,
            maxHeight: 9999,
            pixelRatio: 1,
            autoSize: !0,
            autoHeight: !1,
            autoWidth: !1,
            autoResize: !0,
            autoCenter: !d,
            fitToView: !0,
            aspectRatio: !1,
            topRatio: .5,
            leftRatio: .5,
            scrolling: "auto",
            wrapCSS: "",
            arrows: !0,
            closeBtn: !0,
            closeClick: !1,
            nextClick: !1,
            mouseWheel: !0,
            autoPlay: !1,
            playSpeed: 3e3,
            preload: 3,
            modal: !1,
            loop: !0,
            ajax: {dataType: "html", headers: {"X-fancyBox": !0}},
            iframe: {scrolling: "auto", preload: !0},
            swf: {wmode: "transparent", allowfullscreen: "true", allowscriptaccess: "always"},
            keys: {
                next: {13: "left", 34: "up", 39: "left", 40: "up"},
                prev: {8: "right", 33: "down", 37: "right", 38: "down"},
                close: [27],
                play: [32],
                toggle: [70]
            },
            direction: {next: "left", prev: "right"},
            scrollOutside: !0,
            index: 0,
            type: null,
            href: null,
            content: null,
            title: null,
            tpl: {
                wrap: '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
                image: '<img class="fancybox-image" src="{href}" alt="" />',
                iframe: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen' + (l ? ' allowtransparency="true"' : "") + "></iframe>",
                error: '<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
                closeBtn: '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>',
                next: '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
                prev: '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
            },
            openEffect: "fade",
            openSpeed: 250,
            openEasing: "swing",
            openOpacity: !0,
            openMethod: "zoomIn",
            closeEffect: "fade",
            closeSpeed: 250,
            closeEasing: "swing",
            closeOpacity: !0,
            closeMethod: "zoomOut",
            nextEffect: "elastic",
            nextSpeed: 250,
            nextEasing: "swing",
            nextMethod: "changeIn",
            prevEffect: "elastic",
            prevSpeed: 250,
            prevEasing: "swing",
            prevMethod: "changeOut",
            helpers: {overlay: !0, title: !0},
            onCancel: n.noop,
            beforeLoad: n.noop,
            afterLoad: n.noop,
            beforeShow: n.noop,
            afterShow: n.noop,
            beforeChange: n.noop,
            beforeClose: n.noop,
            afterClose: n.noop
        },
        group: {},
        opts: {},
        previous: null,
        coming: null,
        current: null,
        isActive: !1,
        isOpen: !1,
        isOpened: !1,
        wrap: null,
        skin: null,
        outer: null,
        inner: null,
        player: {timer: null, isActive: !1},
        ajaxLoad: null,
        imgPreload: null,
        transitions: {},
        helpers: {},
        open: function (e, t) {
            return e && (n.isPlainObject(t) || (t = {}), !1 !== s.close(!0)) ? (n.isArray(e) || (e = p(e) ? n(e).get() : [e]), n.each(e, function (o, a) {
                var r, l, c, d, f, u, g, m = {};
                "object" === n.type(a) && (a.nodeType && (a = n(a)), p(a) ? (m = {
                    href: a.data("fancybox-href") || a.attr("href"),
                    title: a.data("fancybox-title") || a.attr("title"),
                    isDom: !0,
                    element: a
                }, n.metadata && n.extend(!0, m, a.metadata())) : m = a), r = t.href || m.href || (h(a) ? a : null), l = t.title !== i ? t.title : m.title || "", c = t.content || m.content, d = c ? "html" : t.type || m.type, !d && m.isDom && (d = a.data("fancybox-type"), d || (f = a.prop("class").match(/fancybox\.(\w+)/), d = f ? f[1] : null)), h(r) && (d || (s.isImage(r) ? d = "image" : s.isSWF(r) ? d = "swf" : "#" === r.charAt(0) ? d = "inline" : h(a) && (d = "html", c = a)), "ajax" === d && (u = r.split(/\s+/, 2), r = u.shift(), g = u.shift())), c || ("inline" === d ? r ? c = n(h(r) ? r.replace(/.*(?=#[^\s]+$)/, "") : r) : m.isDom && (c = a) : "html" === d ? c = r : d || r || !m.isDom || (d = "inline", c = a)), n.extend(m, {
                    href: r,
                    type: d,
                    content: c,
                    title: l,
                    selector: g
                }), e[o] = m
            }), s.opts = n.extend(!0, {}, s.defaults, t), t.keys !== i && (s.opts.keys = t.keys ? n.extend({}, s.defaults.keys, t.keys) : !1), s.group = e, s._start(s.opts.index)) : void 0
        },
        cancel: function () {
            var e = s.coming;
            e && !1 !== s.trigger("onCancel") && (s.hideLoading(), s.ajaxLoad && s.ajaxLoad.abort(), s.ajaxLoad = null, s.imgPreload && (s.imgPreload.onload = s.imgPreload.onerror = null), e.wrap && e.wrap.stop(!0, !0).trigger("onReset").remove(), s.coming = null, s.current || s._afterZoomOut(e))
        },
        close: function (e) {
            s.cancel(), !1 !== s.trigger("beforeClose") && (s.unbindEvents(), s.isActive && (s.isOpen && e !== !0 ? (s.isOpen = s.isOpened = !1, s.isClosing = !0, n(".fancybox-item, .fancybox-nav").remove(), s.wrap.stop(!0, !0).removeClass("fancybox-opened"), s.transitions[s.current.closeMethod]()) : (n(".fancybox-wrap").stop(!0).trigger("onReset").remove(), s._afterZoomOut())))
        },
        play: function (e) {
            var t = function () {
                clearTimeout(s.player.timer)
            }, n = function () {
                t(), s.current && s.player.isActive && (s.player.timer = setTimeout(s.next, s.current.playSpeed))
            }, i = function () {
                t(), r.unbind(".player"), s.player.isActive = !1, s.trigger("onPlayEnd")
            }, o = function () {
                s.current && (s.current.loop || s.current.index < s.group.length - 1) && (s.player.isActive = !0, r.bind({
                    "onCancel.player beforeClose.player": i,
                    "onUpdate.player": n,
                    "beforeLoad.player": t
                }), n(), s.trigger("onPlayStart"))
            };
            e === !0 || !s.player.isActive && e !== !1 ? o() : i()
        },
        next: function (e) {
            var t = s.current;
            t && (h(e) || (e = t.direction.next), s.jumpto(t.index + 1, e, "next"))
        },
        prev: function (e) {
            var t = s.current;
            t && (h(e) || (e = t.direction.prev), s.jumpto(t.index - 1, e, "prev"))
        },
        jumpto: function (e, t, n) {
            var o = s.current;
            o && (e = g(e), s.direction = t || o.direction[e >= o.index ? "next" : "prev"], s.router = n || "jumpto", o.loop && (0 > e && (e = o.group.length + e % o.group.length), e %= o.group.length), o.group[e] !== i && (s.cancel(), s._start(e)))
        },
        reposition: function (e, t) {
            var i, o = s.current, a = o ? o.wrap : null;
            a && (i = s._getPosition(t), e && "scroll" === e.type ? (delete i.position, a.stop(!0, !0).animate(i, 200)) : (a.css(i), o.pos = n.extend({}, o.dim, i)))
        },
        update: function (e) {
            var t = e && e.type, n = !t || "orientationchange" === t;
            n && (clearTimeout(c), c = null), s.isOpen && !c && (c = setTimeout(function () {
                var i = s.current;
                i && !s.isClosing && (s.wrap.removeClass("fancybox-tmp"), (n || "load" === t || "resize" === t && i.autoResize) && s._setDimension(), "scroll" === t && i.canShrink || s.reposition(e), s.trigger("onUpdate"), c = null)
            }, n && !d ? 0 : 300))
        },
        toggle: function (e) {
            s.isOpen && (s.current.fitToView = "boolean" === n.type(e) ? e : !s.current.fitToView, d && (s.wrap.removeAttr("style").addClass("fancybox-tmp"), s.trigger("onUpdate")), s.update())
        },
        hideLoading: function () {
            r.unbind(".loading"), n("#fancybox-loading").remove()
        },
        showLoading: function () {
            var e, t;
            s.hideLoading(), e = n('<div id="fancybox-loading"><div></div></div>').click(s.cancel).appendTo("body"), r.bind("keydown.loading", function (e) {
                27 === (e.which || e.keyCode) && (e.preventDefault(), s.cancel())
            }), s.defaults.fixed || (t = s.getViewport(), e.css({
                position: "absolute",
                top: .5 * t.h + t.y,
                left: .5 * t.w + t.x
            }))
        },
        getViewport: function () {
            var t = s.current && s.current.locked || !1, n = {x: a.scrollLeft(), y: a.scrollTop()};
            return t ? (n.w = t[0].clientWidth, n.h = t[0].clientHeight) : (n.w = d && e.innerWidth ? e.innerWidth : a.width(), n.h = d && e.innerHeight ? e.innerHeight : a.height()), n
        },
        unbindEvents: function () {
            s.wrap && p(s.wrap) && s.wrap.unbind(".fb"), r.unbind(".fb"), a.unbind(".fb")
        },
        bindEvents: function () {
            var e, t = s.current;
            t && (a.bind("orientationchange.fb" + (d ? "" : " resize.fb") + (t.autoCenter && !t.locked ? " scroll.fb" : ""), s.update), e = t.keys, e && r.bind("keydown.fb", function (o) {
                var a = o.which || o.keyCode, r = o.target || o.srcElement;
                return 27 === a && s.coming ? !1 : void (o.ctrlKey || o.altKey || o.shiftKey || o.metaKey || r && (r.type || n(r).is("[contenteditable]")) || n.each(e, function (e, r) {
                    return t.group.length > 1 && r[a] !== i ? (s[e](r[a]), o.preventDefault(), !1) : n.inArray(a, r) > -1 ? (s[e](), o.preventDefault(), !1) : void 0
                }))
            }), n.fn.mousewheel && t.mouseWheel && s.wrap.bind("mousewheel.fb", function (e, i, o, a) {
                for (var r = e.target || null, l = n(r), c = !1; l.length && !(c || l.is(".fancybox-skin") || l.is(".fancybox-wrap"));) c = u(l[0]), l = n(l).parent();
                0 === i || c || s.group.length > 1 && !t.canShrink && (a > 0 || o > 0 ? s.prev(a > 0 ? "down" : "left") : (0 > a || 0 > o) && s.next(0 > a ? "up" : "right"), e.preventDefault())
            }))
        },
        trigger: function (e, t) {
            var i, o = t || s.coming || s.current;
            if (o) {
                if (n.isFunction(o[e]) && (i = o[e].apply(o, Array.prototype.slice.call(arguments, 1))), i === !1) return !1;
                o.helpers && n.each(o.helpers, function (t, i) {
                    i && s.helpers[t] && n.isFunction(s.helpers[t][e]) && s.helpers[t][e](n.extend(!0, {}, s.helpers[t].defaults, i), o)
                }), r.trigger(e)
            }
        },
        isImage: function (e) {
            return h(e) && e.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i)
        },
        isSWF: function (e) {
            return h(e) && e.match(/\.(swf)((\?|#).*)?$/i)
        },
        _start: function (e) {
            var t, i, o, a, r, l = {};
            if (e = g(e), t = s.group[e] || null, !t) return !1;
            if (l = n.extend(!0, {}, s.opts, t), a = l.margin, r = l.padding, "number" === n.type(a) && (l.margin = [a, a, a, a]), "number" === n.type(r) && (l.padding = [r, r, r, r]), l.modal && n.extend(!0, l, {
                closeBtn: !1,
                closeClick: !1,
                nextClick: !1,
                arrows: !1,
                mouseWheel: !1,
                keys: null,
                helpers: {overlay: {closeClick: !1}}
            }), l.autoSize && (l.autoWidth = l.autoHeight = !0), "auto" === l.width && (l.autoWidth = !0), "auto" === l.height && (l.autoHeight = !0), l.group = s.group, l.index = e, s.coming = l, !1 === s.trigger("beforeLoad")) return void (s.coming = null);
            if (o = l.type, i = l.href, !o) return s.coming = null, s.current && s.router && "jumpto" !== s.router ? (s.current.index = e, s[s.router](s.direction)) : !1;
            if (s.isActive = !0, ("image" === o || "swf" === o) && (l.autoHeight = l.autoWidth = !1, l.scrolling = "visible"), "image" === o && (l.aspectRatio = !0), "iframe" === o && d && (l.scrolling = "scroll"), l.wrap = n(l.tpl.wrap).addClass("fancybox-" + (d ? "mobile" : "desktop") + " fancybox-type-" + o + " fancybox-tmp " + l.wrapCSS).appendTo(l.parent || "body"), n.extend(l, {
                skin: n(".fancybox-skin", l.wrap),
                outer: n(".fancybox-outer", l.wrap),
                inner: n(".fancybox-inner", l.wrap)
            }), n.each(["Top", "Right", "Bottom", "Left"], function (e, t) {
                l.skin.css("padding" + t, m(l.padding[e]))
            }), s.trigger("onReady"), "inline" === o || "html" === o) {
                if (!l.content || !l.content.length) return s._error("content")
            } else if (!i) return s._error("href");
            "image" === o ? s._loadImage() : "ajax" === o ? s._loadAjax() : "iframe" === o ? s._loadIframe() : s._afterLoad()
        },
        _error: function (e) {
            n.extend(s.coming, {
                type: "html",
                autoWidth: !0,
                autoHeight: !0,
                minWidth: 0,
                minHeight: 0,
                scrolling: "no",
                hasError: e,
                content: s.coming.tpl.error
            }), s._afterLoad()
        },
        _loadImage: function () {
            var e = s.imgPreload = new Image;
            e.onload = function () {
                this.onload = this.onerror = null, s.coming.width = this.width / s.opts.pixelRatio, s.coming.height = this.height / s.opts.pixelRatio, s._afterLoad()
            }, e.onerror = function () {
                this.onload = this.onerror = null, s._error("image")
            }, e.src = s.coming.href, e.complete !== !0 && s.showLoading()
        },
        _loadAjax: function () {
            var e = s.coming;
            s.showLoading(), s.ajaxLoad = n.ajax(n.extend({}, e.ajax, {
                url: e.href, error: function (e, t) {
                    s.coming && "abort" !== t ? s._error("ajax", e) : s.hideLoading()
                }, success: function (t, n) {
                    "success" === n && (e.content = t, s._afterLoad())
                }
            }))
        },
        _loadIframe: function () {
            var e = s.coming,
                t = n(e.tpl.iframe.replace(/\{rnd\}/g, (new Date).getTime())).attr("scrolling", d ? "auto" : e.iframe.scrolling).attr("src", e.href);
            n(e.wrap).bind("onReset", function () {
                try {
                    n(this).find("iframe").hide().attr("src", "//about:blank").end().empty()
                } catch (e) {
                }
            }), e.iframe.preload && (s.showLoading(), t.one("load", function () {
                n(this).data("ready", 1), d || n(this).bind("load.fb", s.update), n(this).parents(".fancybox-wrap").width("100%").removeClass("fancybox-tmp").show(), s._afterLoad()
            })), e.content = t.appendTo(e.inner), e.iframe.preload || s._afterLoad()
        },
        _preloadImages: function () {
            var e, t, n = s.group, i = s.current, o = n.length, a = i.preload ? Math.min(i.preload, o - 1) : 0;
            for (t = 1; a >= t; t += 1) e = n[(i.index + t) % o], "image" === e.type && e.href && ((new Image).src = e.href)
        },
        _afterLoad: function () {
            var e, t, i, o, a, r, l = s.coming, c = s.current, d = "fancybox-placeholder";
            if (s.hideLoading(), l && s.isActive !== !1) {
                if (!1 === s.trigger("afterLoad", l, c)) return l.wrap.stop(!0).trigger("onReset").remove(), void (s.coming = null);
                switch (c && (s.trigger("beforeChange", c), c.wrap.stop(!0).removeClass("fancybox-opened").find(".fancybox-item, .fancybox-nav").remove()), s.unbindEvents(), e = l, t = l.content, i = l.type, o = l.scrolling, n.extend(s, {
                    wrap: e.wrap,
                    skin: e.skin,
                    outer: e.outer,
                    inner: e.inner,
                    current: e,
                    previous: c
                }), a = e.href, i) {
                    case"inline":
                    case"ajax":
                    case"html":
                        e.selector ? t = n("<div>").html(t).find(e.selector) : p(t) && (t.data(d) || t.data(d, n('<div class="' + d + '"></div>').insertAfter(t).hide()), t = t.show().detach(), e.wrap.bind("onReset", function () {
                            n(this).find(t).length && t.hide().replaceAll(t.data(d)).data(d, !1)
                        }));
                        break;
                    case"image":
                        t = e.tpl.image.replace("{href}", a);
                        break;
                    case"swf":
                        t = '<object id="fancybox-swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="' + a + '"></param>', r = "", n.each(e.swf, function (e, n) {
                            t += '<param name="' + e + '" value="' + n + '"></param>', r += " " + e + '="' + n + '"'
                        }), t += '<embed src="' + a + '" type="application/x-shockwave-flash" width="100%" height="100%"' + r + "></embed></object>"
                }
                p(t) && t.parent().is(e.inner) || e.inner.append(t), s.trigger("beforeShow"), e.inner.css("overflow", "yes" === o ? "scroll" : "no" === o ? "hidden" : o), s._setDimension(), s.reposition(), s.isOpen = !1, s.coming = null, s.bindEvents(), s.isOpened ? c.prevMethod && s.transitions[c.prevMethod]() : n(".fancybox-wrap").not(e.wrap).stop(!0).trigger("onReset").remove(), s.transitions[s.isOpened ? e.nextMethod : e.openMethod](), s._preloadImages()
            }
        },
        _setDimension: function () {
            var e, t, i, o, a, r, l, c, d, p, h, u, y, x, v, w = s.getViewport(), b = 0, k = !1, C = !1, O = s.wrap,
                W = s.skin, _ = s.inner, S = s.current, T = S.width, L = S.height, E = S.minWidth, R = S.minHeight,
                j = S.maxWidth, P = S.maxHeight, H = S.scrolling, M = S.scrollOutside ? S.scrollbarWidth : 0,
                A = S.margin, I = g(A[1] + A[3]), D = g(A[0] + A[2]);
            if (O.add(W).add(_).width("auto").height("auto").removeClass("fancybox-tmp"), e = g(W.outerWidth(!0) - W.width()), t = g(W.outerHeight(!0) - W.height()), i = I + e, o = D + t, a = f(T) ? (w.w - i) * g(T) / 100 : T, r = f(L) ? (w.h - o) * g(L) / 100 : L, "iframe" === S.type) {
                if (x = S.content, S.autoHeight && 1 === x.data("ready")) try {
                    x[0].contentWindow.document.location && (_.width(a).height(9999), v = x.contents().find("body"), M && v.css("overflow-x", "hidden"), r = v.outerHeight(!0))
                } catch (z) {
                }
            } else (S.autoWidth || S.autoHeight) && (_.addClass("fancybox-tmp"), S.autoWidth || _.width(a), S.autoHeight || _.height(r), S.autoWidth && (a = _.width()), S.autoHeight && (r = _.height()), _.removeClass("fancybox-tmp"));
            if (T = g(a), L = g(r), d = a / r, E = g(f(E) ? g(E, "w") - i : E), j = g(f(j) ? g(j, "w") - i : j), R = g(f(R) ? g(R, "h") - o : R), P = g(f(P) ? g(P, "h") - o : P), l = j, c = P, S.fitToView && (j = Math.min(w.w - i, j), P = Math.min(w.h - o, P)), u = w.w - I, y = w.h - D, S.aspectRatio ? (T > j && (T = j, L = g(T / d)), L > P && (L = P, T = g(L * d)), E > T && (T = E, L = g(T / d)), R > L && (L = R, T = g(L * d))) : (T = Math.max(E, Math.min(T, j)), S.autoHeight && "iframe" !== S.type && (_.width(T), L = _.height()), L = Math.max(R, Math.min(L, P))), S.fitToView) if (_.width(T).height(L), O.width(T + e), p = O.width(), h = O.height(), S.aspectRatio) for (; (p > u || h > y) && T > E && L > R && !(b++ > 19);) L = Math.max(R, Math.min(P, L - 10)), T = g(L * d), E > T && (T = E, L = g(T / d)), T > j && (T = j, L = g(T / d)), _.width(T).height(L), O.width(T + e), p = O.width(), h = O.height(); else T = Math.max(E, Math.min(T, T - (p - u))), L = Math.max(R, Math.min(L, L - (h - y)));
            M && "auto" === H && r > L && u > T + e + M && (T += M), _.width(T).height(L), O.width(T + e), p = O.width(), h = O.height(), k = (p > u || h > y) && T > E && L > R, C = S.aspectRatio ? l > T && c > L && a > T && r > L : (l > T || c > L) && (a > T || r > L), n.extend(S, {
                dim: {
                    width: m(p),
                    height: m(h)
                },
                origWidth: a,
                origHeight: r,
                canShrink: k,
                canExpand: C,
                wPadding: e,
                hPadding: t,
                wrapSpace: h - W.outerHeight(!0),
                skinSpace: W.height() - L
            }), !x && S.autoHeight && L > R && P > L && !C && _.height("auto")
        },
        _getPosition: function (e) {
            var t = s.current, n = s.getViewport(), i = t.margin, o = s.wrap.width() + i[1] + i[3],
                a = s.wrap.height() + i[0] + i[2], r = {position: "absolute", top: i[0], left: i[3]};
            return t.autoCenter && t.fixed && !e && a <= n.h && o <= n.w ? r.position = "fixed" : t.locked || (r.top += n.y, r.left += n.x), r.top = m(Math.max(r.top, r.top + (n.h - a) * t.topRatio)), r.left = m(Math.max(r.left, r.left + (n.w - o) * t.leftRatio)), r
        },
        _afterZoomIn: function () {
            var e = s.current;
            e && (s.isOpen = s.isOpened = !0, s.wrap.css("overflow", "visible").addClass("fancybox-opened"), s.update(), (e.closeClick || e.nextClick && s.group.length > 1) && s.inner.css("cursor", "pointer").bind("click.fb", function (t) {
                n(t.target).is("a") || n(t.target).parent().is("a") || (t.preventDefault(), s[e.closeClick ? "close" : "next"]())
            }), e.closeBtn && n(e.tpl.closeBtn).appendTo(s.skin).bind("click.fb", function (e) {
                e.preventDefault(), s.close()
            }), e.arrows && s.group.length > 1 && ((e.loop || e.index > 0) && n(e.tpl.prev).appendTo(s.outer).bind("click.fb", s.prev), (e.loop || e.index < s.group.length - 1) && n(e.tpl.next).appendTo(s.outer).bind("click.fb", s.next)), s.trigger("afterShow"), e.loop || e.index !== e.group.length - 1 ? s.opts.autoPlay && !s.player.isActive && (s.opts.autoPlay = !1, s.play()) : s.play(!1))
        },
        _afterZoomOut: function (e) {
            e = e || s.current, n(".fancybox-wrap").trigger("onReset").remove(), n.extend(s, {
                group: {},
                opts: {},
                router: !1,
                current: null,
                isActive: !1,
                isOpened: !1,
                isOpen: !1,
                isClosing: !1,
                wrap: null,
                skin: null,
                outer: null,
                inner: null
            }), s.trigger("afterClose", e)
        }
    }), s.transitions = {
        getOrigPosition: function () {
            var e = s.current, t = e.element, n = e.orig, i = {}, o = 50, a = 50, r = e.hPadding, l = e.wPadding,
                c = s.getViewport();
            return !n && e.isDom && t.is(":visible") && (n = t.find("img:first"), n.length || (n = t)), p(n) ? (i = n.offset(), n.is("img") && (o = n.outerWidth(), a = n.outerHeight())) : (i.top = c.y + (c.h - a) * e.topRatio, i.left = c.x + (c.w - o) * e.leftRatio), ("fixed" === s.wrap.css("position") || e.locked) && (i.top -= c.y, i.left -= c.x), i = {
                top: m(i.top - r * e.topRatio),
                left: m(i.left - l * e.leftRatio),
                width: m(o + l),
                height: m(a + r)
            }
        }, step: function (e, t) {
            var n, i, o, a = t.prop, r = s.current, l = r.wrapSpace, c = r.skinSpace;
            ("width" === a || "height" === a) && (n = t.end === t.start ? 1 : (e - t.start) / (t.end - t.start), s.isClosing && (n = 1 - n), i = "width" === a ? r.wPadding : r.hPadding, o = e - i, s.skin[a](g("width" === a ? o : o - l * n)), s.inner[a](g("width" === a ? o : o - l * n - c * n)))
        }, zoomIn: function () {
            var e = s.current, t = e.pos, i = e.openEffect, o = "elastic" === i, a = n.extend({opacity: 1}, t);
            delete a.position, o ? (t = this.getOrigPosition(), e.openOpacity && (t.opacity = .1)) : "fade" === i && (t.opacity = .1), s.wrap.css(t).animate(a, {
                duration: "none" === i ? 0 : e.openSpeed,
                easing: e.openEasing,
                step: o ? this.step : null,
                complete: s._afterZoomIn
            })
        }, zoomOut: function () {
            var e = s.current, t = e.closeEffect, n = "elastic" === t, i = {opacity: .1};
            n && (i = this.getOrigPosition(), e.closeOpacity && (i.opacity = .1)), s.wrap.animate(i, {
                duration: "none" === t ? 0 : e.closeSpeed,
                easing: e.closeEasing,
                step: n ? this.step : null,
                complete: s._afterZoomOut
            })
        }, changeIn: function () {
            var e, t = s.current, n = t.nextEffect, i = t.pos, o = {opacity: 1}, a = s.direction, r = 200;
            i.opacity = .1, "elastic" === n && (e = "down" === a || "up" === a ? "top" : "left", "down" === a || "right" === a ? (i[e] = m(g(i[e]) - r), o[e] = "+=" + r + "px") : (i[e] = m(g(i[e]) + r), o[e] = "-=" + r + "px")), "none" === n ? s._afterZoomIn() : s.wrap.css(i).animate(o, {
                duration: t.nextSpeed,
                easing: t.nextEasing,
                complete: s._afterZoomIn
            })
        }, changeOut: function () {
            var e = s.previous, t = e.prevEffect, i = {opacity: .1}, o = s.direction, a = 200;
            "elastic" === t && (i["down" === o || "up" === o ? "top" : "left"] = ("up" === o || "left" === o ? "-" : "+") + "=" + a + "px"), e.wrap.animate(i, {
                duration: "none" === t ? 0 : e.prevSpeed,
                easing: e.prevEasing,
                complete: function () {
                    n(this).trigger("onReset").remove()
                }
            })
        }
    }, s.helpers.overlay = {
        defaults: {closeClick: !0, speedOut: 200, showEarly: !0, css: {}, locked: !d, fixed: !0},
        overlay: null,
        fixed: !1,
        el: n("html"),
        create: function (e) {
            e = n.extend({}, this.defaults, e), this.overlay && this.close(), this.overlay = n('<div class="fancybox-overlay"></div>').appendTo(s.coming ? s.coming.parent : e.parent), this.fixed = !1, e.fixed && s.defaults.fixed && (this.overlay.addClass("fancybox-overlay-fixed"), this.fixed = !0)
        },
        open: function (e) {
            var t = this;
            e = n.extend({}, this.defaults, e), this.overlay ? this.overlay.unbind(".overlay").width("auto").height("auto") : this.create(e), this.fixed || (a.bind("resize.overlay", n.proxy(this.update, this)), this.update()), e.closeClick && this.overlay.bind("click.overlay", function (e) {
                return n(e.target).hasClass("fancybox-overlay") ? (s.isActive ? s.close() : t.close(), !1) : void 0
            }), this.overlay.css(e.css).show()
        },
        close: function () {
            var e, t;
            a.unbind("resize.overlay"), this.el.hasClass("fancybox-lock") && (n(".fancybox-margin").removeClass("fancybox-margin"), e = a.scrollTop(), t = a.scrollLeft(), this.el.removeClass("fancybox-lock"), a.scrollTop(e).scrollLeft(t)), n(".fancybox-overlay").remove().hide(), n.extend(this, {
                overlay: null,
                fixed: !1
            })
        },
        update: function () {
            var e, n = "100%";
            this.overlay.width(n).height("100%"), l ? (e = Math.max(t.documentElement.offsetWidth, t.body.offsetWidth), r.width() > e && (n = r.width())) : r.width() > a.width() && (n = r.width()), this.overlay.width(n).height(r.height())
        },
        onReady: function (e, t) {
            var i = this.overlay;
            n(".fancybox-overlay").stop(!0, !0), i || this.create(e), e.locked && this.fixed && t.fixed && (i || (this.margin = r.height() > a.height() ? n("html").css("margin-right").replace("px", "") : !1), t.locked = this.overlay.append(t.wrap), t.fixed = !1), e.showEarly === !0 && this.beforeShow.apply(this, arguments)
        },
        beforeShow: function (e, t) {
            var i, o;
            t.locked && (this.margin !== !1 && (n("*").filter(function () {
                return "fixed" === n(this).css("position") && !n(this).hasClass("fancybox-overlay") && !n(this).hasClass("fancybox-wrap")
            }).addClass("fancybox-margin"), this.el.addClass("fancybox-margin")), i = a.scrollTop(), o = a.scrollLeft(), this.el.addClass("fancybox-lock"), a.scrollTop(i).scrollLeft(o)), this.open(e)
        },
        onUpdate: function () {
            this.fixed || this.update()
        },
        afterClose: function (e) {
            this.overlay && !s.coming && this.overlay.fadeOut(e.speedOut, n.proxy(this.close, this))
        }
    }, s.helpers.title = {
        defaults: {type: "float", position: "bottom"}, beforeShow: function (e) {
            var t, i, o = s.current, a = o.title, r = e.type;
            if (n.isFunction(a) && (a = a.call(o.element, o)), h(a) && "" !== n.trim(a)) {
                switch (t = n('<div class="fancybox-title fancybox-title-' + r + '-wrap">' + a + "</div>"), r) {
                    case"inside":
                        i = s.skin;
                        break;
                    case"outside":
                        i = s.wrap;
                        break;
                    case"over":
                        i = s.inner;
                        break;
                    default:
                        i = s.skin, t.appendTo("body"), l && t.width(t.width()), t.wrapInner('<span class="child"></span>'), s.current.margin[2] += Math.abs(g(t.css("margin-bottom")))
                }
                t["top" === e.position ? "prependTo" : "appendTo"](i)
            }
        }
    }, n.fn.fancybox = function (e) {
        var t, i = n(this), o = this.selector || "", a = function (a) {
            var r, l, c = n(this).blur(), d = t;
            a.ctrlKey || a.altKey || a.shiftKey || a.metaKey || c.is(".fancybox-wrap") || (r = e.groupAttr || "data-fancybox-group", l = c.attr(r), l || (r = "rel", l = c.get(0)[r]), l && "" !== l && "nofollow" !== l && (c = o.length ? n(o) : i, c = c.filter("[" + r + '="' + l + '"]'), d = c.index(this)), e.index = d, s.open(c, e) !== !1 && a.preventDefault())
        };
        return e = e || {}, t = e.index || 0, o && e.live !== !1 ? r.undelegate(o, "click.fb-start").delegate(o + ":not('.fancybox-item, .fancybox-nav')", "click.fb-start", a) : i.unbind("click.fb-start").bind("click.fb-start", a), this.filter("[data-fancybox-start=1]").trigger("click"), this
    }, r.ready(function () {
        var t, a;
        n.scrollbarWidth === i && (n.scrollbarWidth = function () {
            var e = n('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo("body"),
                t = e.children(), i = t.innerWidth() - t.height(99).innerWidth();
            return e.remove(), i
        }), n.support.fixedPosition === i && (n.support.fixedPosition = function () {
            var e = n('<div style="position:fixed;top:20px;"></div>').appendTo("body"),
                t = 20 === e[0].offsetTop || 15 === e[0].offsetTop;
            return e.remove(), t
        }()), n.extend(s.defaults, {
            scrollbarWidth: n.scrollbarWidth(),
            fixed: n.support.fixedPosition,
            parent: n("body")
        }), t = n(e).width(), o.addClass("fancybox-lock-test"), a = n(e).width(), o.removeClass("fancybox-lock-test"), n("<style type='text/css'>.fancybox-margin{margin-right:" + (a - t) + "px;}</style>").appendTo("head")
    })
}(window, document, jQuery);
/***jquery.fancybox.js***/


/**SLICK.MIN.JS**/
/*
 Version: 1.5.9
 */
!function (a) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], a) : "undefined" != typeof exports ? module.exports = a(require("jquery")) : a(jQuery)
}(function (a) {
    "use strict";
    var b = window.Slick || {};
    b = function () {
        function c(c, d) {
            var f, e = this;
            e.defaults = {
                accessibility: !0,
                adaptiveHeight: !1,
                appendArrows: a(c),
                appendDots: a(c),
                arrows: !0,
                asNavFor: null,
                prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>',
                nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>',
                autoplay: !1,
                autoplaySpeed: 3e3,
                centerMode: !1,
                centerPadding: "50px",
                cssEase: "ease",
                customPaging: function (a, b) {
                    return '<button type="button" data-role="none" role="button" aria-required="false" tabindex="0">' + (b + 1) + "</button>"
                },
                dots: !1,
                dotsClass: "slick-dots",
                draggable: !0,
                easing: "linear",
                edgeFriction: .35,
                fade: !1,
                focusOnSelect: !1,
                infinite: !0,
                initialSlide: 0,
                lazyLoad: "ondemand",
                mobileFirst: !1,
                pauseOnHover: !0,
                pauseOnDotsHover: !1,
                respondTo: "window",
                responsive: null,
                rows: 1,
                rtl: !1,
                slide: "",
                slidesPerRow: 1,
                slidesToShow: 1,
                slidesToScroll: 1,
                speed: 500,
                swipe: !0,
                swipeToSlide: !1,
                touchMove: !0,
                touchThreshold: 5,
                useCSS: !0,
                useTransform: !1,
                variableWidth: !1,
                vertical: !1,
                verticalSwiping: !1,
                waitForAnimate: !0,
                zIndex: 1e3
            }, e.initials = {
                animating: !1,
                dragging: !1,
                autoPlayTimer: null,
                currentDirection: 0,
                currentLeft: null,
                currentSlide: 0,
                direction: 1,
                $dots: null,
                listWidth: null,
                listHeight: null,
                loadIndex: 0,
                $nextArrow: null,
                $prevArrow: null,
                slideCount: null,
                slideWidth: null,
                $slideTrack: null,
                $slides: null,
                sliding: !1,
                slideOffset: 0,
                swipeLeft: null,
                $list: null,
                touchObject: {},
                transformsEnabled: !1,
                unslicked: !1
            }, a.extend(e, e.initials), e.activeBreakpoint = null, e.animType = null, e.animProp = null, e.breakpoints = [], e.breakpointSettings = [], e.cssTransitions = !1, e.hidden = "hidden", e.paused = !1, e.positionProp = null, e.respondTo = null, e.rowCount = 1, e.shouldClick = !0, e.$slider = a(c), e.$slidesCache = null, e.transformType = null, e.transitionType = null, e.visibilityChange = "visibilitychange", e.windowWidth = 0, e.windowTimer = null, f = a(c).data("slick") || {}, e.options = a.extend({}, e.defaults, f, d), e.currentSlide = e.options.initialSlide, e.originalSettings = e.options, "undefined" != typeof document.mozHidden ? (e.hidden = "mozHidden", e.visibilityChange = "mozvisibilitychange") : "undefined" != typeof document.webkitHidden && (e.hidden = "webkitHidden", e.visibilityChange = "webkitvisibilitychange"), e.autoPlay = a.proxy(e.autoPlay, e), e.autoPlayClear = a.proxy(e.autoPlayClear, e), e.changeSlide = a.proxy(e.changeSlide, e), e.clickHandler = a.proxy(e.clickHandler, e), e.selectHandler = a.proxy(e.selectHandler, e), e.setPosition = a.proxy(e.setPosition, e), e.swipeHandler = a.proxy(e.swipeHandler, e), e.dragHandler = a.proxy(e.dragHandler, e), e.keyHandler = a.proxy(e.keyHandler, e), e.autoPlayIterator = a.proxy(e.autoPlayIterator, e), e.instanceUid = b++, e.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, e.registerBreakpoints(), e.init(!0), e.checkResponsive(!0)
        }

        var b = 0;
        return c
    }(), b.prototype.addSlide = b.prototype.slickAdd = function (b, c, d) {
        var e = this;
        if ("boolean" == typeof c) d = c, c = null; else if (0 > c || c >= e.slideCount) return !1;
        e.unload(), "number" == typeof c ? 0 === c && 0 === e.$slides.length ? a(b).appendTo(e.$slideTrack) : d ? a(b).insertBefore(e.$slides.eq(c)) : a(b).insertAfter(e.$slides.eq(c)) : d === !0 ? a(b).prependTo(e.$slideTrack) : a(b).appendTo(e.$slideTrack), e.$slides = e.$slideTrack.children(this.options.slide), e.$slideTrack.children(this.options.slide).detach(), e.$slideTrack.append(e.$slides), e.$slides.each(function (b, c) {
            a(c).attr("data-slick-index", b)
        }), e.$slidesCache = e.$slides, e.reinit()
    }, b.prototype.animateHeight = function () {
        var a = this;
        if (1 === a.options.slidesToShow && a.options.adaptiveHeight === !0 && a.options.vertical === !1) {
            var b = a.$slides.eq(a.currentSlide).outerHeight(!0);
            a.$list.animate({height: b}, a.options.speed)
        }
    }, b.prototype.animateSlide = function (b, c) {
        var d = {}, e = this;
        e.animateHeight(), e.options.rtl === !0 && e.options.vertical === !1 && (b = -b), e.transformsEnabled === !1 ? e.options.vertical === !1 ? e.$slideTrack.animate({left: b}, e.options.speed, e.options.easing, c) : e.$slideTrack.animate({top: b}, e.options.speed, e.options.easing, c) : e.cssTransitions === !1 ? (e.options.rtl === !0 && (e.currentLeft = -e.currentLeft), a({animStart: e.currentLeft}).animate({animStart: b}, {
            duration: e.options.speed,
            easing: e.options.easing,
            step: function (a) {
                a = Math.ceil(a), e.options.vertical === !1 ? (d[e.animType] = "translate(" + a + "px, 0px)", e.$slideTrack.css(d)) : (d[e.animType] = "translate(0px," + a + "px)", e.$slideTrack.css(d))
            },
            complete: function () {
                c && c.call()
            }
        })) : (e.applyTransition(), b = Math.ceil(b), e.options.vertical === !1 ? d[e.animType] = "translate3d(" + b + "px, 0px, 0px)" : d[e.animType] = "translate3d(0px," + b + "px, 0px)", e.$slideTrack.css(d), c && setTimeout(function () {
            e.disableTransition(), c.call()
        }, e.options.speed))
    }, b.prototype.asNavFor = function (b) {
        var c = this, d = c.options.asNavFor;
        d && null !== d && (d = a(d).not(c.$slider)), null !== d && "object" == typeof d && d.each(function () {
            var c = a(this).slick("getSlick");
            c.unslicked || c.slideHandler(b, !0)
        })
    }, b.prototype.applyTransition = function (a) {
        var b = this, c = {};
        b.options.fade === !1 ? c[b.transitionType] = b.transformType + " " + b.options.speed + "ms " + b.options.cssEase : c[b.transitionType] = "opacity " + b.options.speed + "ms " + b.options.cssEase, b.options.fade === !1 ? b.$slideTrack.css(c) : b.$slides.eq(a).css(c)
    }, b.prototype.autoPlay = function () {
        var a = this;
        a.autoPlayTimer && clearInterval(a.autoPlayTimer), a.slideCount > a.options.slidesToShow && a.paused !== !0 && (a.autoPlayTimer = setInterval(a.autoPlayIterator, a.options.autoplaySpeed))
    }, b.prototype.autoPlayClear = function () {
        var a = this;
        a.autoPlayTimer && clearInterval(a.autoPlayTimer)
    }, b.prototype.autoPlayIterator = function () {
        var a = this;
        a.options.infinite === !1 ? 1 === a.direction ? (a.currentSlide + 1 === a.slideCount - 1 && (a.direction = 0), a.slideHandler(a.currentSlide + a.options.slidesToScroll)) : (a.currentSlide - 1 === 0 && (a.direction = 1), a.slideHandler(a.currentSlide - a.options.slidesToScroll)) : a.slideHandler(a.currentSlide + a.options.slidesToScroll)
    }, b.prototype.buildArrows = function () {
        var b = this;
        b.options.arrows === !0 && (b.$prevArrow = a(b.options.prevArrow).addClass("slick-arrow"), b.$nextArrow = a(b.options.nextArrow).addClass("slick-arrow"), b.slideCount > b.options.slidesToShow ? (b.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), b.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), b.htmlExpr.test(b.options.prevArrow) && b.$prevArrow.prependTo(b.options.appendArrows), b.htmlExpr.test(b.options.nextArrow) && b.$nextArrow.appendTo(b.options.appendArrows), b.options.infinite !== !0 && b.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true")) : b.$prevArrow.add(b.$nextArrow).addClass("slick-hidden").attr({
            "aria-disabled": "true",
            tabindex: "-1"
        }))
    }, b.prototype.buildDots = function () {
        var c, d, b = this;
        if (b.options.dots === !0 && b.slideCount > b.options.slidesToShow) {
            for (d = '<ul class="' + b.options.dotsClass + '">', c = 0; c <= b.getDotCount(); c += 1) d += "<li>" + b.options.customPaging.call(this, b, c) + "</li>";
            d += "</ul>", b.$dots = a(d).appendTo(b.options.appendDots), b.$dots.find("li").first().addClass("slick-active").attr("aria-hidden", "false")
        }
    }, b.prototype.buildOut = function () {
        var b = this;
        b.$slides = b.$slider.children(b.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), b.slideCount = b.$slides.length, b.$slides.each(function (b, c) {
            a(c).attr("data-slick-index", b).data("originalStyling", a(c).attr("style") || "")
        }), b.$slider.addClass("slick-slider"), b.$slideTrack = 0 === b.slideCount ? a('<div class="slick-track"/>').appendTo(b.$slider) : b.$slides.wrapAll('<div class="slick-track"/>').parent(), b.$list = b.$slideTrack.wrap('<div aria-live="polite" class="slick-list"/>').parent(), b.$slideTrack.css("opacity", 0), (b.options.centerMode === !0 || b.options.swipeToSlide === !0) && (b.options.slidesToScroll = 1), a("img[data-lazy]", b.$slider).not("[src]").addClass("slick-loading"), b.setupInfinite(), b.buildArrows(), b.buildDots(), b.updateDots(), b.setSlideClasses("number" == typeof b.currentSlide ? b.currentSlide : 0), b.options.draggable === !0 && b.$list.addClass("draggable")
    }, b.prototype.buildRows = function () {
        var b, c, d, e, f, g, h, a = this;
        if (e = document.createDocumentFragment(), g = a.$slider.children(), a.options.rows > 1) {
            for (h = a.options.slidesPerRow * a.options.rows, f = Math.ceil(g.length / h), b = 0; f > b; b++) {
                var i = document.createElement("div");
                for (c = 0; c < a.options.rows; c++) {
                    var j = document.createElement("div");
                    for (d = 0; d < a.options.slidesPerRow; d++) {
                        var k = b * h + (c * a.options.slidesPerRow + d);
                        g.get(k) && j.appendChild(g.get(k))
                    }
                    i.appendChild(j)
                }
                e.appendChild(i)
            }
            a.$slider.html(e), a.$slider.children().children().children().css({
                width: 100 / a.options.slidesPerRow + "%",
                display: "inline-block"
            })
        }
    }, b.prototype.checkResponsive = function (b, c) {
        var e, f, g, d = this, h = !1, i = d.$slider.width(), j = window.innerWidth || a(window).width();
        if ("window" === d.respondTo ? g = j : "slider" === d.respondTo ? g = i : "min" === d.respondTo && (g = Math.min(j, i)), d.options.responsive && d.options.responsive.length && null !== d.options.responsive) {
            f = null;
            for (e in d.breakpoints) d.breakpoints.hasOwnProperty(e) && (d.originalSettings.mobileFirst === !1 ? g < d.breakpoints[e] && (f = d.breakpoints[e]) : g > d.breakpoints[e] && (f = d.breakpoints[e]));
            null !== f ? null !== d.activeBreakpoint ? (f !== d.activeBreakpoint || c) && (d.activeBreakpoint = f, "unslick" === d.breakpointSettings[f] ? d.unslick(f) : (d.options = a.extend({}, d.originalSettings, d.breakpointSettings[f]), b === !0 && (d.currentSlide = d.options.initialSlide), d.refresh(b)), h = f) : (d.activeBreakpoint = f, "unslick" === d.breakpointSettings[f] ? d.unslick(f) : (d.options = a.extend({}, d.originalSettings, d.breakpointSettings[f]), b === !0 && (d.currentSlide = d.options.initialSlide), d.refresh(b)), h = f) : null !== d.activeBreakpoint && (d.activeBreakpoint = null, d.options = d.originalSettings, b === !0 && (d.currentSlide = d.options.initialSlide), d.refresh(b), h = f), b || h === !1 || d.$slider.trigger("breakpoint", [d, h])
        }
    }, b.prototype.changeSlide = function (b, c) {
        var f, g, h, d = this, e = a(b.target);
        switch (e.is("a") && b.preventDefault(), e.is("li") || (e = e.closest("li")), h = d.slideCount % d.options.slidesToScroll !== 0, f = h ? 0 : (d.slideCount - d.currentSlide) % d.options.slidesToScroll, b.data.message) {
            case"previous":
                g = 0 === f ? d.options.slidesToScroll : d.options.slidesToShow - f, d.slideCount > d.options.slidesToShow && d.slideHandler(d.currentSlide - g, !1, c);
                break;
            case"next":
                g = 0 === f ? d.options.slidesToScroll : f, d.slideCount > d.options.slidesToShow && d.slideHandler(d.currentSlide + g, !1, c);
                break;
            case"index":
                var i = 0 === b.data.index ? 0 : b.data.index || e.index() * d.options.slidesToScroll;
                d.slideHandler(d.checkNavigable(i), !1, c), e.children().trigger("focus");
                break;
            default:
                return
        }
    }, b.prototype.checkNavigable = function (a) {
        var c, d, b = this;
        if (c = b.getNavigableIndexes(), d = 0, a > c[c.length - 1]) a = c[c.length - 1]; else for (var e in c) {
            if (a < c[e]) {
                a = d;
                break
            }
            d = c[e]
        }
        return a
    }, b.prototype.cleanUpEvents = function () {
        var b = this;
        b.options.dots && null !== b.$dots && (a("li", b.$dots).off("click.slick", b.changeSlide), b.options.pauseOnDotsHover === !0 && b.options.autoplay === !0 && a("li", b.$dots).off("mouseenter.slick", a.proxy(b.setPaused, b, !0)).off("mouseleave.slick", a.proxy(b.setPaused, b, !1))), b.options.arrows === !0 && b.slideCount > b.options.slidesToShow && (b.$prevArrow && b.$prevArrow.off("click.slick", b.changeSlide), b.$nextArrow && b.$nextArrow.off("click.slick", b.changeSlide)), b.$list.off("touchstart.slick mousedown.slick", b.swipeHandler), b.$list.off("touchmove.slick mousemove.slick", b.swipeHandler), b.$list.off("touchend.slick mouseup.slick", b.swipeHandler), b.$list.off("touchcancel.slick mouseleave.slick", b.swipeHandler), b.$list.off("click.slick", b.clickHandler), a(document).off(b.visibilityChange, b.visibility), b.$list.off("mouseenter.slick", a.proxy(b.setPaused, b, !0)), b.$list.off("mouseleave.slick", a.proxy(b.setPaused, b, !1)), b.options.accessibility === !0 && b.$list.off("keydown.slick", b.keyHandler), b.options.focusOnSelect === !0 && a(b.$slideTrack).children().off("click.slick", b.selectHandler), a(window).off("orientationchange.slick.slick-" + b.instanceUid, b.orientationChange), a(window).off("resize.slick.slick-" + b.instanceUid, b.resize), a("[draggable!=true]", b.$slideTrack).off("dragstart", b.preventDefault), a(window).off("load.slick.slick-" + b.instanceUid, b.setPosition), a(document).off("ready.slick.slick-" + b.instanceUid, b.setPosition)
    }, b.prototype.cleanUpRows = function () {
        var b, a = this;
        a.options.rows > 1 && (b = a.$slides.children().children(), b.removeAttr("style"), a.$slider.html(b))
    }, b.prototype.clickHandler = function (a) {
        var b = this;
        b.shouldClick === !1 && (a.stopImmediatePropagation(), a.stopPropagation(), a.preventDefault())
    }, b.prototype.destroy = function (b) {
        var c = this;
        c.autoPlayClear(), c.touchObject = {}, c.cleanUpEvents(), a(".slick-cloned", c.$slider).detach(), c.$dots && c.$dots.remove(), c.$prevArrow && c.$prevArrow.length && (c.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), c.htmlExpr.test(c.options.prevArrow) && c.$prevArrow.remove()), c.$nextArrow && c.$nextArrow.length && (c.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), c.htmlExpr.test(c.options.nextArrow) && c.$nextArrow.remove()), c.$slides && (c.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function () {
            a(this).attr("style", a(this).data("originalStyling"))
        }), c.$slideTrack.children(this.options.slide).detach(), c.$slideTrack.detach(), c.$list.detach(), c.$slider.append(c.$slides)), c.cleanUpRows(), c.$slider.removeClass("slick-slider"), c.$slider.removeClass("slick-initialized"), c.unslicked = !0, b || c.$slider.trigger("destroy", [c])
    }, b.prototype.disableTransition = function (a) {
        var b = this, c = {};
        c[b.transitionType] = "", b.options.fade === !1 ? b.$slideTrack.css(c) : b.$slides.eq(a).css(c)
    }, b.prototype.fadeSlide = function (a, b) {
        var c = this;
        c.cssTransitions === !1 ? (c.$slides.eq(a).css({zIndex: c.options.zIndex}), c.$slides.eq(a).animate({opacity: 1}, c.options.speed, c.options.easing, b)) : (c.applyTransition(a), c.$slides.eq(a).css({
            opacity: 1,
            zIndex: c.options.zIndex
        }), b && setTimeout(function () {
            c.disableTransition(a), b.call()
        }, c.options.speed))
    }, b.prototype.fadeSlideOut = function (a) {
        var b = this;
        b.cssTransitions === !1 ? b.$slides.eq(a).animate({
            opacity: 0,
            zIndex: b.options.zIndex - 2
        }, b.options.speed, b.options.easing) : (b.applyTransition(a), b.$slides.eq(a).css({
            opacity: 0,
            zIndex: b.options.zIndex - 2
        }))
    }, b.prototype.filterSlides = b.prototype.slickFilter = function (a) {
        var b = this;
        null !== a && (b.$slidesCache = b.$slides, b.unload(), b.$slideTrack.children(this.options.slide).detach(), b.$slidesCache.filter(a).appendTo(b.$slideTrack), b.reinit())
    }, b.prototype.getCurrent = b.prototype.slickCurrentSlide = function () {
        var a = this;
        return a.currentSlide
    }, b.prototype.getDotCount = function () {
        var a = this, b = 0, c = 0, d = 0;
        if (a.options.infinite === !0) for (; b < a.slideCount;) ++d, b = c + a.options.slidesToScroll, c += a.options.slidesToScroll <= a.options.slidesToShow ? a.options.slidesToScroll : a.options.slidesToShow; else if (a.options.centerMode === !0) d = a.slideCount; else for (; b < a.slideCount;) ++d, b = c + a.options.slidesToScroll, c += a.options.slidesToScroll <= a.options.slidesToShow ? a.options.slidesToScroll : a.options.slidesToShow;
        return d - 1
    }, b.prototype.getLeft = function (a) {
        var c, d, f, b = this, e = 0;
        return b.slideOffset = 0, d = b.$slides.first().outerHeight(!0), b.options.infinite === !0 ? (b.slideCount > b.options.slidesToShow && (b.slideOffset = b.slideWidth * b.options.slidesToShow * -1, e = d * b.options.slidesToShow * -1), b.slideCount % b.options.slidesToScroll !== 0 && a + b.options.slidesToScroll > b.slideCount && b.slideCount > b.options.slidesToShow && (a > b.slideCount ? (b.slideOffset = (b.options.slidesToShow - (a - b.slideCount)) * b.slideWidth * -1, e = (b.options.slidesToShow - (a - b.slideCount)) * d * -1) : (b.slideOffset = b.slideCount % b.options.slidesToScroll * b.slideWidth * -1, e = b.slideCount % b.options.slidesToScroll * d * -1))) : a + b.options.slidesToShow > b.slideCount && (b.slideOffset = (a + b.options.slidesToShow - b.slideCount) * b.slideWidth, e = (a + b.options.slidesToShow - b.slideCount) * d), b.slideCount <= b.options.slidesToShow && (b.slideOffset = 0, e = 0), b.options.centerMode === !0 && b.options.infinite === !0 ? b.slideOffset += b.slideWidth * Math.floor(b.options.slidesToShow / 2) - b.slideWidth : b.options.centerMode === !0 && (b.slideOffset = 0, b.slideOffset += b.slideWidth * Math.floor(b.options.slidesToShow / 2)), c = b.options.vertical === !1 ? a * b.slideWidth * -1 + b.slideOffset : a * d * -1 + e, b.options.variableWidth === !0 && (f = b.slideCount <= b.options.slidesToShow || b.options.infinite === !1 ? b.$slideTrack.children(".slick-slide").eq(a) : b.$slideTrack.children(".slick-slide").eq(a + b.options.slidesToShow), c = b.options.rtl === !0 ? f[0] ? -1 * (b.$slideTrack.width() - f[0].offsetLeft - f.width()) : 0 : f[0] ? -1 * f[0].offsetLeft : 0, b.options.centerMode === !0 && (f = b.slideCount <= b.options.slidesToShow || b.options.infinite === !1 ? b.$slideTrack.children(".slick-slide").eq(a) : b.$slideTrack.children(".slick-slide").eq(a + b.options.slidesToShow + 1), c = b.options.rtl === !0 ? f[0] ? -1 * (b.$slideTrack.width() - f[0].offsetLeft - f.width()) : 0 : f[0] ? -1 * f[0].offsetLeft : 0, c += (b.$list.width() - f.outerWidth()) / 2)), c
    }, b.prototype.getOption = b.prototype.slickGetOption = function (a) {
        var b = this;
        return b.options[a]
    }, b.prototype.getNavigableIndexes = function () {
        var e, a = this, b = 0, c = 0, d = [];
        for (a.options.infinite === !1 ? e = a.slideCount : (b = -1 * a.options.slidesToScroll, c = -1 * a.options.slidesToScroll, e = 2 * a.slideCount); e > b;) d.push(b), b = c + a.options.slidesToScroll, c += a.options.slidesToScroll <= a.options.slidesToShow ? a.options.slidesToScroll : a.options.slidesToShow;
        return d
    }, b.prototype.getSlick = function () {
        return this
    }, b.prototype.getSlideCount = function () {
        var c, d, e, b = this;
        return e = b.options.centerMode === !0 ? b.slideWidth * Math.floor(b.options.slidesToShow / 2) : 0, b.options.swipeToSlide === !0 ? (b.$slideTrack.find(".slick-slide").each(function (c, f) {
            return f.offsetLeft - e + a(f).outerWidth() / 2 > -1 * b.swipeLeft ? (d = f, !1) : void 0
        }), c = Math.abs(a(d).attr("data-slick-index") - b.currentSlide) || 1) : b.options.slidesToScroll
    }, b.prototype.goTo = b.prototype.slickGoTo = function (a, b) {
        var c = this;
        c.changeSlide({data: {message: "index", index: parseInt(a)}}, b)
    }, b.prototype.init = function (b) {
        var c = this;
        a(c.$slider).hasClass("slick-initialized") || (a(c.$slider).addClass("slick-initialized"), c.buildRows(), c.buildOut(), c.setProps(), c.startLoad(), c.loadSlider(), c.initializeEvents(), c.updateArrows(), c.updateDots()), b && c.$slider.trigger("init", [c]), c.options.accessibility === !0 && c.initADA()
    }, b.prototype.initArrowEvents = function () {
        var a = this;
        a.options.arrows === !0 && a.slideCount > a.options.slidesToShow && (a.$prevArrow.on("click.slick", {message: "previous"}, a.changeSlide), a.$nextArrow.on("click.slick", {message: "next"}, a.changeSlide))
    }, b.prototype.initDotEvents = function () {
        var b = this;
        b.options.dots === !0 && b.slideCount > b.options.slidesToShow && a("li", b.$dots).on("click.slick", {message: "index"}, b.changeSlide), b.options.dots === !0 && b.options.pauseOnDotsHover === !0 && b.options.autoplay === !0 && a("li", b.$dots).on("mouseenter.slick", a.proxy(b.setPaused, b, !0)).on("mouseleave.slick", a.proxy(b.setPaused, b, !1))
    }, b.prototype.initializeEvents = function () {
        var b = this;
        b.initArrowEvents(), b.initDotEvents(), b.$list.on("touchstart.slick mousedown.slick", {action: "start"}, b.swipeHandler), b.$list.on("touchmove.slick mousemove.slick", {action: "move"}, b.swipeHandler), b.$list.on("touchend.slick mouseup.slick", {action: "end"}, b.swipeHandler), b.$list.on("touchcancel.slick mouseleave.slick", {action: "end"}, b.swipeHandler), b.$list.on("click.slick", b.clickHandler), a(document).on(b.visibilityChange, a.proxy(b.visibility, b)), b.$list.on("mouseenter.slick", a.proxy(b.setPaused, b, !0)), b.$list.on("mouseleave.slick", a.proxy(b.setPaused, b, !1)), b.options.accessibility === !0 && b.$list.on("keydown.slick", b.keyHandler), b.options.focusOnSelect === !0 && a(b.$slideTrack).children().on("click.slick", b.selectHandler), a(window).on("orientationchange.slick.slick-" + b.instanceUid, a.proxy(b.orientationChange, b)), a(window).on("resize.slick.slick-" + b.instanceUid, a.proxy(b.resize, b)), a("[draggable!=true]", b.$slideTrack).on("dragstart", b.preventDefault), a(window).on("load.slick.slick-" + b.instanceUid, b.setPosition), a(document).on("ready.slick.slick-" + b.instanceUid, b.setPosition)
    }, b.prototype.initUI = function () {
        var a = this;
        a.options.arrows === !0 && a.slideCount > a.options.slidesToShow && (a.$prevArrow.show(), a.$nextArrow.show()), a.options.dots === !0 && a.slideCount > a.options.slidesToShow && a.$dots.show(), a.options.autoplay === !0 && a.autoPlay()
    }, b.prototype.keyHandler = function (a) {
        var b = this;
        a.target.tagName.match("TEXTAREA|INPUT|SELECT") || (37 === a.keyCode && b.options.accessibility === !0 ? b.changeSlide({data: {message: "previous"}}) : 39 === a.keyCode && b.options.accessibility === !0 && b.changeSlide({data: {message: "next"}}))
    }, b.prototype.lazyLoad = function () {
        function g(b) {
            a("img[data-lazy]", b).each(function () {
                var b = a(this), c = a(this).attr("data-lazy"), d = document.createElement("img");
                d.onload = function () {
                    b.animate({opacity: 0}, 100, function () {
                        b.attr("src", c).animate({opacity: 1}, 200, function () {
                            b.removeAttr("data-lazy").removeClass("slick-loading")
                        })
                    })
                }, d.src = c
            })
        }

        var c, d, e, f, b = this;
        b.options.centerMode === !0 ? b.options.infinite === !0 ? (e = b.currentSlide + (b.options.slidesToShow / 2 + 1), f = e + b.options.slidesToShow + 2) : (e = Math.max(0, b.currentSlide - (b.options.slidesToShow / 2 + 1)), f = 2 + (b.options.slidesToShow / 2 + 1) + b.currentSlide) : (e = b.options.infinite ? b.options.slidesToShow + b.currentSlide : b.currentSlide, f = e + b.options.slidesToShow, b.options.fade === !0 && (e > 0 && e--, f <= b.slideCount && f++)), c = b.$slider.find(".slick-slide").slice(e, f), g(c), b.slideCount <= b.options.slidesToShow ? (d = b.$slider.find(".slick-slide"), g(d)) : b.currentSlide >= b.slideCount - b.options.slidesToShow ? (d = b.$slider.find(".slick-cloned").slice(0, b.options.slidesToShow), g(d)) : 0 === b.currentSlide && (d = b.$slider.find(".slick-cloned").slice(-1 * b.options.slidesToShow), g(d))
    }, b.prototype.loadSlider = function () {
        var a = this;
        a.setPosition(), a.$slideTrack.css({opacity: 1}), a.$slider.removeClass("slick-loading"), a.initUI(), "progressive" === a.options.lazyLoad && a.progressiveLazyLoad()
    }, b.prototype.next = b.prototype.slickNext = function () {
        var a = this;
        a.changeSlide({data: {message: "next"}})
    }, b.prototype.orientationChange = function () {
        var a = this;
        a.checkResponsive(), a.setPosition()
    }, b.prototype.pause = b.prototype.slickPause = function () {
        var a = this;
        a.autoPlayClear(), a.paused = !0
    }, b.prototype.play = b.prototype.slickPlay = function () {
        var a = this;
        a.paused = !1, a.autoPlay()
    }, b.prototype.postSlide = function (a) {
        var b = this;
        b.$slider.trigger("afterChange", [b, a]), b.animating = !1, b.setPosition(), b.swipeLeft = null, b.options.autoplay === !0 && b.paused === !1 && b.autoPlay(), b.options.accessibility === !0 && b.initADA()
    }, b.prototype.prev = b.prototype.slickPrev = function () {
        var a = this;
        a.changeSlide({data: {message: "previous"}})
    }, b.prototype.preventDefault = function (a) {
        a.preventDefault()
    }, b.prototype.progressiveLazyLoad = function () {
        var c, d, b = this;
        c = a("img[data-lazy]", b.$slider).length, c > 0 && (d = a("img[data-lazy]", b.$slider).first(), d.attr("src", null), d.attr("src", d.attr("data-lazy")).removeClass("slick-loading").load(function () {
            d.removeAttr("data-lazy"), b.progressiveLazyLoad(), b.options.adaptiveHeight === !0 && b.setPosition()
        }).error(function () {
            d.removeAttr("data-lazy"), b.progressiveLazyLoad()
        }))
    }, b.prototype.refresh = function (b) {
        var d, e, c = this;
        e = c.slideCount - c.options.slidesToShow, c.options.infinite || (c.slideCount <= c.options.slidesToShow ? c.currentSlide = 0 : c.currentSlide > e && (c.currentSlide = e)), d = c.currentSlide, c.destroy(!0), a.extend(c, c.initials, {currentSlide: d}), c.init(), b || c.changeSlide({
            data: {
                message: "index",
                index: d
            }
        }, !1)
    }, b.prototype.registerBreakpoints = function () {
        var c, d, e, b = this, f = b.options.responsive || null;
        if ("array" === a.type(f) && f.length) {
            b.respondTo = b.options.respondTo || "window";
            for (c in f) if (e = b.breakpoints.length - 1, d = f[c].breakpoint, f.hasOwnProperty(c)) {
                for (; e >= 0;) b.breakpoints[e] && b.breakpoints[e] === d && b.breakpoints.splice(e, 1), e--;
                b.breakpoints.push(d), b.breakpointSettings[d] = f[c].settings
            }
            b.breakpoints.sort(function (a, c) {
                return b.options.mobileFirst ? a - c : c - a
            })
        }
    }, b.prototype.reinit = function () {
        var b = this;
        b.$slides = b.$slideTrack.children(b.options.slide).addClass("slick-slide"), b.slideCount = b.$slides.length, b.currentSlide >= b.slideCount && 0 !== b.currentSlide && (b.currentSlide = b.currentSlide - b.options.slidesToScroll), b.slideCount <= b.options.slidesToShow && (b.currentSlide = 0), b.registerBreakpoints(), b.setProps(), b.setupInfinite(), b.buildArrows(), b.updateArrows(), b.initArrowEvents(), b.buildDots(), b.updateDots(), b.initDotEvents(), b.checkResponsive(!1, !0), b.options.focusOnSelect === !0 && a(b.$slideTrack).children().on("click.slick", b.selectHandler), b.setSlideClasses(0), b.setPosition(), b.$slider.trigger("reInit", [b]), b.options.autoplay === !0 && b.focusHandler()
    }, b.prototype.resize = function () {
        var b = this;
        a(window).width() !== b.windowWidth && (clearTimeout(b.windowDelay), b.windowDelay = window.setTimeout(function () {
            b.windowWidth = a(window).width(), b.checkResponsive(), b.unslicked || b.setPosition()
        }, 50))
    }, b.prototype.removeSlide = b.prototype.slickRemove = function (a, b, c) {
        var d = this;
        return "boolean" == typeof a ? (b = a, a = b === !0 ? 0 : d.slideCount - 1) : a = b === !0 ? --a : a, d.slideCount < 1 || 0 > a || a > d.slideCount - 1 ? !1 : (d.unload(), c === !0 ? d.$slideTrack.children().remove() : d.$slideTrack.children(this.options.slide).eq(a).remove(), d.$slides = d.$slideTrack.children(this.options.slide), d.$slideTrack.children(this.options.slide).detach(), d.$slideTrack.append(d.$slides), d.$slidesCache = d.$slides, void d.reinit())
    }, b.prototype.setCSS = function (a) {
        var d, e, b = this, c = {};
        b.options.rtl === !0 && (a = -a), d = "left" == b.positionProp ? Math.ceil(a) + "px" : "0px", e = "top" == b.positionProp ? Math.ceil(a) + "px" : "0px", c[b.positionProp] = a, b.transformsEnabled === !1 ? b.$slideTrack.css(c) : (c = {}, b.cssTransitions === !1 ? (c[b.animType] = "translate(" + d + ", " + e + ")", b.$slideTrack.css(c)) : (c[b.animType] = "translate3d(" + d + ", " + e + ", 0px)", b.$slideTrack.css(c)))
    }, b.prototype.setDimensions = function () {
        var a = this;
        a.options.vertical === !1 ? a.options.centerMode === !0 && a.$list.css({padding: "0px " + a.options.centerPadding}) : (a.$list.height(a.$slides.first().outerHeight(!0) * a.options.slidesToShow), a.options.centerMode === !0 && a.$list.css({padding: a.options.centerPadding + " 0px"})), a.listWidth = a.$list.width(), a.listHeight = a.$list.height(), a.options.vertical === !1 && a.options.variableWidth === !1 ? (a.slideWidth = Math.ceil(a.listWidth / a.options.slidesToShow), a.$slideTrack.width(Math.ceil(a.slideWidth * a.$slideTrack.children(".slick-slide").length))) : a.options.variableWidth === !0 ? a.$slideTrack.width(5e3 * a.slideCount) : (a.slideWidth = Math.ceil(a.listWidth), a.$slideTrack.height(Math.ceil(a.$slides.first().outerHeight(!0) * a.$slideTrack.children(".slick-slide").length)));
        var b = a.$slides.first().outerWidth(!0) - a.$slides.first().width();
        a.options.variableWidth === !1 && a.$slideTrack.children(".slick-slide").width(a.slideWidth - b)
    }, b.prototype.setFade = function () {
        var c, b = this;
        b.$slides.each(function (d, e) {
            c = b.slideWidth * d * -1, b.options.rtl === !0 ? a(e).css({
                position: "relative",
                right: c,
                top: 0,
                zIndex: b.options.zIndex - 2,
                opacity: 0
            }) : a(e).css({position: "relative", left: c, top: 0, zIndex: b.options.zIndex - 2, opacity: 0})
        }), b.$slides.eq(b.currentSlide).css({zIndex: b.options.zIndex - 1, opacity: 1})
    }, b.prototype.setHeight = function () {
        var a = this;
        if (1 === a.options.slidesToShow && a.options.adaptiveHeight === !0 && a.options.vertical === !1) {
            var b = a.$slides.eq(a.currentSlide).outerHeight(!0);
            a.$list.css("height", b)
        }
    }, b.prototype.setOption = b.prototype.slickSetOption = function (b, c, d) {
        var f, g, e = this;
        if ("responsive" === b && "array" === a.type(c)) for (g in c) if ("array" !== a.type(e.options.responsive)) e.options.responsive = [c[g]]; else {
            for (f = e.options.responsive.length - 1; f >= 0;) e.options.responsive[f].breakpoint === c[g].breakpoint && e.options.responsive.splice(f, 1), f--;
            e.options.responsive.push(c[g])
        } else e.options[b] = c;
        d === !0 && (e.unload(), e.reinit())
    }, b.prototype.setPosition = function () {
        var a = this;
        a.setDimensions(), a.setHeight(), a.options.fade === !1 ? a.setCSS(a.getLeft(a.currentSlide)) : a.setFade(), a.$slider.trigger("setPosition", [a])
    }, b.prototype.setProps = function () {
        var a = this, b = document.body.style;
        a.positionProp = a.options.vertical === !0 ? "top" : "left", "top" === a.positionProp ? a.$slider.addClass("slick-vertical") : a.$slider.removeClass("slick-vertical"), (void 0 !== b.WebkitTransition || void 0 !== b.MozTransition || void 0 !== b.msTransition) && a.options.useCSS === !0 && (a.cssTransitions = !0), a.options.fade && ("number" == typeof a.options.zIndex ? a.options.zIndex < 3 && (a.options.zIndex = 3) : a.options.zIndex = a.defaults.zIndex), void 0 !== b.OTransform && (a.animType = "OTransform", a.transformType = "-o-transform", a.transitionType = "OTransition", void 0 === b.perspectiveProperty && void 0 === b.webkitPerspective && (a.animType = !1)), void 0 !== b.MozTransform && (a.animType = "MozTransform", a.transformType = "-moz-transform", a.transitionType = "MozTransition", void 0 === b.perspectiveProperty && void 0 === b.MozPerspective && (a.animType = !1)), void 0 !== b.webkitTransform && (a.animType = "webkitTransform", a.transformType = "-webkit-transform", a.transitionType = "webkitTransition", void 0 === b.perspectiveProperty && void 0 === b.webkitPerspective && (a.animType = !1)), void 0 !== b.msTransform && (a.animType = "msTransform", a.transformType = "-ms-transform", a.transitionType = "msTransition", void 0 === b.msTransform && (a.animType = !1)), void 0 !== b.transform && a.animType !== !1 && (a.animType = "transform", a.transformType = "transform", a.transitionType = "transition"), a.transformsEnabled = a.options.useTransform && null !== a.animType && a.animType !== !1
    }, b.prototype.setSlideClasses = function (a) {
        var c, d, e, f, b = this;
        d = b.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden", "true"), b.$slides.eq(a).addClass("slick-current"), b.options.centerMode === !0 ? (c = Math.floor(b.options.slidesToShow / 2), b.options.infinite === !0 && (a >= c && a <= b.slideCount - 1 - c ? b.$slides.slice(a - c, a + c + 1).addClass("slick-active").attr("aria-hidden", "false") : (e = b.options.slidesToShow + a, d.slice(e - c + 1, e + c + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === a ? d.eq(d.length - 1 - b.options.slidesToShow).addClass("slick-center") : a === b.slideCount - 1 && d.eq(b.options.slidesToShow).addClass("slick-center")), b.$slides.eq(a).addClass("slick-center")) : a >= 0 && a <= b.slideCount - b.options.slidesToShow ? b.$slides.slice(a, a + b.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : d.length <= b.options.slidesToShow ? d.addClass("slick-active").attr("aria-hidden", "false") : (f = b.slideCount % b.options.slidesToShow, e = b.options.infinite === !0 ? b.options.slidesToShow + a : a, b.options.slidesToShow == b.options.slidesToScroll && b.slideCount - a < b.options.slidesToShow ? d.slice(e - (b.options.slidesToShow - f), e + f).addClass("slick-active").attr("aria-hidden", "false") : d.slice(e, e + b.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false")), "ondemand" === b.options.lazyLoad && b.lazyLoad()
    }, b.prototype.setupInfinite = function () {
        var c, d, e, b = this;
        if (b.options.fade === !0 && (b.options.centerMode = !1), b.options.infinite === !0 && b.options.fade === !1 && (d = null, b.slideCount > b.options.slidesToShow)) {
            for (e = b.options.centerMode === !0 ? b.options.slidesToShow + 1 : b.options.slidesToShow, c = b.slideCount; c > b.slideCount - e; c -= 1) d = c - 1, a(b.$slides[d]).clone(!0).attr("id", "").attr("data-slick-index", d - b.slideCount).prependTo(b.$slideTrack).addClass("slick-cloned");
            for (c = 0; e > c; c += 1) d = c, a(b.$slides[d]).clone(!0).attr("id", "").attr("data-slick-index", d + b.slideCount).appendTo(b.$slideTrack).addClass("slick-cloned");
            b.$slideTrack.find(".slick-cloned").find("[id]").each(function () {
                a(this).attr("id", "")
            })
        }
    }, b.prototype.setPaused = function (a) {
        var b = this;
        b.options.autoplay === !0 && b.options.pauseOnHover === !0 && (b.paused = a, a ? b.autoPlayClear() : b.autoPlay())
    }, b.prototype.selectHandler = function (b) {
        var c = this, d = a(b.target).is(".slick-slide") ? a(b.target) : a(b.target).parents(".slick-slide"),
            e = parseInt(d.attr("data-slick-index"));
        return e || (e = 0), c.slideCount <= c.options.slidesToShow ? (c.setSlideClasses(e), void c.asNavFor(e)) : void c.slideHandler(e)
    }, b.prototype.slideHandler = function (a, b, c) {
        var d, e, f, g, h = null, i = this;
        return b = b || !1, i.animating === !0 && i.options.waitForAnimate === !0 || i.options.fade === !0 && i.currentSlide === a || i.slideCount <= i.options.slidesToShow ? void 0 : (b === !1 && i.asNavFor(a), d = a, h = i.getLeft(d), g = i.getLeft(i.currentSlide), i.currentLeft = null === i.swipeLeft ? g : i.swipeLeft, i.options.infinite === !1 && i.options.centerMode === !1 && (0 > a || a > i.getDotCount() * i.options.slidesToScroll) ? void (i.options.fade === !1 && (d = i.currentSlide, c !== !0 ? i.animateSlide(g, function () {
            i.postSlide(d);
        }) : i.postSlide(d))) : i.options.infinite === !1 && i.options.centerMode === !0 && (0 > a || a > i.slideCount - i.options.slidesToScroll) ? void (i.options.fade === !1 && (d = i.currentSlide, c !== !0 ? i.animateSlide(g, function () {
            i.postSlide(d)
        }) : i.postSlide(d))) : (i.options.autoplay === !0 && clearInterval(i.autoPlayTimer), e = 0 > d ? i.slideCount % i.options.slidesToScroll !== 0 ? i.slideCount - i.slideCount % i.options.slidesToScroll : i.slideCount + d : d >= i.slideCount ? i.slideCount % i.options.slidesToScroll !== 0 ? 0 : d - i.slideCount : d, i.animating = !0, i.$slider.trigger("beforeChange", [i, i.currentSlide, e]), f = i.currentSlide, i.currentSlide = e, i.setSlideClasses(i.currentSlide), i.updateDots(), i.updateArrows(), i.options.fade === !0 ? (c !== !0 ? (i.fadeSlideOut(f), i.fadeSlide(e, function () {
            i.postSlide(e)
        })) : i.postSlide(e), void i.animateHeight()) : void (c !== !0 ? i.animateSlide(h, function () {
            i.postSlide(e)
        }) : i.postSlide(e))))
    }, b.prototype.startLoad = function () {
        var a = this;
        a.options.arrows === !0 && a.slideCount > a.options.slidesToShow && (a.$prevArrow.hide(), a.$nextArrow.hide()), a.options.dots === !0 && a.slideCount > a.options.slidesToShow && a.$dots.hide(), a.$slider.addClass("slick-loading")
    }, b.prototype.swipeDirection = function () {
        var a, b, c, d, e = this;
        return a = e.touchObject.startX - e.touchObject.curX, b = e.touchObject.startY - e.touchObject.curY, c = Math.atan2(b, a), d = Math.round(180 * c / Math.PI), 0 > d && (d = 360 - Math.abs(d)), 45 >= d && d >= 0 ? e.options.rtl === !1 ? "left" : "right" : 360 >= d && d >= 315 ? e.options.rtl === !1 ? "left" : "right" : d >= 135 && 225 >= d ? e.options.rtl === !1 ? "right" : "left" : e.options.verticalSwiping === !0 ? d >= 35 && 135 >= d ? "left" : "right" : "vertical"
    }, b.prototype.swipeEnd = function (a) {
        var c, b = this;
        if (b.dragging = !1, b.shouldClick = b.touchObject.swipeLength > 10 ? !1 : !0, void 0 === b.touchObject.curX) return !1;
        if (b.touchObject.edgeHit === !0 && b.$slider.trigger("edge", [b, b.swipeDirection()]), b.touchObject.swipeLength >= b.touchObject.minSwipe) switch (b.swipeDirection()) {
            case"left":
                c = b.options.swipeToSlide ? b.checkNavigable(b.currentSlide + b.getSlideCount()) : b.currentSlide + b.getSlideCount(), b.slideHandler(c), b.currentDirection = 0, b.touchObject = {}, b.$slider.trigger("swipe", [b, "left"]);
                break;
            case"right":
                c = b.options.swipeToSlide ? b.checkNavigable(b.currentSlide - b.getSlideCount()) : b.currentSlide - b.getSlideCount(), b.slideHandler(c), b.currentDirection = 1, b.touchObject = {}, b.$slider.trigger("swipe", [b, "right"])
        } else b.touchObject.startX !== b.touchObject.curX && (b.slideHandler(b.currentSlide), b.touchObject = {})
    }, b.prototype.swipeHandler = function (a) {
        var b = this;
        if (!(b.options.swipe === !1 || "ontouchend" in document && b.options.swipe === !1 || b.options.draggable === !1 && -1 !== a.type.indexOf("mouse"))) switch (b.touchObject.fingerCount = a.originalEvent && void 0 !== a.originalEvent.touches ? a.originalEvent.touches.length : 1, b.touchObject.minSwipe = b.listWidth / b.options.touchThreshold, b.options.verticalSwiping === !0 && (b.touchObject.minSwipe = b.listHeight / b.options.touchThreshold), a.data.action) {
            case"start":
                b.swipeStart(a);
                break;
            case"move":
                b.swipeMove(a);
                break;
            case"end":
                b.swipeEnd(a)
        }
    }, b.prototype.swipeMove = function (a) {
        var d, e, f, g, h, b = this;
        return h = void 0 !== a.originalEvent ? a.originalEvent.touches : null, !b.dragging || h && 1 !== h.length ? !1 : (d = b.getLeft(b.currentSlide), b.touchObject.curX = void 0 !== h ? h[0].pageX : a.clientX, b.touchObject.curY = void 0 !== h ? h[0].pageY : a.clientY, b.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(b.touchObject.curX - b.touchObject.startX, 2))), b.options.verticalSwiping === !0 && (b.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(b.touchObject.curY - b.touchObject.startY, 2)))), e = b.swipeDirection(), "vertical" !== e ? (void 0 !== a.originalEvent && b.touchObject.swipeLength > 4 && a.preventDefault(), g = (b.options.rtl === !1 ? 1 : -1) * (b.touchObject.curX > b.touchObject.startX ? 1 : -1), b.options.verticalSwiping === !0 && (g = b.touchObject.curY > b.touchObject.startY ? 1 : -1), f = b.touchObject.swipeLength, b.touchObject.edgeHit = !1, b.options.infinite === !1 && (0 === b.currentSlide && "right" === e || b.currentSlide >= b.getDotCount() && "left" === e) && (f = b.touchObject.swipeLength * b.options.edgeFriction, b.touchObject.edgeHit = !0), b.options.vertical === !1 ? b.swipeLeft = d + f * g : b.swipeLeft = d + f * (b.$list.height() / b.listWidth) * g, b.options.verticalSwiping === !0 && (b.swipeLeft = d + f * g), b.options.fade === !0 || b.options.touchMove === !1 ? !1 : b.animating === !0 ? (b.swipeLeft = null, !1) : void b.setCSS(b.swipeLeft)) : void 0)
    }, b.prototype.swipeStart = function (a) {
        var c, b = this;
        return 1 !== b.touchObject.fingerCount || b.slideCount <= b.options.slidesToShow ? (b.touchObject = {}, !1) : (void 0 !== a.originalEvent && void 0 !== a.originalEvent.touches && (c = a.originalEvent.touches[0]), b.touchObject.startX = b.touchObject.curX = void 0 !== c ? c.pageX : a.clientX, b.touchObject.startY = b.touchObject.curY = void 0 !== c ? c.pageY : a.clientY, void (b.dragging = !0))
    }, b.prototype.unfilterSlides = b.prototype.slickUnfilter = function () {
        var a = this;
        null !== a.$slidesCache && (a.unload(), a.$slideTrack.children(this.options.slide).detach(), a.$slidesCache.appendTo(a.$slideTrack), a.reinit())
    }, b.prototype.unload = function () {
        var b = this;
        a(".slick-cloned", b.$slider).remove(), b.$dots && b.$dots.remove(), b.$prevArrow && b.htmlExpr.test(b.options.prevArrow) && b.$prevArrow.remove(), b.$nextArrow && b.htmlExpr.test(b.options.nextArrow) && b.$nextArrow.remove(), b.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden", "true").css("width", "")
    }, b.prototype.unslick = function (a) {
        var b = this;
        b.$slider.trigger("unslick", [b, a]), b.destroy()
    }, b.prototype.updateArrows = function () {
        var b, a = this;
        b = Math.floor(a.options.slidesToShow / 2), a.options.arrows === !0 && a.slideCount > a.options.slidesToShow && !a.options.infinite && (a.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), a.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), 0 === a.currentSlide ? (a.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true"), a.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : a.currentSlide >= a.slideCount - a.options.slidesToShow && a.options.centerMode === !1 ? (a.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), a.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : a.currentSlide >= a.slideCount - 1 && a.options.centerMode === !0 && (a.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), a.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")))
    }, b.prototype.updateDots = function () {
        var a = this;
        null !== a.$dots && (a.$dots.find("li").removeClass("slick-active").attr("aria-hidden", "true"), a.$dots.find("li").eq(Math.floor(a.currentSlide / a.options.slidesToScroll)).addClass("slick-active").attr("aria-hidden", "false"))
    }, b.prototype.visibility = function () {
        var a = this;
        document[a.hidden] ? (a.paused = !0, a.autoPlayClear()) : a.options.autoplay === !0 && (a.paused = !1, a.autoPlay())
    }, b.prototype.initADA = function () {
        var b = this;
        b.$slides.add(b.$slideTrack.find(".slick-cloned")).attr({
            "aria-hidden": "true",
            tabindex: "-1"
        }).find("a, input, button, select").attr({tabindex: "-1"}), b.$slideTrack.attr("role", "listbox"), b.$slides.not(b.$slideTrack.find(".slick-cloned")).each(function (c) {
            a(this).attr({role: "option", "aria-describedby": "slick-slide" + b.instanceUid + c})
        }), null !== b.$dots && b.$dots.attr("role", "tablist").find("li").each(function (c) {
            a(this).attr({
                role: "presentation",
                "aria-selected": "false",
                "aria-controls": "navigation" + b.instanceUid + c,
                id: "slick-slide" + b.instanceUid + c
            })
        }).first().attr("aria-selected", "true").end().find("button").attr("role", "button").end().closest("div").attr("role", "toolbar"), b.activateADA()
    }, b.prototype.activateADA = function () {
        var a = this;
        a.$slideTrack.find(".slick-active").attr({"aria-hidden": "false"}).find("a, input, button, select").attr({tabindex: "0"})
    }, b.prototype.focusHandler = function () {
        var b = this;
        b.$slider.on("focus.slick blur.slick", "*", function (c) {
            c.stopImmediatePropagation();
            var d = a(this);
            setTimeout(function () {
                b.isPlay && (d.is(":focus") ? (b.autoPlayClear(), b.paused = !0) : (b.paused = !1, b.autoPlay()))
            }, 0)
        })
    }, a.fn.slick = function () {
        var f, g, a = this, c = arguments[0], d = Array.prototype.slice.call(arguments, 1), e = a.length;
        for (f = 0; e > f; f++) if ("object" == typeof c || "undefined" == typeof c ? a[f].slick = new b(a[f], c) : g = a[f].slick[c].apply(a[f].slick, d), "undefined" != typeof g) return g;
        return a
    }
});
/**END SLICK.MIN.JS**/

/**Addition_scripts.js**/
// top link toggle
$(window).load(function () {
    if ($(window).width() <= 991) {
        $(document).click(function () {
            $('.top-links').hide();
        });
        $('#top_link_trigger').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            $('.top-links').toggle();
        });
    }
    if ($(window).width() <= 767) {
        $('.filter_list').removeClass('in');
        // mobile filter
        $('#filter_group').removeClass('in');
        $(".widget_links li input").click(function () {
            $('#filter_group').removeClass('in');
        });

        // category menu
        $('.left_menu .nav-pills > li > a i').click(function (e) {
            e.preventDefault();
            var $show_menu = $(this).closest('li.menu').find('.submenu');
            $('.submenu').slideUp();
            if ($show_menu.css('display') == 'none') {
                $show_menu.slideDown();
            } else {
                $show_menu.slideUp();
            }
        })
        // endcategory menu
    }
});
// end top link toggle

// sidebar menu
$('.sidebar_menu > li > i').click(function () {
    //$(this).closest('li').find('ul').toggleClass('toggled');
    $(this).closest('li').find('ul').toggle('slow');
});
// end sidebar menu

// change state of collapse arrow
$('.filter_group a').click(function () {
    $(this).find('i').toggleClass('fa-angle-down');
    $(this).find('i').toggleClass('fa-angle-right');
});
// end change state of collapse arrow

// mark the chosen color
$('.color_block').click(function () {
    $(this).parent().toggleClass('bordercolor');
});
// end mark the chosen color


/*** top search ***/

$(window).load(function () {
    $(this).scroll(function () {
        if ($('#header').hasClass('sticky-header')) {
            $('.top_search').addClass('top_search_sticker');
        } else {
            $('.top_search').removeClass('top_search_sticker');
        }
    });
});

/*** submenu toggle ***/
$('.submenu_toggle').click(function () {
    $(this).next().toggle(500)
});
/*** end submenu toggle ***/


/**** product overlay ****/

$('.product_overlay').click(function (e) {
    if (!$(e.target).is('.product_quick_add') && !$(e.target).is('.item-quick-view')) {
        var url = $(this).attr('product_url');
        location.href = url;
    }
})
/**** end product overlay ****/

/** scroll menu **/

$('body').scrollspy({target: "#myScrollspy", offset: 20});

var $root = $('html, body');
$('.scroll_menu a').click(function () {
    var padding = 60;
    var location = $($.attr(this, 'href')).offset().top - padding;
    $root.animate({
        scrollTop: location
    }, 500);
    return false;
});

/** end scroll menu **/

/**End Addition_scripts.js**/

//var ega = ega || {};

var ega = function () {

    //USE STRICT
    'use strict';

    var $window = $(window);
    // fancy box

    var fancyBox = {
        handleFancyBox: function () {

            //phong 20150702: add fancyBox data 'product_url' & beforeShow
            //ref: http://stackoverflow.com/questions/2961496/fancybox-get-id-of-clicked-anchor-element
            jQuery(".fancybox-fast-view").each(function (e) {
                $(this).fancybox({
                    'product_url': $(this).attr('product_url'),
                    beforeShow: function () {
                        quickViewProduct(this.product_url); // make-up "#product-pop-up"
                    },
                });
            });
        }
    }

    // tooltip
    var toolTip = {
        handleTooltip: function () {
            $('[data-toggle="tooltip"]').tooltip({
                html: true
            })
        }
    }

    // add class to element
    var addClassToEl = function ($element, $class) {
        $element.addClass($class);
    }

    var removeClassOfEl = function ($element, $class) {
        $element.removeClass($class);
    }

    var handleScroll = function ($options) {
        $options = $options || {};
        var el = (typeof $options.el != undefined) ? $options.el : '';
        var cl = (typeof $options.cl != undefined) ? $options.cl : '';
        var top = (typeof $options.top != undefined) ? $options.top : '';
        var bottom = (typeof $options.bottom != undefined) ? $options.bottom : '';
        $window.on('scroll', function () {
            if ($window.scrollTop() > Number(top)) {
                addClassToEl(el, cl);
            } else {
                removeClassOfEl(el, cl);
            }
        })
    }

    // lazy load
    var lazyLoad = {
        handleLazyLoad: function () {
            var lazyLoadEl = $('[data-lazyload]');
            if (lazyLoadEl.length > 0) {
                lazyLoadEl.each(function () {
                    var element = $(this),
                        elementImg = element.attr('data-lazyload');

                    element.attr('src', '//bizweb.dktcdn.net/100/093/227/themes/133235/assets/blank.svg?1469028122620').css({'background': 'url(//bizweb.dktcdn.net/100/093/227/themes/133235/assets/preloader.gif?1469028122620) no-repeat center center #FFF'});
                    element.attr('alt', '');
                    element.appear(function () {
                        element.css({'background': 'none'}).removeAttr('width').removeAttr('height').attr('src', elementImg);
                    }, {accX: 0, accY: 120}, 'easeInCubic');
                });
            }
        }
    }

    return {
        init: function () {
            fancyBox.handleFancyBox();
            lazyLoad.handleLazyLoad();
        },
        tooltip: function () {
            toolTip.handleTooltip();
        },
        addClassToEl: function () {
            addClassToEl();
        },
        handleScroll: function ($options) {
            handleScroll($options)
        }
    }
}();