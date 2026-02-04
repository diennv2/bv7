<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 10/20/2017
 * Time: 5:03 PM
 */ ?>
<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 04-Jul-17
 * Time: 11:26 AM
 */
$numitem = Yii::$app->controller->config['post_per_page'];
$this->title = "Video";
$config = \common\models\Configure::getConfig();
$nab = Yii::$app->controller->navbar;

?>
<div class="header-navigate">
    <ul id="breadcrumb" class="breadcrumb breadcrumb-arrow">
        <?= $nab ?>
    </ul>
</div>
<h2>Video</h2>
<div class="row img-list">
    <?php foreach($data as $videos):?>

        <div class="img-item">
            <div class="img-thumb">
                <a href="<?= Yii::$app->urlManager->createUrl(['site/video', 'id' => $videos->id, 'title' => func::taoduongdan($videos->name)]) ?>">
                    <img src="<?=Yii::$app->urlManager->baseUrl.$videos->image?>" alt="<?= $videos->name ?>" title="<?= $videos->name ?>"></a>
            </div>
            <div class="img-caption">
                <h2 class="img-title"><a href="<?= Yii::$app->urlManager->createUrl(['site/video', 'id' => $videos->id, 'title' => func::taoduongdan($videos->name)]) ?>"><?= $videos->name ?></a></h2>
                <p class="post-views">Lượt xem: <label><?=$videos->luotxem?></label></p>
            </div>
        </div>
    <?php endforeach;?>

</div>
