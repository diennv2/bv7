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
<style>
    .dst_hottrends a {
        color: #e33135;
        border: 1px solid #e33135;
        display: inline-block;
        vertical-align: top;
        padding-left: 5px;
        padding-right: 6px;
        font-size: 13px;
        line-height: 2;
        -webkit-transition: all 0.2s linear;
        -moz-transition: all 0.2s linear;
        -ms-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        transition: all 0.2s linear;
        background: #fff;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        -o-border-radius: 3px;
        border-radius: 3px;
    }

    .dst_hottrends a:hover {
        background: #e33135;
        color: #fff;
        border: 1px solid #fff;
    }
</style>
<div class="procsContainer">
    <div class="news-container procs">
        <div class="content-product">
            <div class="header-navigate">
                <div class="container">
                    <ul id="breadcrumb" class="breadcrumb breadcrumb-arrow">
                        <?= $nab ?>
                    </ul>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-12 clearfix">
                    <?php echo \yii\helpers\Html::beginForm('', '', ['id' => 'filter-form']); ?>
                    <?php echo \yii\helpers\Html::textInput('catid', $catProduct->id, ['class' => 'hidden']) ?>
                    <div class="filter-destop">
                        <h3 class="hidden">
                            <?= $catProduct->name ?>
                        </h3>
                        <div class="filter-box">
                            <!--                            <p aria-expanded="false">Brand<i class="fa fa-angle-down hidden-lg"></i></p>-->
                            <!---->
                            <!--                            <div class="field-search input-group hidden-md hidden-sm hidden-xs">-->
                            <!--                                <input type="text" class="filter-vendor-list"-->
                            <!--                                       onkeyup="filterItemInList(jQuery('.filter-vendor-list'))">-->
                            <!--                                <button class=""></button>-->
                            <!--                            </div>-->
                            <?php if (!empty($brand)): ?>
                                <div class="col-xs-12 filterbrandcontainer">
                                    <div class="row" style="padding: 0 15px">
                                        <?php foreach ($brand as $value): ?>
                                            <a class="col-xs-4 col-md-2 selectbrand" vals="<?= $value->id ?>">
                                                <div><img src="/images/brand/<?= $value->image ?>"
                                                          class="unveil-loaded"></div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            <?php endif; ?>
                            <div class="clearfix"></div>
                            <?php if (!empty($brand)): ?>
                                <ul class="filter-vendor clearfix hidden">
                                    <?php foreach ($brand as $value): ?>
                                        <li>
                                            <label data-filter="<?= func::taoduongdan($value->name) ?>"
                                                   class="<?= func::taoduongdan($value->name) ?>">
                                                <input name="brand[]" type="checkbox" id="checkbox<?= $value->id ?>"
                                                       value="<?= $value->id ?>">
                                                <span><?= $value->name ?></span>
                                            </label>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div class="filter-box dst_hottrends" id="dst_hottrends" style="padding-top: 5px">
                            <?php $subcatfordelivery = \common\models\Catproduct::find()->where(['parent' => $catProduct->id])->all();
                            if (!empty($subcatfordelivery)):foreach ($subcatfordelivery as $subs): ?>
                                <a title="<?= $subs->name ?>"
                                   href="<?= Yii::$app->urlManager->createUrl(['product/product', 'path' => $subs->url, 'id' => $subs->id]) ?>"><?= $subs->name ?></a>
                            <?php endforeach;endif; ?>
                        </div>

                    </div>
                    <?php echo \yii\helpers\Html::endForm(); ?>
                </div>

                <div class="col-xs-12 clearfix">
                    <div class="icon-loading" style="display: none;">
                        <div class="uil-ring-css">
                            <div></div>
                        </div>
                    </div>

                    <div class="product-lists-book product-lists box-product-lists mt15 clearfix" id="product-list-area">
                        <ul class="homeproduct-book homeproduct margin-top-bot-5">
                            <?php $dem = 0;
                            ?>

                            <?php foreach ($products

                            as $value):
                            $dem++ ?>

                            <li>
                                <!--#region Ngành hàng chính -->
                                <a href="<?= $catProduct->id == 31||$catProduct->id == 36||$catProduct->id == 37 ? $value->ebook : Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $value->url, 'id' => $value->id]) ?>">
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
                                            <span><?= func::vndFormat($value->retail); ?><?= $config['money_suffix'] ?> sách</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="promo noimage">
                                        <p><?= (!empty($value->philapdat) && $value->philapdat != "" && !is_null($value->philapdat) && $value->philapdat != "<p></p>") ? $value->philapdat : $value->decription ?></p>
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
                            <?php endforeach;?>
                        </ul>
                        <?php
                        if ($dem == 0):
                            ?>
                            <div class="product-lists box-product-lists mt15 clearfix">
                                <div class="col-xs-12 empty">
                                    <p>Chưa cập nhật sản phẩm!</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.selectbrand', function () {
            var self = $(this);
            var id = self.attr('vals');
            $("#checkbox" + id).click();
            if (self.hasClass("bactive")) {
                self.removeClass("bactive");
            } else {
                self.addClass("bactive");
            }
        });
        $(document).on('change', '#selectgia', function () {
            var self = $(this);
            var id = self.val();
            $("#gia-" + id).click();

        })
    })
</script>