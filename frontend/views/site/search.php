<?php
/**
 * @var $cat \common\models\Catproduct;
 * @var $parent \common\models\Catproduct;
 * @var $subcats \common\models\Catproduct;
 *
 *
 *
 *
 *
 */
$nab = Yii::$app->controller->navbar;

$config = \common\models\Configure::getConfig();
$this->title="Tìm kiếm";

?>
<div class="bg-white container news-container">
    <div class="content-product"  style="padding-bottom: 15px">
        <div class="container" style="font-family: 'Roboto Condensed'">
            <ul id="breadcrumb">
                <?= $nab ?>
            </ul>
            <div class="row">
                <h2 style="font-family: 'Roboto Condensed';text-transform:uppercase;font-size: 16px;padding: 15px; font-weight: 600">Kết quả tìm kiếm loại sản phẩm với từ khóa "<?= $keyword ?>"</h2>
                <?php
                if(empty($cat)){
                    echo "<span style='padding: 15px!important; display: block'>Không có sản phẩm nào phù hợp</span>";
                }else
                    foreach ($cat as $value):
                    ?>
                        <div class="col-md-2 col-xs-6 col-sm-2">- <a class="catsearch" href="<?php echo Yii::$app->urlManager->createUrl(['product/product','path'=>$value->url,'id'=>$value->id])?>" title="<?php echo $value->name?>"><?php echo $value->name?></a></div>
                <?php endforeach;?>
            </div>
            <div class="row" style="padding-top: 15px">
                <h2 style="font-family: 'Roboto Condensed';text-transform:uppercase;font-size: 16px;padding-left: 15px; font-weight: 600">Kết quả tìm kiếm sản phẩm với từ khóa "<?= $keyword ?>"</h2>

                <?php
                if(empty($product)){
                    echo "<span style='padding: 15px!important; display: block'>Không có sản phẩm nào phù hợp</span>";
                }else
                foreach ($product as $value): ?>
                    <div class="latest-deals-product" >
                        <div class="product-list">
                            <div class="col-md-2 col-xs-6 col-sm-2 d_catpr">
                                <div class="left-block" style="padding-top: 15px">
                                    <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $value->url, 'id' => $value->id]) ?>"><img
                                                class="img-responsive" alt="product"
                                                src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefaultThumb($value->id) ?>"/></a>
                                    <div class="quick-view">
                                        <a title="Add to my wishlist" class="heart" href="#"></a>
                                        <a title="Add to compare" class="compare" href="#"></a>
                                        <a title="Quick view" class="search" href="#"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <?php if ($value->status == 1): ?>
                                            <a title="Add to Cart" class="themgiohang" soluong="1"
                                               idsanpham="<?= $value->url ?>">Add to cart</a>
                                        <?php else: ?>
                                            <a title=""
                                               href="<?= Yii::$app->urlManager->createUrl(['site/contact']) ?>">Sản
                                                phẩm hết</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a
                                                href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $value->url, 'id' => $value->id]) ?>"><?= $value->name ?></a>
                                    </h5>
                                    <div class="content_price">
                                                         <span
                                                                 class="price product-price"><?= $config['money_suffix']." ".number_format($value->sale, 0, '', '.')?></span>
                                        <?php if ($value->sale < $value->retail): ?>
                                            <span
                                                    class="price old-price"><?= $config['money_suffix']." ".number_format($value->retail, 0, '', '.') ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
    </div>
</div>