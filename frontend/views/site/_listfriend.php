<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
/** @var \common\models\Post $model */
$user=\common\models\User::findOne($model->friendid);
?>
<?php $value=$model?>
<div class="col-md-4 col-xs-6" style="padding-top: 15px; padding-bottom: 15px">

        <span style="float: left;margin-right: 5px;width: 50px;height: 50px;overflow: hidden; border-radius: 50%!important;border: 3px solid #ddd"><img title="account" style="width: 100%;" alt="taikhoan" src="<?php if(is_file(dirname(dirname(dirname(__DIR__))).$user->shop_picture)):?><?= Yii::$app->urlManager->baseUrl.$user->shop_picture ?><?php else:?><?= Yii::$app->urlManager->baseUrl ?>/images/taikhoann.png<?php endif;?>"></span>

        <div style="text-align: left;font-weight: bold;margin-top: 10px"><a style="color: black" href="<?=$user->getProfileUrl()?>"><?=$user->firstname?></a></div>

</div>
