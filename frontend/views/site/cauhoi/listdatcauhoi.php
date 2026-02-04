<?php

$config = \common\models\Configure::getConfig();
$this->title = 'Hỏi đáp';
?>
<style>
    .button.dark {
        --background: #2F3545;
        --shadow: 0 2px 8px -1px rgba(21, 25, 36, 0.32);
        --shadow-hover: 0 4px 20px -2px rgba(21, 25, 36, 0.5);
    }

    .button.white {
        --background: #fff;
        --text: #275efe;
        --shadow: 0 2px 8px -1px rgba(18, 22, 33, 0.04);
        --shadow-hover: 0 4px 20px -2px rgba(18, 22, 33, 0.12);
    }

    .button.fast {
        --duration: 0.32s;
    }

    .button {
        --background: #275efe;
        --text: #fff;
        --font-size: 16px;
        --duration: 0.44s;
        --move-hover: -4px;
        --shadow: 0 2px 8px -1px rgba(39, 94, 254, 0.32);
        --shadow-hover: 0 4px 20px -2px rgba(39, 94, 254, 0.5);
        --font-shadow: var(--font-size);
        padding: 16px 32px;
        font-weight: 500;
        line-height: var(--font-size);
        border-radius: 24px;
        display: block;
        outline: none;
        text-decoration: none;
        font-size: var(--font-size);
        letter-spacing: 0.5px;
        background: var(--background);
        color: var(--text);
        box-shadow: var(--shadow);
        transform: translateY(var(--y)) translateZ(0);
        transition: transform var(--duration) ease, box-shadow var(--duration) ease;
    }

    .button div {
        display: flex;
        overflow: hidden;
        text-shadow: 0 var(--font-shadow) 0 var(--text);
    }

    .button div span {
        display: block;
        backface-visibility: hidden;
        font-style: normal;
        transition: transform var(--duration) ease;
        transform: translateY(var(--m)) translateZ(0);
    }

    .button div span:nth-child(1) {
        transition-delay: 0.05s;
    }

    .button div span:nth-child(2) {
        transition-delay: 0.1s;
    }

    .button div span:nth-child(3) {
        transition-delay: 0.15s;
    }

    .button div span:nth-child(4) {
        transition-delay: 0.2s;
    }

    .button div span:nth-child(5) {
        transition-delay: 0.25s;
    }

    .button div span:nth-child(6) {
        transition-delay: 0.3s;
    }

    .button div span:nth-child(7) {
        transition-delay: 0.35s;
    }

    .button div span:nth-child(8) {
        transition-delay: 0.4s;
    }

    .button div span:nth-child(9) {
        transition-delay: 0.45s;
    }

    .button div span:nth-child(10) {
        transition-delay: 0.5s;
    }

    .button div span:nth-child(11) {
        transition-delay: 0.55s;
    }

    .button:hover {
        --y: var(--move-hover);
        --shadow: var(--shadow-hover);
    }

    .button:hover span {
        --m: calc(var(--font-size) * -1);
    }

    .button.reverse {
        --font-shadow: calc(var(--font-size) * -1);
    }

    .button.reverse:hover span {
        --m: calc(var(--font-size));
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
                            <a href="/list-video.html"">
                            <h2>Video</h2>
                            </a>
                            <a class="view-more" href="/list-video.html">Xem thêm tin</a>
                        </div>
                        <div class="home-block-new-content">

                            <?php foreach ($datavideo as $value): ?>
                                <article class="item">
                                    <figure>
                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/video', 'id' => $value->id]) ?>">
                                            <img src="<?= $value->image ?>"
                                                 style="background-image: url('<?= $value->image ?>')"
                                                 alt="<?= $value->name ?>)">
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
                                            <div class="desc" title="" style=""><span class="ellip"><span
                                                            style="white-space: nowrap;"></span></span></div>

                                            <div class="foot">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['site/video', 'id' => $value->id]) ?>">Chi
                                                    tiết </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>


                            <article class="item">
                        </div>
                        </article>

                        <article class="item">
                            <figure>

                            </figure>
                            <div class="info">
                                <div class="info-content">
                                    <div class="title">

                                    </div>
                                    <div class="date">

                                    </div>
                                    <div class="desc">

                                    </div>

                                    <div class="foot">

                                    </div>
                                </div>
                            </div>
                        </article>

                    </div>
                </div>

            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 page-108-content">
                <div id="BodyContent_ctl00_leftPanel" class="ecm-panel">
                    <div class="page-title">
                        <a href="">
                            <h1>TƯ VẤN - HỎI ĐÁP</h1>
                        </a>
                    </div>

                    <div class="page-content">
                        <?php foreach ($data as $value): ?>
                            <article class="item">
                                <div class="info">
                                    <div class="info-content">
                                        <div class="title">
                                            <h3 style="font-size: 16px;">Hỏi: <a style="color: #000;"
                                                                                 href=""><?= $value->tieude ?></a></h3>
                                        </div>
                                        <div class="title" style="display:normal">
                                            <h3 style="font-size: 16px;">Trả lời: <a
                                                        href="<?= Yii::$app->urlManager->createUrl(['site/datcauhoiid', 'id' => $value->id]) ?>">Xem
                                                    chi tiết</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </article>
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
</section>