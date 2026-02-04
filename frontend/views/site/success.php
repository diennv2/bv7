<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$config = \common\models\Configure::getConfig();
\johnitvn\ajaxcrud\CrudAsset::register($this);
$this->title = 'Liên hệ';
?>
<style>
    .container#container-content {
        width: 100% !important;
        margin: 0;
        padding: 0;
        max-width: none;
    }
    .form-control{
        width: 100%;
        margin-bottom: 5px!important;
        display: block;
    }
    .control-label{
        margin-bottom: 0px!important;
        display: block;
        font-size: 14px;
        color: white;
        text-transform: uppercase;
    }
</style>
<script>
    $(document).ready(function () {
        $('#my-menu').addClass('hidden');
    })
</script>

<div class="headline cmsmasters_color_scheme_default">
    <div class="headline_outer">
        <div class="headline_color"></div>
        <div class="headline_inner align_left">
            <div class="headline_aligner"></div>
            <div class="headline_text" style="height: 150px">
            </div>


        </div>
    </div>
</div>

<div class="headline cmsmasters_color_scheme_default">
    <div class="headline_outer">
        <div class="headline_color"></div>
        <div class="headline_inner align_left">
            <div class="headline_aligner"></div>
            <div class="headline_text"><h1 class="entry-title">Trang liên hệ</h1></div>
        </div>
    </div>
</div>
<div class="middle_inner">
    <div class="content_wrap fullwidth">

        <!-- Start Content -->
        <div class="middle_content entry"></div>
    </div>
    <div id="cmsmasters_row_7bdef42d16"
         class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
        <div class="cmsmasters_row_outer_parent">
            <div class="cmsmasters_row_outer">
                <div class="cmsmasters_row_inner">
                    <div class="cmsmasters_row_margin cmsmasters_1212" style="margin: 20px 0 20px 0;">
                        <div id="cmsmasters_column_2107461b3f" class="cmsmasters_column one_half">
                            <div class="cmsmasters_column_inner">
                                <div id="cmsmasters_heading_c929622c59"
                                     class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                    <h2 class="cmsmasters_heading">Thông tin liên hệ</h2>
                                </div>
                                <div class="cmsmasters_text">
                                    <div class="wpb_text_column wpb_content_element "></div>
                                    <div class="wpb_text_column wpb_content_element ">
                                        <div class="wpb_wrapper">
                                            <p>Bệnh viện Quân Y 7 chân thành cảm ơn Quý khách hàng đã luôn quan
                                                tâm, tin tưởng và lựa chọn sử dụng dịch vụ chăm sóc sức khỏe của chung
                                                tôi. Nhằm giúp Quý khách được đón tiếp và có thể trải nghiệm dịch vụ tốt
                                                nhất. Bệnh viện Quân Y 7 khuyến khích Quý khách đặt hẹn khám trước
                                                qua website để tránh tình trạng phải chờ đợi lâu.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div id="cmsmasters_divider_c76ef93988" class="cl"></div>
                                <div class="cmsmasters_sidebar sidebar_layout_1212">
                                    <aside id="custom-contact-info-4" class="widget widget_custom_contact_info_entries">
                                        <h3 class="widgettitle">BÊNH VIỆN QUÂN Y 7</h3>
                                        <div class="adr adress_wrap cmsmasters_theme_icon_user_address"><span
                                                    class="street-address contact_widget_address"><?php echo $config['contact_address'] ?></span>
                                        </div>
                                        <span class="contact_widget_email cmsmasters_theme_icon_user_mail"><a
                                                    class="email"
                                                    href="mailto:<?= $config['contact_email'] ?>"><?= $config['contact_email'] ?></a></span><span
                                                class="contact_widget_phone cmsmasters_theme_icon_user_phone"><span
                                                    class="tel"><?= $config['contact_phone'] ?></span></span></aside>
                                    <div class="cl"></div>
                                </div>
                            </div>
                        </div>
                        <div id="cmsmasters_column_7fd8df5002" class="cmsmasters_column one_half">
                            <div class="cmsmasters_column_inner">
                                <div id="cmsmasters_heading_4904d77983"
                                     class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                    <h2 class="cmsmasters_heading"> Liên hệ tư vấn</h2>
                                </div>
                                <div class="cmsmasters_contact_form">
                                    <div role="form" class="wpcf7" id="wpcf7-f14619-p60-o1" lang="en-US" dir="ltr">
                                        <div class="screen-reader-response"><p role="status" aria-live="polite"
                                                                               aria-atomic="true"></p>
                                            <ul></ul>
                                        </div>
                                        <div class="newsletter">
                                            <div class="clearfix"></div>
                                            <div class="alert alert-success padding15 margin-top-bot-10">
                                                <div class="container">
                                                    <p>Cảm ơn bạn đã đăng ký.</p>
                                                    <p>Chúng tôi sẽ liên hệ lại tư vấn cho quý khách sớm nhất.</p>
                                                    <p><a href="/">Go Home</a></p>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cl"></div>
    <div class="content_wrap fullwidth">

        <div class="middle_content entry"></div>
        <!-- Finish Content -->


    </div>
</div>