<?php
/**
 * Created by PhpStorm.
 * User: DUONG_IT
 * Date: 9/28/2016
 * Time: 3:26 PM
 * @var  $tongsoluongdadat integer
 * @var $giohang \common\models\Product[]
 * @var $tongtien integer
 * @var $soluong integer
 */
$config = \common\models\Configure::getConfig();
?>
<?php
$soluongs = 0;
if (isset(Yii::$app->session['soluong'])) {
    foreach (Yii::$app->session['soluong'] as $soluongvalue) {
        foreach ($soluongvalue as $soluongvalue2) {
            $soluongs += $soluongvalue2;
        }
    }
} ?>
    <div class="Cart__ShippingNotice Text--subdued">
        <div class="Drawer__Container"><p>Cập nhật đơn hàng của bạn (<?= $soluongs ?> sản phẩm)</p></div>
    </div>
<?php if ($giohang = Yii::$app->session->get('giohang')): ?>
    <div class="Cart__ItemList">
        <div class="CartItemWrapper">


            <?php $soluong = Yii::$app->session->get('soluong') ?>
            <?php $dongia = Yii::$app->session->get('dongia') ?>
            <?php $phienban = Yii::$app->session->get('phienban') ?>
            <?php $tongtien = Yii::$app->session->get('tongtien'); ?>

            <?php foreach ($giohang as $index => $item): ?>
                <div class="CartItem" style="padding: 0 10px">
                    <div class="CartItem__ImageWrapper AspectRatio">
                        <div class="AspectRatio" style="--aspect-ratio: 1.175055928411633">
                            <img class="CartItem__Image"
                                 src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefaultThumb($item->id) ?>"
                                 alt="">
                        </div>
                    </div>

                    <div class="CartItem__Info">
                        <h2 class="CartItem__Title Heading"  style="text-align: right; font-size: 14px">
                            <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $item->url, 'id' => $item->id]) ?>"><b><?= $item->name ?></b></a>
                        </h2>

                        <div style="text-align: right" class="CartItem__Meta Heading Text--subdued"><p class="CartItem__Variant">
                                <?= $phienban[$index][$item->id] ?></p>
                            <div style="text-align: right" class="CartItem__PriceList"><span class="CartItem__Price Price"
                                                                                             data-money-convertible="">x <?= $soluong[$index][$item->id] ?></span>
                            </div>
                            <div style="text-align: right; font-weight: bold" class="CartItem__PriceList"><span class="CartItem__Price Price"
                                                                                                                data-money-convertible=""><?= $config['money_suffix'] . " " . number_format($dongia[$index][$item->id], 0, '', '.') ?></span>
                            </div>
                            <div style="text-align: right; font-weight: bold; border-top: 1px solid #ff5f5a; padding-top: 10px" class="CartItem__PriceList"><span class="CartItem__Price Price"
                                                                                                                                                                  data-money-convertible=""><?= $config['money_suffix'] . " " . number_format($dongia[$index][$item->id]*$soluong[$index][$item->id], 0, '', '.') ?></span>
                            </div>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>
            <div style="padding: 10px">
                <table class="table-total table">
                    <tbody>
                    <tr>
                        <td align="left">Tổng:</td>
                        <td align="right"
                            id="total-view-cart"><b><?= $config['money_suffix'] . " " . number_format($tongtien, 0, '', '.') ?></b></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else: ?>
    <p class="Cart__Empty Heading u-h5">Your cart is empty</p>
<?php endif; ?>


<?php if ($soluongs > 0): ?>
    <div class="Drawer__Footer" data-drawer-animated-bottom="">

        <p class="Cart__Taxes Text--subdued">Kiểm tra đơn hàng và thanh toán</p>
        <a href="<?= Yii::$app->urlManager->createUrl('product/payment') ?>" name="checkout"
           class="Cart__Checkout Button Button--primary Button--full">
            <span>Thanh toán</span>
            <span class="Button__SeparatorDot"></span>
            <span data-money-convertible=""><?= $config['money_suffix'] . " " . number_format($tongtien, 0, '', '.') ?></span>
        </a>

    </div>
<?php endif; ?>