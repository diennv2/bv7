<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$a = \common\models\Nganhnghe::getListNganhNghe();
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
$config=\common\models\Configure::getConfig();
?>
<style>
    body{
        background: #f0f0f0;
    }
</style>
<link href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/components.css" rel="stylesheet">
<div class="site-signup" style="margin-bottom: 100px">
    <div class="container">
        <div class="row  wrap_cart">
            <div class="col-md-12 ">
                <div class="display-table-cell">

                </div>
                <div class="display-table-cell">
                    <h1> Đăng ký tài khoản</h1>
                    <p class="font-15"><span>Chào mừng các bạn đến với <strong><?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]"?></strong></p>
                </div>
            </div>
           <div class="col-xs-12">
               <h2 class="form-header"><span class="form-txt">Vui lòng điền thông tin đăng ký tài khoản</span></h2>
               <?php $form = ActiveForm::begin([
                   'id' => 'form-signup',
                   'layout' => 'horizontal',
                   'action' => ['signup'],
                   'options' => ['enctype'=>'multipart/form-data'],
                   'fieldConfig' => [
                       'horizontalCssClasses' => [
                           'label' => 'col-sm-4',
                           'wrapper' => 'col-sm-8',
                       ],
                   ],
               ]); ?>
               <div class="account-detail">
                   <div class="col-xs-12 col-md-12">
                       <div id="daily" class="col-xs-12 col-md-6">
                           <?= $form->field($model, 'isdaily')->dropDownList(
                               [
                                   '1' => 'Hội viên',
                                   '2' => 'Đại lý',
                               ],
                               ['prompt' => 'Chọn'])->label("Chọn loại đăng ký") ?>
                       </div>
                   </div>
                   <div class="col-xs-12 col-md-6">
                       <?= $form->field($model, 'username')->numberInput(['autofocus' => true,'placeholder'=>'Nhập số điện thoại']) ?>

                       <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Nhập mật khẩu']) ?>

                       <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder'=>'Nhập lại mật khẩu'])->label('Xác nhận mật khẩu') ?>

                       <?= $form->field($model, 'nganhnghe_id')->widget(\kartik\select2\Select2::className(), [
                           'data' => $a,
                           'language' => 'vi',
                           'options' => ['placeholder' => 'Chọn loại sản phẩm ...'],
                           'pluginOptions' => [
                               'allowClear' => true
                           ],
                       ]);
                       ?>
                       <?= $form->field($model, 'email')->textInput()->label('Nhập email') ?>
                   </div>
                   <div class="col-xs-12 col-md-6">


                       <?= $form->field($model, 'firstname')->textInput(['placeholder'=>'Nhập họ và tên'])->label("Họ và tên") ?>



                       <div id="se">
                           <?= $form->field($model, 'title')->dropDownList(
                               [
                                   '1' => 'Ms',
                                   '2' => 'Mrs',
                                   '3' => 'Mr',
                               ],
                               ['prompt' => 'Select gender ...'])->label("Danh xưng") ?>
                       </div>

                       <?= $form->field($model, 'city')->dropDownList(\common\models\Tinhthanh::getListTinhThanhForDropdown(),['class'=>'form-control diachiselect','maxlength' => true,'prompt'=>'Chọn', 'placeholder' => $model->getFirstError('city')])->label("Tỉnh/Thành") ?>

                       <?= $form->field($model, 'address')->dropDownList(\common\models\Quanhuyen::getListQuanHuyenForDropdown($model->city),['class'=>'form-control diachiselect','prompt'=>'Chọn','maxlength' => true, 'placeholder' => $model->getFirstError('Quận/Huyện')]) ?>

                       <?= $form->field($model, 'address2')->dropDownList(\common\models\Phuongxa::getListPhuongXaForDropdown($model->address),['class'=>'form-control diachiselect','prompt'=>'Chọn','maxlength' => true, 'placeholder' => $model->getFirstError('Phường/Xã')]) ?>

                       <?= $form->field($model, 'street')->textInput(['placeholder'=>'Nhập địa chỉ chi tiết'])->label("Địa chỉ chi tiết") ?>
                   </div>

                   <div class="col-xs-12 col-md-6 hidden">
                       <?= $form->field($model, 'websiteurl')->textInput()->label('Website') ?>

                       <?= $form->field($model, 'postcode')->textInput() ?>

                       <?= $form->field($model, 'country')->widget(\kartik\select2\Select2::className(), [
                           'data' => $country,

                       ]) ?>

                       <?= $form->field($model, 'company')->textInput()->label('Shop/Company<br>Name',['style'=>'padding-top:0 !important; margin-top: 0']) ?>

                   </div>
                   <div class="clearfix"></div>
               </div>

               <h2 class="form-header hidden"><span class="form-txt">Company Verification Details</span></h2>
               <div class="account-detail hidden">
                   <div class="col-xs-12 col-md-6">
                       <?= $form->field($model, 'company_registration_number')->textInput()->label('Company Registration<br>Number',['style'=>'padding-top:0 !important; margin-top: 0']) ?>

                       <?= $form->field($model, 'file1')->fileInput(['class'=>'form-control'])->label('Company Registration<br>Certificate',['style'=>'padding-top:0 !important; margin-top: 0'])->hint('<div class="row"><div class="col-xs-8" style="float: right"><div class="bg-warning">(.jpg, .jpeg, .gif, .pdf, .doc are allowed)</div></div></div>',['class'=>'col-xs-12']) ?>
                   </div>
                   <div class="col-xs-12 col-md-6">
                       <?= $form->field($model, 'vat_number')->textInput()->label('VAT Number') ?>

                       <?= $form->field($model, 'file2')->fileInput(['class'=>'form-control'])->label('VAT Document')->hint('<div class="row"><div class="col-xs-8" style="float: right"><div class="bg-warning">(.jpg, .jpeg, .gif, .pdf, .doc are allowed)</div></div></div>',['class'=>'col-xs-12']) ?>

                       <?= $form->field($model, 'file3')->fileInput(['class'=>'form-control'])->label('Supplier/Utility<br>Invoice',['style'=>'padding-top:0 !important; margin-top: 0'])->hint('<div class="row"><div class="col-xs-8" style="float: right"><div class="bg-warning">(.jpg, .jpeg, .gif, .pdf, .doc are allowed)</div></div></div>',['class'=>'col-xs-12']) ?>

                       <?= $form->field($model, 'file4')->fileInput(['class'=>'form-control'])->label('Picture/Brochure of<br>Shop',['style'=>'padding-top:0 !important; margin-top: 0'])->hint('<div class="row"><div class="col-xs-8" style="float: right"><div class="bg-warning">(.jpg, .jpeg, .gif, .pdf, .doc are allowed)</div></div></div>',['class'=>'col-xs-12']) ?>
                   </div>
                   <div class="clearfix"></div>
               </div>

               <h2 class="form-header hidden"><span class="form-txt">About Your Business</span></h2>
               <div class="account-detail hidden">
                   <div class="col-xs-12">
                       <!--                    --><?//= $form->field($model, 'brief')->textarea(['rows' => '6'])->label('About Your Business',['style'=>'text-align:left;']) ?>
                       <div class="form-group">
                           <div class="col-xs-2"> <?php echo Html::label('About Your Business','',['class'=>'form-label'])?></div>
                           <div class="col-xs-10"> <textarea name="SignupForm[brief]" id="signupform-brief" rows="6" style="width:100%; text-indent: 10px"></textarea></div>
                       </div>
                   </div>

                   <div class="col-xs-12">
                       <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                   </div>

                   <div class="clearfix"></div>
               </div>
               <div class="account-detail padding15">

                   <div class="col-xs-12">
                       <?= Html::submitButton('Đăng ký', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                   </div>

                   <div class="clearfix"></div>
               </div>



               <?php ActiveForm::end(); ?>
           </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".field-signupform-nganhnghe_id").hide();
        $(".field-signupform-email").hide();
        $(document).on("change","#signupform-isdaily",function (){
            var self = $(this);
            if(self.val()==2){
                $(".field-signupform-nganhnghe_id").fadeIn();
                $(".field-signupform-email").fadeIn();
            }else{
                $(".field-signupform-nganhnghe_id").fadeOut();
                $(".field-signupform-email").fadeOut();
            }
        })
        // $.fn.datepicker.defaults.format = "dd/mm/yyyy";
        // $.fn.datepicker.defaults.autoclose = true;

        // $(".datepicker").inputmask("d/m/y", {
        //     autoUnmask: true,
        //     "placeholder": "dd/mm/yyyy",
        //     removeMaskOnSubmit:false
        // });
        $(".diachiselect").select2();

        $("#signupform-city").on("change",function () {
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

                    $("#signupform-address").empty().select2({
                        data: dataDrop,
                    }).trigger('change');

                }
            })
        });
        $("#signupform-address").on("change",function () {
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

                    $("#signupform-address2").empty().select2({
                        data: dataDrop,
                    }).trigger('change');

                }
            })
        })


    })
</script>