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
$value = $data;
?>

<?php
function processExcelFiles($content) {
    $pattern = '/<iframe[^>]*src=["\']([^"\']*\.(xls|xlsx))["\'][^>]*>.*?<\/iframe>/i';

    preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $file_url = $match[1];

        $file_url = str_replace('Zsource/', '/source/', $file_url);
        $file_url = str_replace('.xlsz"', '.xls', $file_url);
        $file_url = str_replace('.xlsxz"', '.xlsx', $file_url);

        if (strpos($file_url, 'http') !== 0) {
            $file_url = 'https://benhvienquany7.vn' . $file_url;
        }

        $office_viewer_url = 'https://view.officeapps.live.com/op/view.aspx?src=' . urlencode($file_url);

        $new_iframe = '<div class="excel-viewer" style="margin: 20px 0; padding: 15px; background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px;">';
        $new_iframe .= '<p style="margin-bottom: 10px; font-weight: bold; color: #495057;">';
        $new_iframe .= '<i class="fa fa-file-excel-o" style="color: #28a745;"></i> ';
        $new_iframe .= 'File Excel: <a href="' . $file_url . '" target="_blank" style="color: #007bff;">Tải về</a>';
        $new_iframe .= '</p>';
        $new_iframe .= '<iframe title="Xem file Excel" src="' . $office_viewer_url . '" width="100%" height="600" frameborder="0" style="border: 1px solid #ced4da; border-radius: 3px;"></iframe>';
        $new_iframe .= '</div>';

        $content = str_replace($match[0], $new_iframe, $content);
    }

    return $content;
}

$processed_content = processExcelFiles($data->content);
?>
<style>
    .excel-viewer {
        margin: 20px 0;
        padding: 15px;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }
    .excel-viewer p {
        margin-bottom: 10px;
        font-weight: bold;
        color: #495057;
    }
    .excel-viewer iframe {
        border: 1px solid #ced4da;
        border-radius: 3px;
        width: 100%;
        height: 600px;
    }
    .fa-file-excel-o {
        color: #28a745;
        margin-right: 5px;
    }
</style>
<section class="page-108">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 sidebar-global">
                <div id="BodyContent_ctl00_rightPanel" class="ecm-panel">
                    <div id="divsubcategory">
                    </div>
                    <div class="home-block-new block-type-6">
                        <div class="title-section">
                            <h2>Video</h2>
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

                        ;

                        /* Zebra striping */
                        tr:nth-of-type(odd) {
                        }

                        ;

                        th {
                            background: #333;
                            color: white;
                            font-weight: bold;
                        }

                        ;

                        td, th {
                            padding: 6px;
                            text-align: left;
                        }

                        ;

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

                                <?= $nab ?>
                            </nav>
                        </div>
                    </div>
                    <div class="page-title-single">
                        <h1>
                            <span style="font-size: 25px !important;"
                                  id="BodyContent_ctl00_ctl02_newsTitle"><?php echo $data->title; ?></span></h1>
                    </div>
                    <div class="page-content page-newinfo" style="padding: 15px">
                        <div id="fb-root"></div>
                        <div class="fb-like" data-href="<?=getCurrentUrl()?>" data-width="" data-layout="" data-action="" data-size="" data-share="true"></div>
                        <div style="
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    margin-bottom: 15px;
    background: #e5e8f4;
    border-radius: 999px;
    font-family: 'Segoe UI', sans-serif;
    font-size: 14px;
    color: #374151;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" width="18" height="18">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <span><?=number_format($data->luotxem,0,"",",")?> lượt xem</span>
                            <?php
                            function getCurrentUrl() {
                                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
                                    || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

                                $host = $_SERVER['HTTP_HOST'];
                                $requestUri = $_SERVER['REQUEST_URI'];

                                return $protocol . $host . $requestUri;
                            }
                            ?>
                        </div>
                        <?php echo $processed_content; ?>
                        <div class="fb-comments" data-href="<?=getCurrentUrl()?>" data-width="" data-numposts="10"></div>
                    </div>

                    <div class="page-share">
                        <span>Chia sẻ</span>
                        <div class="sharethis-inline-share-buttons st-center  st-inline-share-buttons st-animated"
                             id="st-2">
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
                                <img alt="twitter sharing button"
                                     src="https://platform-cdn.sharethis.com/img/twitter.svg">

                            </div>
                            <div class="st-btn st-last st-remove-label" data-network="pinterest" style="display: none;">
                                <img alt="pinterest sharing button"
                                     src="https://platform-cdn.sharethis.com/img/pinterest.svg">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>