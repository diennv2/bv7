<?php
if (!empty($data)) {

    ?>
    <?php $dem = 0;
    foreach ($data as $index => $value): ?>
        <div class="product-grid-item product h-hover-alt product-type-simple product-wrapper product-resize col-lg-3 col-md-3 col-sm-4 col-xs-6 product-item animated zoomIn fixheight">
            <div class="product-element-top">
                <div class="product-image image-resize">
                    <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $value->url, 'id' => $value->id]) ?>"
                       title="<?= $value->name ?>"
                       rel="dofollow">
                        <img alt="<?= $value->name ?>"
                             src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefaultThumb($value->id) ?>"/>
                    </a>
                    <h3 class="product-title">
                        <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $value->url, 'id' => $value->id]) ?>"
                           title="<?= $value->name ?>"><?= $value->name ?></a>
                    </h3>
                    <div class="wrap-price">
                        <div class="wrapp-swap">
                            <div class="swap-elements">
                                <div class="price-info clearfix">
                                    <div class="price-new-old price">
                                        <span><?= $config['money_suffix']." ".number_format($value->sale, 0, '', '.') ?></span>
                                        <?php if ($value->sale < $value->retail): ?>
                                            <small class="price2">
                                                <del> <?= $config['money_suffix']." ".number_format($value->retail, 0, '', '.') ?> </del>
                                            </small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="btn-add">
                                    <a href="javascript:void(0);" onclick="add_item_show_modalCart(1012249029)"
                                       class="button product_type_simple add_to_cart_button  h-tooltip ">
                                        <span class="h-tooltip-label">Add to cart</span>Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php
} else {
    ?>
    <div class="product-lists box-product-lists mt15 clearfix">
        <div class="col-xs-12 empty">
            <p>no suitable product was found, try again!</p>
        </div>
    </div>
    <?php
}
?>