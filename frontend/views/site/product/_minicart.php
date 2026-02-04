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
    <a class="cart-link" href="<?= Yii::$app->urlManager->createUrl(['product/giohang']) ?>">
                                        <span>
                                            <span class="cart-number"><?= count($giohang)?></span>
                                            <span class="divider">/</span>
                                            <span class="cart-sum-price">Cart</span>
                                        </span>
    </a>
<script>
    jQuery('.cart-link').hover(function() {
        jQuery('.cart-view').slideDown(200);
    }, function() {
        setTimeout(function() {
            if (viewout) jQuery('.cart-view').slideUp(200);
        }, 500)
    });
    jQuery('.search-cart').hover(function() {
        viewout = false;
    }, function() {
        viewout = true;
        jQuery('.cart-view').slideUp(100);
    })
</script>
    <div class="cart-view clearfix">

            <table id="cart-view">
                <tbody>
                <?php foreach ($giohang as $index => $item): ?>
                <?php $valueids = explode('-', $index);
                $valueProperties = [];
                foreach ($valueids as $value => $valueid) {
                    if ($value > 0) {
                        $valueProperties[] = \common\models\Propertiesvalueproduct::findOne($valueid);
                    }
                }
                ?>
                <tr class="item_2">
                    <td class="img"><a
                            href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $item->url, 'id' => $item->id]) ?>"
                            title="<?= $item->name ?>"><img
                                src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefault($item->id) ?>"
                                alt="<?= $item->name ?>"></a>
                    </td>

                    <td>
                        <a class="pro-title-view"
                           href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $item->url, 'id' => $item->id]) ?>"
                           title="/products/kem-tao-sang-kma-perfect"><?= $item->name ?></a>
                        <span
                            class="pro-quantity-view">Số lượng: <?= $soluong[$index][$item->id] ?></span>
                        <?php if (!empty($valueProperties)): ?>
                            <?php foreach ($valueProperties as $valueProperty): ?>
                                <span class="pro-quantity-view"
                                      style="color: #333"><?= $valueProperty->properties->name ?>
                                    :
                                    <?= $valueProperty->name_value ?>
                                                                </span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (!empty($valueProperties)): ?>
                            <?php foreach ($valueProperties as $valueProperty): ?>
                                <?php if ($valueProperty->properties->type != 1): ?>
                                    <span
                                        class="pro-price-view">Giá: <?= $config['money_suffix']." ".number_format($valueProperty->default_price * $soluong[$index][$item->id], 0, '', '.')  ?></span>
                                <?php else: ?>
                                    <span
                                        class="pro-price-view">Giá: <?= $config['money_suffix']." ".number_format($item->sale * $soluong[$index][$item->id], 0, '', '.')  ?></span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <span class="line"></span>
        <table class="table-total">
            <tbody>
            <tr>
                <td align="left">Total Amount:</td>
                <td align="right"
                    id="total-view-cart"><?= $config['money_suffix']." ".number_format($tongtien, 0, '', '.')?></td>
            </tr>
            <tr>
                <td>
                    <a href="<?= Yii::$app->urlManager->createUrl(['product/giohang']) ?>"
                       class="linktocart">View Cart</a></td>
                <td>
                    <a href="<?= Yii::$app->urlManager->createUrl('product/payment') ?>"
                       class="linktocheckout">Checkout</a></td>
            </tr>
            </tbody>
        </table>
    </div>
