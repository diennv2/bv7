<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
/** @var \common\models\Congviec $model */

?>
<?php $value=$model?>
<?php if($type=="production"):?>
    <li class="feature featuretimkiem">

        <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $value->url, 'id' => $value->id]) ?>">
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
            <h6 class="textkm"><?= $value->tag ?></h6>
            <div class="price">
                <strong><?= func::vndFormat($value->sale); ?><?= $config['money_suffix'] ?></strong>
                <?php if ($value->sale < $value->retail): ?>
                    <span><?= func::vndFormat($value->retail); ?><?= $config['money_suffix'] ?></span>
                <?php endif; ?>
            </div>
            <div class="promo noimage">
                <p><?= (!empty($value->philapdat)&&$value->philapdat!=""&&!is_null($value->philapdat)&&$value->philapdat!="<p></p>")?$value->philapdat:$value->decription ?></p>
            </div>

            <?php if ($value->sale < $value->retail): ?>
                <label class="discount">GIẢM <?= func::vndFormat($value->retail - $value->sale) ?><?= $config['money_suffix'] ?></label>
            <?php endif; ?>

        </a>
    </li>
<?php else:?>
    <article class="blog-loop">
        <div class="blog-post row">

            <div class="col-md-4 col-xs-12 col-sm-12">
                <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>"
                   class="blog-post-thumbnail" title="<?= $value->title ?>" rel="nofollow">
                    <img src="<?= Yii::$app->urlManager->baseUrl . $value->image ?>" alt="<?= $value->title ?>">
                </a>
            </div>

            <div class="col-md-8 col-xs-12 col-sm-12">
                <h3 class="blog-post-title">
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>" title="<?= $value->title ?>"><?= $value->title ?></a>
                </h3>
                <div class="blog-post-meta">
                    <span class="author vcard">Quản trị viên</span>
                    <span class="date">
											<time pubdate="" datetime="<?= $value->posted_date ?>"><?= $value->posted_date ?></time>
										</span>
                </div>
                <p class="entry-content"><?= $value->brief ?>...</p>
            </div>
        </div>
    </article>
<?php endif;?>
