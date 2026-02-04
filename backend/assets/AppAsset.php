<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "css/mystyle.css",
        "css/tag.css",
//        "http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700",
//        "http://fonts.googleapis.com/css?family=Oswald:400,700,300",
        "themes/plugins/bootstrap/css/bootstrap.min.css",
        "themes/css/font.css",
        "themes/plugins/font-awesome/css/font-awesome.min.css",
        "themes/plugins/simple-line-icons/simple-line-icons.min.css",
        "themes/plugins/bootstrap-switch/css/bootstrap-switch.min.css",
        "themes/admin/pages/css/tasks.css",
        'jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css',

        'themes/plugins/sweetalert/dist/sweetalert2.min.css',
        "themes/css/components.css",
        "themes/css/style.css",
        "themes/css/jquery-confirm.min.css",
        "themes/css/plugins.css",

        "themes/admin/layout/css/layout.css",
        "themes/admin/layout/css/themes/darkblue.css",
        "themes/admin/layout/css/custom.css",
        "themes/plugins/typeahead/typeahead.css",
        "themes/plugins/bootstrap-datepicker/css/datepicker3.css",
        "themes/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css",
        "themes/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css",
        "themes/plugins/bootstrap-editable/inputs-ext/address/address.css",
        "themes/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css",
        "themes/plugins/typeahead/typeahead.css",
        "themes/plugins/jquery-tags-input/jquery.tagsinput.css",
        "themes/plugins/dropzone/css/dropzone.css",
        "themes/plugins/jquery-nestable/jquery.nestable.css",
        "themes/plugins/fullcalendar/fullcalendar.min.css",
        "themes/admin/pages/css/invoice.css",
        "themes/admin/pages/css/login-soft.css",
        "themes/css/all-krajee.css",


        "themes/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css",
        "themes/plugins/jquery-file-upload/css/jquery.fileupload.css",
        "themes/plugins/jquery-file-upload/css/jquery.fileupload-ui.css",
        'themes/select2-develop/dist/css/select2.min.css',
    ];
    public $js = [
        "ckeditor/ckeditor.js",
        "mainjs/mainjs.js",
        "themes/js/jquery-migrate-1.2.1.min.js",
        "themes/plugins/moment.min.js",
        "themes/plugins/jquery-inputmask/inputmask/jquery.maskMoney.js",
        "themes/plugins/jquery-ui/jquery-ui.js",
        "themes/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js",
        "themes/plugins/jquery-slimscroll/jquery.slimscroll.min.js",
        "themes/plugins/jquery.blockui.min.js",
        "themes/plugins/jquery.cokie.min.js",
        "themes/plugins/bootstrap-switch/js/bootstrap-switch.min.js",
        "themes/plugins/respond.min.js",
        "themes/plugins/excanvas.min.js",
        "themes/plugins/fullcalendar/fullcalendar.min.js",
        "themes/js/formjs.js",
        "themes/scripts/metronic.js",
        "themes/admin/layout/scripts/layout.js",
        "themes/admin/layout/scripts/quick-sidebar.js",
        "themes/plugins/jquery.blockui.min.js",
        "themes/plugins/jquery.mockjax.js",
        "themes/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js",
        "themes/plugins/bootstrap-editable/inputs-ext/address/address.js",
        "themes/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js",
        "themes/plugins/sweetalert/dist/sweetalert2.all.min.js",

        "themes/js/jquery.printElement.js",
        "themes/js/calendar.js",
        "themes/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js",
        "themes/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js",
        "themes/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js",
        "themes/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js",
        "themes/plugins/typeahead/typeahead.bundle.min.js",
        "themes/plugins/jquery-inputmask/jquery.inputmask.bundle.js",
        "themes/plugins/jquery-tags-input/jquery.tagsinput.min.js",
        "themes/plugins/dropzone/dropzone.js",
        "themes/plugins/jquery-nestable/jquery.nestable.js",
        "themes/js/nest.js",
        "themes/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js",

        "themes/plugins/jquery-file-upload/js/vendor/tmpl.min.js",

        "themes/plugins/jquery-file-upload/js/vendor/load-image.min.js",

        "themes/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js",

        "themes/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js",

        "themes/plugins/jquery-file-upload/js/jquery.iframe-transport.js",

        "themes/plugins/jquery-file-upload/js/jquery.fileupload.js",

        "themes/plugins/jquery-file-upload/js/jquery.fileupload-process.js",

        "themes/plugins/jquery-file-upload/js/jquery.fileupload-image.js",

        "themes/plugins/jquery-file-upload/js/jquery.fileupload-audio.js",

        "themes/plugins/jquery-file-upload/js/jquery.fileupload-video.js",

        "themes/plugins/jquery-file-upload/js/jquery.fileupload-validate.js",

        "themes/plugins/jquery-file-upload/js/jquery.fileupload-ui.js",

        "themes/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js",

        "themes/select2-develop/dist/js/select2.full.min.js",
        "themes/js/jquery-confirm.min.js",
        "jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.js"

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
