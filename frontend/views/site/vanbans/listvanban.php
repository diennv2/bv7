<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 04-Jul-17
 * Time: 11:26 AM
 */

use common\models\News;

$this->title = $cat;
$config = \common\models\Configure::getConfig();
\johnitvn\ajaxcrud\CrudAsset::register($this);
$related = News::find()->where("active=1")->orderBy('id desc')->limit(6)->all();
$nab = Yii::$app->controller->navbar;

?>
<style id='medical-clinic-style-inline-css' type='text/css'>

    .header_mid .header_mid_inner .logo_wrap {
        width : 220px;
    }

    .header_mid_inner .logo img.logo_retina {
        width : 220px;
    }


    .headline_outer {
        background-image:url(/images/heading-3-2.jpg);
        background-repeat:no-repeat;
        background-attachment:scroll;
        background-size:cover;
    }

    .headline_aligner,
    .cmsmasters_breadcrumbs_aligner {
        min-height:130px;
    }



    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_1 {
        color:#ffffff;
    }


    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_1:hover {
        color:#3065b5;
    }

    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_2 {
        color:#ffffff;
    }


    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_2:hover {
        color:#3065b5;
    }

    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_3 {
        color:#ffffff;
    }


    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_3:hover {
        color:#3065b5;
    }

    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_4 {
        color:#ffffff;
    }


    #page .cmsmasters_social_icon_color.cmsmasters_social_icon_4:hover {
        color:#3065b5;
    }

    .header_top {
        height : 44px;
    }

    .header_mid {
        height : 100px;
    }

    .header_bot {
        height : 58px;
    }

    #page.cmsmasters_heading_after_header #middle,
    #page.cmsmasters_heading_under_header #middle .headline .headline_outer {
        padding-top : 100px;
    }

    #page.cmsmasters_heading_after_header.enable_header_top #middle,
    #page.cmsmasters_heading_under_header.enable_header_top #middle .headline .headline_outer {
        padding-top : 144px;
    }

    #page.cmsmasters_heading_after_header.enable_header_bottom #middle,
    #page.cmsmasters_heading_under_header.enable_header_bottom #middle .headline .headline_outer {
        padding-top : 158px;
    }

    #page.cmsmasters_heading_after_header.enable_header_top.enable_header_bottom #middle,
    #page.cmsmasters_heading_under_header.enable_header_top.enable_header_bottom #middle .headline .headline_outer {
        padding-top : 202px;
    }


    .mid_nav > li > a,
    .bot_nav > li > a {
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
    }


    @media only screen and (max-width: 1024px) {
        .header_top,
        .header_mid,
        .header_bot {
            height : auto;
        }

        .header_mid .header_mid_inner > div {
            height : 100px;
        }

        .header_bot .header_bot_inner > div {
            height : 58px;
        }

        #page.cmsmasters_heading_after_header #middle,
        #page.cmsmasters_heading_under_header #middle .headline .headline_outer,
        #page.cmsmasters_heading_after_header.enable_header_top #middle,
        #page.cmsmasters_heading_under_header.enable_header_top #middle .headline .headline_outer,
        #page.cmsmasters_heading_after_header.enable_header_bottom #middle,
        #page.cmsmasters_heading_under_header.enable_header_bottom #middle .headline .headline_outer,
        #page.cmsmasters_heading_after_header.enable_header_top.enable_header_bottom #middle,
        #page.cmsmasters_heading_under_header.enable_header_top.enable_header_bottom #middle .headline .headline_outer {
            padding-top : 0 !important;
        }
    }

    @media only screen and (max-width: 540px) {
        .header_mid .header_mid_inner > div,
        .header_bot .header_bot_inner > div {
            height:auto;
        }
    }
    #page .cmsmasters_make_an_appointment .wpcf7-submit {
        background-color: rgba(255,255,255,.0);
        border-color: rgba(255,255,255,.3);
    }
    #page .cmsmasters_make_an_appointment .wpcf7-mail-sent-ok {
        border:1px solid rgba(255, 255, 255, 0.5);
        padding:10px;
        margin:30px 0 0;
        color:#ffffff;
    }
    #page .cmsmasters_make_an_appointment input:focus {
        border-color:#ffffff;
    }
    #page .cmsmasters_make_an_appointment input,
    #page .cmsmasters_make_an_appointment select {
        color:#ffffff;
        background-color: rgba(255,255,255,.2);
        border-color: rgba(255,255,255,.5);
    }
    #page .cmsmasters_make_an_appointment  input::-webkit-input-placeholder {
        color:#ffffff;
    }
    #page .cmsmasters_make_an_appointment  input:-moz-placeholder {
        color:#ffffff;
    }
    #page .cmsmasters_make_an_appointment  .wpcf7-submit:hover {
        color:#3065b5;
        background-color:#ffffff;
        border:1px solid #ffffff;
    }
    #page .cmsmasters_homepage_departments a:hover {
        color:#ffffff;
    }
    .cmsmasters_homepage_info {
        border-bottom:1px solid #e3e3e3;
    }
    .cmsmasters_homepage_info h6 {
        color:#9a9a9a;
    }
    .cmsmasters_homepage_featured_blocks {
        margin-top:-80px;
    }
    .widget_wysija > .widget {
        padding:0;
    }
    .widget_wysija .wysija-paragraph {
        width: 390px;
        max-width: 100%;
        float: left;
    }
    #page .widget_wysija .wysija-paragraph input {
        padding:0 22px !important;
        color: #ffffff;
        background-color: rgba(255,255,255,.2);
        border-color: rgba(255,255,255,.5);
    }
    .widget_wysija .wysija-submit {
        margin:0 -1px !important;
        border:0px;
        line-height:44px;
        color:#0392ce;
        width:170px;
        max-width:100%;
    }
    .widget_wysija .wysija-submit:hover {
        color:#0392ce;
        background-color: rgba(255,255,255,.9);
    }
    .cmsmasters_widget_departments {
        clear:both;
    }
    .cmsmasters_widget_departments .align-right {
        float:right;
        width:50%;
        text-align:right;
    }
    .cmsmasters_widget_departments span[class^="cmsmasters-icon-"]:before,
    .cmsmasters_widget_departments span[class*=" cmsmasters-icon-"]:before {
        margin:0 10px 0 0;
    }
    .cmsmasters_homepage_fb_opening .cmsmasters_homepage_fb_opening_item,
    .cmsmasters_widget_departments li,
    .cmsmasters_homepage_sidebar_lists li {
        display:block;
        padding:12px 0;
        border-bottom:1px solid rgba(255,255,255,.2);
    }
    .cmsmasters_homepage_sidebar_lists li {
        padding:9px 0;
        border-bottom:1px solid rgba(255,255,255,.07);
    }
    .cmsmasters_widget_departments.cmsmasters_dep_list  li {
        padding:9px 0;
    }
    .cmsmasters_homepage_fb_opening .cmsmasters_homepage_fb_opening_item .align-right {
        float:right;
        width:50%;
        text-align:right;
    }
    aside.widget_wysija {
        padding:20px 0 0px;
    }
    .widget_wysija .widgettitle {
        display:none;
    }
    .cmsmasters_homepage_subscribe_sidebar input::-webkit-input-placeholder {
        color:#ffffff;
    }
    .cmsmasters_homepage_subscribe_sidebar input:-moz-placeholder {
        color:#ffffff;
    }

    /* Adaptive */
    @media only screen and (max-width: 1440px) and (min-width: 950px) {
        .cmsmasters_widget_departments .align-right {
            display:block;
            float:none;
            width:100%;
            text-align:left;
        }
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
                            <a href="/" class="cms_home">Trang chủ</a>
                            <span class="breadcrumbs_sep"> / </span>
                            <span><?= $this->title ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle_inner">
        <div class="content_wrap r_sidebar">

            <!-- Start Content -->
            <div class="content entry">
                <div id="cmsmasters_row_a3f3041942" class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
                    <div class="cmsmasters_row_outer_parent">
                        <div class="cmsmasters_row_outer">
                            <div class="cmsmasters_row_inner">
                                <div class="cmsmasters_row_margin cmsmasters_11">
                                    <div id="cmsmasters_column_73318f44e8" class="cmsmasters_column one_first">
                                        <div class="cmsmasters_column_inner">
                                            <div id="blog_33ec4bcfa5" class="cmsmasters_wrap_blog entry-summary"
                                                 data-layout="standard" data-layout-mode=""
                                                 data-url="https://medical-clinic.cmsmasters.net/wp-content/plugins/cmsmasters-content-composer/"
                                                 data-orderby="date" data-order="DESC" data-count="3"
                                                 data-categories="advice,childrens-health,live-well,pediatrics"
                                                 data-metadata="date,categories,author,comments,likes,more"
                                                 data-pagination="more">
                                                <div class="blog standard isotope"
                                                     style="position: relative; height: auto">
                                                    <!-- Start Post Default Article -->
                                                    <?php
                                                    echo \yii\widgets\ListView::widget([
                                                        'dataProvider' => $data,
                                                        'layout' => '{items}',
                                                        'layout' =>  "{summary}\n{items}\n{pager}",
                                                        'itemOptions' => [

                                                            'tag' => false

                                                        ],
                                                        'itemView' =>function ($order, $key, $index, $widget) use($config){

                                                            return $this->render( '_listnew', [
                                                                'value'=>$order,
                                                                'type'=>'news',
                                                                'config'=>$config
                                                            ]);

                                                        },
                                                    ]);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cl"></div></div>
            <!-- Finish Content -->


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
                            <?php foreach ($related as $value):/** @var \common\models\News $value */ ?>
                                <li id="menu-item-12212"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12212">
                                    <a
                                            href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>"><?= $value->title ?></a>
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

