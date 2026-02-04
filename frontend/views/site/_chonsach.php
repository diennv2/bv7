<li class="choosesach" id="sach<?=$value->id?>"  data-target="<?=$value->id?>">
    <!--#region Ngành hàng chính -->
    <a>
        <img alt="<?= $value->name ?>"
             src="<?php
             if (!empty($value->anhsanphams)) {
                 $anhdefault = \common\models\Anhsanpham::getAnhDefault($value->id);
                 /** @var \common\models\Anhsanpham $anhdefault */
                 if (!is_null($anhdefault)) {
                     echo Yii::$app->urlManager->baseUrl . $anhdefault->image;
                 } else {
                     echo Yii::$app->urlManager->baseUrl . "/images/noimg.jpg";
                 }
             } else {
                 echo Yii::$app->urlManager->baseUrl . "/images/noimg.jpg";
             }
             ?>">
        <h3><?= $value->name ?></h3>
        <h6 class="textkm"><?= $value->decription ?></h6>

    </a>
    <!--#endregion -->

</li>
