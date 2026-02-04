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
<link rel="stylesheet" href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/cart.css">
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
                    "<h2 class=\"coll-title cart-title\">Giỏ hàng rỗng</h2>" ?>
                <?php if (count($giohang) > 0): ?>
                    <div class="clearfix overflow-cart">
                        <table id="table-cart">
                            <thead>
                            <tr>
                                <th class="cart_product" style="width: 10%"></th>
                                <th style="width: 25%">Sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($giohang as $index => $item): ?>

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
                                                    href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $item->url, 'id' => $item->id]) ?>"><?= $item->name ?>

                                                <span class="pro-quantity-view phienbanview"><?= $phienban[$index][$item->id] ?></span>

                                            </a>
                                        </p>

                                    </td>
                                    <td class="cart_avail"><?= ($item->status == 0) ? "<span class=\"label label-success\">Instock</span>" : "<span class=\"label label-danger\">Out of stock</span>" ?></td>
                                    <td class="price">

                                        <span><?= $config['money_suffix'] . ' ' . number_format($dongia[$index][$item->id], 0, '', '.') ?></span>

                                    </td>
                                    <td class="qty" style="min-width: 100px">
                                        <input type="number" class="form-control qtychange" access-key="<?= $index ?>"
                                               min="1" access-item="<?= $item->id ?>"
                                               value="<?= $soluongchitiet[$index][$item->id] ?>">
                                    </td>
                                    <td class="price">

                                        <span><?= $config['money_suffix'] . ' ' . number_format($dongia[$index][$item->id] * $soluongchitiet[$index][$item->id], 0, '', '.') ?></span>


                                    </td>
                                    <td class="remove">
                                        <a href="javascript:void(0)"
                                           access-key="<?= $index ?>"
                                           access-item="<?= $item->id ?>"
                                           class="cart removecarts">
                                            <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/remove-cart.png"></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="clearfix">
                        <a class="continue-shopping" title="Continue shoping"
                           href="<?= Yii::$app->urlManager->createUrl('site/index') ?>">Tiếp tục mua sắm</a>

                    </div>

                <?php endif; ?>
            </div>


            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <h2 class="coll-title cart-title">Đặt hàng</h2>
                <?php if (count($giohang) == 0 && $tongtien == 0) : ?>
                    <div class="right-cart">

                        <?php
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

                        ?>


                        <p>
                            <label>Phí vận chuyển:</label>
                            <label>
                                Giá trên chưa bao gồm phí ship
                            </label>
                        </p>

                        <hr>
                        <h2>
                            <label>Tổng tiền</label>
                            <label>
                                <?= number_format($tongtien + $phishipo, 0, '', '.') ?>
                            </label>
                        </h2>
                        <a class="checkout" href="<?= Yii::$app->urlManager->createUrl('product/payment') ?>">
                            Đặt hàng
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>


<script>
    $(document).ready(function () {
        $(document).on('change', '.qtychange', function () {
            var self = $(this);
            $.ajax({
                url: "<?=Yii::$app->urlManager->createUrl(['product/updateqty'])?>",
                type: "post",
                dataType: 'json',
                data: {
                    val: self.val(),
                    datakey: self.attr("access-key"),
                    itemid: self.attr("access-item"),
                },
                complete: function () {
                    location.reload();
                }
            })
        });
        $(document).on('click', '.removecarts', function () {
            var self = $(this);
            Swal.fire({
                title: 'Bạn chắc chắn muốn xóa chứ?!',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?=Yii::$app->urlManager->createUrl(['product/removecart'])?>",
                        type: "post",
                        dataType: 'json',
                        data: {
                            datakey: self.attr("access-key"),
                            itemid: self.attr("access-item"),
                        },
                        complete: function () {
                            Swal.fire(
                                'Xóa!',
                                'Xóa thành công.',
                                'success'
                            ).then(() => {
                                location.reload();
                            })
                        }
                    })

                }
            })

        })
    })
</script>