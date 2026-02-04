<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
/** @var \common\models\Post $model */
$user = \common\models\User::findOne($model->userid);
?>
<?php $value=$model?>
<div class="row <?php if($key>5) echo "hidden";?>" style="padding: 5px" id="<?=$model->id.$model->id.$model->id.$key?>">
    <div class="col-xs-2">
        <span style="float: left;margin-right: 5px;width: 50px;height: 50px;overflow: hidden; border-radius: 50%!important;border: 3px solid #ddd"><img title="account" style="width: 100%;" alt="taikhoan" src="<?php if(is_file(dirname(dirname(dirname(__DIR__))).$user->shop_picture)):?><?= Yii::$app->urlManager->baseUrl.$user->shop_picture ?><?php else:?><?= Yii::$app->urlManager->baseUrl ?>/images/taikhoann.png<?php endif;?>"></span>
    </div>
    <div class="col-xs-10 bubble-bottom-left" style="padding: 15px; border: 1px solid #ddd;border-radius: 4px ">
        <div style="text-align: left;font-weight: bold"><a style="color: black" href="<?=$user->getProfileUrl()?>"><?=$user->firstname?></a></div>
        <div style="text-align: justify"><?=$value->comment?></div>
        <?php if($value->userid==Yii::$app->user->id):?>
            <div style="position: absolute;top: 5px;right: 5px"><button class="btn btn-default btn-xoas" data-s="<?=$model->id.$model->id.$model->id.$key?>" data-target="<?=$value->id?>"><i class="fa fa-remove"></i></button></div>
        <?php endif;?>
    </div>
</div>
