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

?>


<div class="col-xs-12">
    <div class="row" style="margin-bottom: 30px">
        <div class="col-lg-6 col-md-5 col-sm-12">
            <div id="surround">
                <div class="row">
                    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 box-image-featured"
                         style="border: 1px solid#ddd">
                        <img class="product-image-feature"
                             src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefaultThumb($product->id) ?>"
                             alt="<?= $product->name ?>">
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
                            class="sale-value"><?= $config['money_suffix']." ".number_format($product->sale, 0, '', '.')?></span>
                    <?php if ($product->sale < $product->retail): ?>
                        <del><?= $config['money_suffix']." ".number_format($product->retail, 0, '', '.') ?></del>
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
                        <a href="#" class="btn-style-add addtocart-modal">Out of stock</a>
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
        }
        if ($(".product-thumb-vertical").length > 0 && $(window).width() < 1200) {
            $(".product-thumb-vertical").mThumbnailScroller({
                axis: "x",
                theme: "buttons-out",
                contentTouchScroll: true
            });
            $('#sliderproduct').show();
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
