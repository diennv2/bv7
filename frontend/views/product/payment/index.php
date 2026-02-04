<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 04-Jul-17
 * Time: 8:48 PM
 *
 */

$config = \common\models\search\Configure::getConfig();
$this->title = "Thanh toán đơn hàng";
$nab = Yii::$app->controller->navbar;

$tonngtienvat = '';

?>
<?php $form = \yii\widgets\ActiveForm::begin() ?>
<div id="breadcrumbs">
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

        <div class="row checkout-info">
            <div class="col-xs-12" style="font-size:14px;">
                <p>
                <h2>Đơn đặt hàng</h2>
                </p>
            </div>
        </div>

    </div>
    <style>
        .cart_summary th {
            background: #524545;
            color: white;
        }
        label:not(.control-label){
            font-weight: normal;
        }
        .margin-top-20{
            margin-top: 20px;
        }
        #giaohang{
            padding: 15px;
            background: #f0f0f0;
        }
    </style>
    <div class="container payment-container">
        <div class="row">
            <div class="col-sx-12">
                <div class="order-detail-content">
                    <div class="clearfix overflow-cart">
                        <table class="table table-bordered cart_summary">
                            <thead>
                            <tr>
                                <th class="cart_product" style="width: 60px"></th>
                                <th style="width: 25%">Sản phẩm</th>

                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($giohang as $index => $item): ?>

                                <tr>
                                    <td class="cart_product">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $item->url, 'id' => $item->id]) ?>">
                                            <img style="width: 60px"
                                                 src="<?= Yii::$app->urlManager->baseUrl . \common\models\Product::getImageDefaultThumb($item->id) ?>"
                                                 alt="Product">
                                        </a>
                                    </td>
                                    <td class="item-title">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $item->url, 'id' => $item->id]) ?>">
                                            <?= $item->name ?>
                                            <span class="pro-quantity-view phienbanview"><?= $phienban[$index][$item->id] ?></span>
                                        </a>

                                    </td>
                                    <td class="item-price">

                                        <?= $config['money_suffix'] . " " . number_format($dongia[$index][$item->id], 0, '', '.') ?>

                                    </td>
                                    <td class="qty">
                                        <span class="input-sm"><?= $soluongchitiet[$index][$item->id] ?></span>
                                    </td>
                                    <td class="item-price">

                                        <?= $config['money_suffix'] . " " . number_format($dongia[$index][$item->id] * $soluongchitiet[$index][$item->id], 0, '', '.') ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>

                            <?php $phiship = 0;
                            $phishipo = 0; ?>
                            <tr>
                                <td style="text-align: right" colspan="4">
                                    <p>Tổng trước VAT</p>
                                </td>

                                <td colspan="2">
                                    <p style="font-weight: bold">
                                        <?= $config['money_suffix'] . ' ' . number_format($tongtien, 0, '', '.') ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right" colspan="4">
                                    <p>VAT</p>
                                </td>

                                <td colspan="2">
                                    <p style="font-weight: bold">
                                        <?= $config['money_suffix'] . ' ' . number_format($tongtien * $config['VAT'] / 100, 0, '', '.') ?>
                                    </p>
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align: right" colspan="4"><strong>Tổng thanh toán</strong></td>
                                <td colspan="2">
                                    <strong><?= $config['money_suffix'] . " " . number_format($tongtien + $tongtien * $config['VAT'] / 100 + $phishipo, 0, '', '.') ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5"><i>Chi phí trên chưa bao gồm phí vận chuyển</i></td>
                            </tr>
                            </tfoot>
                        </table>

                        <div class="row">
                            <div class="col-xs-12">
                                <?= $form->field($model, 'gender')->radioList(\frontend\models\BillInfo::get('gender')) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($model, 'name')->textInput(['placeholder'=>$model->attributeLabels()['name']])->label(false) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'sdt')->textInput(['placeholder'=>$model->attributeLabels()['sdt']])->label(false) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'email')->input('email',['placeholder'=>$model->attributeLabels()['email']])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?= $form->field($model, 'yeucaukhac')->textInput(['placeholder'=>$model->attributeLabels()['yeucaukhac']])->label(false) ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?= $form->field($model, 'type')->radioList(\frontend\models\BillInfo::get('type')) ?>
                            </div>
                        </div>
                        <div id="giaohang" class="<?=($model->type!="Giao hàng tận nơi ở")?"hidden":""?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        <p><i class="fa fa-star"></i> <i>Với khách hàng tại <b>Hải Phòng</b>, Chúng tôi hỗ trợ free ship thu tiền tận nhà</i></p>
                                        <p><i class="fa fa-star"></i> <i>Với các khách hàng ngoại tỉnh, chi phí trên chưa bao gồm phí vận chuyển!</i></p>
                                    </div>
                                </div>
                            </div>
                            <?php if(!isset(Yii::$app->request->cookies['karionlive'])):?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'tinhthanh')->dropDownList(\common\models\Tinhthanh::getListTinhThanhForDropdown(),['maxlength' => true, 'class'=>'form-control diachiselect','prompt'=>'Chọn'])?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'quanhuyen')->dropDownList(\common\models\Quanhuyen::getListQuanHuyenForDropdown($model->tinhthanh),['maxlength' => true, 'class'=>'form-control diachiselect','prompt'=>'Chọn']) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'phuongxa')->dropDownList(\common\models\Phuongxa::getListPhuongXaForDropdown($model->quanhuyen),['maxlength' => true, 'class'=>'form-control diachiselect','prompt'=>'Chọn']) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'address')->textInput() ?>
                                    </div>
                                </div>
                            <?php else:?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'address')->textInput() ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                            <span class="text-success alert alert-warning"><?php
                                                $cookiesKarion = Yii::$app->request->cookies['karionlive'];
                                                $cookies = \yii\helpers\Json::decode($cookiesKarion->value);
                                                echo $cookies['tinhthanh'].", ".$cookies['quanhuyen'].", ".$cookies['phuongxa'];
                                                ?></span> <a class="btn btn-warning" href="<?=Yii::$app->urlManager->createUrl(['site/reset'])?>">Thay đổi</a>
                                    </div>
                                </div>
                            <?php endif;?>

                            <div class="row margin-top-20">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'isNguoikhacnhan')->checkbox(['class'=>"onoffcheck", 'for'=>"nguoikhac"]) ?>
                                </div>
                            </div>
                            <div class="row <?=($model->isNguoikhacnhan)?"":"hidden"?>" id="nguoikhac">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'nguoinhanhang')->textInput(['placeholder'=>$model->attributeLabels()['nguoinhanhang']])->label(false)?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'nguoinhanhangsdt')->textInput(['placeholder'=>$model->attributeLabels()['nguoinhanhangsdt']])->label(false) ?>
                                </div>
                            </div>





                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'typethanhtoan')->radioList(\frontend\models\BillInfo::get('tt')) ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="muataicuahang" class="<?=($model->type=="Giao hàng tận nơi ở")?"hidden":""?>">
                            <div class="clearfix"></div>
                        </div>

                        <label><input type="checkbox" required style="margin-top:2px; float:left;"><span
                                    style="padding-left: 6px; font-size: 15px; font-weight: bold;">Tôi đồng ý với các điều khoản</span></label>
                        <br>
                        <span style="color: red">Bạn cần nhấn đồng ý với các điều khoản của chúng tôi.</span>
                        <div class="form-group payment-btn">
                            <?= \yii\helpers\Html::submitButton('Đặt hàng', ['class' => 'btn blue', 'name' => 'contact-button']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php \yii\widgets\ActiveForm::end() ?>
<script>
    $(document).ready(function () {
        $(".diachiselect").select2();
        $("#billinfo-tinhthanh").on("change",function () {
            var self=$(this);
            $.ajax({
                url:"<?=Yii::$app->urlManager->createUrl(["site/getquanhuyenbytinhthanh"])?>",
                type: 'post',
                dataType: 'json',
                data:{
                    tinhthanh: self.val()
                },
                success: function (datas) {
                    dataDrop=[];
                    $.each(datas,function(index,value){
                        dataDrop.push({
                            "id": value,
                            "text": value
                        });
                    });

                    $("#billinfo-quanhuyen").empty().select2({
                        data: dataDrop,
                    }).trigger('change');

                }
            })
        });
        $("#billinfo-quanhuyen").on("change",function () {
            var self=$(this);
            $.ajax({
                url:"<?=Yii::$app->urlManager->createUrl(["site/getphuongxabyquanhuyen"])?>",
                type: 'post',
                dataType: 'json',
                data:{
                    tinhthanh: self.val()
                },
                success: function (datas) {
                    dataDrop=[];
                    $.each(datas,function(index,value){
                        dataDrop.push({
                            "id": value,
                            "text": value
                        });
                    });

                    $("#billinfo-phuongxa").empty().select2({
                        data: dataDrop,
                    }).trigger('change');

                }
            })
        });
        $(document).on('click','.onoffcheck',function () {
            var self=$(this);
            if(self.is(":checked")){
                $("#"+self.attr('for')).removeClass('hidden');
                $("#"+self.attr('for')+" input").attr("required",'required');
            }else{
                $("#"+self.attr('for')).addClass('hidden');
                $("#"+self.attr('for')+" input").val("").removeAttr("required");
            }
        });
        $(document).on('click','input[name="BillInfo[type]"]',function () {
            if($(this).val()==="Giao hàng tận nơi ở"){
                $.each($('input[type="checkbox"]:checked'),function () {
                    var selfAttr = $(this).attr('for');
                    $("#"+selfAttr+" input").attr('required','required');
                });
                $($("#giaohang")).removeClass("hidden");
                $($("#muataicuahang")).addClass("hidden");
            }else{
                $("#giaohang input").removeAttr("required");
                $($("#muataicuahang")).removeClass("hidden");
                $($("#giaohang")).addClass("hidden");
            }
        })
    })
</script>
