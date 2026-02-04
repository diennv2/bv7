<?php
/**
 * @var $product \common\models\Product
 * @var $properties \common\models\Properties
 * @var $productRelatives \common\models\Product
 * @var $thuoctinhs \common\models\Propertiesvalueproduct
 */
$config = \common\models\search\Configure::getConfig();
$images = \common\models\Product::getAllImage($product->id);
$nab = Yii::$app->controller->navbar;
$this->title = $product->name;
\johnitvn\ajaxcrud\CrudAsset::register($this);
?>
<div class="procsContainer">
    <div class="header-navigate">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb breadcrumb-arrow">
                        <?= $nab ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row" style="margin-bottom: 30px">
                    <div class="col-lg-6 col-md-5 col-sm-12">
                        <div id="surround">
                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 box-image-featured"
                                 style="border: 1px solid#ddd">
                                <img class="product-image-feature"
                                     src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefault($product->id) ?>"
                                     alt="<?= $product->name ?>">
                            </div>
                            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="product-thumb-vertical mThumbnailScroller _mTS_1 mTS-buttons-out mTS_no_scroll auto-mTS-x-hover-50-none"
                                         id="sliderproduct">
                                        <div id="mTS_1" class="mTSWrapper mTS_vertical">
                                            <ul class="mTSContainer" id="mTS_1_container">
                                                <?php foreach ($images as $image): ?>
                                                    <li class="product-thumb upload mTSThumbContainer">
                                                        <a href="javascript:void(0);"
                                                           data-image="<?= Yii::$app->urlManager->baseUrl . $image->image ?>"
                                                           class="<?= ($image->default == 1) ? 'zoomGalleryActive' : '' ?>">
                                                            <img src="<?= Yii::$app->urlManager->baseUrl . $image->image ?>"
                                                                 class="mTSThumb">
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12 information-product">
                        <div class="product-title">
                            <h1><?= $product->name ?></h1>
                        </div>
                        <div class="product-price" id="price-preview">
                            <span
                                    class="sale-value"><?= $config['money_suffix']." ".number_format($product->sale, 0, '', '.')  ?></span>
                            <?php if ($product->sale < $product->retail): ?>
                                <del><?= $config['money_suffix']." ".number_format($product->retail, 0, '', '.')  ?></del>
                            <?php endif; ?>
                        </div>

                        <div id="add-item-form" class="variants clearfix variant-style">
                            <div class="select-wrapper clearfix ">
                                <label>Quantity</label>
                                <input type="button" value="-" onclick="minusQuantity()" class="qty-btn">
                                <input type="text" id="quantity" name="quantity" value="1" min="1"
                                       class="quantity-selector">
                                <input type="button" value="+" onclick="plusQuantity()" class="qty-btn">
                                <input id="idsanpham" type="hidden" name="codesanpham"
                                       value="<?= $product->id ?>">
                                <input id="thongso" type="hidden" name="thongsosanpham" value="<?= $product->id ?>">
                            </div>
                            <div class="clearfix">
                                <?php if ($product->status == 1): ?>
                                    <a href="javascript:void(0)" class="btn-style-add themvaogiohang">Add to cart</a>
                                <?php else: ?>
                                    <a href="#" class="btn-style-add addtocart-modal">Liên hệ</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="information-more">
                            <p><?= $product->brief ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="product-comment">
                            <!-- Nav tabs -->
                            <ul class="product-tablist nav nav-tabs" id="tab-product-template">
                                <li class="dropdown pull-right tabdrop hide"><a class="dropdown-toggle"
                                                                                data-toggle="dropdown" href="#"><i
                                                class="fa fa-bars"></i> <b class="caret"></b></a>
                                    <ul class="dropdown-menu"></ul>
                                </li>
                                <li class="active">
                                    <a data-toggle="tab" href="#description">
                                        <span> Description</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="tab-content">
                            <div id="description" class="tab-pane fade in active">
                                <?= $product->decription ?>
                            </div>
                        </div>
                        <div id="comment">
                            <div class="container-fluid">
                                <div class="row">

                                </div>

                            </div>
                        </div>
                        <div id="product-related">
                            <div class="title-decoration">

								<span>
									Các sản phẩm khác
								</span>

                                <div class="decoration"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12  col-sm-12 col-xs-12">
                                    <div class="home-products-block bh-products">
                                        <div class="home-products-block-content">
                                            <div class="home-products-slider product-box-list row">
                                                <div id="featured-products"
                                                     class="clearfix owl-carousel owl-theme">
                                                    <?php foreach ($productRelatives as $productRelative): ?>
                                                        <div class="item">
                                                            <div
                                                                    class="product-grid-item product h-hover-alt product-type-simple product-wrapper product-resize product_itemh fixheight">
                                                                <div class="product-wrapp">
                                                                    <div class="product-element-top">
                                                                        <div class="product-image image-resize">
                                                                            <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $productRelative->url, 'id' => $productRelative->id]) ?>"
                                                                               title="<?= $productRelative->name ?>">

                                                                                <?php if ($productRelative->sale < $productRelative->retail): ?>
                                                                                    <div class="field-sale">

                                                                                                <span><?= round(100 - (($productRelative->sale / $productRelative->retail) * 100), 0) ?>
                                                                                                    % Discount</span>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                                <img class="unveil-loaded"
                                                                                        src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefaultThumb($productRelative->id) ?>"
                                                                                        alt="<?= $productRelative->name ?>">
                                                                            </a>
                                                                        </div>
                                                                        <div class="h-buttons">
                                                                            <div class="quick-view">
                                                                                <a href="javascript:void(0);"
                                                                                   class="quickview  h-tooltip"><span
                                                                                            class="h-tooltip-label">Quick view</span>Quick view</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <h3 class="product-title">
                                                                        <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $productRelative->url, 'id' => $productRelative->id]) ?>"
                                                                           title="<?= $productRelative->name ?>"><?= $productRelative->name ?></a>
                                                                    </h3>
                                                                    <div class="wrap-price">
                                                                        <div class="wrapp-swap">
                                                                            <div class="swap-elements">
                                                                                <div
                                                                                        class="price-info clearfix">
                                                                                    <div
                                                                                            class="price-new-old price">

                                                                                        <span><?= $config['money_suffix']." ".number_format($productRelative->sale, 0, '', '.') ?></span>
                                                                                        <?php if ($productRelative->sale < $productRelative->retail): ?>
                                                                                            <small
                                                                                                    class="price2">
                                                                                                <del><?= $config['money_suffix']." ".number_format($productRelative->retail, 0, '', '.') ?></del>
                                                                                            </small>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="btn-add">
                                                                                    <?php if ($productRelative->status == 1): ?>
                                                                                        <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $productRelative->url, 'id' => $productRelative->id]) ?>"
                                                                                           class="button product_type_simple add_to_cart_button  h-tooltip ">
                                                                                                    <span
                                                                                                            class="h-tooltip-label">Add to cart</span>Add to cart
                                                                                        </a>
                                                                                    <?php else: ?>
                                                                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/contact']) ?>"
                                                                                           class="button product_type_simple add_to_cart_button  h-tooltip ">
                                                                                                    <span
                                                                                                            class="h-tooltip-label">Sản phẩm tạm thời hết</span>Sản
                                                                                            phẩm tạm thời hết
                                                                                        </a>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            if ($(".product-thumb-vertical").length > 0 && $(window).width() >= 1200) {
                $(".product-thumb-vertical").mThumbnailScroller({
                    axis: "y",
                    type: "click-thumb",
                    theme: "buttons-out",
                    type: "hover-precise",
                    contentTouchScroll: true
                });
                $('.product-thumb-vertical').css('height', $('.product-image-feature').height());
                $('#sliderproduct').show();
                $('.product-thumb .mTSThumb').removeClass('anh-thumb');
            }
            if ($(".product-thumb-vertical").length > 0 && $(window).width() < 1200) {
                $(".product-thumb-vertical").mThumbnailScroller({
                    axis: "x",
                    theme: "buttons-out",
                    contentTouchScroll: true
                });
                $('#sliderproduct').show();
                $('.product-thumb .mTSThumb').addClass('anh-thumb');
            }
        });
    </script>

    <script>
        var selectCallback = function (variant, selector) {
            if (variant && variant.available) {
                $('.product-image-feature').hide();
                $('.lazy-product-featured').show();
                $(".product-thumb").children('a.zoomGalleryActive').removeClass('zoomGalleryActive');
                if (variant != null && variant.featured_image != null) {
                    $(".product-thumb a[data-image='" + Haravan.resizeImage(variant.featured_image.src, '1024x1024') + "']").click();
                }
                $('.lazy-product-featured').hide();
                $('.product-image-feature').show();
                if (variant.sku != null) {
                    jQuery('#pro_sku').html('SKU: ' + variant.sku);
                }
            } else {
                jQuery('.addtocart').attr('disabled', 'disabled');
                jQuery('.addnow').attr('disabled', 'disabled');
                var message = variant ? "Out of stock" : "Không có hàng";
                jQuery('#price-preview').html('<span>' + message + '</span>');
                $('.lazy-product-featured').hide();
                $('.product-image-feature').show();
            }
        };
        setTimeout(function () {
            if ($(".product-thumb-vertical").length > 0 && $(window).width() >= 1200) {
                jQuery(".product-image-feature").elevateZoom({
                    gallery: 'sliderproduct',
                    scrollZoom: true
                });
            }
            if ($(".product-thumb-vertical").length > 0 && $(window).width() < 1200) {
                jQuery(".product-image-feature").elevateZoom({
                    gallery: 'sliderproduct',
                    zoomEnabled: false
                });
            }
        }, 500);
    </script>

</div>