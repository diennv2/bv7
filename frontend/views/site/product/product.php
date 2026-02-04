<?php
/**
 * @var $catProduct \common\models\Catproduct;
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

$this->title = $parent->name;
\johnitvn\ajaxcrud\CrudAsset::register($this);

?>

<div class="news-container procs">
    <div class="content-product">
        <div class="header-navigate">
            <div class="container">
                <ul id="breadcrumb" class="breadcrumb breadcrumb-arrow">
                    <?= $nab ?>
                </ul>
            </div>
        </div>
        <div class="container">

            <div class="col-lg-collection-left hidden-md hidden-sm hidden-xs clearfix">
                <?php echo \yii\helpers\Html::beginForm('', '', ['id' => 'filter-form']); ?>
                <?php echo \yii\helpers\Html::textInput('catid', $catProduct->id, ['class' => 'hidden']) ?>
                <div class="filter-destop">
                    <h3>
                        Filter category "<?= $catProduct->name?>"
                    </h3>
                    <div class="filter-box">
                        <p aria-expanded="false">Brand<i class="fa fa-angle-down hidden-lg"></i></p>

                        <div class="field-search input-group hidden-md hidden-sm hidden-xs">
                            <input type="text" class="filter-vendor-list"
                                   onkeyup="filterItemInList(jQuery('.filter-vendor-list'))">
                            <button class=""></button>
                        </div>

                        <ul class="filter-vendor clearfix">
                            <?php foreach ($brand as $value): ?>
                                <li>
                                    <label data-filter="<?= func::taoduongdan($value->name) ?>"
                                           class="<?= func::taoduongdan($value->name) ?>">
                                        <input name="brand[]" type="checkbox" value="<?= $value->id ?>">
                                        <span><?= $value->name ?></span>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="filter-box" id="filter-box">
                        <p aria-expanded="false">Price<i class="fa fa-angle-down hidden-lg"></i></p>
                        <ul class="filter-price clearfix">
                            <li>
                                <label>
                                    <input type="radio" name="price-filter" data-price="0"
                                           value="nope" checked="true">
                                    <span>No filter</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" name="price-filter" data-price="0:100"
                                           value="0:100">
                                    <span>Less than 100VNĐ</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" name="price-filter" data-price="100:300"
                                           value="100:300">
                                    <span>From 100VNĐ - 300VNĐ</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" name="price-filter" data-price="300:500"
                                           value="300:500">
                                    <span>From 300VNĐ - 500₫</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" name="price-filter" data-price="500:1000"
                                           value="500:1000">
                                    <span>from 500VNĐ - 1000VNĐ</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" name="price-filter" data-price="1000:max"
                                           value="1000:max">
                                    <span>More than 1000VNĐ</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                </div>
                <?php echo \yii\helpers\Html::endForm(); ?>
            </div>

            <div class="col-lg-collection-right col-xs-12 clearfix">
                <div class="icon-loading" style="display: none;">
                    <div class="uil-ring-css">
                        <div></div>
                    </div>
                </div>

                <div class="product-lists box-product-lists mt15 clearfix" id="product-list-area">
                    <?php $dem=0;foreach ($products as $index => $product): ?>
                        <?php if (!empty($product)): ?>
                            <?php foreach ($product as $value): $dem++?>
                                <div class="product-grid-item product h-hover-alt product-type-simple product-wrapper product-resize col-lg-3 col-md-3 col-sm-4 col-xs-6 product-item animated zoomIn fixheight">
                                    <div class="product-element-top">
                                        <div class="product-image image-resize">
                                            <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $value->url, 'id' => $value->id]) ?>"
                                               title="<?= $value->name ?>"
                                               rel="dofollow">
                                                <?php if ($value->sale < $value->retail): ?>
                                                    <div class="field-sale">

                                                        <span><?= round(100 - (($value->sale / $value->retail) * 100), 0) ?>% Discount</span>
                                                    </div>
                                                <?php endif;?>
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
                                                                <span><?=  $config['money_suffix']." ".number_format($value->sale, 0, '', '.') ?></span>
                                                                <?php if ($value->sale < $value->retail): ?>
                                                                    <small class="price2">
                                                                        <del> <?=  $config['money_suffix']." ".number_format($value->retail, 0, '', '.') ?> </del>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="btn-add">
                                                            <a href="javascript:void(0);"
                                                               onclick="add_item_show_modalCart(1012249029)"
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
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php
                    if($dem==0):
                        ?>
                        <div class="product-lists box-product-lists mt15 clearfix">
                            <div class="col-xs-12 empty">
                                <p>Chưa cập nhật sản phẩm!</p>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
