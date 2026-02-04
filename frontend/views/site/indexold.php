<div id="middle">
    <div class="middle_inner">
        <div class="content_wrap fullwidth">

            <!-- Start Content -->
            <div class="middle_content entry"></div>
        </div>
        <div id="cmsmasters_row_ac02f7b0b6"
             class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_fullwidth">
            <div class="cmsmasters_row_outer_parent">
                <div class="cmsmasters_row_outer">
                    <div class="cmsmasters_row_inner cmsmasters_row_fullwidth">
                        <div class="cmsmasters_row_margin">
                            <div id="cmsmasters_column_d6f4d1f9d5" class="cmsmasters_column one_first">
                                <div class="cmsmasters_column_inner">
                                    <div class="cmsmasters_slider">
                                        <script type="text/javascript">jQuery(function () {
                                                _initLayerSlider('#layerslider_1_d9vvpcj3pcwy', {
                                                    sliderVersion: '6.0.6',
                                                    type: 'fullwidth',
                                                    responsiveUnder: 0,
                                                    layersContainer: 0,
                                                    hideOnMobile: true,
                                                    hideUnder: 624,
                                                    hideOver: 100000,
                                                    skin: 'v5',
                                                    navPrevNext: false,
                                                    hoverPrevNext: false,
                                                    hoverBottomNav: true,
                                                    showCircleTimer: false,
                                                    skinsPath: 'https://medical-clinic.cmsmasters.net/wp-content/plugins/LayerSlider/assets/static/layerslider/skins/'
                                                });
                                            });</script>
                                        <div id="layerslider_1_d9vvpcj3pcwy"
                                             class="ls-wp-container fitvidsignore"
                                             style="width:1903px;height:720px;margin:0 auto;margin-bottom: 0px;">
                                            <?php foreach ($slide as $slides): /** @var \common\models\Slides $slides */ ?>
                                                <div class="ls-slide"
                                                     data-ls="duration:3500;kenburnsscale:1.2;"><img
                                                            width="1903" height="720"
                                                            src="<?= $slides->image ?>"
                                                            class="ls-bg" alt=""

                                                            sizes="(max-width: 1903px) 100vw, 1903px">
                                                    <p style="text-shadow: 0px 1px 0px rgba(44, 49, 55, 0.3);font-family:open sans;font-size:22px;color:#ffffff;top:277px;left:375px;"
                                                       class="ls-l"
                                                       data-ls="offsetxin:80;offsetxout:-80;durationout:400;parallaxlevel:0;">
                                                        <?= $slides->name ?></p>
                                                    <h1 style="text-shadow: 0px 1px 0px rgba(44, 49, 55, 0.5);
;font-size:44px;line-height:50px;color:#ffffff;top:322px;left:374px;" class="ls-l"
                                                        data-ls="offsetxin:80;offsetxout:-80;durationout:400;parallaxlevel:0;">
                                                        <?= $slides->brief ?></h1><a style=""
                                                                                     class="ls-l"
                                                                                     href="/site/dangkykham.html"
                                                                                     target="_self"
                                                                                     data-ls="offsetxin:80;offsetxout:-80;durationout:400;parallaxlevel:0;">
                                                        <p style="text-shadow: 0px 1px 0px rgba(44, 49, 55, 0.4);padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px;border-top:1px solid rgba(255, 255, 255, 0.4);border-right:1px solid rgba(255, 255, 255, 0.4);border-bottom:1px solid rgba(255, 255, 255, 0.4);border-left:1px solid rgba(255, 255, 255, 0.4);font-family:open sans;font-size:14px;color:#ffffff;top:470px;left:374px;"
                                                           class=" cmsms_layer_button booklearn">Đặt lịch khám
                                                            online</p></a><a style="" class="ls-l"
                                                                             href="<?= $slides->url ?>"
                                                                             target="_self"
                                                                             data-ls="offsetxin:80;offsetxout:-80;durationout:400;parallaxlevel:0;">
                                                        <p style="text-shadow: 0px 1px 0px rgba(44, 49, 55, 0.4);padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px;border-top:1px solid rgba(255, 255, 255, 0.4);border-right:1px solid rgba(255, 255, 255, 0.4);border-bottom:1px solid rgba(255, 255, 255, 0.4);border-left:1px solid rgba(255, 255, 255, 0.4);font-family:open sans;font-size:14px;color:#ffffff;top:470px;left:580px;"
                                                           class=" cmsms_layer_button booklearn">Tìm hiểu thêm</p></a>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="cmsmasters_row_1d42098c7b"
             class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_homepage_info cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
            <div class="cmsmasters_row_outer_parent">
                <div class="cmsmasters_row_outer">
                    <div class="cmsmasters_row_inner">
                        <div class="cmsmasters_row_margin">
                            <div id="cmsmasters_column_f8f40a3808" class="cmsmasters_column one_third">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_icon_box_2b8392b483"
                                         class="cmsmasters_icon_box cmsmasters_icon_box_left box_icon_type_icon cmsmasters-icon-phone-4">
                                        <div class="icon_box_inner">
                                            <h6 class="icon_box_heading">Gọi cho chúng tôi</h6>
                                            <div class="icon_box_text">
                                                <div id="cmsmasters_heading_768707b6b4"
                                                     class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                                    <h2 class="cmsmasters_heading"><span
                                                                style="color: #2a2d32;"><?= $config['contact_hotline']?></span>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="cmsmasters_column_d96fbd6922" class="cmsmasters_column one_third">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_icon_box_8662358f66"
                                         class="cmsmasters_icon_box cmsmasters_icon_box_left box_icon_type_icon cmsmasters-icon-mail-3">
                                        <div class="icon_box_inner">
                                            <h6 class="icon_box_heading">Gửi tin nhắn cho chúng tôi</h6>
                                            <div class="icon_box_text">
                                                <div id="cmsmasters_heading_c3ca13ac1d"
                                                     class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                                    <h2 class="cmsmasters_heading"><span
                                                                style="color: #2a2d32;"><?= $config['contact_email']?></span>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="cmsmasters_column_3bd16257a6" class="cmsmasters_column one_third">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_icon_box_64f8c052c2"
                                         class="cmsmasters_icon_box cmsmasters_icon_box_left box_icon_type_icon cmsmasters-icon-location-3">
                                        <div class="icon_box_inner">
                                            <h6 class="icon_box_heading">Địa chỉ của chúng tôi</h6>
                                            <div class="icon_box_text">
                                                <div id="cmsmasters_heading_07e02b57f5"
                                                     class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                                    <h2 class="cmsmasters_heading"><span
                                                                style="color: #2a2d32;"><?= $config['contact_address2']?></span>
                                                    </h2>
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
        <div id="cmsmasters_row_534cea9066"
             class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_homepage_featured_blocks cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
            <div class="cmsmasters_row_outer_parent">
                <div class="cmsmasters_row_outer">
                    <div class="cmsmasters_row_inner cmsmasters_row_no_margin">
                        <div class="cmsmasters_row_margin cmsmasters_row_columns_behavior">
                            <div id="cmsmasters_column_b3de0ac729" class="cmsmasters_column one_third">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_fb_aa1485ad6a" class="cmsmasters_featured_block">
                                        <div class="featured_block_inner">
                                            <div class="featured_block_text">
                                                <p><span style="color: #ffffff; font-size: 24px;">Bệnh viện Hạng 1</span>
                                                </p>
                                                <div id="cmsmasters_divider_06b86aee12" class="cl"></div>
                                                <p><span style="color: #ffffff; font-size: 13px;">
                                                        Từ tháng 3 năm 2019, Bệnh viện được công nhận là Bệnh viện Hạng 1, theo quy định xếp hạng Bệnh viện của Bộ Y tế.</span>
                                                </p>
                                                <div id="cmsmasters_divider_55404b1154" class="cl"></div>
                                                <div id="cmsmasters_button_515b9558ff" class="button_wrap">

                                                    <a href="/dau-tu-co-so-vat-chat-trang-thiet-bi-ki-thuat-dap-ung-yeu-cau-kham-chua-benh-b32.html"
                                                       class="cmsmasters_button"><span>Đọc thêm</span></a>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="cmsmasters_column_9048609f49" class="cmsmasters_column one_third">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_fb_bb413181f0" class="cmsmasters_featured_block">
                                        <div class="featured_block_inner">
                                            <div class="featured_block_text">
                                                <p>
                                                    <span style="color: #ffffff; font-size: 24px;">Đoàn kết, vượt khó</span>
                                                </p>
                                                <div id="cmsmasters_divider_3312a4c640" class="cl"></div>
                                                <p><span style="color: #ffffff; font-size: 13px;">Với những nỗ lực phấn đấu của bao thế hệ cán bộ, nhân viên Bệnh viện 70 năm qua đã đưa vị thế của Bệnh viện lên tầm cao mới.</span>
                                                </p>
                                                <div id="cmsmasters_divider_fd5401891d" class="cl"></div>
                                                <div id="cmsmasters_button_f122a87adb" class="button_wrap">
                                                    <a href="/gioi-thieu-benh-vien-quan-y-7-hai-duong-b31.html"
                                                       class="cmsmasters_button"><span>Đọc thêm</span></a>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="cmsmasters_column_27618acfd0" class="cmsmasters_column one_third">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_fb_92e0865b36"
                                         class="cmsmasters_featured_block cmsmasters_homepage_fb_opening">
                                        <div class="featured_block_inner">
                                            <div class="featured_block_text">
                                                <p><span style="color: #ffffff; font-size: 24px;">Khám chữa bệnh</span>
                                                </p>
                                                <p><span class="cmsmasters_homepage_fb_opening_item"
                                                         style="color: #ffffff;">Thời gian <span
                                                                class="align-right">24/24h</span></span><span
                                                            class="cmsmasters_homepage_fb_opening_item"
                                                            style="color: #ffffff;">Tất cả ngày trong tuần </span>
                                                </p>

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
        <div id="cmsmasters_row_760dbd339f"
             class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
            <div class="cmsmasters_row_outer_parent">
                <div class="cmsmasters_row_outer">
                    <div class="cmsmasters_row_inner">
                        <div class="cmsmasters_row_margin">
                            <div id="cmsmasters_column_e482d434d5" class="cmsmasters_column one_fourth">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_icon_0bfa97157c" class="cmsmasters_icon_wrap"><span
                                                class="cmsmasters_simple_icon cmsmasters-icon-custom-4"></span><span
                                                class="cmsmasters_simple_icon_title"></span></div>
                                    <div id="cmsmasters_heading_deac12d98e"
                                         class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                        <h3 class="cmsmasters_heading">Điều trị y tế</h3>
                                    </div>
                                    <div class="cmsmasters_text">
                                        <p>Tiếp nhận khám chữa bệnh cho bộ đội, thương bệnh binh, người có công và các đối tượng khác.</p>
                                    </div>
                                </div>
                            </div>
                            <div id="cmsmasters_column_a30bb0d274" class="cmsmasters_column one_fourth">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_icon_9eb815a220" class="cmsmasters_icon_wrap"><span
                                                class="cmsmasters_simple_icon cmsmasters-icon-custom-2"></span><span
                                                class="cmsmasters_simple_icon_title"></span></div>
                                    <div id="cmsmasters_heading_63d6aebdf4"
                                         class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                        <h3 class="cmsmasters_heading">Trợ giúp khẩn cấp</h3>
                                    </div>
                                    <div class="cmsmasters_text">
                                        <p>Luôn có lực lượng dự phòng, sẵn sàng cho mọi tình huống.</p>
                                    </div>
                                </div>
                            </div>
                            <div id="cmsmasters_column_2bef40d733" class="cmsmasters_column one_fourth">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_icon_18048982c1" class="cmsmasters_icon_wrap"><span
                                                class="cmsmasters_simple_icon cmsmasters-icon-custom-27"></span><span
                                                class="cmsmasters_simple_icon_title"></span></div>
                                    <div id="cmsmasters_heading_7aa17eb3f9"
                                         class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                        <h3 class="cmsmasters_heading">Các chuyên gia y tế </h3>
                                    </div>
                                    <div class="cmsmasters_text">
                                        <p>Thường xuyên hội chẩn giữa các chuyên khoa, giữa Bệnh viện các tuyến.</p>
                                    </div>
                                </div>
                            </div>
                            <div id="cmsmasters_column_723b4a3dcc" class="cmsmasters_column one_fourth">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_icon_0672b66f14" class="cmsmasters_icon_wrap"><span
                                                class="cmsmasters_simple_icon cmsmasters-icon-custom-6"></span><span
                                                class="cmsmasters_simple_icon_title"></span></div>
                                    <div id="cmsmasters_heading_17bc6da01b"
                                         class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                        <h3 class="cmsmasters_heading">Bác sĩ hàng đầu</h3>
                                    </div>
                                    <div class="cmsmasters_text">
                                        <p>Bác sĩ có kinh nghiệm lâu năm trong chữa trị, trình độ chuyên khoa II, chuyên khoa I.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="cmsmasters_row_2a592f7a75"
             class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_fullwidth">
            <div class="cmsmasters_row_outer_parent">
                <div class="cmsmasters_row_outer">
                    <div class="cmsmasters_row_inner cmsmasters_row_fullwidth">
                        <div class="cmsmasters_row_margin">
                            <div id="cmsmasters_column_39fb74f541" class="cmsmasters_column one_first">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_divider_ff4ccb4dbc"
                                         class="cmsmasters_divider cmsmasters_divider_width_long cmsmasters_divider_pos_center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="cmsmasters_row_1cc4d76273"
             class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
            <div class="cmsmasters_row_outer_parent">
                <div class="cmsmasters_row_outer">
                    <div class="cmsmasters_row_inner">
                        <div class="cmsmasters_row_margin">
                            <div id="cmsmasters_column_3dcbe01481" class="cmsmasters_column one_fourth">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_fb_0c7fe0f647"
                                         class="cmsmasters_featured_block cmsmasters_homepage_departments">
                                        <div class="featured_block_inner">

                                            <div class="featured_block_text">
                                                <div id="cmsmasters_heading_702072e7a2" class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                                    <h2 class="cmsmasters_heading"><a href="javascript:0">Chuyên khoa</a></h2>
                                                </div>
                                                <?php $menu = \common\models\Chuyenkhoa::find()->where(['active' => 1])->limit('5')->all();
                                                foreach ($menu as $value):
                                                    ?>
                                                    <div id="cmsmasters_heading_ea9b5d9a7a" class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                                        <h3 class="cmsmasters_heading"><a href="<?= Yii::$app->urlManager->createUrl(['site/chuyenkhoas', 'id' => $value->id, 'url' => $value->url]) ?>"><?=$value->title?></a></h3>
                                                    </div>

                                                <?php endforeach;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="cmsmasters_column_260e5b164f" class="cmsmasters_column three_fourth">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_heading_d11c3874cf"
                                         class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                        <h3 class="cmsmasters_heading">Sự đổi mới</h3>
                                    </div>
                                    <div id="cmsmasters_heading_7ae924c169"
                                         class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                        <h3 class="cmsmasters_heading">Chuyên khoa của chúng tôi</h3>
                                    </div>
                                    <div class="cmsmasters_posts_slider project">
                                        <div id="cmsmasters_slider_e1ee51ecfc"
                                             class="cmsmasters_owl_slider owl-carousel" data-items="3"
                                             data-single-item="false" data-auto-play="5000"
                                             data-pagination="false" data-navigation="true">
                                            <?php foreach (\common\models\Chuyenkhoa::find()->where(['active' => 1])->all() as $index => $value): ?>
                                                <div class="cmsmasters_owl_slider_item">
                                                    <!-- Start Posts Slider Project Article -->
                                                    <article id="post-<?= $value->id ?>"
                                                             class="cmsmasters_slider_project post-619 project type-project status-publish format-standard has-post-thumbnail hentry pj-categs-pharmacy">
                                                        <div class="cmsmasters_slider_project_outer">
                                                            <figure class="cmsmasters_img_rollover_wrap preloader">
                                                                <img width="580" height="360"
                                                                     src="<?= $value->image?>"
                                                                     class="full-width wp-post-image"
                                                                     alt="Laboratory Analysis" loading="lazy"
                                                                     title="7"
                                                                     srcset="<?= $value->image?> 580w, <?= $value->image?> 300w"
                                                                     sizes="(max-width: 580px) 100vw, 580px">
                                                                <div class="cmsmasters_img_rollover"><a
                                                                            href="<?= Yii::$app->urlManager->createUrl(['site/chuyenkhoas', 'id' => $value->id, 'url' => $value->url]) ?>"
                                                                            title="<?= $value->title ?>"
                                                                            class="cmsmasters_open_post_link"><span
                                                                                class="cmsmasters-icon-custom-11"></span></a>
                                                                </div>
                                                            </figure>
                                                            <div class="cmsmasters_slider_project_inner">
                                                                <header class="cmsmasters_slider_project_header entry-header">
                                                                    <h4 class="cmsmasters_slider_project_title entry-title">
                                                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/chuyenkhoas', 'id' => $value->id, 'url' => $value->url]) ?>"><?= $value->title ?></a></h4></header>
                                                                <div class="cmsmasters_slider_project_content entry-content">
                                                                    <p><?= $value->content ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                    <!-- Finish Posts Slider Project Article -->

                                                </div>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="cmsmasters_row_958e64ff5a"
             class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed"
             data-stellar-background-ratio="0.5">
            <div class="cmsmasters_row_outer_parent">
                <div class="cmsmasters_row_outer">
                    <div class="cmsmasters_row_inner">
                        <div class="cmsmasters_row_margin">
                            <div id="cmsmasters_column_aa7e1ce143" class="cmsmasters_column one_first">
                                <div class="cmsmasters_column_inner">
                                    <div id="cmsmasters_heading_3662c76830"
                                         class="cmsmasters_heading_wrap cmsmasters_heading_align_center">
                                        <h4 class="cmsmasters_heading">Lời chứng thực</h4>
                                    </div>
                                    <div id="cmsmasters_heading_de445fde94"
                                         class="cmsmasters_heading_wrap cmsmasters_heading_align_center">
                                        <h2 class="cmsmasters_heading">Bệnh nhân của chúng tôi nói gì</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cmsmasters_row_inner">
                        <div class="cmsmasters_row_margin">
                            <div id="cmsmasters_column_36790c8b7f" class="cmsmasters_column one_third"
                                 style="width: 100%!important;">
                                <div class="cmsmasters_column_inner">
                                    <div class="cmsmasters_quotes_slider_wrap">
                                        <div id="cmsmasters_quotes_slider_65261cd97d"
                                             class=" owl-carousel cmsmasters_quotes cmsmasters_quotes_slider cmsmasters_quotes_slider_type_box"
                                        "="" data-auto-play="false" data-pagination="true"
                                        data-navigation="false" data-navigation-prev="<span
                                                class='cmsmasters_prev_arrow'><span></span></span>"
                                        data-navigation-next="<span
                                                class='cmsmasters_next_arrow'><span></span></span>">
                                        <?php foreach (\common\models\Comment::findAll(['active' => 1]) as $index => $value): ?>
                                            <div class="cmsmasters_quote">
                                                <!-- Start Quote Slider Box Article -->
                                                <article class="cmsmasters_quote_inner"
                                                         id="cmsmasters_quote_6256991e2534d">
                                                    <style>#cmsmasters_quote_6256991e2534d .cmsmasters_quote_inner_top {
                                                            background-color: #3eb8d7;
                                                        }

                                                        #cmsmasters_quote_6256991e2534d .cmsmasters_quote_content:before {
                                                            color: #3eb8d7;
                                                        }
                                                    </style>
                                                    <div class="cmsmasters_quote_inner_top ">
                                                        <figure class="cmsmasters_quote_image"><img width="65"
                                                                                                    height="65"
                                                                                                    src="<?= $value->image ?>"
                                                                                                    class="attachment-cmsmasters-small-thumb size-cmsmasters-small-thumb"
                                                                                                    alt=""
                                                                                                    loading="lazy">
                                                        </figure>
                                                        <header class="cmsmasters_quote_header"><h4
                                                                    class="cmsmasters_quote_title"><?= $value->name ?></h4>
                                                            <div class="cmsmasters_quote_subtitle_wrap"><h5
                                                                        class="cmsmasters_quote_subtitle">
                                                                    <?= $value->job ?></h5></div>
                                                        </header>
                                                    </div>
                                                    <div class="cmsmasters_quote_content"><p><?= $value->content ?></p>

                                                    </div>
                                                    <div class="cmsmasters_quote_inner_bottom">
                                                        <p>
                                                            <?= $value->address ?></p>
                                                    </div>
                                                </article>
                                                <!-- Finish Quote Slider Box Article -->

                                            </div>
                                        <?php endforeach; ?>
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

<div id="cmsmasters_row_6a738daf32"
     class="cmsmasters_row cmsmasters_color_scheme_first cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
    <div class="cmsmasters_row_outer_parent">
        <div class="cmsmasters_row_outer">
            <div class="cmsmasters_row_inner">
                <div class="cmsmasters_row_margin">
                    <div id="cmsmasters_column_cdfc76eaea" class="cmsmasters_column one_first">
                        <div class="cmsmasters_column_inner">
                            <div id="cmsmasters_counters_103a7567d1"
                                 class="cmsmasters_counters counters_type_vertical">
                                <div class="cmsmasters_counter_wrap one_fifth">
                                    <div id="cmsmasters_counter_0a3c2aaa19" class="cmsmasters_counter"
                                         data-percent="100">
                                        <div class="cmsmasters_counter_inner">
<span class="cmsmasters_counter_counter_wrap">
<span class="cmsmasters_counter_prefix"></span><span class="cmsmasters_counter_counter">0</span><span
            class="cmsmasters_counter_suffix">%</span>
</span>
                                            <span class="cmsmasters_counter_title">Chất lượng</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="cmsmasters_counter_wrap one_fifth">
                                    <div id="cmsmasters_counter_8642f92c56" class="cmsmasters_counter"
                                         data-percent="14000">
                                        <div class="cmsmasters_counter_inner">
<span class="cmsmasters_counter_counter_wrap">
<span class="cmsmasters_counter_prefix"></span><span class="cmsmasters_counter_counter">0</span><span
            class="cmsmasters_counter_suffix"></span>
</span>
                                            <span class="cmsmasters_counter_title">Bệnh nhân một năm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="cmsmasters_counter_wrap one_fifth">
                                    <div id="cmsmasters_counter_e233143e71" class="cmsmasters_counter"
                                         data-percent="110">
                                        <div class="cmsmasters_counter_inner">
<span class="cmsmasters_counter_counter_wrap">
<span class="cmsmasters_counter_prefix"></span><span class="cmsmasters_counter_counter">0</span><span
            class="cmsmasters_counter_suffix"></span>
</span>
                                            <span class="cmsmasters_counter_title">Bác sĩ làm việc</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="cmsmasters_counter_wrap one_fifth">
                                    <div id="cmsmasters_counter_04f49e3618" class="cmsmasters_counter"
                                         data-percent="166">
                                        <div class="cmsmasters_counter_inner">
<span class="cmsmasters_counter_counter_wrap">
<span class="cmsmasters_counter_prefix"></span><span class="cmsmasters_counter_counter">0</span><span
            class="cmsmasters_counter_suffix"></span>
</span>
                                            <span class="cmsmasters_counter_title">Điều dưỡng làm việc</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="cmsmasters_counter_wrap one_fifth">
                                    <div id="cmsmasters_counter_a888fda10d" class="cmsmasters_counter"
                                         data-percent="72">
                                        <div class="cmsmasters_counter_inner">
<span class="cmsmasters_counter_counter_wrap">
<span class="cmsmasters_counter_prefix"></span><span class="cmsmasters_counter_counter">0</span><span
            class="cmsmasters_counter_suffix"></span>
</span>
                                            <span class="cmsmasters_counter_title">Năm thành lập</span>
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
<div id="cmsmasters_row_f9b2ca92d1"
     class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
    <div class="cmsmasters_row_outer_parent">
        <div class="cmsmasters_row_outer">
            <div class="cmsmasters_row_inner">
                <div class="cmsmasters_row_margin">
                    <div id="cmsmasters_column_f4f69ab1b1" class="cmsmasters_column one_first">
                        <div class="cmsmasters_column_inner">
                            <div id="cmsmasters_heading_a23970834b"
                                 class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                <h3 class="cmsmasters_heading">Chuyên gia</h3>
                            </div>
                            <div id="cmsmasters_heading_4517861ec2"
                                 class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                <h3 class="cmsmasters_heading">Bác sĩ của chúng tôi</h3>
                            </div>
                            <div id="cmsmasters_profile_6256991e26613" class="cmsmasters_profile horizontal">
                                <!-- Start Profile Horizontal Article -->
                                <?php  foreach (\common\models\Nhansu::findAll(['active' => 1]) as $nhansu => $value): ?>
                                    <article id="post-<?= $value->id ?>"
                                             class="cmsmasters_profile_horizontal one_fourth post-9427 profile type-profile status-publish has-post-thumbnail hentry pl-categs-throat-specialist">
                                        <div class="profile_outer">
                                            <figure class="cmsmasters_img_wrap">
                                                <a href="<?=$value->facebook?>"
                                                   title="<?= $value->name ?>" class="cmsmasters_img_link cmsmasters-icon-custom-6"><img
                                                            width="500" height="500"
                                                            src="<?= $value->image ?>"
                                                            class=" wp-post-image" alt="<?= $value->name ?>"
                                                            loading="lazy" title="1"
                                                            sizes="(max-width: 500px) 100vw, 500px">
                                                </a></figure>
                                            <div class="profile_inner">
                                                <header class="cmsmasters_profile_header entry-header" style="text-align: center">
                                                    <h4
                                                            class="cmsmasters_profile_title entry-title"><?= $value->capbac?><br><?= $value->name ?></h4>
                                                    <h6
                                                            class="cmsmasters_profile_subtitle"><?= $value->job ?>
                                                    </h6>
                                                </header>
                                                <div class="cmsmasters_profile_content entry-content" style="text-align: center">
                                                    <p><?= $value->content ?></p>
                                                </div>
                                                <div class="cmsmasters_profile_content entry-content" style="text-align: center">
                                                    <p><?= $value->phone ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                <?php endforeach;?>
                                <!-- Finish Profile Horizontal Article -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="cmsmasters_row_98e0b18ffe"
     class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_fullwidth">
    <div class="cmsmasters_row_outer_parent">
        <div class="cmsmasters_row_outer">
            <div class="cmsmasters_row_inner cmsmasters_row_fullwidth">
                <div class="cmsmasters_row_margin">
                    <div id="cmsmasters_column_28d4e491b8" class="cmsmasters_column one_first">
                        <div class="cmsmasters_column_inner">
                            <div id="cmsmasters_divider_917201f89b"
                                 class="cmsmasters_divider cmsmasters_divider_width_long cmsmasters_divider_pos_center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="cmsmasters_row_f097564cae"
     class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
    <div class="cmsmasters_row_outer_parent">
        <div class="cmsmasters_row_outer">
            <div class="cmsmasters_row_inner">
                <div class="cmsmasters_row_margin">
                    <div id="cmsmasters_column_fd111dc411" class="cmsmasters_column three_fourth">
                        <div class="cmsmasters_column_inner">
                            <div id="cmsmasters_heading_d11c3874cf"
                                 class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                <h3 class="cmsmasters_heading">Tin mới nhất</h3>
                            </div>
                            <div id="cmsmasters_heading_7ae924c169"
                                 class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                <h3 class="cmsmasters_heading">Hãy là người đầu tiên đọc tin tức</h3>
                            </div>
                            <div class="cmsmasters_posts_slider post">
                                <div id="cmsmasters_slider_b7d2b499c1"
                                     class="owl-carousel" data-items="3"
                                     data-single-item="false" data-auto-play="5000" data-pagination="false"
                                     data-navigation="true">
                                    <?php foreach (\common\models\News::find()->where(['hot'=>1,'pheduyet'=>1])->orderBy('id desc')->all() as $value):?>
                                        <div class="cmsmasters_owl_slider_item">
                                            <!-- Start Posts Slider Post Article -->
                                            <article id="post-10736"
                                                     class="cmsmasters_slider_post post-10736 post type-post status-publish format-image has-post-thumbnail hentry category-advice post_format-post-format-image">
                                                <div class="cmsmasters_slider_post_outer">
                                                    <div class="cmsmasters_slider_post_img_wrap">
                                                        <figure class="cmsmasters_img_rollover_wrap preloader"><img
                                                                    width="580" height="360"
                                                                    src="<?= Yii::$app->urlManager->baseUrl . $value->image ?>"
                                                                    class="full-width wp-post-image"
                                                                    alt="<?= $value->title ?>"
                                                                    loading="lazy" title="1">
                                                            <div class="cmsmasters_img_rollover"><a
                                                                        href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>"
                                                                        title="<?= $value->title ?>"
                                                                        class="cmsmasters_open_link"></a></div>
                                                        </figure>
                                                    </div>
                                                    <div class="cmsmasters_slider_post_inner">
                                                        <div class="cmsmasters_slider_post_inner_header">
                                                        <span
                                                                class="cmsmasters_slider_post_date cmsmasters-icon-calendar-3">
                                                            <abbr class="published" title="<?= $value->posted_date ?>">
                                                                <span class="cmsmasters_day_mon"><?= $value->posted_date ?></span>
                                                            </abbr>
                                                            <abbr
                                                                    class="dn date updated"
                                                                    title="<?= $value->posted_date ?>"><?= $value->posted_date ?>
                                                            </abbr>
                                                        </span>
                                                            <div class="cmsmasters_slider_post_meta_wrap entry-meta"></div>
                                                        </div>
                                                        <header class="cmsmasters_slider_post_header entry-header">
                                                            <h4 class="cmsmasters_slider_post_title entry-title"><a
                                                                        href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>"><?= $value->title ?></a></h4>
                                                        </header>
                                                        <div class="cmsmasters_slider_post_content entry-content">
                                                            <p><?= $value->brief ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                            <!-- Finish Posts Slider Post Article -->

                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="cmsmasters_column_af254245e0" class="cmsmasters_column one_fourth">
                        <div class="cmsmasters_column_inner">
                            <div id="cmsmasters_fb_7fb3382d2c" class="cmsmasters_featured_block">
                                <div class="featured_block_inner">
                                    <div class="featured_block_text">
                                        <p><span style="font-size: 26px;"><span
                                                        style="color: #ffffff;"></span><br>
<span style="font-size: 16px; color: #a8cbff;"></span><br>
<span style="font-size: 16px; color: #a8cbff;"></span><br>
</span></p>

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
<div id="cmsmasters_row_14f3008ed9"
     class="cmsmasters_row cmsmasters_color_scheme_second cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
    <div class="cmsmasters_row_outer_parent">
        <div class="cmsmasters_row_outer">
            <div class="cmsmasters_row_inner">
                <div class="cmsmasters_row_margin">
                    <div id="cmsmasters_column_6c166ae253" class="cmsmasters_column one_half">
                        <div class="cmsmasters_column_inner">
                            <div id="cmsmasters_fb_85a3972ad4"
                                 class="cmsmasters_featured_block cmsmasters_make_an_appointment">
                                <div class="featured_block_inner">
                                    <div class="featured_block_text">
                                        <div id="cmsmasters_heading_74905cdcb5"
                                             class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                            <h2 class="cmsmasters_heading"> Đặt lịch khám online</h2>
                                        </div>
                                        <div class="cmsmasters_contact_form">
                                            <div>
                                                <div role="form" class="wpcf7" id="wpcf7-f14612-p7366-o1"
                                                     lang="en-US" dir="ltr">
                                                    <div class="screen-reader-response"><p role="status"
                                                                                           aria-live="polite"
                                                                                           aria-atomic="true"></p>
                                                        <ul></ul>
                                                    </div>
                                                    <img id="preloadimg" style="width: 100%" src="/images/loading.gif">
                                                    <div id="hidden-input" style="display: none">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Họ và tên
                                                            </label>
                                                            <input required type="text" class="form-control" id="hovaten" name="hovaten">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                CMND/CCCD
                                                            </label>
                                                            <input required type="text" class="form-control" id="cccd" name="cccd">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Số điện thoại
                                                            </label>
                                                            <input required type="text" class="form-control" id="sdt" name="sdt">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Ngày giờ hẹn khám
                                                            </label>
                                                            <input required type="datetime-local" class="form-control" id="ngaygiohenkham" name="ngaygiohenkham">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Mô tả triệu chứng
                                                            </label>
                                                            <input type="text" class="form-control" id="motatrieuchung"  name="motatrieuchung">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Chuyên khoa khám
                                                            </label>
                                                            <select required class="form-control" id="chuyenkhoa" name="chuyenkhoa"></select>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button id="dangky" class="btn btn-success">Đăng ký</button>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function(){
                                                            $('input[name="cccd"]').keyup(function(e)
                                                            {
                                                                if (/\D/g.test(this.value))
                                                                {
                                                                    // Filter non-digits from input value.
                                                                    this.value = this.value.replace(/\D/g, '');
                                                                }
                                                            });
                                                            $('input[name="sdt"]').keyup(function(e)
                                                            {
                                                                if (/\D/g.test(this.value))
                                                                {
                                                                    // Filter non-digits from input value.
                                                                    this.value = this.value.replace(/\D/g, '');
                                                                }
                                                            });
                                                            var t = $("#chuyenkhoa");
                                                            $.ajax({
                                                                url:"https://ttkc.techber.vn/api/services/app/PortalAppServices/PortalGetListChuyenKhoa",
                                                                type:'post',
                                                                dataType:'json',
                                                                contentType: "application/json",
                                                                data: JSON.stringify({
                                                                    token:"<?=$config['api_token']?>"
                                                                }),
                                                                success: function (data) {
                                                                    $.each(data.result.chuyenKhoaDtos,function (index,value) {
                                                                        t.append("<option value='"+value.id+"'>"+value.ten+"</option>")
                                                                    });

                                                                    $("#preloadimg").fadeOut();
                                                                    $("#hidden-input").fadeIn();
                                                                }
                                                            });

                                                            $(document).on("click","#dangky",function () {
                                                                var hovaten = $("#hovaten").val();
                                                                var sdt = $("#sdt").val();
                                                                var ngaygiohenkham = $("#ngaygiohenkham").val();
                                                                var motatrieuchung = $("#motatrieuchung").val();
                                                                var cccd = $("#cccd").val();
                                                                var chuyenkhoa = $("#chuyenkhoa").val();
                                                                if(hovaten==="" || ngaygiohenkham==="" || cccd==="" || chuyenkhoa === ""|| sdt === ""){
                                                                    alert("Chưa nhập đủ thông tin!");
                                                                }else{
                                                                    $.ajax({
                                                                        url:"https://ttkc.techber.vn/api/services/app/PortalAppServices/PortalRegister",
                                                                        type:'post',
                                                                        contentType: "application/json",
                                                                        dataType:'json',
                                                                        data:JSON.stringify({
                                                                            token: "<?=$config['api_token']?>",
                                                                            hovaten:hovaten,
                                                                            ngaygiohenkham:ngaygiohenkham+":00Z",
                                                                            motatrieuchung:motatrieuchung,
                                                                            cccd:cccd,
                                                                            sdt:sdt,
                                                                            chuyenkhoa:chuyenkhoa,
                                                                        }),
                                                                        success: function (data) {
                                                                            console.log(data);
                                                                            alert(data.result.message);
                                                                            $("#hidden-input").html("<p class='alert "+(data.result.status?"alert-success-white":"alert-warning")+"'>"+data.result.message+"</p>")
                                                                        }
                                                                    });
                                                                }

                                                            })
                                                        })
                                                    </script>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="cmsmasters_column_b2d4062cec" class="cmsmasters_column one_half">
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
                            <div id="cmsmasters_heading_c929622c59"
                                 class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                <h3 class="cmsmasters_heading">HÌNH THỨC HẸN KHÁM THÔNG THƯỜNG:</h3>

                            </div>
                            <br>
                            <div class="cmsmasters_text">
                                <div class="wpb_text_column wpb_content_element ">
                                    <h3>ĐẶT HẸN QUA TỔNG ĐÀI: </h3>
                                </div>
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p>Quý khách liên hệ trực tiếp đến số điện thoại của Bệnh Quân Y 7:<br> <a href="tel:<?= $config['contact_phone'] ?>"><?= $config['contact_phone'] ?></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="cmsmasters_text">
                                <div class="wpb_text_column wpb_content_element ">
                                    <h3>ĐẶT HẸN TRỰC TUYẾN: </h3>
                                </div>
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p>Quý khách truy cập vào đường link <a href="/site/dangkykham.html">đặt lịch khám</a> này.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="cmsmasters_divider_c76ef93988" class="cl"></div>
                            <div class="cmsmasters_sidebar sidebar_layout_1212">
                                <aside id="custom-contact-info-4" class="widget widget_custom_contact_info_entries">
                                    <h3 class="widgettitle">BÊNH VIỆN QUÂN Y 7</h3>
                                    <div class="adr adress_wrap cmsmasters_theme_icon_user_address"><span
                                                class="street-address contact_widget_address contact_widget_address-custom"><?php echo $config['contact_address'] ?></span>
                                    </div>
                                    <span class="contact_widget_email cmsmasters_theme_icon_user_mail"><a
                                                class="email"
                                                href="mailto:<?= $config['contact_email'] ?>"><?= $config['contact_email'] ?></a></span><span
                                            class="contact_widget_phone cmsmasters_theme_icon_user_phone"><span
                                                class="tel tel-custom"><?= $config['contact_phone'] ?></span></span></aside>
                                <div class="cl"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="cmsmasters_row_fdanhgia"
     class="cmsmasters_row cmsmasters_color_scheme_second cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
    <div class="cmsmasters_row_outer_parent">
        <div class="cmsmasters_row_outer">
            <div class="cmsmasters_row_inner">
                <div class="cmsmasters_row_margin">
                    <div id="cmsmasters_column_6c166ae253" class="cmsmasters_column">
                        <form method="post" id="poll_form">
                            <br />
                            <h3 style="text-align: center;font-weight: bold">THĂM DÒ Ý KIẾN</h3>
                            <p style="text-align: center;">Bạn có thấy hài lòng khi khám bệnh tại bệnh viện không?</p>
                            <div class="col-xs-12" style="margin-bottom: 15px">
                                <div class="col-md-10">
                                    <div class="col-xs-12">
                                        <div class="radio col-md-3">
                                            <label>
                                                <input type="radio" class="poll_option" name="poll_option" value="khonghailong" /> Không hài lòng
                                            </label>
                                        </div>
                                        <div class="radio col-md-3">
                                            <label>
                                                <input type="radio" class="poll_option" name="poll_option" value="binhthuong" /> Bình thường
                                            </label>
                                        </div>
                                        <div class="radio col-md-3">
                                            <label>
                                                <input type="radio" class="poll_option" name="poll_option" value="hailong" /> Hài lòng
                                            </label>
                                        </div>
                                        <div class="radio col-md-3">
                                            <label>
                                                <input type="radio" class="poll_option" name="poll_option" value="rathailong" /> Rất hài lòng
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" value="Gửi" name="poll_button" id="poll_button" class="btn btn-primary" />
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $videos = \common\models\Video::find()->all();
if (!empty($videos)): ?>
    <div id="cmsmasters_row_f097564cae" class="outer">
        <div id="big" class="owl-carousel owl-theme">
            <?php foreach ($videos as $value): ?>
                <div class="item">
                    <iframe class="player" type="text/html" width="100%" height="500"
                            src="https://www.youtube.com/embed/<?= $value->code ?>"
                            frameborder="0"></iframe>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
<?php $lienkets = \common\models\Lienket::findAll(['active' => 1]);
if (!empty($lienkets)): ?>
    <div id="cmsmasters_row_f5693c5c3c"
         class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
        <div class="cmsmasters_row_outer_parent">
            <div class="cmsmasters_row_outer">
                <div class="cmsmasters_row_inner">
                    <div id="lienket" class="cmsmasters_slider_e1ee51abcd cmsmasters_row_margin">
                        <h3 style="text-align: center;font-weight: bold">TRANG LIÊN KẾT</h3>
                        <?php foreach ($lienkets as $value): ?>
                            <a ng-repeat="item in webLink"
                               href="<?= $value->lienket ?>"
                               target="_blank" class="ng-scope">
                                <img style="width: 150px; height:60px; object-fit: cover;"
                                     ng-src="<?= $value->hinhanh ?>"
                                     alt=""
                                     src="<?= $value->hinhanh ?>">
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>

<script>
    $(document).ready(function() {
        var bigimage = $("#big");
        var thumbs = $("#thumbs");
        //var totalslides = 10;
        var syncedSecondary = true;

        bigimage
            .owlCarousel({
                items: 1,
                slideSpeed: 40000,
                nav: true,
                animateOut: 'fadeOut',
                autoplay: false,
                dots: false,
                loop: true,
                responsiveRefreshRate: 200,
                navText: [
                    '<i aria-hidden="true"><</i>',
                    '<i aria-hidden="true">></i>'
                ]
            })
            .on("changed.owl.carousel", syncPosition);

        thumbs
            .on("initialized.owl.carousel", function() {
                thumbs
                    .find(".owl-item")
                    .eq(0)
                    .addClass("current");
            })
            .owlCarousel({
                items: 4,
                dots: true,
                nav: true,
                navText: [
                    '<i aria-hidden="true"><</i>',
                    '<i aria-hidden="true">></i>'
                ],
                smartSpeed: 200,
                slideSpeed: 500,
                slideBy: 4,
                responsiveRefreshRate: 100
            })
            .on("changed.owl.carousel", syncPosition2);

        function syncPosition(el) {
            //if loop is set to false, then you have to uncomment the next line
            //var current = el.item.index;

            //to disable loop, comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
            $('#counter').html("item "+current+" of "+count);
            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
            //to this
            thumbs
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = thumbs.find(".owl-item.active").length - 1;
            var start = thumbs
                .find(".owl-item.active")
                .first()
                .index();
            var end = thumbs
                .find(".owl-item.active")
                .last()
                .index();

            if (current > end) {
                thumbs.data("owl.carousel").to(current, 100, true);
            }
            if (current < start) {
                thumbs.data("owl.carousel").to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                bigimage.data("owl.carousel").to(number, 100, true);
            }
        }

        thumbs.on("click", ".owl-item", function(e) {
            e.preventDefault();
            var number = $(this).index();
            bigimage.data("owl.carousel").to(number, 300, true);
        });
    });

</script>

<!--    Rating -->
<script src="/js/index.js"></script>