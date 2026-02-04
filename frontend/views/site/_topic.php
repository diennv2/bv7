<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
/** @var \common\models\Congviec $model */

?>
<?php $value=$model?>
<div class="row" style="border-bottom: 1px solid #ddd; padding: 5px 0">
    <a  href="<?=$value->getUrl()?>">
    <div class="col-xs-12 col-md-4" style="overflow-y: hidden">
        <img src="<?=$value->image?>" style="width: 100%">
    </div>
    <div class="col-xs-12 col-md-8">
        <p><h3 style="color: #e33135;text-align: justify"><?=$value->name?></h3></p>
        <p style="text-align: justify"><?=$value->brief?></p>

        <p style="margin-top: 15px;text-align: justify"><i class="fa fa-calendar-check-o" style="font-weight: bold"></i> Ngày đăng: <?=$value->ngaytao?></p>
        <p style="text-align: justify"><i class="fa fa-user" style="font-weight: bold"></i> Người đăng: <?php $user = \common\models\User::findOne($value->userid);echo (!is_null($user))?$user->firstname:"#N/A";?></p>
        <p style="text-align: justify"><i class="fa fa-comment" style="font-weight: bold"></i> <?=$value->luotbinhluan?> lượt bình luận, <i class="fa fa-eye" style="font-weight: bold"></i> <?=$value->luotxem?> lượt xem </p>
    </div>
    <div class="clearfix"></div>
    </a>
</div>
