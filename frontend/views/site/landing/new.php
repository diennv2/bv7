<?php $news = \yii\helpers\Json::decode($data);

?>
<?php if(!empty($news)):?>
<style>
    .news-landingpage div>b {
        font-weight: normal;
        margin-bottom: 20px;
    }
    .news-landingpage div>* {
        display: block;
        color: #fff;
    }

</style>
<div class="row" style="background: <?= (is_file(Yii::$app->urlManager->baseUrl.$landing->backgroundimage)?"url(".Yii::$app->urlManager->baseUrl.$landing->backgroundimage.")":$landing->backgroundimage)?>">
<div class="container news-landingpage" >
    <div class="col-md-6">
        <?php $new0 = \common\models\News::findOne(['id'=>$news[0]]); if(!is_null($new0)):?>
        <h3>🎧 <?=$new0->title?></h3>
        <div style="margin-bottom: 15px"><p><?=$new0->brief?></p></div>
        <img src="<?=$new0->image?>" alt="<?=$new0->title?>" title="<?=$new0->title?>" style="display: block;">
        <a style="padding: 10px;text-align: center" href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $new0->id, 'url' => $new0->url, 'catname' => func::taoduongdan($new0->catNew->name)]) ?>" title="<?=$new0->title?>">Xem chi tiết</a>
        <?php else:?>
        Tin đã bị xóa
        <?php endif;?>
    </div>
    <div class="col-md-6" style="padding-top: 35px">
        <?php foreach ($news as $index=> $newss): if($index>0): $new=\common\models\News::findOne(['id'=>$newss]);if(!is_null($new)):?>
            <div class="row" style="margin-bottom: 15px">
            <a class="avt col-md-4" title="<?=$new->title?>" href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $new->id, 'url' => $new->url, 'catname' => func::taoduongdan($new->catNew->name)]) ?>">
                <img src="<?=$new->image?>" alt="<?=$new->title?>" title="<?=$new->title?>" style="display: block;">
            </a>
            <a class="link col-md-8" title="<?=$new->title?>" href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $new->id, 'url' => $new->url, 'catname' => func::taoduongdan($new->catNew->name)]) ?>"><?=$new->title?><p style="color: #b9b9b9"><?=$new->posted_date?> | <?=number_format(rand(1000,10000),0,'','.')?> người đã đọc</p></a>

        </div>
        <?php else:?>
        Tin đã bị xóa
        <?php endif;endif; endforeach;?>
    </div>

</div>
</div>
<?php endif;?>