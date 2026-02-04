<?php

$config = \common\models\Configure::getConfig();

$nab = Yii::$app->controller->navbar;

use common\models\Configure;
use yii\widgets\ActiveForm;

\johnitvn\ajaxcrud\CrudAsset::register($this);

?>
<div class="col-xs-12"
     style="background-image: url(<?= $product->getDefaultImage() ?>);position: absolute;left: 0;padding-top: 10vh;padding-bottom: 10vh;">
    <div class="ttxxx">
        <h1 class="thaoluantitle">Thảo luận: <span><?= $product->name ?></span></h1>
        <div class="navis">
            <ul class="nav1" >
                <?= $nab ?>
            </ul>
        </div>
    </div>

</div>
<style>
    .nav1 li{
        display: inline-block;
        padding: 5px;
        padding-bottom: 10px;
    }
    .nav1 li a{
        color: white;
    }
    .ttxxx:after {
        content: "";
        position: absolute;
        left: 0;
        width: 100%;
        height: 100%;
        top: 0;
        background: #00000085;
        z-index: 98;
    }
    .navis{
        color: #f0f0f0;
        z-index: 99;
        position: absolute;
        left: 0;
        bottom: 0;
        text-align: center;
        width: 100%;
    }
    .thaoluantitle {
        text-transform: uppercase;
        font-size: 2em;
        font-weight: bold;
        color: #f0f0f0;
        z-index: 99;
        position: absolute;
        left: 0;
        width: 100%;
        margin: 15px 0;
        text-align: center;
        transform: translateY(-20px);
    }
    .noidungcontent{
        font-size: 1em;
        line-height: 1.5em;

    }
    .noidungcontent p{
        margin: 1em 0;
        text-align: justify-all;
    }
    .noidungcontent h2{
        font-size: 1em;
    }
</style>
<div class="backgroundwhite" style="min-height: 100vh;margin-top: 20vh">
    <div class="container" style="padding: 3vh 0;clear: both">

        <div class="col-xs-12">
            <h2><?= $model->name ?></h2>
            <div style="padding: 10px 0; border-bottom: 1px dotted #ddd; margin: 15px 0">
                <i class="fa fa-calendar-check-o" style="font-weight: bold"></i> Ngày đăng: <?=$model->ngaytao?>
                <?php $user = \common\models\User::findOne($model->userid);?>
                <i class="fa fa-user" style="font-weight: bold; margin-left: 10px"></i> Người đăng: <a style="color: #e33135;font-weight: bold" href="<?=$user->getProfileUrl()?>"><?php echo (!is_null($user))?$user->firstname:"#N/A";?></a>
                <i class="fa fa-comment" style="font-weight: bold; margin-left: 10px"></i> <?=$model->luotbinhluan?> lượt bình luận, <i class="fa fa-eye" style="font-weight: bold; margin-left: 10px"></i> <?=$model->luotxem?> lượt xem
            </div>
            <div class="noidungcontent"><?= $model->noidung ?></div>
        </div>
        <div class="col-xs-12" style="padding-top: 10px">
            <div class="fb-like"
                 data-href="<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"
                 data-layout="standard" data-action="like" data-size="large" data-show-faces="true"
                 data-share="true"></div>
            <div class="fb-comments"
                 data-href="<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"
                 data-numposts="5" data-width="100%"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>