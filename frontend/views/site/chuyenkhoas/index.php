<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 03-Jul-17
 * Time: 4:00 PM
 */
/** @var \common\models\News $data */

$this->context->og_type = "article";
$this->context->og_image = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . $data->image;
$this->title = $data->title;
$user = \common\models\Admin::findOne(['id' => $data->lang_id]);

$config = \common\models\Configure::getConfig();
$nab = Yii::$app->controller->navbar;
\johnitvn\ajaxcrud\CrudAsset::register($this);
$value=$data;
?>
<style id='medical-clinic-style-inline-css' type='text/css'>

    .header_mid .header_mid_inner .logo_wrap {
        width: 220px;
    }

    .header_mid_inner .logo img.logo_retina {
        width: 220px;
    }


    .headline_outer {
        background-image: url(/images/heading-3-2.jpg);
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-size: cover;
    }

    .headline_aligner,
    .cmsmasters_breadcrumbs_aligner {

    }


    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_1 {
        color: #ffffff;
    }


    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_1:hover {
        color: #3065b5;
    }

    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_2 {
        color: #ffffff;
    }


    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_2:hover {
        color: #3065b5;
    }

    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_3 {
        color: #ffffff;
    }


    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_3:hover {
        color: #3065b5;
    }

    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_4 {
        color: #ffffff;
    }


    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_4:hover {
        color: #3065b5;
    }

    .header_top {
        height: 44px;
    }

    .header_mid {
        height: 100px;
    }

    .header_bot {
        height: 58px;
    }

    #page.cmsmasters_heading_after_header #middle,
    #page.cmsmasters_heading_under_header #middle .headline .headline_outer {
        padding-top: 100px;
    }

    #page.cmsmasters_heading_after_header.enable_header_top #middle,
    #page.cmsmasters_heading_under_header.enable_header_top #middle .headline .headline_outer {
        padding-top: 144px;
    }

    #page.cmsmasters_heading_after_header.enable_header_bottom #middle,
    #page.cmsmasters_heading_under_header.enable_header_bottom #middle .headline .headline_outer {
        padding-top: 158px;
    }

    #page.cmsmasters_heading_after_header.enable_header_top.enable_header_bottom #middle,
    #page.cmsmasters_heading_under_header.enable_header_top.enable_header_bottom #middle .headline .headline_outer {
        padding-top: 202px;
    }


    .mid_nav > li > a,
    .bot_nav > li > a {
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
    }


    @media only screen and (max-width: 1024px) {
        .header_top,
        .header_mid,
        .header_bot {
            height: auto;
        }

        .header_mid .header_mid_inner > div {
            height: 100px;
        }

        .header_bot .header_bot_inner > div {
            height: 58px;
        }

        #page.cmsmasters_heading_after_header #middle,
        #page.cmsmasters_heading_under_header #middle .headline .headline_outer,
        #page.cmsmasters_heading_after_header.enable_header_top #middle,
        #page.cmsmasters_heading_under_header.enable_header_top #middle .headline .headline_outer,
        #page.cmsmasters_heading_after_header.enable_header_bottom #middle,
        #page.cmsmasters_heading_under_header.enable_header_bottom #middle .headline .headline_outer,
        #page.cmsmasters_heading_after_header.enable_header_top.enable_header_bottom #middle,
        #page.cmsmasters_heading_under_header.enable_header_top.enable_header_bottom #middle .headline .headline_outer {
            padding-top: 0 !important;
        }
    }

    @media only screen and (max-width: 540px) {
        .header_mid .header_mid_inner > div,
        .header_bot .header_bot_inner > div {
            height: auto;
        }
    }

    #page .cmsmasters_make_an_appointment .wpcf7-submit {
        background-color: rgba(255, 255, 255, .0);
        border-color: rgba(255, 255, 255, .3);
    }

    #page .cmsmasters_make_an_appointment .wpcf7-mail-sent-ok {
        border: 1px solid rgba(255, 255, 255, 0.5);
        padding: 10px;
        margin: 30px 0 0;
        color: #ffffff;
    }

    #page .cmsmasters_make_an_appointment input:focus {
        border-color: #ffffff;
    }

    #page .cmsmasters_make_an_appointment input,
    #page .cmsmasters_make_an_appointment select {
        color: #ffffff;
        background-color: rgba(255, 255, 255, .2);
        border-color: rgba(255, 255, 255, .5);
    }

    #page .cmsmasters_make_an_appointment input::-webkit-input-placeholder {
        color: #ffffff;
    }

    #page .cmsmasters_make_an_appointment input:-moz-placeholder {
        color: #ffffff;
    }

    #page .cmsmasters_make_an_appointment .wpcf7-submit:hover {
        color: #3065b5;
        background-color: #ffffff;
        border: 1px solid #ffffff;
    }

    #page .cmsmasters_homepage_departments a:hover {
        color: #ffffff;
    }

    .cmsmasters_homepage_info {
        border-bottom: 1px solid #e3e3e3;
    }

    .cmsmasters_homepage_info h6 {
        color: #9a9a9a;
    }

    .cmsmasters_homepage_featured_blocks {
        margin-top: -80px;
    }

    .widget_wysija > .widget {
        padding: 0;
    }

    .widget_wysija .wysija-paragraph {
        width: 390px;
        max-width: 100%;
        float: left;
    }

    #page .widget_wysija .wysija-paragraph input {
        padding: 0 22px !important;
        color: #ffffff;
        background-color: rgba(255, 255, 255, .2);
        border-color: rgba(255, 255, 255, .5);
    }

    .widget_wysija .wysija-submit {
        margin: 0 -1px !important;
        border: 0px;
        line-height: 44px;
        color: #0392ce;
        width: 170px;
        max-width: 100%;
    }

    .widget_wysija .wysija-submit:hover {
        color: #0392ce;
        background-color: rgba(255, 255, 255, .9);
    }

    .cmsmasters_widget_departments {
        clear: both;
    }

    .cmsmasters_widget_departments .align-right {
        float: right;
        width: 50%;
        text-align: right;
    }

    .cmsmasters_widget_departments span[class^="cmsmasters-icon-"]:before,
    .cmsmasters_widget_departments span[class*=" cmsmasters-icon-"]:before {
        margin: 0 10px 0 0;
    }

    .cmsmasters_homepage_fb_opening .cmsmasters_homepage_fb_opening_item,
    .cmsmasters_widget_departments li,
    .cmsmasters_homepage_sidebar_lists li {
        display: block;
        padding: 12px 0;
        border-bottom: 1px solid rgba(255, 255, 255, .2);
    }

    .cmsmasters_homepage_sidebar_lists li {
        padding: 9px 0;
        border-bottom: 1px solid rgba(255, 255, 255, .07);
    }

    .cmsmasters_widget_departments.cmsmasters_dep_list li {
        padding: 9px 0;
    }

    .cmsmasters_homepage_fb_opening .cmsmasters_homepage_fb_opening_item .align-right {
        float: right;
        width: 50%;
        text-align: right;
    }

    aside.widget_wysija {
        padding: 20px 0 0px;
    }

    .widget_wysija .widgettitle {
        display: none;
    }

    .cmsmasters_homepage_subscribe_sidebar input::-webkit-input-placeholder {
        color: #ffffff;
    }

    .cmsmasters_homepage_subscribe_sidebar input:-moz-placeholder {
        color: #ffffff;
    }

    /* Adaptive */
    @media only screen and (max-width: 1440px) and (min-width: 950px) {
        .cmsmasters_widget_departments .align-right {
            display: block;
            float: none;
            width: 100%;
            text-align: left;
        }
    }
</style>
<style id='medical-clinic-retina-inline-css' type='text/css'>
    #cmsmasters_row_6161215432 .cmsmasters_row_outer_parent {
        padding-top: 0px;
    }

    #cmsmasters_row_6161215432 .cmsmasters_row_outer_parent {
        padding-bottom: 0px;
    }



    #cmsmasters_heading_e67b251130 {
        text-align:left;
        margin-top:30px;
        margin-bottom:20px;
    }

    #cmsmasters_heading_e67b251130 .cmsmasters_heading {
        text-align:left;
    }

    #cmsmasters_heading_e67b251130 .cmsmasters_heading, #cmsmasters_heading_e67b251130 .cmsmasters_heading a {
        font-size:24px;
        font-weight:normal;
        font-style:normal;
        color:#3065b5;
    }

    #cmsmasters_heading_e67b251130 .cmsmasters_heading a:hover {
    }

    #cmsmasters_heading_e67b251130 .cmsmasters_heading_divider {
    }



    #cmsmasters_divider_8680cc41e8 {
        border-bottom-width:1px;
        border-bottom-style:solid;
        margin-top:25px;
        margin-bottom:38px;
    }
    #cmsmasters_row_e5c2499100 .cmsmasters_row_outer_parent {
        padding-top: 0px;
    }

    #cmsmasters_row_e5c2499100 .cmsmasters_row_outer_parent {
        padding-bottom: 0px;
    }



    #cmsmasters_heading_4098870f09 {
        text-align:left;
        margin-top:0px;
        margin-bottom:0px;
    }

    #cmsmasters_heading_4098870f09 .cmsmasters_heading {
        text-align:left;
    }

    #cmsmasters_heading_4098870f09 .cmsmasters_heading, #cmsmasters_heading_4098870f09 .cmsmasters_heading a {
        font-family:'Open Sans';
        font-size:18px;
        font-weight:normal;
        font-style:normal;
    }

    #cmsmasters_heading_4098870f09 .cmsmasters_heading a:hover {
    }

    #cmsmasters_heading_4098870f09 .cmsmasters_heading_divider {
    }



    #cmsmasters_divider_6baeaf1992 {
        border-bottom-width:1px;
        border-bottom-style:solid;
        margin-top:10px;
        margin-bottom:30px;
        border-bottom-color:#3eb8d7;
    }


    #cmsmasters_heading_84bbf62006 {
        text-align:left;
        margin-top:0px;
        margin-bottom:0px;
    }

    #cmsmasters_heading_84bbf62006 .cmsmasters_heading {
        text-align:left;
    }

    #cmsmasters_heading_84bbf62006 .cmsmasters_heading, #cmsmasters_heading_84bbf62006 .cmsmasters_heading a {
        font-family:'Open Sans';
        font-size:18px;
        font-weight:normal;
        font-style:normal;
    }

    #cmsmasters_heading_84bbf62006 .cmsmasters_heading a:hover {
    }

    #cmsmasters_heading_84bbf62006 .cmsmasters_heading_divider {
    }



    #cmsmasters_divider_8086f63001 {
        border-bottom-width:1px;
        border-bottom-style:solid;
        margin-top:10px;
        margin-bottom:30px;
        border-bottom-color:#3eb8d7;
    }


    #cmsmasters_heading_7d02e5e97e {
        text-align:left;
        margin-top:0px;
        margin-bottom:0px;
    }

    #cmsmasters_heading_7d02e5e97e .cmsmasters_heading {
        text-align:left;
    }

    #cmsmasters_heading_7d02e5e97e .cmsmasters_heading, #cmsmasters_heading_7d02e5e97e .cmsmasters_heading a {
        font-family:'Open Sans';
        font-size:18px;
        font-weight:normal;
        font-style:normal;
    }

    #cmsmasters_heading_7d02e5e97e .cmsmasters_heading a:hover {
    }

    #cmsmasters_heading_7d02e5e97e .cmsmasters_heading_divider {
    }



    #cmsmasters_divider_4d771a281a {
        border-bottom-width:1px;
        border-bottom-style:solid;
        margin-top:10px;
        margin-bottom:30px;
        border-bottom-color:#3eb8d7;
    }
    #cmsmasters_row_fc2ec917c6 .cmsmasters_row_outer_parent {
        padding-top: 0px;
    }

    #cmsmasters_row_fc2ec917c6 .cmsmasters_row_outer_parent {
        padding-bottom: 35px;
    }



    #cmsmasters_divider_5dd22ccef9 {
        border-bottom-width:1px;
        border-bottom-style:solid;
        margin-top:25px;
        margin-bottom:39px;
    }

    #cmsmasters_heading_9995057550 {
        text-align:left;
        margin-top:0px;
        margin-bottom:0px;
    }

    #cmsmasters_heading_9995057550 .cmsmasters_heading {
        text-align:left;
    }

    #cmsmasters_heading_9995057550 .cmsmasters_heading, #cmsmasters_heading_9995057550 .cmsmasters_heading a {
        font-family:'Open Sans';
        font-size:24px;
        font-weight:normal;
        font-style:normal;
        color:#3065b5;
    }

    #cmsmasters_heading_9995057550 .cmsmasters_heading a:hover {
    }

    #cmsmasters_heading_9995057550 .cmsmasters_heading_divider {
    }



    #cmsmasters_heading_10831d4ec6 {
        text-align:left;
        margin-top:0px;
        margin-bottom:0px;
    }

    #cmsmasters_heading_10831d4ec6 .cmsmasters_heading {
        text-align:left;
    }

    #cmsmasters_heading_10831d4ec6 .cmsmasters_heading, #cmsmasters_heading_10831d4ec6 .cmsmasters_heading a {
        font-family:'Open Sans';
        font-size:14px;
        font-weight:normal;
        font-style:normal;
        color:#747474;
    }

    #cmsmasters_heading_10831d4ec6 .cmsmasters_heading a:hover {
    }

    #cmsmasters_heading_10831d4ec6 .cmsmasters_heading_divider {
    }


    #cmsmasters_row_ed81cec8a1 .cmsmasters_row_outer_parent {
        padding-top: 0px;
    }

    #cmsmasters_row_ed81cec8a1 .cmsmasters_row_outer_parent {
        padding-bottom: 0px;
    }


    #cmsmasters_row_e6363f5339 .cmsmasters_row_outer_parent {
        padding-top: 0px;
    }

    #cmsmasters_row_e6363f5339 .cmsmasters_row_outer_parent {
        padding-bottom: 50px;
    }



    #cmsmasters_divider_dfb8508069 {
        border-bottom-width:1px;
        border-bottom-style:solid;
        margin-top:20px;
        margin-bottom:39px;
    }

    #cmsmasters_heading_6f62e3f40c {
        text-align:left;
        margin-top:0px;
        margin-bottom:0px;
    }

    #cmsmasters_heading_6f62e3f40c .cmsmasters_heading {
        text-align:left;
    }

    #cmsmasters_heading_6f62e3f40c .cmsmasters_heading, #cmsmasters_heading_6f62e3f40c .cmsmasters_heading a {
        font-family:'Open Sans';
        font-size:24px;
        font-weight:normal;
        font-style:normal;
        color:#3065b5;
    }

    #cmsmasters_heading_6f62e3f40c .cmsmasters_heading a:hover {
    }

    #cmsmasters_heading_6f62e3f40c .cmsmasters_heading_divider {
    }



    #cmsmasters_heading_4e62919030 {
        text-align:left;
        margin-top:0px;
        margin-bottom:10px;
    }

    #cmsmasters_heading_4e62919030 .cmsmasters_heading {
        text-align:left;
    }

    #cmsmasters_heading_4e62919030 .cmsmasters_heading, #cmsmasters_heading_4e62919030 .cmsmasters_heading a {
        font-size:14px;
        font-weight:normal;
        font-style:normal;
        color:#747474;
    }

    #cmsmasters_heading_4e62919030 .cmsmasters_heading a:hover {
    }

    #cmsmasters_heading_4e62919030 .cmsmasters_heading_divider {
    }



</style>
<div id="middle">
    <div class="headline cmsmasters_color_scheme_default">
        <div class="headline_outer">
            <div class="headline_color"></div>
            <div class="headline_inner align_left">
                <div class="headline_aligner"></div>
                <div class="headline_text"><h1 class="entry-title"><?= $this->title ?></h1>
                    <div class="cmsmasters_breadcrumbs">
                        <div class="cmsmasters_breadcrumbs_inner">
                            <span><?= $nab ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle_inner">
        <div class="content_wrap r_sidebar">

            <!-- Start Content -->
            <div class="content entry">
                <div class="blog opened-article"><!-- Start Post Single Article -->
                    <article id="post-85"
                             class="cmsmasters_open_post post-85 post type-post status-publish format-image has-post-thumbnail hentry category-advice category-pediatrics post_format-post-format-image">
                        <figure class="cmsmasters_img_wrap"><a
                                    href="<?= Yii::$app->urlManager->baseUrl . $value->image ?>"
                                    title="Kids’ Health Questions" rel="ilightbox[img_85_6257a43613899]"
                                    class="cmsmasters_img_link"><img width="860" height="430"
                                                                     src="<?= Yii::$app->urlManager->baseUrl . $value->image ?>"
                                                                     class=" wp-post-image" alt="Kids’ Health Questions"
                                                                     loading="lazy" title="6"

                                                                     sizes="(max-width: 860px) 100vw, 860px"></a>
                        </figure>
                        <header class="cmsmasters_post_header entry-header"><h2
                                    class="cmsmasters_post_title entry-title"><?php echo $data->title; ?></h2></header>

                        <div class="cmsmasters_post_content entry-content">
                            <?= $data->noidung ?>
                        </div>
                    </article>
                    <!-- Finish Post Single Article -->

                </div>
                <!-- Finish Content -->




            </div>

            <!-- Start Sidebar -->
            <div class="sidebar">
                <aside id="search-3" class="widget widget_search"><h3 class="widgettitle">Tìm kiếm</h3>
                    <div class="search_bar_wrap">
                        <form method="get" action="/tim-kiem.html">
                            <p class="search_field">
                                <input name="finder" placeholder="Bạn cần tìm gì..." value="" type="search">
                            </p>
                            <p class="search_button">
                                <button type="submit" class="cmsmasters_theme_icon_search"></button>
                            </p>
                        </form>
                    </div>
                </aside>
                <aside id="nav_menu-2" class="widget widget_nav_menu">
                    <div class="menu-departaments-container">
                        <ul id="menu-departaments" class="menu">
                            <?php foreach ($related as $value):/** @var \common\models\Chuyenkhoas $value */ ?>
                                <li id="menu-item-12212"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12212">
                                    <a
                                            href="<?= Yii::$app->urlManager->createUrl(['site/chuyenkhoas', 'id' => $value->id, 'url' => $value->url]) ?>"><?= $value->title ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </aside>
            </div>
            <!-- Finish Sidebar -->
        </div>
    </div>
</div>