<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "OwlCarousel2/dist/assets/owl.carousel.min.css",
        "slick-1.8.1/slick-1.8.1/slick/slick.css",
        "slick-1.8.1/slick-1.8.1/slick/slick-theme.css",
        "theme/css/font-awesome.min.css",
        "css/layerslider.css",
        "css/contact.css",
        "css/layerslider.custom.css",
        "css/style.min.css",
        "css/vendors-style.css",
        "css/style.css",
        "css/styles.css",
        "css/cookie-law-info-public.css",
        "css/cookie-law-info-gdpr.css",
        "css/rs6.css",
        "css/jquery.qtip.css",
        "css/style2.css",
        "css/adaptive.css",
        "css/retina.css",
        "css/fontello.css",
        "css/fontello-custom.css",
        "css/animate.css",
        "css/ilightbox.css",
        "css/dark-skin.css",
        "css/medical-clinic.css",
        "css/frontend-style.css",
        "css/plugin-style.css",
        "css/plugin-adaptive.css",
        "css/plugin-style.css",
        "css/plugin-adaptive.css",
        'theme/sweetalert/dist/sweetalert2.min.css',
    ];
    public $js = [
        "OwlCarousel2/dist/owl.carousel.js",
        "slick-1.8.1/slick-1.8.1/slick/slick.js",
        "theme/js/bootstrap.min.js",
        "js/jquery-migrate.min.js",
        "js/layerslider.utils.js",
        "js/layerslider.kreaturamedia.jquery.js",
        "js/layerslider.transitions.js",
        "js/cookie-law-info-public.js",
        "js/rbtools.min.js",
        "js/rs6.min.js",
        "js/debounced-resize.min.js",
        "js/modernizr.min.js",
        "js/respond.min.js",
        "js/jquery.iLightBox.min.js",
        "js/jquery.megaMenu.js",
        "js/wp-polyfill.min.js",
        "theme/sweetalert/dist/sweetalert2.all.min.js",
        "js/core.min.js",
        "js/tabs.min.js",
        "js/jquery.blockUI.min.js",

        "js/cmsmasters-hover-slider.min.js",
        "js/easing.min.js",
        "js/easy-pie-chart.min.js",
        "js/mousewheel.min.js",
        "js/imagesloaded.min.js",
        "js/request-animation-frame.min.js",
        "js/scrollspy.js",
        "js/scroll-to.min.js",
        "js/stellar.min.js",
        "js/waypoints.min.js",
        "theme/js/pagination.js",


    ];
    public $depends = [
    ];
}
