<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 03-Jul-17
 * Time: 4:00 PM
 */

$this->context->og_type = "article";
$user = \common\models\Admin::findOne(['id' => $data->lang_id]);
$this->title = $data->title;
$config = \common\models\Configure::getConfig();
$nab = Yii::$app->controller->navbar;
\johnitvn\ajaxcrud\CrudAsset::register($this);
$value = $data;
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
            <script type="text/javascript">
                $(document).ready(function () {
                    setTimeout(loadSubCategory, 3000);
                });

                function loadSubCategory() {
                    var aData = [];
                    var jsonData = JSON.stringify({aData: aData});
                    $.ajax({
                        type: "POST",
                        url: "../Ajax.aspx/LoadSubCategory",
                        data: jsonData,
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                        success: function (result) {

                            if (result.d !== "") $('#divsubcategory').html(result.d);
                        },
                        error: function () {
                        }
                    })
                        .done(function (msg) {
                        });
                }
            </script>
            <style>
                /*
                Generic Styling, for Desktops/Laptops
                */
                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                /* Zebra striping */
                tr:nth-of-type(odd) {
                }

                th {
                    background: #333;
                    color: white;
                    font-weight: bold;
                }

                td, th {
                    padding: 6px;
                    text-align: left;
                }

                /*
                Max width before this PARTICULAR table gets nasty
                This query will take effect for any screen smaller than 760px
                and also iPads specifically.
                */
                @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {

                    /* Force table to not be like tables anymore */
                    table, thead, tbody, th, td, tr {
                        display: block;
                    }

                    /* Hide table headers (but not display: none;, for accessibility) */
                    thead tr {
                        position: absolute;
                        top: -9999px;
                        left: -9999px;
                    }

                    tr {
                    }

                    td {
                        /* Behave  like a "row" */
                        border: none;
                        border-bottom: 1px solid #eee;
                        position: relative;
                    }

                    td:before {
                        /* Now like a table header */
                        position: absolute; /* Top/left values mimic padding */
                        top: 6px;
                        left: 6px;
                        width: 50%;
                        padding-right: 10px;
                        white-space: nowrap;
                    }
                }

                /* Smartphones (portrait and landscape) ----------- */
                @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
                    body {
                        padding: 0;
                        margin: 0;
                    }
                }

                /* iPads (portrait and landscape) ----------- */
                /*@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
                    body {
                        width: 495px;
                    }
                }*/
            </style>

            <div class="float-breadcrumbs">
                <div class="container">
                    <nav class="breadcrumbs" id="breadcrumbs">
            <span>
                <span>
                    <?= $nab?>
                </span>
            </span>
                    </nav>
                </div>
            </div>
            <div class="page-title-single">
                <h1>
                    <span id="BodyContent_ctl00_ctl02_newsTitle"><?=$data->title?></span>
                </h1>
            </div>
            <div class="page-content page-newinfo" style="padding: 15px">
                <div class="toolbar">
                    <div class="sharethis-inline-share-buttons st-center  st-inline-share-buttons st-animated"
                         id="st-1">
                        <div class="st-btn st-first st-remove-label" data-network="facebook"
                             style="display: inline-block;">
                            <img alt="facebook sharing button"
                                 src="https://platform-cdn.sharethis.com/img/facebook.svg">

                        </div>
                        <div class="st-btn st-remove-label" data-network="linkedin" style="display: inline-block;">
                            <img alt="linkedin sharing button"
                                 src="https://platform-cdn.sharethis.com/img/linkedin.svg">

                        </div>
                        <div class="st-btn st-remove-label" data-network="twitter" style="display: inline-block;">
                            <img alt="twitter sharing button" src="https://platform-cdn.sharethis.com/img/twitter.svg">

                        </div>
                        <div class="st-btn st-last st-remove-label" data-network="pinterest" style="display: none;">
                            <img alt="pinterest sharing button"
                                 src="https://platform-cdn.sharethis.com/img/pinterest.svg">

                        </div>
                    </div>
                </div>
                <div class="sabo">
                    <span id="BodyContent_ctl00_ctl02_newsContent"></span>
                </div>
                <br>
                <?php echo $data->content; ?>

                <div class="clearfix">
                    <div class="editor-img-wrapper">
                        <div class="editor-img-wrapper">
                            <div class="editor-img-desc">&nbsp;</div>
                        </div>
                    </div>
                </div>

                <div class="clearfix margin-bottom-10" style="margin-bottom: 10px;"></div>


            </div>

            <div class="page-share">
                <span>Chia sẻ</span>
                <div class="sharethis-inline-share-buttons st-center  st-inline-share-buttons st-animated" id="st-2">
                    <div class="st-btn st-first st-remove-label" data-network="facebook" style="display: inline-block;">
                        <img alt="facebook sharing button" src="https://platform-cdn.sharethis.com/img/facebook.svg">

                    </div>
                    <div class="st-btn st-remove-label" data-network="linkedin" style="display: inline-block;">
                        <img alt="linkedin sharing button" src="https://platform-cdn.sharethis.com/img/linkedin.svg">

                    </div>
                    <div class="st-btn st-remove-label" data-network="twitter" style="display: inline-block;">
                        <img alt="twitter sharing button" src="https://platform-cdn.sharethis.com/img/twitter.svg">

                    </div>
                    <div class="st-btn st-last st-remove-label" data-network="pinterest" style="display: none;">
                        <img alt="pinterest sharing button" src="https://platform-cdn.sharethis.com/img/pinterest.svg">

                    </div>
                </div>
            </div>
            <section class="news-related" style="display: none">
                <div class="title-related">
                    <h2>Tin cùng chuyên mục</h2>
                </div>
                <ul style="list-style-type: inherit !important">

                </ul>
            </section>
            <section class="news-related" style="display: none">
                <div class="title-related">
                    <h2>Tin cùng chuyên mục</h2>
                </div>
                <ul style="list-style-type: inherit !important">

                </ul>
            </section>


        </div>
    </div>
    </div>
    </div>
</section>