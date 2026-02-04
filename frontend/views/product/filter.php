

            <ul class="homeproduct margin-top-bot-5">
                <?php $dem=0;foreach ($products as $index => $product): ?>
                <?php if (!empty($product)): ?>
                <?php $indexing = 0; foreach ($product as $value): $dem++;?>

                    <?php if ($index == 0): ?>
                        <li class="feature">

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
                    <?php else: ?>
                        <li>
                            <!--#region Ngành hàng chính -->
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
                                <?php if ($value->hot): ?>
                                    <img
                                            class="icon-imgNew cate42 left lazyloaded"
                                            src="/images/unnamed.png">
                                <?php endif; ?>
                            </a>
                            <!--#endregion -->

                        </li>
                    <?php endif; ?>

                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

<?php
if($dem==0):
    ?>
    <div class="product-lists box-product-lists mt15 clearfix">
        <div class="col-xs-12 empty">
            <p>no suitable product was found, try again!</p>
        </div>
    </div>
<?php endif;?>

