<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 03-Jul-17
 * Time: 4:00 PM
 */

$this->context->og_type = "article";

$this->title = "Album ảnh";
$config = \common\models\Configure::getConfig();
$nab = Yii::$app->controller->navbar;

?>
<div id="main-content" class="col-lg-6">
    <div class="row">
        <h3 class="widget-title cat-heading"><i class="fa fa-picture-o ico-flat"></i> Thư viện ảnh</h3>
    </div>
    <div class="header-navigate">
        <ul id="breadcrumb" class="breadcrumb breadcrumb-arrow">
            <?= $nab ?>
        </ul>
    </div>
    <div class="line-block"></div>
    <div class="row img-list">

        <?php foreach ($data as $albumchitiet): ?>
            <div class="img-item">
                <div class="img-thumb">
                    <a title="<?= $albumchitiet->name_vi ?>" href="<?= Yii::$app->urlManager->createUrl(['site/album', 'name' => func::taoduongdan($albumchitiet->name_vi), 'id' => $albumchitiet->id]) ?>"><img src="<?= Yii::$app->urlManager->baseUrl . $albumchitiet->image ?>"></a>
                </div>
                <div class="img-caption">
                    <h2 class="img-title"><a href="<?= Yii::$app->urlManager->createUrl(['site/album', 'name' => func::taoduongdan($albumchitiet->name_vi), 'id' => $albumchitiet->id]) ?>">Album <?= $albumchitiet->name_vi ?></a></h2>

                </div>
            </div>

        <?php endforeach; ?>
    </div>
    <div class="row">
        <!-- Plugin Navigation -->
        <!-- End -->
    </div>
</div>
