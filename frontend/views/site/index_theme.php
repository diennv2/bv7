<?php $themes = \common\models\Configure::find()->where(["nhom" => 'giaodien'])->orderBy('CAST(label AS UNSIGNED) asc')->all();
foreach ($themes as $dataGiaodien):/** @var \common\models\Configure $dataGiaodien */
    ?>
    <?php
    $type = explode("_", $dataGiaodien->name)[0];
    $data = \yii\helpers\Json::decode($dataGiaodien->value);
    ?>
    <?php if ($type == "slide"): ?>
    <div class="row margin-top-bot-5">
        <div class="col-md-12">
            <div class="navigat ">
                <h2><i class="fa fa-star-o"></i> <?php
                    echo $data['tenhienthi'];
                    ?> <i class="fa fa-star-o"></i></h2>
            </div>
            <div id="<?= $dataGiaodien->name ?>" class="owl-carousel homepromo owl-theme">
                <?php
                if ($data['nguondulieu'] == 0) {
                    $products = \common\models\Product::find()->where('active=1 and home=1 and cat_product_id=' . $data['danhmucsanpham'])->orderBy('ord asc')->limit((isset($data['sosanphamhienthi'])) ? $data['sosanphamhienthi'] : 10)->all();
                } else {
                    $products = \common\models\Product::find()->where('active=1 and home=1')->andWhere(['IN', 'id', (isset($data['danhmucsanphamtudinhnghia']) ? $data['danhmucsanphamtudinhnghia'] : [])])->orderBy('ord asc')->limit((isset($data['sosanphamhienthi'])) ? $data['sosanphamhienthi'] : 10)->all();
                }
                foreach ($products as $value): /** @var \common\models\Product $value */
                    ?>
                    <div class="item">
                        <!--#region Ngành hàng chính -->
                        <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $value->url, 'id' => $value->id]) ?>">
                            <img
                                    src="<?php
                                    if (!empty($value->anhsanphams)) {
                                        $anhdefault = \common\models\Anhsanpham::getAnhDefault($value->id);
                                        /** @var \common\models\Anhsanpham $anhdefault */
                                        if (!is_null($anhdefault)) {
                                            echo Yii::$app->urlManager->baseUrl . $anhdefault->thumb;
                                        } else {
                                            echo Yii::$app->urlManager->baseUrl . "/images/noimg.jpg";
                                        }
                                    } else {
                                        echo Yii::$app->urlManager->baseUrl . "/images/noimg.jpg";
                                    }
                                    ?>"
                                    alt="<?= $value->name ?>">
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

                    </div>
                <?php endforeach; ?>


            </div>
            <script>
                $(document).ready(function () {
                    $("#<?=$dataGiaodien->name?>").owlCarousel({
                        responsive: {
                            0: {
                                items: '2'
                            },
                            600: {
                                items: '3'
                            },

                            768: {
                                items: '4'
                            },
                            960: {
                                items: '5'
                            },

                        },
                        slideSpeed: 2000,
                        nav: true,
                        autoplay: true,
                        dots: false,
                        loop: false,

                        navText: [
                            '<',
                            '>'
                        ]
                    });
                })
            </script>
            <style>
                #<?=$dataGiaodien->name?>
                .owl-nav.disabled,

                #<?=$dataGiaodien->name?>
                .owl-nav {
                    display: block;
                    position: absolute;
                    top: 25%;
                    width: 100%;
                }

                #<?=$dataGiaodien->name?>
                .owl-nav.disabled .owl-next,

                #<?=$dataGiaodien->name?>
                .owl-nav .owl-next {
                    right: 0;

                }
            </style>

        </div>
    </div>
<?php endif; ?>

    <?php if ($type == "listsanpham"): ?>
    <?php
    if ($data['nguondulieu'] == 0) {
        $products = \common\models\Product::find()->where('active=1 and home=1 and cat_product_id=' . $data['danhmucsanpham'])->orderBy('ord asc')->limit((isset($data['sosanphamhienthi'])) ? $data['sosanphamhienthi'] : 10)->all();
    } else {
        $products = \common\models\Product::find()->where('active=1 and home=1')->andWhere(['IN', 'id', (isset($data['danhmucsanphamtudinhnghia']) ? $data['danhmucsanphamtudinhnghia'] : [])])->orderBy('ord asc')->limit((isset($data['sosanphamhienthi'])) ? $data['sosanphamhienthi'] : 10)->all();
    }
    /** @var \common\models\Product $value */
    ?>

    <div class="navigat cate42 margin-top-bot-5 nomarginbottom">
        <h2><i class="fa fa-star-o"></i> <?= $data['tenhienthi'] ?> <i class="fa fa-star-o"></i></h2>

    </div>
    <!-- home products -->
    <div class="row margin-top-bot-5 nomargintop">
        <div class="col-md-12 paddingdown">
            <ul class="homeproduct margin-top-bot-5">
                <?php $indexing = 0;
                foreach ($products as $index => $value): ?>
                    <?php if ($index == 0): ?>
                        <li class="feature">

                            <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $value->url, 'id' => $value->id]) ?>">
                                <img alt="<?= $value->name ?>"
                                     src="<?php
                                     if (!empty($value->anhsanphams)) {
                                         $anhdefault = \common\models\Anhsanpham::getAnhDefault($value->id);
                                         /** @var \common\models\Anhsanpham $anhdefault */
                                         if (!is_null($anhdefault)) {
                                             echo Yii::$app->urlManager->baseUrl . $anhdefault->thumb;
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
                                             echo Yii::$app->urlManager->baseUrl . $anhdefault->thumb;
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
            </ul>
        </div>
    </div>
<?php endif; ?>
<?php endforeach; ?>