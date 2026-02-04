<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 03-Jul-17
 * Time: 4:00 PM
 */
/** @var \common\models\Video $data */

$this->context->og_type = "article";
//$this->context->og_image = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . $data->image;
//$this->title = $data->title;
$config = \common\models\Configure::getConfig();
$nab = Yii::$app->controller->navbar;
\johnitvn\ajaxcrud\CrudAsset::register($this);
?>
<link href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/news.css" rel="stylesheet">
<style>a {
        background-color: transparent;
    }
    a:active,
    a:hover {
        outline: 0;
    }
    @media print {
        *,
        :after,
        :before {
            color: #000 !important;
            text-shadow: none !important;
            background: 0 0 !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
        }
        a,
        a:visited {
            text-decoration: underline;
        }
        a[href]:after {
            content: " (" attr(href) ")";
        }
        a[href^="javascript:"]:after {
            content: "";
        }
        h3 {
            orphans: 3;
            widows: 3;
        }
        h3 {
            page-break-after: avoid;
        }
    }
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    :after,
    :before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    a {
        color: #337ab7;
        text-decoration: none;
    }
    a:focus,
    a:hover {
        color: #23527c;
        text-decoration: underline;
    }
    a:focus {
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }
    h3 {
        font-family: inherit;
        font-weight: 500;
        line-height: 1.1;
        color: inherit;
    }
    h3 {
        margin-top: 20px;
        margin-bottom: 10px;
    }
    h3 {
        font-size: 24px;
    }
    /*! CSS Used from: https://benhvien108.vn/Assets/dist/app.css?bust=1.1.3 */
    *,
    ::after,
    ::before {
        box-sizing: border-box;
    }
    h3 {
        margin-top: 0;
        margin-bottom: 0.5rem;
    }
    a {
        color: #007bff;
        text-decoration: none;
        background-color: transparent;
        -webkit-text-decoration-skip: objects;
    }
    a:hover {
        color: #0056b3;
        text-decoration: underline;
    }
    h3 {
        margin-bottom: 0.5rem;
        font-family: inherit;
        font-weight: 500;
        line-height: 1.2;
        color: inherit;
    }
    h3 {
        font-size: 1.75rem;
    }
    @media print {
        *,
        ::after,
        ::before {
            text-shadow: none !important;
            box-shadow: none !important;
        }
        a:not(.btn) {
            text-decoration: underline;
        }
        h3 {
            orphans: 3;
            widows: 3;
        }
        h3 {
            page-break-after: avoid;
        }
    }
    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .fa-clock-o:before {
        content: "\F017";
    }
    .fa-eye:before {
        content: "\F06E";
    }
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        outline: none;
        transition: all 300ms ease 0s;
        -moz-transition: all 300ms ease 0s;
        -webkit-transition: all 300ms ease 0s;
        -o-transition: all 300ms ease 0s;
        -ms-transition: all 300ms ease 0s;
    }
    h3 {
        line-height: 1.3;
        margin: 0;
        padding: 0;
    }
    .date {
        color: #555;
        margin-bottom: 15px;
        font-size: 14px;
        font-style: italic;
    }
    /*! CSS Used from: https://benhvien108.vn/Assets/new-styles/style.css?bust=1.1.3 */
    .ellip {
        display: block;
        height: 100%;
    }
    .ellip-line {
        display: inline-block;
        text-overflow: ellipsis;
        white-space: nowrap;
        word-wrap: normal;
    }
    .ellip,
    .ellip-line {
        position: relative;
        overflow: hidden;
        max-width: 100%;
    }
    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #f5f5f5;
    }
    ::-webkit-scrollbar {
        width: 6px;
        background-color: #f5f5f5;
    }
    ::-webkit-scrollbar-thumb {
        background-color: #28a745;
    }
    body main .video-row article .info-content .title {
        margin-bottom: 10px;
        text-align: left;
        font-weight: bold;
    }
    body main .video-row article .info-content .title a:hover {
        color: #319243;
    }
    body main .video-row article .info-content .title a h3 {
        font-size: 14px;
        height: 3.15em;
        display: block;
    }
    body main .video-row article .info-content .stats {
        -webkit-box-align: baseline;
        -ms-flex-align: baseline;
        align-items: baseline;
        color: #7d7d7d;
        font-size: 12px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }
    body main .video-row article .info-content .stats .date {
        position: relative;
        -webkit-box-ordinal-group: 3;
        -ms-flex-order: 2;
        order: 2;
    }
    @media (max-width: 767px) {
        body main .video-row article .info-content .stats .date {
            display: none;
        }
    }
    body main .video-row article .info-content .stats .view::after {
        content: "Lượt xem";
    }
    body .item .info .info-content .title h3 {
        font-weight: bold !important;
        line-height: 22px !important;
        color: #000000 !important;
        text-align: left;
        font-size: 14px;
    }
    body .item .info .info-content .title:hover h3 {
        color: #0c6115 !important;
    }
    body .item .info .info-content .date {
        font-size: 12px !important;
        line-height: 12px !important;
        color: #7d7d7d !important;
    }
    body .page-content a:hover * {
        color: #00820c !important;
    }
    /*! CSS Used from: https://benhvien108.vn/Assets/styles/custom/video.css?bust=1.1.3 */
    @media (min-width: 768px) {
        .video-item a {
            font-size: 14px !important;
        }
    }
    .video-item a:hover {
        color: #0461af;
    }
    .video-item a {
        text-decoration: none;
        color: #000;
        font-size: 15px;
        font-weight: bold;
    }
    .video-item .date {
        font-size: 12px;
        color: #999;
        font-style: italic;
    }
</style>
<div id="BodyContent_ctl00_bodyPanel" class="ecm-panel">
    <script type="text/javascript">
        function loadVideoData(query, isloadMore, tabId, isSelectVideo) {
            window.videoJsonData = {
                pageNumber: query.pageNumber || 1,
                type: query.type || 0,
                pageSize: "8",
                termId: "ad3ce7e6-aaea-4760-837a-04e1de105a43",
                storylineType: "2",
                applicationId: "93e3cbd1-1e7e-4be9-97cf-36edd407f5f4"
            };
            var jsonData = JSON.stringify(window.videoJsonData);
            $('#videoGrid').addClass("loading-ajax");
            $('#videoLoadMore').attr("disabled");
            $.ajax({
                type: "POST",
                url: "../Ajax.aspx/GetVideoData",
                data: jsonData,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (result) {
                    if (result.d !== "") {
                        if (isloadMore) {
                            $('#videoGrid').append(result.d.Data);
                        } else {
                            $('#videoGrid').html(result.d.Data);
                        }
                        if (!result.d.HasMore) {
                            $('#videoLoadMore').hide();
                        }
                    }
                    if (tabId) {
                        $('#videoTabMostRecent').removeClass("active");
                        $('#videoTabMostView').removeClass("active");
                        $('#' + tabId).addClass("active");
                    }

                    $('#videoGrid').removeClass("loading-ajax");
                    $('#videoLoadMore').removeAttr("disabled");
                    if (isSelectVideo) {
                        var firstId = "92ff01ed-fc42-437c-82e9-5067ca03b430";
                        if (firstId) {
                            loadVideoPlayer(firstId, true);
                        } else {
                            loadVideoPlayer(result.d.FirstId, true);
                        }
                    }
                    $('.play-btn').click(function () {
                        var id = $(this).attr("data-newid");
                        loadVideoPlayer(id);
                    });
                    $('.play-title').click(function () {
                        var id = $(this).attr("data-newid");
                        loadVideoPlayer(id);
                    });
                    setTimeout(() => {
                        $('.info-content a h3').ellipsis({ lines: 2, responsive: true });
                    }, 500);
                },
                error: function () {
                    $('#videoGrid').removeClass("loading-ajax");
                    $('#videoLoadMore').removeAttr("disabled");
                }
            });
        }
        function loadVideoPlayer(storyLineId, isFirst) {
            const id = 'breadcrumbs';
            const yOffset = -200;
            const element = document.getElementById(id);
            const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
            window.scrollTo({ top: y, behavior: 'smooth' });


            $('#player-holder').addClass("loading-ajax");
            var data = {
                storyLineId
            };
            var jsonData = JSON.stringify(data);
            $.ajax({
                type: "POST",
                url: "../Ajax.aspx/GetVideoPlayer",
                data: jsonData,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (result) {
                    if (result.d !== "") {
                        jwplayer("video-player").setup({
                            image: result.d.Cover,
                            file: result.d.Source,
                            autostart: !isFirst,
                            width: '100%',
                            height: '100%',
                            skin: "/Assets/Plugins/Jwplayer/jwplayer-skins-premium/glow.xml",
                        });
                        $('#video-detail').html(result.d.Data);
                        $('#player-holder').removeClass("loading-ajax");
                        var titleHeight = $('#video-detail .title').height();
                        $('#video-detail .sabo').height(270 - titleHeight);
                    }
                },
                error: function () {
                }
            });
        }

        $(document).ready(function () {
            setTimeout(loadVideoData({ pageNumber: 1, type: 0 }, false, 'videoTabMostRecent', true), 300);
            $('#videoTabMostRecent').click(() => {
                loadVideoData({ pageNumber: 1, type: 0 }, false, 'videoTabMostRecent');
            });
            $('#videoTabMostView').click(() => {
                loadVideoData({ pageNumber: 1, type: 1 }, false, 'videoTabMostView');
            });
            $('#videoLoadMore').click(() => {
                window.videoJsonData.pageNumber = window.videoJsonData.pageNumber + 1;
                loadVideoData(window.videoJsonData, true);
            });


        });

    </script>
    <div class="container">
        <nav class="breadcrumbs" id="breadcrumbs">
        <span>
            <span>
                <a href="/home.htm">Trang chủ </a>&nbsp;<span class="divider">|</span>&nbsp;
            <span>Video  </span>
            </span>
        </span>
        </nav>
    </div>
    <div class="page-content container">
        <div class="player-row" id="player-holder">
            <div class="video-player">
                <div class="jwplayer playlist-none jw-user-inactive" id="video-player" tabindex="0" style="width: 100%; height: 100%; background-color: rgb(0, 0, 0); opacity: 1;">
                    <iframe style="width:100%; height:100%" frameborder="0" allowfullscreen="" src="https://www.youtube.com/embed/<?php echo $data->code; ?>"></iframe>

                </div>
            </div>
            <div id="video-detail">
                <div class="video-detail">
                    <div class="title"><?php echo $data->name; ?></div>
                    <div class="sabo" style="height: 204px;"></div>
                    <div class="info">
                        <div class="public-date"><i class="fa fa-clock-o" aria-hidden="true"></i><b><?php echo $data->posted_date; ?></b></div>
                    </div>

                </div>

            </div>

        </div>
        <div class="video-row video-row-box">
            <div class="box-title">Video khác</div>
            <div class="videoGrid">

                <?php foreach (\common\models\Video::find()->where(['active' => 1])->all() as $value): ?>
                    <article class="item video-item">
                        <a href="<?= Yii::$app->urlManager->createUrl(['site/video', 'id' => $value->id]) ?>">
                            <figure style="background-image: url(<?= Yii::$app->urlManager->baseUrl . $value->image ?>)">
                                <div class="play-btn" data-newid="92ff01ed-fc42-437c-82e9-5067ca03b430"> </div>
                            </figure>
                        </a>
                        <div class="info" style="position: absolute;top: 90%;">
                            <div class="info-content">
                                <div class="title">
                                    <a href="javascript:;" class="play-title" data-newid="92ff01ed-fc42-437c-82e9-5067ca03b430">
                                        <h3><span class="ellip"><?= $value->name ?></span></h3>
                                    </a>
                                </div>
                                <div class="stats">
                                    <div class="date"><?= $value->posted_date ?></div>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>


    </div>

</div>