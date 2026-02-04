<?php

/* @var $this yii\web\View */
/* @var $model common\models\Billmobile */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
CrudAsset::register($this);
$this->title = 'Bill';
$config=\common\models\Configure::getConfig();
$bill = \common\models\Billmobile::findOne($id);/** @var \common\models\Billmobile $bill */


if(!is_null($bill)):
    $congno = 0;
    ?>
    <script src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/js/jquery-1.11.3.min.js"></script>
    <link href="/admin/themes/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <div id="printzone" style="page-break-after: always">
        <style>
            *{
                font-size: 14px;
            }
            .table1>tbody>tr>td{
                border: none!important;
            }
            .dongia td:not(.bangchu),.dongia th{
                border: none!important;
                line-height: 0.2!important;
                font-size: 12px;
            }
            .table-bordered>tbody>tr>th{
                border-bottom: 2px solid black!important;
            }
        </style>
        <div class="col-md-12 table-responsive" style="text-align: center">
            <h2 style="font-weight: 400;text-transform: uppercase"><?=$config['company_name']?></h2>
            <p><?=$config['company_address']?></p>
            <p><?=$config['company_phone']?></p>
            <table class="table table1" style="text-align: left">
                <tr><td style="font-weight: bold">Khách hàng: <span style="font-weight: normal"><?=$bill->ten?></span></td></tr>
                <tr><td colspan="2" style="font-weight: bold">Số điện thoại: <span style="font-weight: normal"><?=$bill->sdt?></span></td></tr>
                <tr><td colspan="2" style="font-weight: bold">Địa chỉ: <span style="font-weight: normal"><?=$bill->address?>,<?=$bill->tinhthanh?>,<?=$bill->quanhuyen?>,<?=$bill->phuongxa?></span></td></tr>
            </table>
            <p style="font-weight: bold;text-transform: uppercase">Hóa đơn thanh toán</p>
            <table class="table table-striped table-hover table-bordered">
                <tr><td colspan="3">Ngày xuất hóa đơn: <?=func::getTimeNow()?></td><td colspan="3">Người xuất hóa đơn: <?=Yii::$app->user->identity->username?></td></tr>
                <tr>
                    <th>STT</th>
                    <th></th>
                    <th>Sản phẩm khách hàng đặt</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
                <?php
                $product  = \yii\helpers\Json::decode($bill->product);
                $tong = 0;

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
                                         echo Yii::$app->urlManagerFrontend->baseUrl . $anhdefault->thumb;
                                     } else {
                                         echo Yii::$app->urlManagerFrontend->baseUrl . "/images/noimg.jpg";
                                     }
                                 } else {
                                     echo Yii::$app->urlManagerFrontend->baseUrl . "/images/noimg.jpg";
                                 }
                                 ?>"
                                 alt="<?= $item['name'] ?>">
                        </td>
                        <td>
                            <a target="_blank" style="font-weight: bold" href="<?= Yii::$app->urlManagerFrontend->createUrl(['product/detailproduct', 'path' => $item['url'], 'id' => $item['id']])?>"><?= $item['name'] ?></a><br>
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
                <tr><td style="text-align: right;font-weight: bold" colspan="4">Tổng:</td><td style="text-align: right;font-weight: bold"><?= number_format($product['tongtien'],0,'','.')." ".$config['money_suffix'] ?><br></td></tr>
                <tr><td style="text-align: right;font-weight: bold" colspan="4">VAT:</td><td style="text-align: right;font-weight: bold"><?= number_format($bill->vat,0,'','.')." ".$config['money_suffix'] ?></td></tr>
                <tr><td style="text-align: right;font-weight: bold" colspan="4">Tổng sau VAT:</td><td style="text-align: right;font-weight: bold"><?= number_format($bill->tongsauvat,0,'','.')." ".$config['money_suffix'] ?></td></tr>

            </table>
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <th>Danh sách quà</th>
                    <td>
                        <?php $listsach = \common\models\Listnhanqua::findAll(['billid'=>$bill->id]);
                        foreach($listsach as $value):
                            $product = \common\models\Product::findOne($value->productid);
                            ?>
                            <p><?=(is_null($product)?"Không tìm thấy sách hoặc đã bị xóa":$product->name)?></p>
                            <img style="width: 60px" src="<?=$product->getDefaultImage()?>">
                        <?php endforeach;?>
                    </td>
                </tr>
            </table>
            <p><?=$config['invoice_thank']?></p>
            <p><?=$config['invoice_dieukhoan']?></p>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            window.print();
        })
    </script>
<?php else:?>
    <script>

    </script>
<?php endif;?>
