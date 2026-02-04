<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 03-Jul-17
 * Time: 4:00 PM
 */
/** @var \common\models\News $data */

$this->context->og_type = "video.movie";
$this->context->og_image = Yii::$app->urlManager->baseUrl . $data->image;
$this->title = $data->name;

$config = \common\models\Configure::getConfig();
$nab = Yii::$app->controller->navbar;
?>
<div class="mnv-wrap-new clearfix">
    <div class="header-navigate">
        <ul id="breadcrumb" class="breadcrumb breadcrumb-arrow">
            <?= $nab ?>
        </ul>
    </div>
    <div class="single-content">
        <h1 class="single-title"><?= $data->name ?></h1>
        <div class="cat-item-info">
            <p>
                <span><i class="fa fa-user ico-download"></i>Người đăng: <label>Quản trị</label></span>
                <span><i class="fa fa-calendar-o ico-download"></i>Ngày đăng: <label><?=$data->ngaytao?></label></span>
                <span><i class="fa fa-eye ico-download"></i>Lượt xem: <label><?=$data->luotxem?></label></span>
            </p>
        </div>
        <div class="mnv-box-left clearfix">

            <?php
            $datas = explode('https://www.youtube.com/watch?v=', $data->url);
            if (isset($datas[1]))
                $test = $datas[1];
            else
                $test = "";
            ?>
            <iframe width="100%" height="350" src="https://www.youtube.com/embed/<?= $test ?>" frameborder="0"
                    allowfullscreen></iframe>
            <p class="margin-top-10px"><?= $data->description ?></p>

        </div>
    </div>



</div>

