<?php $newfooter = \common\models\News::find()->where('active=1 and home=1')->orderBy('id desc')->limit(6)->all()?>
<?php if(!empty($newfooter)): /** @var \common\models\News[] $newfooter */?>
    <h3 class="tieudetintuc"><p>Có thể bạn quan tâm</p></h3>
    <div class="row listcate">
        <div class="col-xs-12">
            <div class="listcate2">
                <div class="fl col-md-6 col-sm-5 col-xs-12">
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $newfooter[0]->id, 'url' => $newfooter[0]->url, 'catname' => func::taoduongdan($newfooter[0]->catNew->name)]) ?>"
                       title="<?=$newfooter[0]->title?>">
                        <div class="tintuc-firstimg-container">
                            <img
                                    src="<?= Yii::$app->urlManager->baseUrl . $newfooter[0]->image ?>"
                                    alt="<?= $newfooter[0]->title ?>">
                        </div>
                        <p class="listcatetilte"><?=$newfooter[0]->title?></p> </a></div>
                <div class="fr col-md-6 col-sm-7 col-xs-12">
                    <?php foreach ($newfooter as $indexnews=> $new): if($indexnews!=0):?>
                        <div class="group3">
                            <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $new->id, 'url' => $new->url, 'catname' => func::taoduongdan($new->catNew->name)]) ?>"
                               title="<?= $new->title ?>">
                                <div class="zone-youtube">
                                    <img src="<?= Yii::$app->urlManager->baseUrl . $new->image ?>"
                                         alt="<?= $new->title ?>">
                                    <i class="iconhome-yt"></i>
                                </div>
                                <p class="listcatetilte">
                                    <?= $new->title ?></br></br>
                                    <i class="fa fa-calendar-check-o"></i>  <?=$new->posted_date?>
                                </p>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    <?php endif;endforeach;?>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<?php endif;?>