<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 04-Jul-17
 * Time: 11:26 AM
 */

$this->title = $cat;
$config = \common\models\Configure::getConfig();
$numitem = $config ['post_per_page'];
\johnitvn\ajaxcrud\CrudAsset::register($this);

$nab = Yii::$app->controller->navbar;

if (isset($data[0])) $new = $data;
?>

<section class="page-108">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 sidebar-global">
                <div id="BodyContent_ctl00_rightPanel" class="ecm-panel">

                    <div id="divsubcategory">
                    </div>
                    <div class="home-block-new block-type-6">
                        <div class="title-section">
                            <a href="/video/home.htm">
                                <h2>Video</h2>
                            </a>
                            <a class="view-more" href="/video/home.htm">Xem thêm tin</a>
                        </div>
                        <div class="home-block-new-content">

                            <?php foreach (\common\models\Video::find()->where(['hot' => 1])->orderBy(['id' => 'asc'])->limit(4)->all() as $value): ?>
                                <article class="item">
                                    <figure>
                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/video', 'id' => $value->id]) ?>">
                                            <img src="<?= Yii::$app->urlManager->baseUrl . $value->image ?>"
                                                 style="background-image: url('https://files.benhvien108.vn/ecm/source_files/2022/04/01/5470c2520930c76e9e21-081807-010422-54.jpg')"
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
                                            <div class="date">
                                                <i class="fa fa-clock-o"></i>&nbsp;
                                                <?= $value->posted_date ?>
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

                            </article>

                            <article class="item">

                                <div class="info">
                                    <div class="info-content">

                                        <div class="foot">

                                        </div>
                                    </div>
                                </div>
                            </article>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 page-108-content">
                <div id="BodyContent_ctl00_leftPanel" class="ecm-panel">
                    <div class="float-breadcrumbs">
                        <div class="container">
                            <nav class="breadcrumbs" id="breadcrumbs">
                                <?= $nab ?>
                            </nav>
                        </div>
                    </div>
                    <div class="page-title">
                        <h1>
                            <span id="BodyContent_ctl00_ctl02_lbTitle"><?= $this->title ?></span></h1>

                    </div>
                    <div class="page-content" id="page">
                        <span id="BodyContent_ctl00_ctl02_lbSTT" style="margin-left: 10px;"></span>
                        <?php foreach ($data as $index => $value): ?>
                            <?php if (true): ?>

                                <div id="pagination-<?php echo $index ?>" <?php if ($index > 4) echo "style='display:none'" ?> >
                                    <article class="item">
                                        <figure>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>">
                                                <img src="<?= Yii::$app->urlManager->baseUrl . $value->image ?>"
                                                     style="background-image: url('https://files.benhvien108.vn/ecm/source_files/2022/06/17/220617-1-4-145007-170622-43.jpg')"
                                                     alt="<?= $value->title ?>">
                                                <div class=""></div>
                                            </a>
                                        </figure>
                                        <div class="info">
                                            <div class="info-content">
                                                <div class="title">
                                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>">
                                                        <h3>
                                                            <?= $value->title ?>
                                                        </h3>
                                                    </a>
                                                </div>
                                                <div class="date">
                                                    <i class="fa fa-clock-o"></i>&nbsp;
                                                    <?= $value->posted_date ?>
                                                </div>
                                                <div class="desc">

                                                </div>
                                                <div class="foot">
                                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>">Chi
                                                        tiết </a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <script>
                            $(document).ready(function () {
                                $("#page").pagination({
                                    pagesize: 5,
                                    count: <?= (count($data) - 1)?>
                                })
                            })
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php if(isset($data[0])):?>
        <script>
            var total_page = 0, cur_page = 4;
            var curl = 'news';
            jQuery(document).ready(function () {
                jQuery(document).on("click", ".loadmore a", function () {
                    cur_page += 3;
                    var html_loadmore = jQuery('.btn-loading').html();
                    jQuery('.btn-loading').html("<i class='fa fa-refresh fa-spin'></i> Vui lòng đợi trong giây lát...");
                    setTimeout(function () {
                        jQuery.ajax({
                            url: "<?=Yii::$app->urlManager->createUrl(['site/updatenews'])?>",
                            data: {
                                cat: <?= $data[0]->cat_new_id?>,
                                cur: (cur_page - 2)
                            },
                            type: 'post',
                            success: function (data) {
                                jQuery('#list-articles').append(data);
                                jQuery('#list-articles img').imagesLoaded(function () {
                                    jQuery('.btn-loading').html(html_loadmore);
                                    jQuery(window).resize();
                                });
                                if (cur_page >= total_page) {
                                    jQuery('.loadmore').remove();
                                }
                            }
                        });

                    }, 1000)
                })
            });
        </script>
    <?php endif;?>
</section>

