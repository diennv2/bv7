<?php foreach ($data as $index =>$value):
    if($index>=$cur && $index <=($cur+2)):
        ?>
        <li class="clearfix">
            <div class="blog-item-image">

                <a href="<?php echo Yii::$app->urlManager->createUrl(['site/news','catname'=>func::taoduongdan($value->catNew->name),'url'=>$value->url,'id'=>$value->id])?>">
                    <img src="<?= Yii::$app->urlManager->baseUrl.$value->image?>" alt="<?= $value->title?>"></a>

            </div>
            <div class="blog-item-title">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['site/news','catname'=>func::taoduongdan($value->catNew->name),'url'=>$value->url,'id'=>$value->id])?>" title="<?= $value->title?>">
                    <h2><?= $value->title?></h2>
                </a>
                <p>
                    Ngày: <?= $value->posted_date?>
                </p>
                <div class="blog-content-short-description"><?= $value->brief?></div>
            </div>
        </li>
        <hr>
    <?php endif;
endforeach;
?>