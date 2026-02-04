<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 04-Jul-17
 * Time: 8:48 PM
 *
 */

$config = \common\models\search\Configure::getConfig();
$this->title = "Checkout";
$nab = Yii::$app->controller->navbar;
$tonngtienvat = '';
?>
    <link rel="stylesheet" href="<?= Yii::$app->urlManager->baseUrl ?>/css/components.css">
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


    <div class="bg-white container">
        <div class="container payment-container">
            <?php $form = \yii\widgets\ActiveForm::begin() ?>
            <div class="row checkout-info">
                <div class="col-xs-12" style="font-size:14px;">
                    <p>
						<h2>Delivery Rates</h2>
					</p>
                    <p style="text-align:justify">&nbsp;</p>

                    <p style="text-align:justify"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">Delivery within the UK</span></strong>
                    </p>

                    <p style="text-align:justify"><span style="font-family:&quot;Times New Roman&quot;,serif">Delivery within the UK mainland is FREE on orders over VNĐ1500 (exclude VAT). Orders under this threshold subject to a delivery charge of VNĐ20. We do not accept orders under VNĐ500 (exclude VAT).</span>
                    </p>

                    <p style="text-align:justify">&nbsp;</p>

                    <p style="text-align:justify"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">Delivery to non-mainland UK &amp; Northern Ireland</span></strong>
                    </p>

                    <p style="text-align:justify"><span style="font-family:&quot;Times New Roman&quot;,serif">Delivery is free for orders over VNĐ2000 (exclude VAT). Order under this threshold subject to a delivery charge of VNĐ50. We do not accept orders under VNĐ1000 (exclude VAT) for non-mainland UK delivery addresses.</span>
                    </p>

                    <p style="text-align:justify">&nbsp;</p>

                    <p style="text-align:justify"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">Delivery Worldwide</span></strong>
                    </p>

                    <p style="text-align:justify"><span style="font-family:&quot;Times New Roman&quot;,serif">We are currently not accepting orders from customer worldwide.</span>
                    </p>
                </div>
            </div>

        </div>
        <div class="container payment-container">
            <div class="row">
                <div class="col-sx-12">
                    <div class="order-detail-content">
                        <div class="clearfix  table-responsive overflow-cart">
                            <table class="table table-bordered cart_summary">
                                <thead>
                                <tr>
                                    <th class="cart_product" style="width: 10%">Image</th>
                                    <th style="width: 25%">Product</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>SUBTOTAL (EXCL. VAT)</th>
                                </tr>
                                </thead>
                                <tbody>
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
                                    <tr>
                                        <td class="cart_product">
                                            <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $item->url, 'id' => $item->id]) ?>">
                                                <img
                                                    src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefault($item->id) ?>"
                                                    alt="Product">
                                            </a>
                                        </td>
                                        <td class="item-title">
                                            <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $item->url, 'id' => $item->id]) ?>">
                                                <?= $item->name ?>
                                            </a>
                                            <?php if (!empty($valueProperties)): ?>
                                                <?php foreach ($valueProperties as $valueProperty): ?>
                                                    <p style="color: #333"><?= $valueProperty->properties->name ?>:
                                                        <span
                                                            style="color: red"><?= $valueProperty->name_value ?></span>
                                                    </p>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </td>

                                        <td class="cart_avail"><?= ($item->status == 1) ? "<span class=\"label label-success\">Instock</span>" : "<span class=\"label label-danger\">Out of stock</span>" ?></td>
                                        <td class="item-price">
                                            <?php if (!empty($valueProperties)): ?>
                                                <?php foreach ($valueProperties as $valueProperty): ?>
                                                    <?php if ($valueProperty->properties->type != 1): ?>
                                                        <?= $config['money_suffix'] . " " . number_format($valueProperty->default_price, 0, '', '.') ?>
                                                    <?php else: ?>
                                                        <?= $config['money_suffix'] . " " . number_format($item->sale, 0, '', '.') ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <?= $config['money_suffix'] . " " . number_format($item->sale, 0, '', '.') ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="qty">
                                            <span class="input-sm"><?= $soluongchitiet[$index][$item->id] ?></span>
                                        </td>
                                        <td class="item-price">
                                            <?php if (!empty($valueProperties)): ?>
                                                <?php foreach ($valueProperties as $valueProperty): ?>
                                                    <?php if ($valueProperty->properties->type != 1): ?>
                                                        <?= $config['money_suffix'] . " " . number_format($valueProperty->default_price * $soluongchitiet[$index][$item->id], 0, ',', '.') ?>
                                                    <?php else: ?>
                                                        <?= $config['money_suffix'] . " " . number_format($item->sale * $soluongchitiet[$index][$item->id], 0, ',', '.') ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <?= $config['money_suffix'] . " " . number_format($item->sale * $soluongchitiet[$index][$item->id], 0, '', '.') ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                                <tfoot>

                                <?php if (Yii::$app->user->identity->country == 'United Kingdom') {
                                    $tienvat = 0;
                                    $khuvucs = \common\models\Shipping::find()->where(['name' => Yii::$app->user->identity->country])->all();
                                    $tonngtienvat = $tongtien + ($tongtien * $config['VAT'] / 100);
                                    $tienvat = $tongtien * $config['VAT'] / 100;
                                    $phiship = 0;
                                    foreach ($khuvucs as $khuvuc) {
                                        /** @var $khuvuc \common\models\Shipping */
                                        if ($tonngtienvat <= $khuvuc->muctren && $tongtien >= $khuvuc->mucduoi) {
                                            $phiship = $khuvuc->shipping_fee;
                                            break;
                                        }
                                    }
                                } else {
                                    $phishipo = 0;
                                    $tonngtienvat=$tongtien;
                                    $khuvucalls = \common\models\Shipping::find()->where(['name' => 'Other'])->all();
                                    foreach ($khuvucalls as $khuvucall) {

                                        /** @var $khuvucall \common\models\Shipping */
                                        if ($tongtien <= $khuvucall->muctren && $tongtien >= $khuvucall->mucduoi) {
                                            $phishipo = $khuvucall->shipping_fee;
                                            break;
                                        }
                                    }
                                }
                                ?>
                                <?php if (Yii::$app->user->identity->country == 'United Kingdom'):?>
                                <tr>
                                    <td colspan="3" rowspan="1"></td>
                                    <td colspan="2">
                                        <p>VAT</p>
                                    </td>
                                    <td colspan="2">
                                        <p style="font-weight: bold"><?= $config['money_suffix'].($tongtien * $config['VAT'] / 100)?> </p>
                                    </td>
                                </tr>
                                <?php endif;?>
                                <?php if ($tonngtienvat != ""): ?>
                                    <tr>
                                        <td colspan="3" rowspan="1"></td>
                                        <td colspan="2">
                                            <p>SUBTOTAL (INCL. VAT)</p>
                                        </td>
                                        <td colspan="2">
                                            <p style="font-weight: bold">
                                                <?= $config['money_suffix'] . ' ' . number_format($tonngtienvat, 0, '', '.') ?>
                                            </p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td colspan="3" rowspan="1"></td>
                                    <td colspan="2">
                                        <p>Delivery Charge</p>
                                    </td>
                                    <td colspan="2">
                                        <p style="font-weight: bold">
                                            <?= (Yii::$app->user->identity->country == 'United Kingdom') ? ($config['money_suffix'] . " " . number_format($phiship, 0, '', '.')) : $config['money_suffix'] . " " . number_format($phishipo, 0, '', '.') ?>
                                        </p>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" rowspan="1"></td>
                                    <td colspan="2"><strong>Total amount</strong></td>
                                    <td colspan="2">
                                        <strong><?= (Yii::$app->user->identity->country == 'United Kingdom') ? $config['money_suffix'] . " " . number_format($tonngtienvat + $phiship, 0, '', '.') : $config['money_suffix'] . " " . number_format($tongtien + $phishipo, 0, '', '.') ?></strong>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            <?= $form->field($model, 'user_id')->textInput(['class' => 'hidden', 'value' => Yii::$app->user->identity->getId()])->label(false) ?>
                            <?= $form->field($model, 'name')->textInput(['class' => 'hidden', 'value' => Yii::$app->user->identity->company])->label(false) ?>
                            <?= $form->field($model, 'shipping_fee')->textInput(['class' => 'hidden', 'value' => (Yii::$app->user->identity->country == 'United Kingdom') ? $phiship : $phishipo])->label(false) ?>
                            <?= $form->field($model, 'vat')->textInput(['class' => 'hidden', 'value' => (Yii::$app->user->identity->country == 'United Kingdom') ? $config['VAT'] : ""])->label(false) ?>
                            <?= $form->field($model, 'address')->dropDownList($address)->label('Delivery Address');
                            ?>
                            <div class="row">
                                <div class="col-md-3 col-xs-12">
                                    <p>Payment Method</p>
                                    <img src="<?=Yii::$app->urlManager->baseUrl?>/images/222.png">
                                </div>
                                <div class="col-md-9 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Cardholder Name</label>
                                        <?=\yii\helpers\Html::textInput('payment[cardname]','',['class'=>'form-control','required'=>true])?>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Card Number</label>
                                        <?=\yii\helpers\Html::textInput('payment[cardnumber]','',['class'=>'form-control','required'=>true])?>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Expiry Date</label>
                                        <?=\yii\helpers\Html::textInput('payment[expire]','',['class'=>'form-control','id'=>'expiry','required'=>true])?>
                                        <script>
                                            $(document).ready(function () {
                                                $("#expiry").mask("99/99",{placeholder:"MM/YY"});
                                            })
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">CVV/CVV2</label>
                                        <?=\yii\helpers\Html::passwordInput('payment[CVV]','',['class'=>'form-control','required'=>true])?>
                                    </div>
                                </div>
                            </div>
                            <input type="checkbox" required style="margin-top:2px; float:left;"><span
                                style="padding-left: 6px; font-size: 15px; font-weight: bold;">I agree to the Terms and Conditions of the website</span>
                            <br>
                            <span style="color: red">You need to agree to the Terms and Conditions before placing your order.</span>
                            <div class="form-group payment-btn">
                                <?= \yii\helpers\Html::submitButton('Checkout', ['class' => 'btn blue', 'name' => 'contact-button']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php \yii\widgets\ActiveForm::end() ?>