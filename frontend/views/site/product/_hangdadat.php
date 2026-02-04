<?php
/**
 * Created by PhpStorm.
 * User: DUONG_IT
 * Date: 9/28/2016
 * Time: 12:58 PM
 * @var $sanpham \common\models\Product
 * @var $giohang \common\models\Product[]
 * @var $soluong integer
 * @var $tongtien integer
 *
 *
 */

$config = \common\models\search\Configure::getConfig();
?>
<?php if (!empty($giohang)): ?>
    <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b><?= count($giohang) ?></b> Products
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <a aria-hidden="true" class="close-modal"><i class="fa fa-times"></i></a>
        </button>
    </div>

    <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'form-update-quantity']) ?>
    <div class="modal-body">
        <table style="width:100%;" id="cart-table">
            <thead>
            </thead>
            <tbody>
            <tr>
                <th></th>
                <th style="width: 25%">Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Amount</th>
                <th></th>
            </tr>
            <?php foreach ($giohang as $index => $item): ?>
                <?php $valueids = explode('-', $index);
                $valueProperties = [];
                if (sizeof($valueids) > 1) {
                    foreach ($valueids as $value => $valueid) {
                        if ($value > 0) {
                            $valueProperties[] = \common\models\Propertiesvalueproduct::findOne($valueid);
                        }
                    }
                }

                ?>
                <tr class="line-item original">
                    <td class="item-image">
                        <img
                            src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefaultThumb($item->id) ?>"
                            alt="Product">
                    </td>
                    <td class="item-title">
                        <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $item->url, 'id' => $item->id]) ?>">
                            <?= $item->name ?>
                        </a>
                        <?php if (!empty($valueProperties)): ?>
                            <?php foreach ($valueProperties as $valueProperty): ?>
                                <p style="color: #333"><?= $valueProperty->properties->name ?>:
                                    <span style="color: red"><?= $valueProperty->name_value ?></span></p>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td class="item-quantity">
                        <input class="form-control input-sm" type="number"
                               value="<?= $soluong[$index][$item->id] ?>" min="1"
                               name="updates_quantity[<?= $index ?>][<?= $item->id ?>]">
                    </td>
                    <td class="item-price">
                        <?php if (!empty($valueProperties)): ?>
                            <?php foreach ($valueProperties as $valueProperty): ?>
                                <?php if ($valueProperty->properties->type != 1): ?>
                                    <?= $config['money_suffix'].' '.number_format($valueProperty->default_price, 0, '', '.')   ?>
                                <?php else: ?>
                                    <?= $config['money_suffix'].' '.number_format($item->sale, 0, '', '.') . ' '  ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?= $config['money_suffix'].' '.number_format($item->sale, 0, '', '.') . ' '  ?>
                        <?php endif; ?>
                    </td>
                    <td class="item-price">
                        <?php if (!empty($valueProperties)): ?>
                            <?php foreach ($valueProperties as $valueProperty): ?>
                                <?php if ($valueProperty->properties->type != 1): ?>
                                    <?=  $config['money_suffix'].' '.number_format($valueProperty->default_price * $soluong[$index][$item->id], 0, '', '.') . ' ' ?>
                                <?php else: ?>
                                    <?= $config['money_suffix'].' '.number_format($item->sale * $soluong[$index][$item->id], 0, '', '.') . ' '  ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?=  $config['money_suffix'].' '.number_format($item->sale * $soluong[$index][$item->id], 0, '', '.') . ' '  ?>
                        <?php endif; ?>
                    </td>
                    <td class="item-delete text-center">
                        <a href="javascript:void(0)" class="deletemodal" id="<?= $index ?>">
                            <i class="fa fa-times"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col-sm-6">
                <div class="modal-note">
                    <textarea placeholder="note" id="note" name="note" rows="5"></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total-price-modal">
                    Total :
                    <span
                        class="item-total"> <?= $config['money_suffix'].' '.number_format($tongtien, 0, '', '.') . ' '  ?></span>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-lg-6">
                <div class="comeback">
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>">
                        Continue shoping
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-right">
                <div class="buttons btn-modal-cart">

                    <a href="<?=($tongtien >=500)? Yii::$app->urlManager->createUrl('product/payment'):'javascript:void(0)' ?>" class="button-default <?=($tongtien < 500)?'thongbaoupdate':''?>" id="checkout" name="checkout">
                        Checkout
                    </a>

                </div>

                <div class="buttons btn-modal-cart">
                    <button type="submit" class="button-default" id="update-cart-modal" name="">
                        Update Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php \yii\widgets\ActiveForm::end() ?>
<?php else: ?>
    <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Your cart is empty.
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <a aria-hidden="true"><i class="fa fa-times"></i></a>
        </button>
    </div>
<?php endif; ?>
