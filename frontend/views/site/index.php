<?php

$config = \common\models\Configure::getConfig();
$this->context->og_type = 'website';
$this->context->og_image = $config['contact_logo'];
$catnew = \common\models\Catnew::find()->where(['position' => 3])->all();
\johnitvn\ajaxcrud\CrudAsset::register($this);

?>
<?php $slides = \common\models\Slides::findAll(['active' => 1, 'position' => 'main']);
if (!empty($slides)): ?>
    <div id="BodyContent_ctl00_banner" class="ecm-panel">
        <section class="home-banner">

            <?php foreach ($slides as $slide): ?>
                <a href="#">
                    <img class="hidden-xs hidden-sm" src="<?= $slide->image ?>">

                    <img class="hidden-md hidden-lg hidden-sm" src="<?= $slide->image ?>">
                </a>
            <?php endforeach; ?>

        </section>
        <div class="hidden-md hidden-lg hidden-sm" style="margin: 80px">

        </div>
        <div style="position: relative;text-align: center; margin: 20px 0">
            <div style="position: absolute;width: 100%; top:-80px">
                <div class="info-boxes">
                    <a href="tel:02206255135" class="info-box">
                        <div class="icon">📞</div>
                        <div class="content">
                            <h4>Liên hệ</h4>
                            <p>Tư vấn và giải đáp các vấn đề của bạn</p>
                        </div>
                    </a>
                    <a href="https://hisbvqy7.vn/dangkykham" class="info-box">
                        <div class="icon">📅</div>
                        <div class="content">
                            <h4>Đặt lịch khám</h4>
                            <p>Đặt lịch hẹn nhanh chóng, tiện lợi</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#Slideslide-0").owlCarousel({
                autoplay: true,
                autoplayTimeout: 10500,//Autoplay interval timeout.
                loop: true,
                responsive: {
                    0: {
                        items: 1
                    },
                },
                slideSpeed: 2500,
                paginationSpeed: 2500,
                rewindSpeed: 2500,
                smartSpeed: 2500,
                addClassActive: true,
                lazyLoad: true,
                navigation: true,
                stopOnHover: true,
                pagination: false,
                scrollPerPage: true,
            });
        })
    </script>

<?php endif; ?>
<style>
    .info-boxes {
        display: flex;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 600px;
        margin: auto;
        font-family: sans-serif;
    }

    .info-box {
        flex: 1;
        display: flex;
        align-items: center;
        padding: 15px;
        gap: 10px;
    }

    .info-box:not(:last-child) {
        border-right: 1px solid #ddd;
    }

    .icon {
        font-size: 20px;
        color: #00a0c6;
    }

    .content h4 {
        margin: 0;
        color: #00a0c6;
        font-size: 16px;
    }

    .content p {
        margin: 4px 0 0;
        font-size: 13px;
        color: #555;
    }
</style>


<div class="row-0 home-row">
    <div class="container">
        <div class="row ">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div id="BodyContent_ctl00_row0block1" class="ecm-panel">
                    <!--//========================== PAGE LINKS ================================//-->
                    <div class="home-calendar animate__animated  animate__pulse" style="background: darkred">
                        <h2>Khám cấp cứu 24/24&nbsp;</h2>

                        <span>&nbsp;Từ thứ 2 - thứ 6: <b>Sáng 7h00 - 11h00 </b></span>
                        <span><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;<b>Chiều 14h00 - 17h00</b> / Thứ 7, CN <b>khám cấp cứu</b> </span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row-1 home-row">
    <div class="container">
        <div class="row ">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div id="BodyContent_ctl00_row1block1" class="ecm-panel">
                    <div class="highlight-block">
                        <div class="title-section">
                            <h2>Tin nổi bật</h2>
                        </div>

                        <div class="news-feature-first">
                            <?php $tinnoibat = \common\models\News::find()->where(['active' => 1, 'pheduyet' => 1])->orderBy('id desc')->limit(1)->all(); ?>
                            <?php foreach ($tinnoibat as $value): ?>
                                <article class="item">
                                    <figure style="height: 350px!important; overflow: hidden">
                                        <a style="height: 100%;display: block" href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>">
                                            <img src="<?= Yii::$app->urlManager->baseUrl . $value->image ?>" style="width: 100%;object-fit: contain"
                                                 alt="<?= $value->title ?>">

                                        </a>
                                    </figure>
                                    <div class="info">
                                        <div class="info-content">
                                            <div class="title">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>"
                                                   title="<?= $value->title ?>">
                                                    <h3>
                                                        <?= $value->title ?>
                                                    </h3>
                                                </a>
                                            </div>
                                            <div class="date">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                                                <?= $value->posted_date ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>


                        <div class="news-feature-recent">
							<div class="row" style="display: flex; flex-wrap: wrap; margin: 0 -5px;">
								<?php $tinnoibat = \common\models\News::find()->where(['active' => 1, 'pheduyet' => 1])->orderBy('id desc')->limit(10)->all(); ?>
								<?php foreach ($tinnoibat as $value): ?>
									<div class="col-4" style="padding: 5px; display: flex;">
										<article class="item" style="border: 1px solid #eee; border-radius: 5px; padding: 10px; display: flex; flex-direction: column; width: 100%;">
											<figure style="height: 150px; overflow: hidden; margin: 0 0 10px 0; flex-shrink: 0;">
												<a style="height: 150px; display: block;" href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>">
													<img src="<?= Yii::$app->urlManager->baseUrl . $value->image ?>"
														 alt="<?= $value->title ?>"
														 style="width: 100%; height: 100% !important; object-fit: cover; transition: transform 0.5s ease;">
												</a>
											</figure>
											<div class="info" style="flex-grow: 1; display: flex; flex-direction: column;">
												<div class="info-content" style="flex-grow: 1;">
													<div class="title">
														<a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>"
														   title="<?= $value->title ?>">
															<h3 style="margin: 0 0 8px 0; font-size: 14px; line-height: 1.3; min-height: 36px;">
																<?= $value->title ?>
															</h3>
														</a>
													</div>
													<div class="date" style="font-size: 12px; color: #666; margin-top: auto;">
														<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
														<?= $value->posted_date ?>
													</div>
												</div>
											</div>
										</article>
									</div>
								<?php endforeach; ?>
							</div>
						</div>

						<style>
						.news-feature-recent figure img:hover {
							transform: scale(1.05);
						}
						</style>

						

                    </div>

                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div id="BodyContent_ctl00_row1block2" class="ecm-panel">
                    <div class="home-notification-block">
                        <?php foreach ($catnew as $indenew => $valuenew):
                            if ($indenew == 5):
                                ?>
                                <div class="title-section">
                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/listnews', 'catname' => func::taoduongdan($valuenew->name), 'id' => $valuenew->id]) ?>">
                                        <h2><?= $valuenew->name ?></h2>
                                    </a>
                                    <a class="view-more"
                                       href="<?= Yii::$app->urlManager->createUrl(['site/listnews', 'catname' => func::taoduongdan($valuenew->name), 'id' => $valuenew->id]) ?>">Xem
                                        thêm tin</a>
                                </div>
                                <style>
                                    .marquee {
                                        overflow: hidden!important;
                                        position: relative;
                                    }

                                    .marquee-inner {
                                        display: flex;
                                        flex-direction: column;
                                        animation: scroll-up 25s linear infinite;
                                    }

                                    .marquee-inner ul {
                                        list-style: none;
                                        margin: 0;
                                        padding: 0;
                                    }
                                    .marquee:hover .marquee-inner {
                                        animation-play-state: paused;
                                    }
                                    .marquee-inner li {
                                        padding: 10px 15px;
                                        border-bottom: 1px dashed #ccc;
                                        /*background: #f9f9f9;*/
                                    }

                                    .marquee-inner .blank-space {
                                        height: 100px; /* khoảng trắng phía dưới để tạo hiệu ứng lặp */
                                        background: transparent;
                                        border-bottom: none;
                                    }

                                    /* Animation cuộn lên */
                                    @keyframes scroll-up {
                                        0% {
                                            transform: translateY(100%);
                                        }
                                        100% {
                                            transform: translateY(-100%);
                                        }
                                    }
                                </style>
                                <div class="home-info-notification-content marquee" style="height: 650px">
                                    <div class="marquee-inner">
                                        <ul>
                                            <?php $new = \common\models\News::find()->where(['active' => 1, 'pheduyet' => 1, 'cat_new_id' => $valuenew->id])->orderBy('id desc')->limit(10)->all();
                                            foreach ($new as $indexz => $valuez):?>
                                                <li>
                                                    <a href="<?= $valuez->getUrl() ?>"><?= $valuez->title ?></a>
                                                    <div class="date">
                                                        <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                                                        <?= $valuez->posted_date ?>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif;endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row-21 home-row" style="background: #d9f3dd">
    <div class="container">
        <div class="row ">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div id="BodyContent_ctl00_row21block1" class="ecm-panel">

                    <script type="text/javascript">

                    </script>
                    <div class="home-danhba">
                        <div class="title-section">
                            <h2>Chuyên gia KH&amp;CN</h2>
                        </div>
                        <div id="homedanhba">
                            <?php foreach (\common\models\Nhansu::find()->where(['active' => 1])->orderBy("ord asc")->all() as $nhansu => $value): ?>
                                <div class="item-outer">
                                    <article class="item">
                                        <figure style="float: none!important;margin: auto!important;background: none!important;">
                                            <a>
                                                <img src="<?= $value->image ?>"
                                                     alt="<?= $value->name ?>">
                                            </a>
                                        </figure>
                                        <div class="info" style="display:block;">
                                            <div class="info-content">
                                                <div class="danhba-info" style="text-align: center">
                                                    <a class="name">
                                                        <?= $value->name ?>
                                                    </a>
                                                    <div class="chucvu" style="height: 30px; max-height: 30px">
                                                        <?= $value->job ?>
                                                    </div>
                                                    <div class="khoa" style="height: 30px; max-height: 30px">
                                                        <b>Chuyên môn:</b>&nbsp;<?= $value->content ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endforeach; ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row-3 home-row">
    <div class="container">
        <div class="row ">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div id="BodyContent_ctl00_row3block1" class="ecm-panel">
                    <div class="home-block-new block-type-2">
                        <div class="title-section">
                            <h2>Video</h2>
                            <a class="view-more"
                               href="/list-video.html">Xem
                                thêm tin</a>
                        </div>
                        <div class="home-block-new-content">
                            <?php foreach (\common\models\Video::find()->where(['active' => 1])->orderBy('id desc')->limit(4)->all() as $value): ?>
                                <article class="item">
                                    <figure style="height: 200px!important;overflow: hidden;border: 1px solid #ddd">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/video', 'id' => $value->id]) ?>">
                                            <img src="<?= Yii::$app->urlManager->baseUrl . $value->image ?>"
                                                 style="background-image: url('<?= Yii::$app->urlManager->baseUrl . $value->image ?>');width: 100%;height: 100%;object-fit: contain"
                                                 alt="<?= $value->name ?>">
                                            <div class="play-btn"></div>
                                        </a>
                                    </figure>
                                    <div class="info">
                                        <div class="info-content">
                                            <div class="title">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['site/video', 'id' => $value->id]) ?>">
                                                    <h3 title="<?= $value->name ?>">
                                                        <?= $value->name ?>
                                                    </h3>
                                                </a>
                                            </div>
                                            <div class="desc" title="">

                                            </div>

                                            <div class="foot">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['site/video', 'id' => $value->id]) ?>">Chi
                                                    tiết </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div id="BodyContent_ctl00_row3block2" class="ecm-panel">
                    <div class="home-block-new block-type-3">
                        <?php
                        foreach ($catnew as $indenew => $valuenew):
                            if ($indenew <= 0):
                                ?>

                                <div class="title-section">
                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/listnews', 'catname' => func::taoduongdan($valuenew->name), 'id' => $valuenew->id]) ?>">
                                        <h2><?= $valuenew->name ?></h2>
                                    </a>
                                    <a class="view-more"
                                       href="<?= Yii::$app->urlManager->createUrl(['site/listnews', 'catname' => func::taoduongdan($valuenew->name), 'id' => $valuenew->id]) ?>">Xem
                                        thêm tin</a>
                                </div>
                                <div class="home-block-new-content">

                                    <?php $new = \common\models\News::find()->where(['active' => 1, 'pheduyet' => 1, 'cat_new_id' => $valuenew->id])->orderBy('id desc')->limit(10)->all();
                                    foreach ($new as $indexz => $valuez):
                                        ?>
                                        <article class="item">
                                            <figure>
                                                <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $valuez->id, 'url' => $valuez->url, 'catname' => func::taoduongdan($valuez->catNew->name)]) ?>">
                                                    <img src="<?= Yii::$app->urlManager->baseUrl . $valuez->image ?>"
                                                         style="background-image: url('<?= Yii::$app->urlManager->baseUrl . $valuez->image ?>')"
                                                         alt="<?= $valuez->title ?>">
                                                    <div class=""></div>
                                                </a>
                                            </figure>
                                            <div class="info">
                                                <div class="info-content">
                                                    <div class="title">
                                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $valuez->id, 'url' => $valuez->url, 'catname' => func::taoduongdan($valuez->catNew->name)]) ?>">
                                                            <h3 title="<?= $valuez->title ?>">
                                                                <?= $valuez->title ?>
                                                            </h3>
                                                        </a>
                                                    </div>
                                                    <div class="date">
                                                        <i class="fa fa-clock-o"></i>&nbsp;
                                                        <?= $valuez->posted_date ?>
                                                    </div>
                                                    <div class="desc">
                                                        <?= $valuez->brief ?>
                                                    </div>

                                                    <div class="foot">
                                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $valuez->id, 'url' => $valuez->url, 'catname' => func::taoduongdan($valuez->catNew->name)]) ?>">Chi
                                                            tiết </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row-4 home-row">
        <div class="container">
            <div class="row ">
                <?php

                foreach ($catnew as $indexv => $valuev):
                    if ($indexv > 0 && $indexv <= 2):
                        ?>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div id="BodyContent_ctl00_row4blocck1" class="ecm-panel">
                                <div class="home-block-new block-type-1">
                                    <div class="title-section">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/listnews', 'catname' => func::taoduongdan($valuev->name), 'id' => $valuev->id]) ?>">
                                            <h2><?= $valuev->name ?></h2>
                                        </a>
                                        <a class="view-more"
                                           href="<?= Yii::$app->urlManager->createUrl(['site/listnews', 'catname' => func::taoduongdan($valuev->name), 'id' => $valuev->id]) ?>">Xem
                                            thêm tin</a>
                                    </div>
                                    <div class="home-block-new-content">
                                        <?php $new = \common\models\News::find()->where(['active' => 1, 'pheduyet' => 1, 'cat_new_id' => $valuev->id])->orderBy('id desc')->limit('3')->all();
                                        foreach ($new as $indexz => $valuez):
                                            ?>
                                            <article class="item">
                                                <figure style="height: 150px!important;overflow: hidden;border: 1px solid #ddd">
                                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $valuez->id, 'url' => $valuez->url, 'catname' => func::taoduongdan($valuez->catNew->name)]) ?>">
                                                        <img src="<?= Yii::$app->urlManager->baseUrl . $valuez->image ?>"
                                                             style="background-image: url('<?= Yii::$app->urlManager->baseUrl . $valuez->image ?>');width: 100%;height: 100%;object-fit: contain"
                                                             alt="<?= $valuez->title ?>">
                                                        <div class=""></div>
                                                    </a>
                                                </figure>
                                                <div class="info">
                                                    <div class="info-content">
                                                        <div class="title">
                                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $valuez->id, 'url' => $valuez->url, 'catname' => func::taoduongdan($valuez->catNew->name)]) ?>">
                                                                <h3 title="<?= $valuez->title ?>">
                                                                    <?= $valuez->title ?>
                                                                </h3>
                                                            </a>
                                                        </div>
                                                        <div class="date">
                                                            <i class="fa fa-clock-o"></i>&nbsp;
                                                            <?= $valuez->posted_date ?>
                                                        </div>
                                                        <div class="desc">
                                                            <?= $valuez->brief ?>
                                                        </div>

                                                        <div class="foot">
                                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $valuez->id, 'url' => $valuez->url, 'catname' => func::taoduongdan($valuez->catNew->name)]) ?>">Chi
                                                                tiết </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>

                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif;endforeach; ?>
            </div>
        </div>
    </div>

    <div class="row-5 home-row">
        <div class="container">
            <div class="row ">
                <?php

                foreach ($catnew as $indexv => $valuev):
                    if ($indexv == 3):
                        ?>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                            <div id="BodyContent_ctl00_row5block1" class="ecm-panel">
                                <div class="home-block-new block-type-4">
                                    <div class="title-section">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/listnews', 'catname' => func::taoduongdan($valuev->name), 'id' => $valuev->id]) ?>">
                                            <h2><?= $valuev->name ?></h2>
                                        </a>
                                        <a class="view-more"
                                           href="<?= Yii::$app->urlManager->createUrl(['site/listnews', 'catname' => func::taoduongdan($valuev->name), 'id' => $valuev->id]) ?>">Xem
                                            thêm tin</a>
                                    </div>
                                    <div class="home-block-new-content">

                                        <?php
                                        $new = \common\models\News::find()->where(['active' => 1, 'pheduyet' => 1, 'cat_new_id' => $valuev->id])->orderBy('id desc')->limit(10)->all();
                                        foreach ($new as $indexz => $valuez):
                                            ?>

                                            <article class="item">
                                                <figure style="height: 150px!important;overflow: hidden;border: 1px solid #ddd">
                                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $valuez->id, 'url' => $valuez->url, 'catname' => func::taoduongdan($valuez->catNew->name)]) ?>">
                                                        <img src="<?= Yii::$app->urlManager->baseUrl . $valuez->image ?>"
                                                             style="background-image: url('<?= Yii::$app->urlManager->baseUrl . $valuez->image ?>');width: 100%;height: 100%;object-fit: contain"
                                                             alt="<?= $valuez->title ?>">
                                                        <div class=""></div>
                                                    </a>
                                                </figure>
                                                <div class="info">
                                                    <div class="info-content">
                                                        <div class="title">
                                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $valuez->id, 'url' => $valuez->url, 'catname' => func::taoduongdan($valuez->catNew->name)]) ?>">
                                                                <h3 title="<?= $valuez->title ?>">
                                                                    <?= $valuez->title ?>
                                                                </h3>
                                                            </a>
                                                        </div>
                                                        <div class="date">
                                                            <i class="fa fa-clock-o"></i>&nbsp;
                                                            <?= $valuez->posted_date ?>
                                                        </div>
                                                        <div class="desc">
                                                            <?= $valuez->brief ?>
                                                        </div>

                                                        <div class="foot">
                                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $valuez->id, 'url' => $valuez->url, 'catname' => func::taoduongdan($valuez->catNew->name)]) ?>">Chi
                                                                tiết </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php elseif ($indexv == 4): ?>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                            <div id="BodyContent_ctl00_row5block1" class="ecm-panel">
                                <div class="home-block-new block-type-5">
                                    <div class="title-section">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/listnews', 'catname' => func::taoduongdan($valuev->name), 'id' => $valuev->id]) ?>">
                                            <h2><?= $valuev->name ?></h2>
                                        </a>
                                        <a class="view-more"
                                           href="<?= Yii::$app->urlManager->createUrl(['site/listnews', 'catname' => func::taoduongdan($valuev->name), 'id' => $valuev->id]) ?>">Xem
                                            thêm tin</a>
                                    </div>
                                    <div class="home-block-new-content">
                                        <?php $new = \common\models\News::find()->where(['active' => 1, 'pheduyet' => 1, 'cat_new_id' => $valuev->id])->orderBy('id desc')->limit(10)->all();
                                        foreach ($new as $indexz => $valuez):
                                            ?>

                                            <article class="item">
                                                <figure>
                                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $valuez->id, 'url' => $valuez->url, 'catname' => func::taoduongdan($valuez->catNew->name)]) ?>">
                                                        <img src="images/icon/3x2.png"
                                                             style="background-image: url('')"
                                                             alt="<?= $valuez->title ?>">
                                                        <div class=""></div>
                                                    </a>
                                                </figure>
                                                <div class="info">
                                                    <div class="info-content">
                                                        <div class="title">
                                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $valuez->id, 'url' => $valuez->url, 'catname' => func::taoduongdan($valuez->catNew->name)]) ?>">
                                                                <h3 title="<?= $valuez->title ?>">
                                                                    <?= $valuez->title ?>
                                                                </h3>
                                                            </a>
                                                        </div>
                                                        <div class="date">
                                                            <i class="fa fa-clock-o"></i>&nbsp;
                                                            <?= $valuez->posted_date ?>
                                                        </div>
                                                        <div class="desc">
                                                            <?= $valuez->brief ?>
                                                        </div>

                                                        <div class="foot">
                                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $valuez->id, 'url' => $valuez->url, 'catname' => func::taoduongdan($valuez->catNew->name)]) ?>">Chi
                                                                tiết </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        <?php endforeach; ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif; endforeach; ?>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div id="BodyContent_ctl00_row5block3" class="ecm-panel">
                        <style>
                            .form-control {
                                font-size: 14px !important;
                            }
                        </style>
                        <div class="home-rate" id="home-rate">

                            <div class="title-section">
                                <h2>ĐÁNH GIÁ CHẤT LƯỢNG</h2>
                            </div>
                            <form method="post" id="poll_form">
                                <style>
                                    .feedback-bar {
                                        width: 100%;
                                        max-width: 600px;
                                        margin: 30px auto;
                                        font-family: sans-serif;
                                    }

                                    .feedback-row {
                                        display: flex;
                                        align-items: center;
                                        margin-bottom: 14px;
                                    }

                                    .feedback-label {
                                        width: 120px;
                                        font-size: 14px;
                                        white-space: nowrap;
                                    }

                                    .feedback-track {
                                        flex: 1;
                                        background-color: #f0f0f0;
                                        border-radius: 6px;
                                        height: 16px;
                                        margin: 0 10px;
                                        overflow: hidden;
                                        position: relative;
                                    }

                                    .feedback-fill {
                                        height: 100%;
                                        width: 0;
                                        border-radius: 6px;
                                        transition: width 0.5s ease;
                                    }

                                    .feedback-percent {
                                        width: 40px;
                                        text-align: right;
                                        font-size: 13px;
                                    }

                                    /* Màu riêng cho từng mức */
                                    .no {
                                        background-color: #f44336; /* đỏ */
                                    }

                                    .neutral {
                                        background-color: #ff9800; /* cam */
                                    }

                                    .yes {
                                        background-color: #ffeb3b; /* vàng */
                                    }

                                    .very-yes {
                                        background-color: #4caf50; /* xanh lá */
                                    }
                                </style>

                                <div class="feedback-bar" id="feedback-bar">

                                </div>

                                <div class="wrap-group-radio">
									<div class="wrap-group">
                                        <label>
                                            <input type="radio" class="poll_option" name="poll_option" value="hailong"/>
                                            Hài lòng
                                        </label>
                                    </div>
									<div class="wrap-group">
                                        <label>
                                            <input type="radio" class="poll_option" name="poll_option"
                                                   value="rathailong"/> Rất hài lòng
                                        </label>
                                    </div>
                                    <div class="wrap-group">
                                        <label>
                                            <input type="radio" class="poll_option" name="poll_option"
                                                   value="khonghailong"/> Không hài lòng
                                        </label>
                                    </div>
                                    <div class="wrap-group">
                                        <label>
                                            <input type="radio" class="poll_option" name="poll_option"
                                                   value="binhthuong"/> Bình thường
                                        </label>
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 wrap-group">
                                        <br>
                                        <input id="txtNameDanhGia" class="form-control" placeholder="Họ và tên"
                                               name="name" type="text" value="">

                                        <br>
                                        <input id="txtPhoneDanhGia" class="form-control" placeholder="Số điện thoại"
                                               name="tel" type="text" value="">

                                        <br>
                                        <input id="txtEmailDanhGia" class="form-control" placeholder="Email"
                                               name="email" type="text" value="">

                                        <br>
                                        <input id="txtNoiDungDanhGia" class="form-control" placeholder="Ghi chú"
                                               name="message" type="text" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 wrap-group">
                                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                        <div class="g-recaptcha"
                                             data-sitekey="6LdzaIgfAAAAAFc7EDF6pjMsrVqE3Xpu3u8_vPNa"></div>
                                        <div style="padding: 15px;color: red ;text-shadow: 2px 2px 15px red;margin-bottom: 15px">
                                            <?= Yii::$app->session->getFlash('gcaptcha'); ?>
                                        </div>

                                        <br>
                                        <input type="submit" value="Gửi" name="poll_button" id="poll_button"
                                               class="btn btn-primary"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }

        .loading-spinner {
            width: 32px;
            height: 32px;
            border: 4px solid #ccc;
            border-top-color: #2196f3;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
    <script>
        function block({target}) {
            const $target = $(target);
            // Đảm bảo target có position để overlay nằm đúng
            if ($target.css('position') === 'static') {
                $target.css('position', 'relative');
            }

            // Xóa overlay cũ nếu có
            $target.find('.loading-overlay').remove();

            const overlay = $(`
    <div class="loading-overlay">
      <div class="loading-spinner"></div>
    </div>
  `);

            $target.append(overlay);
        }

        function unblock(target) {
            $(target).find('.loading-overlay').remove();
        }
    </script>
    <script>
        $(document).ready(function () {

            fetch_poll_data();
            $(".custom-close").on('click', function () {
                $('#review_modal').modal('hide');
            })

            function fetch_poll_data() {
                block({target: "#home-rate"});
                $.ajax({
                    url: "<?=Yii::$app->urlManager->createUrl(['site/tinhtoandanhgia'])?>",
                    method: "POST",
                    success: function (data) {
                        $('#feedback-bar').html(data);
                        unblock("#home-rate");
                    }
                })
            }

            $('#poll_form').on('submit', function (event) {
                event.preventDefault();
                var poll_option = '';
                $('.poll_option').each(function () {
                    if ($(this).prop("checked")) {
                        poll_option = $(this).val();
                    }
                });
                if (poll_option != '') {
                    $('#poll_button').attr("disabled", "disabled");
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "<?=Yii::$app->urlManager->createUrl(['site/danhgia'])?>",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            $('#poll_form')[0].reset();
                            $('#poll_button').attr('disabled', false);
                            fetch_poll_data();
                            Swal.fire('Thành công, đánh giá của bạn đã được ghi nhận, nhấn OK để xem thống kê!', '', 'success').then(() => {
                                $('#review_modal').modal('show');
                            });

                        }
                    });
                } else {
                    Swal.fire('Bạn chưa chọn đánh giá!', '', 'warning');
                }
            });

        });

    </script>
</div>
<script>
    $(window).on('load', function () {
        const $imgs = $('.home-banner .slick-slide img:visible');
        let loaded = 0;
        let minHeight = Infinity;

        function applyMinHeight() {
            $imgs.each(function () {
                const h = this.naturalHeight * (this.clientWidth / this.naturalWidth);
                if (h > 0 && h < minHeight) minHeight = h;
            });

            if (minHeight < Infinity) {
                $('.slick-slide').css('height', minHeight + 'px');
                $('.slick-track').css('height', minHeight + 'px');
                $('.slick-list').css('height', minHeight + 'px');
            }
        }

        $imgs.each(function () {
            if (this.complete && this.naturalHeight) {
                loaded++;
            } else {
                $(this).on('load', function () {
                    loaded++;
                    if (loaded === $imgs.length) applyMinHeight();
                });
            }
        });

        if (loaded === $imgs.length) applyMinHeight();
    });
</script>



<style>
    .slick-slide {
        display: block; /* or flex */
        height: auto !important; /* override inline-style height */
    }

    .slick-slide img {
        width: 100%;
        height: auto !important;
        display: block;
        object-fit: contain; /* or 'cover' tùy ý */
    }

</style>
