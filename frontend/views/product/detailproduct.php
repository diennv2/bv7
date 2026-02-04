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

if (!empty($images)) {
    foreach ($images as $image) {
        /** @var \common\models\Anhsanpham $image */
        if ($image->default) {
            $this->context->og_image = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . $image->thumb;
            break;
        }
    }
} else {
    $this->context->og_image = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . $config['contact_logo'];
}
?>
    <main id="main" class="main-pages">
        <section class="section-banner">
            <div class="banner-page">
                <div class="bs-container">
                    <div class="banner-text"><h1 class="title aos-init aos-animate" data-aos="zoom-out"
                                                 data-aos-delay="1200"><?=$product->name ?></h1>
                        <ul class="link-list" vocab="https://schema.org/" typeof="BreadcrumbList">
                            <?= $nab ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <div class="section-content_detial">
            <div class="bs-container ">
                <div class="content_detail">
                    <div class="video">
                        <div class="bs-row row-sm-15">
                            <div class="bs-col sm-50-15">
                                <div class="img">
                                    <div class="ImagesFrame"><a class="ImagesFrameCrop0 tall"><img
                                                    src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefault($product->id) ?>"
                                                    loading="lazy" class="tall"><span class="play-button"
                                                                                      modal-show="show"
                                                                                      modal-data="#videoModel"><span></span></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="bs-col sm-50-15">
                                <div class="content_img"><h3 class="title"><?=$product->name ?></h3>
                                    <?= $product->decription ?><span class="contact"> Chia sẻ: <a
                                                href="http://www.facebook.com/sharer.php?u=https://bytesoft.vn/giai-phap-hop-co-dong-truc-tuyen-tron-goi"
                                                target="_blank" rel="nofollow"><i class="fab fa-facebook"></i></a><a
                                                href="https://twitter.com/share?text=&amp;url=https://bytesoft.vn/giai-phap-hop-co-dong-truc-tuyen-tron-goi"
                                                target="_blank" rel="nofollow"><i class="fab fa-twitter"></i></a><a
                                                href="http://pinterest.com/pin/create/button/?url=https://bytesoft.vn/giai-phap-hop-co-dong-truc-tuyen-tron-goi"
                                                target="_blank" rel="nofollow"><i
                                                    class="fab fa-pinterest"></i></a></span>
                                    <button class="view" modal-show="show" modal-data="#videoModel">Xem video</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info_detail"><span class="title">Chi tiết sản phẩm</span>
                        <div class="product-content">
                            <div class="content-vote page_speed_1671220251">
                                <?= $product->brief ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section-slogan">
            <div class="bs-container"><p class="desc aos-init aos-animate" data-aos="zoom-out" data-aos-delay="0">Chúng
                    tôi ở đây để làm mọi thứ tốt hơn!</p></div>
        </section>
    </main>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
    "size" => Modal::SIZE_LARGE
]) ?>
<?php Modal::end(); ?>