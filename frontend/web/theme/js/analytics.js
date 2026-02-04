$(window).on("load", function () {
    "use strict";
    $(".loader").fadeOut(800), $(".side-menu").removeClass("opacity-0")
}), jQuery(e => {
    "use strict";
    let t = e(window), i = e("body"), a = e("html, body");
    e('[data-toggle="tooltip"]').tooltip(), e("#submit_btn1 , #submit_btn").on("click", function () {
        let t, i, a, s = e("#name1").val(), o = e("#email1").val(), l = e("#message1").val();
        "submit_btn" === this.id ? (t = e("#result"), l = e("#companyName").val(), s = e("#userName").val(), o = e("#email").val()) : t = e("#result1");
        let n = !0;
        "" === s && (n = !1), "" === o && (n = !1), "" === l && (n = !1), n ? (i = {
            userName: s,
            userEmail: o,
            userMessage: l
        }, e.post("contact.php", i, function (i) {
            "error" === i.type ? a = '<div class="alert-danger" style="padding:10px; margin-bottom:25px;">' + i.text + "</div>" : (a = '<div class="alert-success" style="padding:10px; margin-bottom:25px;">' + i.text + "</div>", e(".getin_form input").val(""), e(".getin_form textarea").val("")), t.slideUp("fast").html(a).slideDown()
        }, "json")) : (a = '<div class="alert-danger" style="padding:10px; margin-bottom:25px;">Please provide the missing fields.</div>', t.slideUp("fast").html(a).slideDown())
    });
    let s = e("#ratingText");
    e("#rattingIcon .fa-star").on("click", function () {
        let t = e(this).index();
        var i;
        e(this).addClass("fas").removeClass("far"), e(this).prevAll().addClass("fas").removeClass("far"), e(this).nextAll().addClass("far").removeClass("fas"), (() => {
            let t = e("#rattingIcon .fa-star.fas");
            t.addClass("scale-star"), setTimeout(function () {
                t.removeClass("scale-star")
            }, 180)
        })(), i = t, s.addClass("scale-price"), setTimeout(function () {
            switch (s.removeClass("scale-price"), i) {
                case 0:
                    s.text("Poor!");
                    break;
                case 1:
                    s.text("Average!");
                    break;
                case 2:
                    s.text("Good!");
                    break;
                case 3:
                    s.text("Very Good!");
                    break;
                case 4:
                    s.text("Excellent!")
            }
        }, 180)
    }), e(i).append('<a href="#" class="back-top"><i class="fa fa-angle-up"></i></a>');
    let o = e("a.back-top");
    t.on("scroll", function () {
        t.scrollTop() > 700 ? o.addClass("back-top-visible") : o.removeClass("back-top-visible")
    }), o.on("click", function () {
        return a.animate({scrollTop: 0}, 700), !1
    }), e("a.pagescroll").on("click", function (t) {
        t.preventDefault();
        let i = e(this.hash).offset().top;
        e(this).hasClass("scrollupto") && (i -= 45), e("html,body").animate({scrollTop: i}, 1200)
    }), e(".dropdown").on("mouseenter", function () {
        let t = e(this).find(".dropdown-menu"), i = t.offset().left, a = t.width(), s = e(window).width();
        i + a > s ? t.addClass("right-show") : i + 2 * a < s && t.removeClass("right-show")
    });
    let l = e("header").outerHeight(), n = e("nav.navbar");
    if (n.not(".fixed-bottom").hasClass("static-nav") && (t.scroll(function () {
        let i = t.scrollTop(), a = e(".static-nav"), s = e(".section-nav-smooth");
        i > 250 ? (a.addClass("fixedmenu"), s.css("margin-top", l)) : (a.removeClass("fixedmenu"), s.css("margin-top", 0)), i > 125 ? e(".header-with-topbar nav").addClass("mt-0") : e(".header-with-topbar nav").removeClass("mt-0")
    }), e(function () {
        t.scrollTop() >= e(window).height() && e(".static-nav").addClass("fixedmenu")
    })), n.hasClass("fixed-bottom")) {
        let i = e(".fixed-bottom").offset().top, a = t.scrollTop();
        e(window).scroll(function () {
            e(window).scrollTop() > i ? e(".fixed-bottom").addClass("fixedmenu") : e(".fixed-bottom").removeClass("fixedmenu"), e(window).scrollTop() < 260 ? e(".fixed-bottom").addClass("menu-top") : e(".fixed-bottom").removeClass("menu-top")
        }), e(function () {
            a < 230 ? e(".fixed-bottom").addClass("menu-top") : e(".fixed-bottom").removeClass("menu-top"), a >= e(window).height() && e(".fixed-bottom").addClass("fixedmenu")
        })
    }
    let r = e("#sidemenu_toggle"), d = e(".side-menu");
    r.length && (r.on("click", function () {
        e("body").addClass("overflow-hidden"), d.addClass("side-menu-active"), e(function () {
            setTimeout(function () {
                e("#close_side_menu").fadeIn(300)
            }, 300)
        })
    }), e("#close_side_menu , #btn_sideNavClose , .side-nav .nav-link.pagescroll").on("click", function () {
        e("body").removeClass("overflow-hidden"), d.removeClass("side-menu-active"), e("#close_side_menu").fadeOut(200), e(() => {
            setTimeout(() => {
                e(".sideNavPages").removeClass("show"), e(".fas").removeClass("rotate-180")
            }, 400)
        })
    }), e(document).keyup(t => {
        27 === t.keyCode && d.hasClass("side-menu-active") && (e("body").removeClass("overflow-hidden"), d.removeClass("side-menu-active"), e("#close_side_menu").fadeOut(200), m.tooltipster("close"), e(() => {
            setTimeout(() => {
                e(".sideNavPages").removeClass("show"), e(".fas").removeClass("rotate-180")
            }, 400)
        }))
    })), e(".collapsePagesSideMenu").on("click", function () {
        e(this).children().toggleClass("rotate-180")
    });
    let c = () => {
        let i = e(".full-screen");
        i.css("height", t.height()), i.css("width", t.width())
    };
    c(), t.resize(function () {
        c()
    }), e(".progress").each(function () {
        e(this).appear(function () {
            e(this).animate({opacity: 1, left: "0px"}, 500);
            let t = jQuery(this).find(".progress-bar").attr("data-value");
            e(this).find(".progress-bar").animate({width: t + "%"}, 500)
        })
    }), e(function () {
        !function () {
            var t = 500, i = e(window), a = !0, s = e(".tab-to-accordion"),
                o = s.find(".tab-container").children("div[id]"), l = s.find(".tabset-list"), n = l.find("li"),
                r = l.find("a"), d = l.find(".active").children().attr("href");

            function c() {
                var e = Math.round(n.outerWidth()), t = n.length, i = e * t, o = l.outerWidth();
                o <= i ? (a = !0, s.addClass("accordion-mod")) : (a = !1, s.removeClass("accordion-mod"))
            }

            e(r).each(function () {
                var t = e(this), i = t.parent().hasClass("active"), a = t.attr("href"), s = e(a);
                if (i) {
                    var o = a;
                    s.show()
                }
                var l = t.clone(), n = t.attr("href");
                o ? l.insertBefore(n).wrap('<div class="accordion-item active"></div>') : l.insertBefore(n).wrap('<div class="accordion-item"></div>')
            }), c(), o.hide(), e(d).show(), e(s).on("click", 'a[href^="#tab"]', function (i) {
                i.preventDefault();
                var l = e(this), n = l.attr("href"), r = e(n), d = s.find('a[href="' + n + '"]');
                e('a[href^="#tab"]').parent().removeClass("active"), d.parent().addClass("active"), a ? (o.stop().slideUp(t), r.stop().slideDown(t)) : (o.hide(), r.show())
            }), function () {
                var t = location.hash, a = t, l = e(a), n = s.find('a[href="' + a + '"]');
                e(t).length > 0 && (e('a[href^="#tab"]').parent().removeClass("active"), n.parent().addClass("active"), o.hide(), l.show(), i.scrollTop(l.offset().top).scrollLeft(l.offset().left))
            }(), i.on("resize orientationchange", c)
        }()
    }), e("#particles-js").length && particlesJS("particles-js", {
        particles: {
            number: {
                value: 100,
                density: {enable: !0, value_area: 800}
            },
            color: {value: "#ffffff"},
            shape: {
                type: "circle",
                stroke: {width: 0, color: "#000000"},
                polygon: {nb_sides: 5},
                image: {src: "img/github.svg", width: 100, height: 100}
            },
            opacity: {value: .5, random: !1, anim: {enable: !1, speed: 1, opacity_min: .1, sync: !1}},
            size: {value: 5, random: !0, anim: {enable: !1, speed: 40, size_min: .1, sync: !1}},
            line_linked: {enable: !1, distance: 150, color: "#ffffff", opacity: .4, width: 1},
            move: {
                enable: !0,
                speed: 2,
                direction: "none",
                random: !1,
                straight: !1,
                out_mode: "bounce",
                attract: {enable: !1, rotateX: 600, rotateY: 1200}
            }
        },
        interactivity: {
            detect_on: "canvas",
            events: {onhover: {enable: !0, mode: "grab"}, onclick: {enable: !0, mode: "bubble"}, resize: !0},
            modes: {
                grab: {distance: 150, line_linked: {opacity: 1}},
                bubble: {distance: 150, size: 12, duration: .2, opacity: .6, speed: 10},
                repulse: {distance: 150},
                push: {particles_nb: 1},
                remove: {particles_nb: 2}
            }
        },
        retina_detect: !0
    });
    let p = e("#morph-text");
    p.length && p.Morphext({
        animation: "flipInX", separator: ",", speed: 3500, complete: function () {
        }
    });
    let m = e(".tooltip");
    if (e(() => {
        m.tooltipster({
            plugins: ["follower"],
            anchor: "bottom-right",
            offset: [0, 0],
            animation: "fade",
            content: "Click Here To Close or Press ESC!",
            delay: 20,
            theme: "tooltipster-light",
            repositionOnScroll: !0
        })
    }), e(".wow").length && e(window).outerWidth() >= 567) {
        new WOW({boxClass: "wow", animateClass: "animated", offset: 0, mobile: !1, live: !0}).init()
    }
    e(window).width() > 992 ? (e(".parallax").parallaxie({
        speed: .55,
        offset: 0
    }), e(".parallax.parallax-slow").parallaxie({speed: .31})) : e(window).width() < 576 ? (e("#pagepiling #submit_btn").on("click", function () {
        e("#pagepiling #result").remove()
    }), e("#pagepiling .para-opacity").addClass("opacity-5")) : e("#pagepiling .para-opacity").removeClass("opacity-5"), e(window).resize(function () {
        e(window).width() < 576 ? e("#pagepiling .para-opacity").addClass("opacity-5") : e("#pagepiling .para-opacity").removeClass("opacity-5")
    }), e(".Pricing-toggle-button").on("click", function () {
        var t = !0;
        e(this).hasClass("month") && (t = !1), e(this).hasClass("active") || (e(".pricing-price .pricing-currency").each(function () {
            let i = e(this).text(), a = i.substring(1, i.length);
            t ? a *= 9 : a /= 9;
            let s = "$" + (a = a.toFixed(2));
            u(e(this), s)
        }), e(".pricing-price .pricing-duration").each(function () {
            t ? e(this).text("year") : e(this).text("month")
        }), e(this).addClass("active").siblings().removeClass("active"))
    });
    let u = (t, i) => {
        let a = e(".pricing-price");
        a.addClass("scale-price"), setTimeout(function () {
            t.text(i), a.removeClass("scale-price")
        }, 200)
    };
    e(".pricing-item").on("mouseenter", function () {
        e(".pricing-item").removeClass("active"), e(this).addClass("active")
    }).on("mouseleave", function () {
        e(".pricing-item").removeClass("active"), e(".pricing-item.selected").addClass("active")
    }), e("[data-fancybox]").fancybox({
        transitionIn: "elastic",
        transitionOut: "elastic",
        speedIn: 600,
        speedOut: 200,
        buttons: ["slideShow", "fullScreen", "thumbs", "share", "zoom", "close"]
    }), e("#partners-slider").owlCarousel({
        items: 5,
        autoplay: 1500,
        smartSpeed: 1500,
        autoplayHoverPause: !0,
        slideBy: 1,
        loop: !0,
        margin: 30,
        dots: !1,
        nav: !1,
        responsive: {1200: {items: 5}, 991: {items: 4}, 767: {items: 3}, 480: {items: 2}, 0: {items: 1}}
    }), e("#testimonial-slider").owlCarousel({
        items: 1,
        autoplay: !1,
        autoplayHoverPause: !0,
        mouseDrag: !1,
        loop: !0,
        margin: 30,
        animateIn: "fadeIn",
        animateOut: "fadeOut",
        dots: !1,
        nav: !0,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {980: {items: 1}, 600: {items: 1}, 320: {items: 1}}
    }), e("#carousel-gallery-detail").owlCarousel({
        items: 1,
        autoplay: !1,
        mouseDrag: !0,
        loop: !0,
        margin: 0,
        dots: !1,
        nav: !0,
        responsive: {980: {items: 1}, 600: {items: 1}, 320: {items: 1}}
    }), e("#testimonial-main-slider").owlCarousel({
        items: 3,
        autoplay: 2500,
        autoplayHoverPause: !0,
        loop: !0,
        margin: 0,
        dots: !0,
        nav: !1,
        responsive: {1280: {items: 3}, 980: {items: 3}, 600: {items: 2}, 320: {items: 1}}
    }), e(".price-slider").owlCarousel({
        items: 3,
        autoplay: 1,
        loop: !1,
        margin: 0,
        padding: 0,
        dots: 1,
        nav: 1,
        responsive: {1280: {items: 3}, 980: {items: 3}, 600: {items: 2}, 0: {items: 1}}
    }), e("#ourteam-slider").owlCarousel({
        items: 4,
        margin: 0,
        dots: 1,
        nav: 1,
        responsive: {1280: {items: 4}, 768: {items: 3}, 520: {items: 2}, 0: {items: 1}}
    }), e("#app-slider").owlCarousel({
        items: 1,
        loop: !0,
        dots: !1,
        nav: !1,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        autoplay: !1,
        autoplayTimeout: 5e3,
        responsive: {1280: {items: 1}, 600: {items: 1}, 320: {items: 1}}
    }), e(".app-slider-lock-btn").on("click", function () {
        e(".app-slider-lock").fadeToggle(600)
    }), e("#services-slider").owlCarousel({
        autoplay: !1,
        autoplayTimeout: 3e3,
        autoplayHoverPause: !0,
        smartSpeed: 1200,
        loop: !0,
        nav: !1,
        navText: !1,
        dots: !1,
        mouseDrag: !0,
        touchDrag: !0,
        center: !0,
        responsive: {0: {items: 1}, 640: {items: 3}}
    }), e("#service-detail").owlCarousel({
        autoplay: !0,
        autoplayTimeout: 3e3,
        autoplayHoverPause: !0,
        smartSpeed: 1200,
        loop: !0,
        nav: !1,
        dots: !1,
        mouseDrag: !0,
        touchDrag: !0,
        margin: 15,
        responsive: {0: {items: 1}, 640: {items: 2}}
    }), e(".owl-blog-item").owlCarousel({
        loop: !0,
        dots: !1,
        items: 1,
        nav: !0,
        navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"]
    });
    let f = e("#shop-dual-carousel"), h = e("#syncCarousel.owl-carousel");
    if (f) {
        f.append('<div class="owl-carousel carousel-shop-detail-inner owl-theme" id="syncChild"></div>');
        let t = h.find(".item").length - 1, i = "", a = e("#syncChild");
        for (let e = 0; e <= t; e++) i = h.find(".item").eq(e).find("img").attr("src"), a.append("\x3c!-- Item " + (e + 1) + '--\x3e<div class="item"><img src="' + i + '" alt=""></div>')
    }
    let g = e("#syncChild.owl-carousel");

    function v() {
        setTimeout(function () {
            g.find(".owl-item").first().addClass("synced")
        }, 300)
    }

    h.owlCarousel({
        singleItem: !0,
        items: 1,
        dots: !1,
        slideSpeed: 1e3,
        mouseDrag: !1,
        nav: !0,
        pagination: !1,
        afterAction: v(),
        responsiveRefreshRate: 200
    }), g.owlCarousel({
        items: 4,
        pagination: !1,
        margin: 0,
        dots: !1,
        afterAction: v()
    }), h.on("click", ".owl-next", function () {
        let e = g.find(".owl-item.active:first").index(), t = g.find(".owl-item.active:last").index(),
            i = g.find(".owl-item.active.synced").index(), a = g.find(".owl-item.synced").index();
        if (-1 === i) {
            if (e > a) for (; e > a;) g.trigger("prev.owl.carousel"), a++; else if (e < a) for (; e < a;) g.trigger("next.owl.carousel"), a--
        } else i === t && g.trigger("next.owl.carousel");
        g.find(".owl-item.synced").next().addClass("synced").siblings().removeClass("synced")
    }), h.on("click", ".owl-prev", function () {
        let e = g.find(".owl-item.active:first").index(), t = g.find(".owl-item.active.synced").index(),
            i = g.find(".owl-item.synced").index();
        if (-1 === t) {
            if (e > i) for (; e > i - 2;) g.trigger("prev.owl.carousel"), i++; else if (e < i) for (; e < i - 2;) g.trigger("next.owl.carousel"), i--
        } else t === e && g.trigger("prev.owl.carousel");
        g.find(".owl-item.synced").prev().addClass("synced").siblings().removeClass("synced")
    }), g.on("click", ".owl-item", function () {
        let t = e(this).index();
        h.trigger("to.owl.carousel", t, 300), e(this).siblings().removeClass("synced"), e(this).addClass("synced")
    }), e("#syncCarousel [data-fancybox]").fancybox({
        transitionIn: "elastic",
        transitionOut: "elastic",
        speedIn: 600,
        speedOut: 200,
        buttons: ["slideShow", "fullScreen", "thumbs", "share", "download", "zoom", "close"],
        afterShow: function () {
            let t = this.index;
            e(g).add(h).trigger("to.owl.carousel", t, 300), e("#syncChild .owl-item").removeClass("synced").eq(t).addClass("synced")
        }
    }), e("#syncCarousel .item").on("mousemove", function (t) {
        e(this).find("img").css({"transform-origin": (t.pageX - e(this).offset().left) / e(this).width() * 100 + "% " + (t.pageY - e(this).offset().top) / e(this).height() * 100 + "%"})
    }), e("#carousel-gallery-detail .item").on("mousemove", function (t) {
        e(this).find("img").css({"transform-origin": (t.pageX - e(this).offset().left) / e(this).width() * 100 + "% " + (t.pageY - e(this).offset().top) / e(this).height() * 100 + "%"})
    }), e(".counters").appear(function () {
        e(".count_nums").countTo()
    });
    let w = (new Date).getFullYear(), C = e("#year , #year1");
    2019 === w ? C.text(w) : C.text("2019-" + w);
    let b = e(".count_down");
    b.length && b.downCount({date: "2/21/2021 12:00:00", offset: 10});
    let y = e("#pagepiling");
    if (e(y).length && (e(y).pagepiling({
        onLeave: function (t, i, a) {
            let s = t, o = e("#pagepiling section:last").index();
            "down" === a ? (e("#para-menu li a").removeClass("current"), e("#para-menu li").eq(s).children().addClass("current"), e(".para-btn.para-up").removeClass("disabled")) : (s -= 2, e("#para-menu li a").removeClass("current"), e("#para-menu li").eq(s).children().addClass("current")), 0 === s ? e(".para-btn.para-up").addClass("disabled") : o === s ? e(".para-btn.para-down").addClass("disabled") : "up" === a && s < o && e(".para-btn.para-down").removeClass("disabled")
        }
    }), e(".para-up").on("click", function () {
        e.fn.pagepiling.moveSectionUp()
    }), e(".para-down").on("click", function () {
        e.fn.pagepiling.moveSectionDown()
    })), e("#para-menu li a").on("click", function (t) {
        t.preventDefault();
        let i = e(this).parent().index(), a = e("#pagepiling").find("section").length;
        i++, e.fn.pagepiling.moveTo(i), e("#para-menu li a").removeClass("current"), e(this).addClass("current"), 1 === i ? e(".para-btn.para-up").addClass("disabled") : i === a && e(".para-btn.para-down").addClass("disabled")
    }), e("#typed-text").length) {
        new Typed("#typed-text", {
            strings: ["Front End Developer", "Front End Designer", "Front End Master", "Creative Designer", "Creative Builder"],
            typeSpeed: 45,
            backSpeed: 22,
            backDelay: 1e3,
            smartBackspace: !0,
            loop: !0
        })
    }
    e("#blog-measonry").cubeportfolio({
        layoutMode: "grid",
        defaultFilter: "*",
        animationType: "scaleSides",
        gapHorizontal: 30,
        gapVertical: 30,
        gridAdjustment: "responsive",
        mediaQueries: [{width: 1500, cols: 3}, {width: 1100, cols: 3}, {width: 992, cols: 3}, {
            width: 768,
            cols: 3
        }, {width: 480, cols: 1}, {width: 320, cols: 1}]
    }), e("#services-measonry").cubeportfolio({
        layoutMode: "grid",
        defaultFilter: "*",
        filters: "#services-filter",
        animationType: "scaleSides",
        gapHorizontal: 30,
        gapVertical: 30,
        gridAdjustment: "responsive",
        mediaQueries: [{width: 1500, cols: 3}, {width: 1100, cols: 3}, {width: 992, cols: 3}, {
            width: 768,
            cols: 2
        }, {width: 480, cols: 1}, {width: 320, cols: 1}]
    }), e("#testimonial-grid").cubeportfolio({
        layoutMode: "grid",
        defaultFilter: "*",
        animationType: "quicksand",
        gapHorizontal: 0,
        gapVertical: 0,
        gridAdjustment: "responsive",
        mediaQueries: [{width: 1500, cols: 4}, {width: 1100, cols: 4}, {width: 800, cols: 3}, {
            width: 480,
            cols: 2
        }, {width: 320, cols: 1}]
    }), e("#price-grid").cubeportfolio({
        layoutMode: "grid",
        defaultFilter: "*",
        animationType: "quicksand",
        gapHorizontal: 50,
        gapVertical: 50,
        gridAdjustment: "responsive",
        mediaQueries: [{width: 1500, cols: 3}, {width: 1100, cols: 3}, {width: 800, cols: 2}, {width: 480, cols: 1}]
    }), e("#grid-mosaic").cubeportfolio({
        filters: "#mosaic-filter",
        layoutMode: "grid",
        defaultFilter: "*",
        animationType: "rotateSides",
        gapHorizontal: 0,
        gapVertical: 0,
        gridAdjustment: "responsive",
        mediaQueries: [{width: 1500, cols: 3}, {width: 1100, cols: 3}, {width: 767, cols: 2}, {width: 480, cols: 1}],
        plugins: {loadMore: {element: "#js-loadMore-mosaic", action: "click", loadItems: 3}}
    })
});