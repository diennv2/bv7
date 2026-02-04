<?php use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\BaseHtml;
use common\models\Blacklist;
use common\models\Configure;

$config = Configure::getConfig();
$ip=\func::get_client_ip();
$bl = Blacklist::findOne(['ip'=>$ip]);
if($bl!=null){
    if($bl->isblock==1){
        echo "You are Blocked";
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        exit;
    }

}
if(Yii::$app->user->isGuest){
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    exit;
}
\backend\assets\AppAsset::register($this);
$userkh = \common\models\User::find()->where('status=10')->all();
$this->beginPage();
//error_reporting( E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING );
?>
    <!DOCTYPE html>
    <!--[if IE 8]> <html lang="vi" class="ie8 no-js"> <![endif]-->
    <!--[if IE 9]> <html lang="vi" class="ie9 no-js"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="vi">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <?php
        /**
         * Created by PhpStorm.
         * User: HungLuongFamily
         * Date: 10/19/2015
         * Time: 9:42 AM
         */ ?>
        <meta charset="utf-8"/>
        <title><?php echo $this->title; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->head();
        ?>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <script src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/js/jquery-1.11.3.min.js"></script>
        <!-- END:File Upload Plugin JS files-->
        <style>
            *{
                font-size: small;
            }
            .swal2-icon{
                border-radius: 50%!important;
            }
            .swal2-icon.swal2-success .swal2-success-ring {
                border-radius: 50%!important;
            }
            .modal-open .select2-dropdown {
                z-index: 10060;
            }

            .modal-open .select2-close-mask {
                z-index: 10055;
            }

            .select2-selection.select2-selection--single {
                height: 33px;
            !important;
            }
            .sup-image{
                display: none;
                position: absolute;
                top: 0;
                left: 15px;
                border: 3px groove #4B77BE;
                background: white;
                padding: 10px;
                border-radius: 5px!important;
                z-index: 999;
                overflow: hidden;
                line-height: 14px;
            }
            .sup-image img{
                max-width: 1000px;
            }
            sup:hover .sup-image{
                display: block;
            }
            .pulse .pulse-ring {
                display: block;
                border-radius: 40px;
                height: 40px;
                width: 40px;
                position: absolute;
                -webkit-animation: animation-pulse 3.5s ease-out;
                animation: animation-pulse 3.5s ease-out;
                -webkit-animation-iteration-count: infinite;
                animation-iteration-count: infinite;
                opacity: 0;
                border-width: 3px;
                border-style: solid;
                border-color: #e4e6ef;
            }
            .pulse {
                position: relative;
            }
            .pulse {
                position: relative
            }

            .pulse .pulse-ring {
                display: block;
                border-radius: 40px;
                height: 40px;
                width: 40px;
                position: absolute;
                -webkit-animation: animation-pulse 3.5s ease-out;
                animation: animation-pulse 3.5s ease-out;
                -webkit-animation-iteration-count: infinite;
                animation-iteration-count: infinite;
                opacity: 0;
                border-width: 3px;
                border-style: solid;
                border-color: #e4e6ef
            }

            @media screen and (-ms-high-contrast: active),(-ms-high-contrast: none) {
                .pulse .pulse-ring {
                    top: 2px;
                    left: 2px
                }
            }

            .pulse.pulse-primary .pulse-ring {
                border-color: rgba(54, 153, 255, .75)
            }

            .pulse.pulse-secondary .pulse-ring {
                border-color: rgba(228, 230, 239, .75)
            }

            .pulse.pulse-success .pulse-ring {
                border-color: rgba(27, 197, 189, .75)
            }

            .pulse.pulse-info .pulse-ring {
                border-color: rgba(137, 80, 252, .75)
            }

            .pulse.pulse-warning .pulse-ring {
                border-color: rgba(255, 168, 0, .75)
            }

            .pulse.pulse-danger .pulse-ring {
                border-color: rgba(246, 78, 96, .75)
            }

            .pulse.pulse-light .pulse-ring {
                border-color: rgba(243, 246, 249, .75)
            }

            .pulse.pulse-dark .pulse-ring {
                border-color: rgba(24, 28, 50, .75)
            }

            .pulse.pulse-white .pulse-ring {
                border-color: rgba(255, 255, 255, .75)
            }

            @-webkit-keyframes animation-pulse {
                0% {
                    -webkit-transform: scale(.1, .1);
                    opacity: 0
                }
                60% {
                    -webkit-transform: scale(.1, .1);
                    opacity: 0
                }
                65% {
                    opacity: 1
                }
                100% {
                    -webkit-transform: scale(1.2, 1.2);
                    opacity: 0
                }
            }

            @keyframes animation-pulse {
                0% {
                    -webkit-transform: scale(.1, .1);
                    opacity: 0
                }
                60% {
                    -webkit-transform: scale(.1, .1);
                    opacity: 0
                }
                65% {
                    opacity: 1
                }
                100% {
                    -webkit-transform: scale(1.2, 1.2);
                    opacity: 0
                }
            }
        </style>
        <?php if($this->context->action->controller->id=="site" && $this->context->action->id=="index"):?>
            <script src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/bootstrap/js/bootstrap.js"></script>
        <?php endif;?>
        <link rel="shortcut icon" href="<?= Yii::$app->request->hostInfo . $config['favicon'] ?>" type="image/png">
        <script>
            $(document).ready(function () {
                $(document).on('click','.img-grid',function () {
                    var t= $(this);
                    $("#anh-img").attr('src',"<?php echo str_replace("/admin","",Yii::$app->request->getBaseUrl())?>"+t.attr('vals'));
                });

                $('.date-picker').datepicker({
                    orientation: "left",
                    autoclose: true
                });
                $('.timepicker-no-seconds').timepicker({
                    autoclose: true,
                    minuteStep: 5
                });
                // handle input group button click
                $('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
                    e.preventDefault();
                    $(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
                });
            });
			function OnMessage(e) {
                var event = e.originalEvent;
                if (event.data.origin !== "uU6tCuY2kqj1y5A") {
                    alert("Hack à mày?")
                    return;
                }
                // Make sure the sender of the event is trusted
                if (event.data.key) {
                    $(document).find("#"+event.data.key).val(event.data.value);
                    $(window).off('message', OnMessage);
                }
            }
        </script>
        <?php
        /**
         * Created by PhpStorm.
         * User: HungLuongFamily
         * Date: 10/19/2015
         * Time: 9:43 AM
         */ ?>
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <!--[if lt IE 9]>

        <![endif]-->



        <script>

            function block(options) {
                var globalImgPath = "<?php echo Yii::$app->urlManager->baseUrl ?>"+'/themes/img/';

                options = $.extend(true, {}, options);
                var html = '';
                if (options.animate) {
                    html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '">' + '<div class="block-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>' + '</div>';
                } else if (options.iconOnly) {
                    html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + globalImgPath + 'loading-spinner-grey.gif" align=""></div>';
                } else if (options.textOnly) {
                    html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
                } else {
                    html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + globalImgPath + 'loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
                }

                if (options.target) { // element blocking
                    var el = $(options.target);
                    if (el.height() <= ($(window).height())) {
                        options.cenrerY = true;
                    }
                    el.block({
                        message: html,
                        baseZ: options.zIndex ? options.zIndex : 1000,
                        centerY: options.cenrerY !== undefined ? options.cenrerY : false,
                        css: {
                            top: '10%',
                            border: '0',
                            padding: '0',
                            backgroundColor: 'none'
                        },
                        overlayCSS: {
                            backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                            opacity: options.boxed ? 0.05 : 0.1,
                            cursor: 'wait'
                        }
                    });
                } else { // page blocking
                    $.blockUI({
                        message: html,
                        baseZ: options.zIndex ? options.zIndex : 1000,
                        css: {
                            border: '0',
                            padding: '0',
                            backgroundColor: 'none'
                        },
                        overlayCSS: {
                            backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                            opacity: options.boxed ? 0.05 : 0.1,
                            cursor: 'wait'
                        }
                    });
                }
            }

            function unblock(target) {
                if (target) {
                    $(target).unblock({
                        onUnblock: function() {
                            $(target).css('position', '');
                            $(target).css('zoom', '');
                        }
                    });
                } else {
                    $.unblockUI();
                }
            }
            jQuery(document).ready(function() {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                QuickSidebar.init(); // init quick sidebar
                $(".tien-te").maskMoney({thousands:".", allowZero:true, /*suffix: " £",*/precision:0});

            });
            $('#printButton').on('click', function () {
                $('#body-in-bbbg').printElement();
            });
            /*$('.modal').on('shown.bs.modal', function() {

             });*/
            $(document).ready(function () {
                $('.phanquyen').on('click', function () {
                    var role = $(this).attr('name');
                    var permission = $(this).attr('value');
                    var check = $(this).is(":checked");
                    $.ajax({
                        type: 'post',
                        url: '<?php echo Yii::$app->urlManager->createUrl('rbac/update_permission') ?>',
                        data: {rolez: role, permissionz: permission, checkz: check},

                        success: function (output) {

                        }
                    });
                })

                $('.phanquyenall').on('click', function () {

                    var role = $(this).attr('name');
                    var permission = $(this).attr('value');
                    var check = $(this).is(":checked");
                    $.ajax({
                        type: 'post',
                        url: '<?php echo Yii::$app->urlManager->createUrl('rbac/update_permission') ?>',
                        data: {roleall: role, controller: permission, checkall: check},
                        dataType:'json',
                        success: function (output) {

                            $('.phanquyen').each(function () {
                                var name = $(this).attr('name');
                                var self=$(this);
                                if (name === role) {
                                    var val = $(this).attr('value');

                                    var matchstr = '^' + permission + '\/';
                                    if (val.match(matchstr)){
                                        console.log(output);
                                        if(output=='1'){

                                            self.attr('checked','checked');
                                        }
                                        else
                                            self.removeAttr('checked');
                                    }
                                }
                            })
                        }
                    });
                })



                $('.phanvaitro').on('click', function () {
                    var role = $(this).attr('name');
                    var user = $(this).attr('value');
                    var check = $(this).is(":checked");
                    $.ajax({
                        type: 'post',
                        url: '<?php echo Yii::$app->urlManager->createUrl('rbac/user_role') ?>',
                        data: {rolez: role, user: user, checkz: check},

                        success: function (output) {

                        }
                    });
                })
            })

        </script>

        <?php date_default_timezone_set('Asia/Ho_Chi_Minh');?>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->

    <body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
    <?php $this->beginBody();?>

    <div class="page-header -i navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner">
            <!-- BEGIN LOGO -->
            <div class="page-logo" style="overflow: hidden;">
                <a href="<?=Yii::$app->urlManager->baseUrl?>">
                    <img src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/img/logo.png" alt="logo" class="logo-default" style="height: 30px; margin: 8px 0"/>
                </a>
                <div class="menu-toggler sidebar-toggler hide">
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-user" style="text-align: center">
                        <a href="<?=Yii::$app->urlManager->baseUrl; ?>/../" target="_blank" class="dropdown-toggle" style="padding-right: 10px;">
                            <i class="fa fa-globe"></i>
                            <span class="username username-hide-on-mobile" style="    color: rgb(198, 207, 218);">Xem website</span>
                        </a>
                    </li>
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"><?=Yii::$app->user->identity->username?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="javascript:void(0)" class="logoutbtn"><i class="icon-key"></i>Đăng xuất</a>
                                <a href="<?=Yii::$app->urlManager->createUrl('site/changepassword') ?>" ><i class="icon-rocket"></i>Đổi mật khẩu</a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="javascript:void(0)" class="dropdown-toggle">
                            <i class="icon-logout logoutbtn"></i>
                        </a>
                        <?php echo Html::beginForm(['site/logout','post']).Html::submitButton('s',['class'=>'hidden btn-submit']).Html::endForm()?>
                        <script>
                            $(document).ready(function () {
                                $(document).on('click','.logoutbtn',function () {
                                    $(".btn-submit").click();
                                })
                            })
                        </script>
                    </li>
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <div class="clearfix">
    </div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <?php echo Yii::$app->view->render('menu')?>
                <!-- END SIDEBAR MENU -->
            </div>
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?php echo Yii::$app->urlManager->baseUrl; ?>">Home</a>
                            <?php if(isset($this->params['breadcrumbs'])) :?>
                            <i class="fa fa-angle-right"></i>
                        </li>

                        <li>
                            <?php foreach ($this->params['breadcrumbs'] as $index=> $value):?>
                                <a href="<?php echo $value['link']?>"><?php echo $value['name']?></a>
                                <?php if($index+1<count($this->params['breadcrumbs'])):?>
                                    <i class="fa fa-angle-right"></i>
                                <?php endif;?>
                            <?php endforeach;?>
                            <?php endif;?>
                        </li>

                    </ul>
                </div>
                <?php if($this->title!="" ): ?>
                    <h3 class="page-title">
                        <?php echo $this->title; ?> <small> </small>
                    </h3>
                <?php endif;?>
                <!--        <div class="loading"> <span>Đang tải dữ liệu...</span></div>-->
                <?php echo $content; ?>
                <div class="clearfix"></div>
                <!-- END PAGE HEADER-->
            </div>
        </div>
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->
        <a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
        <!-- END QUICK SIDEBAR -->
    </div>

    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner">
            2016 - <?php echo Html::a('Techber VN Co.,Ltd','https://techber.vn/') ?>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->

    <?php $this->endBody();?>

    <script>
        $.ajaxSetup({
            data: <?= \yii\helpers\Json::encode([
            \yii::$app->request->csrfParam => \yii::$app->request->csrfToken,
        ]) ?>
        });
        $(document).ready(function () {

            $(document).on('click','#w3',function () {
                var t = $(this);
                if(t.attr('aria-expanded')==='true') {
                    t.removeAttr('aria-expanded').attr('aria-expanded', 'false');
                    t.parent().removeAttr('class').attr('class', 'btn-group');
                }
                else
                {
                    t.removeAttr('aria-expanded').attr('aria-expanded', 'true');
                    t.parent().removeAttr('class').attr('class', 'btn-group open');
                }
            });

        })
    </script>

    </body>

    <!-- END BODY -->
    </html>
<?php $this->endPage();?>