<?php
/**
 * Created by PhpStorm.
 * User: Duong_IT
 * Date: 7/4/2017
 * Time: 8:24 PM
 * @var $giohang \common\models\Product[]
 * @var $soluongchitiet integer[]
 * @var $tongtien integer
 */
$nab = Yii::$app->controller->navbar;
$config = \common\models\search\Configure::getConfig();
$this->title = "Cart";
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
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
<section id="content">
    <div class="container">
        <div class="row" id="cart">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <?= count($giohang) > 0 ? "<h2 class=\"coll-title cart-title\">Cart</h2>" :
                    "<h2 class=\"coll-title cart-title\">Your cart is empty</h2>" ?>
                <?php if (count($giohang) > 0): ?>
                    <?= \yii\helpers\Html::beginForm() ?>
                    <div class="clearfix overflow-cart">
                        <table id="table-cart">
                            <thead>
                            <tr>
                                <th class="cart_product" style="width: 10%">Image</th>
                                <th style="width: 25%">Product</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Amount</th>
                                <th></th>

                            </tr>
                            </thead>
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
                                <tr>
                                    <td class="cart_product">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $item->url, 'id' => $item->id]) ?>">
                                            <img
                                                src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefaultThumb($item->id) ?>"
                                                alt="Product">
                                        </a>
                                    </td>
                                    <td class="cart_description">
                                        <p class="product-name"><a
                                                href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $item->url, 'id' => $item->id]) ?>"><?= $item->name ?></a>
                                        </p>
                                        <?php if (!empty($valueProperties)): ?>
                                            <?php foreach ($valueProperties as $valueProperty): ?>
                                                <p style="color: #333"><?= $valueProperty->properties->name ?>:
                                                    <?= $valueProperty->name_value ?></p>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="cart_avail"><?= ($item->status == 1) ? "<span class=\"label label-success\">Instock</span>" : "<span class=\"label label-danger\">Out of stock</span>" ?></td>
                                    <td class="price">
                                        <?php if (!empty($valueProperties)): ?>
                                            <?php foreach ($valueProperties as $valueProperty): ?>
                                                <?php if ($valueProperty->properties->type != 1): ?>
                                                    <span> <?= $config['money_suffix'].' '.number_format($valueProperty->default_price, 0, '', '.') ?></span>
                                                <?php else: ?>
                                                    <span><?= $config['money_suffix'].' '.number_format($item->sale, 0, '', '.')  ?></span>

                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span><?= $config['money_suffix'].' '.number_format($item->sale, 0, '', '.')  ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="qty">
                                        <input type="number" name="updates_quantity[<?= $index ?>][<?= $item->id ?>]"
                                               min="1"
                                               value="<?= $soluongchitiet[$index][$item->id] ?>">
                                    </td>
                                    <td class="price" >
                                        <?php if (!empty($valueProperties)): ?>
                                            <?php foreach ($valueProperties as $valueProperty): ?>
                                                <?php if ($valueProperty->properties->type != 1): ?>
                                                    <span><?= $config['money_suffix'].' '.number_format($valueProperty->default_price * $soluongchitiet[$index][$item->id], 0, '', '.')  ?></span>
                                                <?php else: ?>
                                                    <span><?= $config['money_suffix'].' '.number_format($item->sale * $soluongchitiet[$index][$item->id], 0, '', '.')  ?></span>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span><?= $config['money_suffix'].' '.number_format($item->sale * $soluongchitiet[$index][$item->id], 0, '', '.')  ?></span>
                                        <?php endif; ?>

                                    </td>
                                    <td class="remove">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['product/xoagiohang', 'path' => $item->url, 'id' => $index]) ?>"
                                           class="cart">
                                            <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/remove-cart.png"></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="clearfix">
                        <a class="continue-shopping" title="Continue shoping"
                           href="<?= Yii::$app->urlManager->createUrl('site/index') ?>">Continue shoping</a>
                        <button class="update-cart" type="submit">Update Cart</button>
                    </div>
                    <?= \yii\helpers\Html::endForm() ?>
                <?php endif; ?>
            </div>


            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <h2 class="coll-title cart-title">Checkout</h2>
                <?php if (count($giohang > 0) && $tongtien >=0) : ?>
                    <div class="right-cart">

                        <?php if (Yii::$app->user->identity->country == 'United Kingdom') {
                            $khuvucs = \common\models\Shipping::find()->where(['name' => Yii::$app->user->identity->country])->all();
                            $tonngtienvat = $tongtien + ($tongtien * $config['VAT'] / 100);
                            $phiship = 0;
                            if ($tonngtienvat >= 1500) {
                                $phiship = 0;
                            } else {
                                foreach ($khuvucs as $khuvuc) {
                                    /** @var $khuvuc \common\models\Shipping */
                                    if ($tonngtienvat <= $khuvuc->muctren && $tongtien >= $khuvuc->mucduoi) {
                                        $phiship = $khuvuc->shipping_fee;
                                    }
                                }
                            }

                        } else {
                            $phishipo = 0;
                            $khuvucalls = \common\models\Shipping::find()->where(['name' => 'Other'])->all();
                            if ($tongtien >= 1500) {
                                $phiship = 0;
                            } else {
                                foreach ($khuvucalls as $khuvucall) {

                                    /** @var $khuvucall \common\models\Shipping */
                                    if ($tongtien <= $khuvucall->muctren && $tongtien >= $khuvucall->mucduoi) {
                                        $phishipo = $khuvucall->shipping_fee;
                                    } else if ($tongtien > 1500) {
                                        $phishipo = 0;
                                    }
                                }
                            }
                        }
                        ?>

                        <?php if (Yii::$app->user->identity->country == 'United Kingdom'): ?>
                            <p>
                                <label>VAT:</label>
                                <label><?= $config['VAT'] ?>%</label>
                            </p>
                            <p>
                                <label>Shipping fee:</label>
                                <label>
                                    <?= $config['money_suffix'].' '.number_format($phiship, 0, '', '.')  ?>
                                </label>
                            </p>
                        <?php else: ?>
                            <p>
                                <label>Shipping fee:</label>
                                <label>
                                    <?= $config['money_suffix'].' '.number_format($phishipo, 0, '', '.')  ?>
                                </label>
                            </p>
                        <?php endif; ?>
                        <hr>
                        <h2>
                            <label>Total Amount</label>
                            <label>
                                <?= (Yii::$app->user->identity->country == 'United Kingdom') ? $config['money_suffix'].' '.number_format($tonngtienvat + $phiship, 0, '', '.')  : number_format($tongtien + $phishipo, 0, '', '.')  ?>
                            </label>
                        </h2>
                        <a class="checkout" href="<?= Yii::$app->urlManager->createUrl('product/payment') ?>">
                            Checkout
                        </a>
                    </div>
                <?php else: ?>
                    <div class="right-cart">
					 <p>You have not reached minimum order, please update your carts</p>
                        <a class="checkout" href="<?= Yii::$app->urlManager->createUrl('site/index') ?>">
                            Continue shoping
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>


