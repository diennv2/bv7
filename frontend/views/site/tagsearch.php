<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 02-Aug-17
 * Time: 1:19 PM
 */
$nab = Yii::$app->controller->navbar;

$config = \common\models\Configure::getConfig();

$this->title = $title;
\johnitvn\ajaxcrud\CrudAsset::register($this);
?>
<div class="header-navigate">
    <div class="container">
        <ul id="breadcrumb" class="breadcrumb breadcrumb-arrow">
            <?= $nab ?>
        </ul>
    </div>
</div>

<div class="container">
    <h1><?=$title?></h1>
    <div class="col-lg-collection-left hidden-md hidden-sm hidden-xs clearfix">
        <?php echo \yii\helpers\Html::beginForm('', '', ['id' => 'filter-form']); ?>
        <?php echo \yii\helpers\Html::textInput('id',$id,['class'=>'hidden'])?>
        <div class="filter-destop">
            <h3>
                Lọc sản phẩm
            </h3>
            <div class="filter-box tagfil">
                <p aria-expanded="false">Thương hiệu<i class="fa fa-angle-down hidden-lg"></i></p>

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
            <div class="filter-box tagfil">
                <p aria-expanded="false">Giá<i class="fa fa-angle-down hidden-lg"></i></p>
                <ul class="filter-price clearfix">
                    <li>
                        <label>
                            <input type="radio" name="price-filter" data-price="0"
                                   value="nope" checked="true">
                            <span>Không lọc</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="price-filter" data-price="0:500000"
                                   value="0:500000">
                            <span>Nhỏ hơn 500,000₫</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="price-filter" data-price="500000:2000000"
                                   value="500000:2000000">
                            <span>Từ 500,000₫ - 2,000,000₫</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="price-filter" data-price="2000000:5000000"
                                   value="2000000:5000000">
                            <span>Từ 2,000,000₫ - 5,000,000₫</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="price-filter" data-price="5000000:10000000"
                                   value="5000000:10000000">
                            <span>Từ 5,000,000₫ - 10,000,000₫</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="price-filter" data-price="10000000:max"
                                   value="10000000:max">
                            <span>Lớn hơn 10,000,000₫</span>
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
    <div  class="product-lists box-product-lists mt15 clearfix" id="hienthitag">
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
                                                <span><?= $config['money_suffix']." ".number_format($value->sale, 0, '', '.')?></span>
                                                <?php if ($value->sale < $value->retail): ?>
                                                    <small class="price2">
                                                        <del> <?=  $config['money_suffix']." ".number_format($value->retail, 0, '', '.')?> </del>
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
    </div>
    </div>
</div>
