<?php
/**
 * @var $product \common\models\Product
 * @var $properties \common\models\Properties
 * @var $productRelatives \common\models\Product
 * @var $thuoctinhs \common\models\Propertiesvalueproduct
 */

use yii\bootstrap\Modal;

$config = \common\models\search\Configure::getConfig();
$images = \common\models\Product::getAllImage($product->id);
$nab = Yii::$app->controller->navbar;
$this->title = $product->name;
\johnitvn\ajaxcrud\CrudAsset::register($this);
?>
<style>
    .cmu_tags {
        margin: 0;
    }

    .cmu_tags a {
        background: #85c8ea;
        border-radius: 3px 0 0 3px;
        color: #fff !important;
        display: inline-block !important;
        height: 26px;
        float: left;
        line-height: 26px;
        padding: 0 30px 0 10px;
        position: relative;
        margin: 0 3px 3px 0;
        text-decoration: none;
        -webkit-transition: color 0.2s;
    }

    .cmu_tags a::before {
        background: #fff;
        border-radius: 10px;
        box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
        content: '';
        height: 6px;
        right: 13px;
        position: absolute;
        width: 6px;
        top: 10px;
    }

    .cmu_tags a::after {
        background: #fff;
        border-bottom: 13px solid transparent;
        border-left: 10px solid #85c8ea;
        border-top: 13px solid transparent;
        content: '';
        position: absolute;
        right: 0;
        top: 0;
    }

    /* 02:13:28 26/06/2020 */
    .fullparameter {
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        z-index: 99;
        display: none;
        padding: 0 0 0 55px;
        width: 630px;
        margin: 0 auto
    }

    .fullparameter.display {
        display: block
    }

    .fullparameter ul {
        padding: 10px 30px 10px 30px;
        width: 450px
    }

    .fullparameter .scroll {
        height: 100vh;
        width: auto;
        padding: 0 30px 0 30px;
        overflow-x: hidden;
        overflow-y: auto;
        background: #fff
    }

    .fullparameter .scroll img {
        display: block;
        margin: 0 auto;
        width: 500px;
        height: auto
    }

    .fullparameter .scroll h4, .fullparameter .scroll h3 {
        display: block;
        font-size: 18px;
        color: #666;
        font-weight: 600;
        margin-top: 15px;
        line-height: 1.3em
    }

    .tableparameter .closebtn {
        position: fixed;
        top: 0;
        right: 0;
        z-index: 99
    }

    .fullparameter .closebtn {
        float: right;
        width: 75px;
        height: 75px;
        position: absolute;
        top: 0;
        right: 0;
        cursor: pointer
    }

    .fullparameter .scroll .viewarticle {
        float: left;
        padding: 8px;
        width: 200px;
        border: 1px solid #e33135;
        border-radius: 4px;
        font-size: 13px;
        color: #e33135;
        font-weight: 600;
        margin: 15px 0 0 30px;
        text-align: center
    }

    .fullparameter .scroll .viewarticle:hover {
        background: #e33135;
        color: #fff
    }

    .fullparameter .scroll .closetable {
        float: left;
        padding: 8px;
        margin: 16px;
        font-size: 13px;
        color: #e33135;
        position: relative;
        width: auto;
        height: auto
    }

    .fullparameter .scroll .closetable:hover {
        color: #e67e22
    }

    .fullparameter .scroll::-webkit-scrollbar {
        width: 9px
    }

    .fullparameter .scroll::-webkit-scrollbar-track {
        background: #fff;
        width: 11px;
        padding: 2px
    }

    .fullparameter .scroll::-webkit-scrollbar-thumb {
        background: #d8d8d8;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border-radius: 8px
    }

    .parameterfull {
        display: block;
        position: relative;
        overflow: hidden;
        background: #fff
    }

    .parameterfull li {
        display: table;
        *display: block;
        background: #fff;
        width: 100%;
        border-bottom: 1px solid #dadada
    }

    .parameterfull li label {
        display: block;
        background: #f2f2f2;
        font-size: 16px;
        font-weight: 600;
        color: #c0392b;
        padding: 8px
    }

    .parameterfull li span {
        display: table-cell;
        *float: left;
        width: 35%;
        vertical-align: top;
        padding: 6px 5px;
        font-size: 13px;
        color: #666;
        font-weight: 600
    }

    .parameterfull li span div.ph {
        padding: 0
    }

    .parameterfull li div {
        display: table-cell;
        *float: left;
        width: auto;
        vertical-align: top;
        padding: 6px 5px;
        font-size: 13px;
        color: #666
    }

    .parameterfull li div a {
        color: #e33135
    }

    .parameterfull li div a:hover {
        color: #e67e22
    }

    .specWear {
        padding: 0 !important;
        margin-top: 15px;
        width: 100% !important
    }

    .fixbody {
        overflow: hidden;
        left: 0;
        right: 0
    }

    .fixparameter {
        display: block;
        overflow: hidden;
        background: rgba(0, 0, 0, .75);
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        top: 0;
        z-index: 99;
        text-indent: 999999em
    }

    .icondetail-closepara {
        width: 75px;
        height: 75px;
        cursor: pointer;
        display: block
    }

    .parameterfull li span a {
        color: #e33135
    }

    .parameterfull li span a div {
        color: #e33135
    }
</style>


    <div class="col-md-6 col-sm-12 information-product">

        <div id="surround">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-image-featured"
            >
                <img class="product-image-feature"
                     src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefault($product->id) ?>"
                     alt="<?= $product->name ?>">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                                 class="mTSThumb unveil-loaded">
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-price" id="price-preview">
            <?php if ($product->status == 0): ?>
                <span
                        class="sale-value"><?= $config['money_suffix'] . " " . number_format($product->sale, 0, '', '.') ?></span>
                <?php if ($product->sale < $product->retail): ?>
                    <del><?= $config['money_suffix'] . " " . number_format($product->retail, 0, '', '.') ?></del>
                    <span class="text-danger text-giamgia">- <?php echo round(($product->retail - $product->sale) * 100 / $product->retail, 0) ?> %</span>
                <?php endif; ?>
            <?php else: ?>
                <span
                        class="sale-value">Hết hàng tạm thời</span>
            <?php endif; ?>
        </div>

        <?php $thuoctinhsanpham = \common\models\Thuoctinhproduct::find()->where(['product_id' => $product->id])->all();
        $listthuoctinh = \common\models\Thuoctinh::find()->all(); ?>
        <?php if (!empty($thuoctinhsanpham)): ?>
            <div class="col-xs-12 owl-carousel owl-theme " id="phienbanselect">

                <?php
                foreach ($thuoctinhsanpham as $index => $value):/** @var \common\models\Thuoctinhproduct $value */
                    ?>
                    <div class="item price-phienban" <?= ($value->conhang) ? "" : "style='background: #ddd;'"; ?>>
                        <div class="phienbanselect"><?php
                            $dulieuthuoctinh = \yii\helpers\Json::decode($value->thuoctinh_id);
                            foreach ($dulieuthuoctinh as $value2) {
                                foreach ($listthuoctinh as $valuett) {
                                    if ($valuett->id == $value2) {
                                        echo $valuett->tenthuoctinh . ", ";
                                        break;
                                    }
                                }
                            }
                            ?></div>


                        <input type="radio" style="margin-top: 10px" <?= ($value->conhang) ? "" : "disabled"; ?>
                               name="selectthuoctinh"
                               sale="<?= $config['money_suffix'] . " " . number_format($value->gia, 0, '', '.') ?>"
                               retail="<?php if ($value->gia < $value->giagoc) echo $config['money_suffix'] . " " . number_format($value->giagoc, 0, '', '.') ?>"
                               discount="<?php if ($value->gia < $value->giagoc) echo "- " . round(($value->giagoc - $value->gia) * 100 / $value->giagoc, 0) . " %" ?>"
                               value="<?= $value->id ?>">
                        <?= ($value->conhang) ? "" : "<span class='text-danger text-hethang'>Hết hàng</span>" ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <script>
                $(document).ready(function () {
                    $("#phienbanselect").owlCarousel({
                        responsive: {
                            0: {
                                items: 2
                            },
                            768: {
                                items: 2
                            },

                        },
                        slideSpeed: 2000,
                        nav: true,
                        autoplay: false,
                        dots: false,
                        loop: false,
                        responsiveRefreshRate: 200,
                        navText: [
                            '<i class="fa fa-angle-left fa-5x" aria-hidden="true"></i>',
                            '<i class="fa fa-angle-right fa-5x" aria-hidden="true"></i>'
                        ]
                    });
                })
            </script>
        <?php endif; ?>
        <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $product->url, 'id' => $product->id]) ?>" class="btn-style-add muangay buy_now">Đặt mua ngay</a>
    </div>
    <div id="description" class="col-md-6 col-xs-12">
        <h2 class="title-danh-muc">Chi tiết</h2>
        <div class="detail-product content-containers">
            <?= $product->decription ?>
        </div>
        <p class="show-more" style="display:block;position:sticky;">
            <a id="xem-them-bai-viet" href="javascript:;" data-toggle="modal"
               data-target="#ajaxCrudModal"
               class="readmoredetail readmore viewparameterfull">Xem thêm</a>
        </p>
    </div>


<script>
    $(document).ready(function () {
        $("#description table").attr('class', 'table table-hover table-striped table-bordered');
        if ($(".product-thumb-vertical").length > 0 && $(window).width() >= 1200) {
            $(".product-thumb-vertical").mThumbnailScroller({
                axis: "x",
                type: "click-thumb",
                theme: "buttons-out",
                type: "hover-precise",
                contentTouchScroll: true
            });
            //$('.product-thumb-vertical').css('height', $('.product-image-feature').height());
            $('#sliderproduct').show();
            $('.product-thumb .mTSThumb').removeClass('anh-thumb');
        }
        if ($(".product-thumb-vertical").length > 0 && $(window).width() < 1200) {
            $(".product-thumb-vertical").mThumbnailScroller({
                axis: "y",
                theme: "buttons-out",
                contentTouchScroll: true
            });
            $('#sliderproduct').show();
            $('.product-thumb .mTSThumb').addClass('anh-thumb');
        }

        var modalHeader = $("#ajaxCrudModal .modal-header");
        var modalBody = $("#ajaxCrudModal .modal-body");
        var modalFooter = $("#ajaxCrudModal .modal-footer");
        $(document).on('click', ".readmoredetail", function () {
            var self = $(this).parent().parent();
            var d = self.find("h2.title-danh-muc").clone();
            modalHeader.append(d);
            modalFooter.remove();
            modalBody.html(self.find(".content-containers").html()).append("<div class='clearfix'></div>").attr("style", "max-height:80vh;overflow-y:scroll");
            modalBody.animate({scrollTop: 0}, "fast");
        });
        $(document).on('click', ".price-phienban", function () {
            var self = $(this);
            self.find("input[type='radio']")[0].click();
        });
        $(document).on('click', ".price-phienban input[type='radio']", function () {
            var self = $(this);
            $("#price-preview .sale-value").text(self.attr('sale'));
            $("#price-preview del").text(self.attr('retail'));
            $("#price-preview .text-giamgia").text(self.attr('discount'));
        });
        $("#ajaxCrudModal").on("hidden.bs.modal", function () {
            modalBody.removeAttr('style');
            modalBody.html('');
            modalHeader.html("<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>");
        });
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
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
    "size" => Modal::SIZE_LARGE
]) ?>
<?php Modal::end(); ?>