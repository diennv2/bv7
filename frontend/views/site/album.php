<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 03-Jul-17
 * Time: 4:00 PM
 */

$this->context->og_type = "article";

$this->title = $album->name_vi;
$config = \common\models\Configure::getConfig();
$nab = Yii::$app->controller->navbar;

?>

<div class="mnv-wrap-new clearfix">
    <div class="single">
        <div class="header-navigate">
            <ul id="breadcrumb" class="breadcrumb breadcrumb-arrow">
                <?= $nab ?>
            </ul>
        </div>
        <div class="single-content">
            <h1 class="single-title">Giấy mời kỷ niệm 20 năm thành lập trường THCS CHu Văn An, Chư Sê</h1>
            <div id="gallery">
                <?php foreach ($data as $value): ?>
                    <div class="img-post">
                        <div class="img-thumb-post">
                            <a href="<?= Yii::$app->urlManager->baseUrl . $value->image ?>" rel="prettyPhoto[pp_gal]"><img src="<?= Yii::$app->urlManager->baseUrl . $value->image ?>" alt="<?= $value->name ?>"></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


        </div>
    </div>


    <script>
        $(document).ready(function () {
            $("#gallery").jGallery({
                "transition": "fade_moveFromRight",
                "transitionBackward": "fade_moveFromLeft",
                "transitionCols": "1",
                "transitionRows": "1",
                "thumbnailsPosition": "bottom",
                "thumbType": "image",
                "backgroundColor": "#ffffff",
                "textColor": "#000000",
                "mode": "standard"
            });
        })
    </script>
</div>