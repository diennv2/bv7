<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Billmobile */
$config=\common\models\Configure::getConfig();
?>

<style>
    table{
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }
    table th, table td{
        border: 1px solid #ddd;
        text-align: left;
    }
</style>
<div class="row">
    <div class="col-xs-4">
        <img class="imglogo" src="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . Yii::$app->urlManager->baseUrl.$config['contact_logo']?>">
    </div>
    <div class="col-xs-8">
        <h2>Thông tin đơn đặt hàng mới!</h2>
        Kiểm tra hệ thống để xử lý
    </div>
</div>
<div class="billmobile-view">
    <div class="row">
        <div class="table1">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'ngaylap',
                    'gioitinh',
                    'ten',
                    'sdt',
                    'yeucaukhac:ntext',
                ],
            ]) ?>
        </div>
        <div class="col-md-6 table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <th>STT</th>
                    <th></th>
                    <th>Sản phẩm khách hàng đặt</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
                <?php $product = \yii\helpers\Json::decode($model->product);
                $dem = 1;
                foreach ($product['giohang'] as $index => $item):
                    ?>
                    <tr>
                        <td><?= $dem ?></td>
                        <td>
                            <img style="width: 50px"
                                 src="<?php
                                 $value=\common\models\Product::findOne(['id'=>$item['id']]);
                                 if (!empty($value->anhsanphams)) {
                                     $anhdefault = \common\models\Anhsanpham::getAnhDefault($item['id']);

                                     /** @var \common\models\Anhsanpham $anhdefault */
                                     if (!is_null($anhdefault)) {
                                         echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . $anhdefault->thumb;
                                     } else {
                                         echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . "/images/noimg.jpg";
                                     }
                                 } else {
                                     echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . "/images/noimg.jpg";
                                 }
                                 ?>"
                                 alt="<?= $item['name'] ?>">
                        </td>
                        <td>
                            <a target="_blank" style="font-weight: bold" href="<?= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]".Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $item['url'], 'id' => $item['id']])?>"><?= $item['name'] ?></a><br>
                            <span class="text-danger"><?= $product['phienban'][$index][$item['id']] ?></td></span>
                        <td>
                            <?= $product['soluongchitiet'][$index][$item['id']] ?></td>
                        <td>
                            <?= number_format($product['dongia'][$index][$item['id']],0,'','.')." ".$config['money_suffix'] ?></td>
                        <td>
                            <?= number_format($product['dongia'][$index][$item['id']]*$product['soluongchitiet'][$index][$item['id']],0,'','.')." ".$config['money_suffix'] ?><br>
                        </td>
                    </tr>
                    <?php $dem++; endforeach; ?>
                <tr><td style="text-align: right;font-weight: bold" colspan="5">Tổng:</td><td style="text-align: right;font-weight: bold"><?= number_format($product['tongtien'],0,'','.')." ".$config['money_suffix'] ?><br></td></tr>
                <tr><td style="text-align: right;font-weight: bold" colspan="5">VAT:</td><td style="text-align: right;font-weight: bold"><?= number_format($model->vat,0,'','.')." ".$config['money_suffix'] ?></td></tr>
                <tr><td style="text-align: right;font-weight: bold" colspan="5">Tổng sau VAT:</td><td style="text-align: right;font-weight: bold"><?= number_format($model->tongsauvat,0,'','.')." ".$config['money_suffix'] ?></td></tr>
            </table>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
