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

<main id="main" class="main-pages">
    <section class="section-banner">
        <div class="banner-page">
            <div class="bs-container">
                <div class="banner-text"><h1 class="title aos-init aos-animate" data-aos="zoom-out"
                                             data-aos-delay="1200"> Khối Nhà Nước </h1>
                    <ul class="link-list aos-init aos-animate" data-aos="zoom-out" data-aos-delay="1200">
                        <?= $nab ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="section-productPage abc">
        <div class="bs-container">
            <div class="bs-row">
                <div class="bs-col">
                    <div class="module module-product">
                        <div class="module-header"><h4 class="title aos-init aos-animate" data-aos="fade-down"
                                                       data-aos-delay="0">Danh sách sản phẩm</h4></div>
                        <div class="module-content aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                            <div class="product">
                                <div class="bs-row row-sm-10">
                                    <?php $dem = 0;
                                    foreach ($products as $index => $product): ?>
                                        <?php if (!empty($product)): ?>
                                            <?php foreach ($product as $value): $dem++ ?>
                                                <?php if ($index == 0): ?>

                                                <?php else: ?>
                                                    <div class="bs-col sm-33-10">
                                                        <div class="item pro_block">
                                                            <div class="img a_height"><h2 class="title f_height"><a
                                                                            href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $value->url, 'id' => $value->id])?>"
                                                                            class="title_link"><span>Phần Mềm Quản Lý Đối Tượng Bảo Trợ Xã Hội | Người Có Công Cho Các Tỉnh</span></a>
                                                                </h2><img
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
                                                                        ?>"
                                                                        alt="<?= $value->name ?>"
                                                                        loading="lazy"></div>
                                                            <div class="description"><?= $value->decription ?></div>
                                                            <div class="see-more"><a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $value->url, 'id' => $value->id])?>"
                                                                                     class="link">Xem thêm</a></div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
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
        </div>
    </section>
    <section class="section-slogan">
        <div class="bs-container"><p class="desc aos-init aos-animate" data-aos="zoom-out" data-aos-delay="0">Chúng tôi
                ở đây để làm mọi thứ tốt hơn!</p></div>
    </section>
</main>
<script>
    $(document).ready(function () {
        $(document).on('click','.selectbrand',function () {
            var self=$(this);
            var id = self.attr('vals');
            $("#checkbox"+id).click();
            if(self.hasClass("bactive")){
                self.removeClass("bactive");
            }else{
                self.addClass("bactive");
            }
        });
        $(document).on('change','#selectgia',function () {
            var self=$(this);
            var id = self.val();
            $("#gia-"+id).click();

        })
    })
</script>