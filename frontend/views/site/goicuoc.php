<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\GoiCuocForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$nab = Yii::$app->controller->navbar;
$config = \common\models\Configure::getConfig();

$a = \common\models\Catproduct::getListCat();
\johnitvn\ajaxcrud\CrudAsset::register($this);
$this->title = 'Đăng ký gói cước';
?>
<style>
    .container#container-content {
        width: 100% !important;
        margin: 0;
        padding: 0;
        max-width: none;
    }

</style>
<script>
    $(document).ready(function () {
        $('#my-menu').addClass('hidden');
    })
</script>


<main id="main" class="main-pages">
    <section class="section-banner white_after">
        <div class="banner-page">
            <div class="bs-container">
                <div class="banner-text"><h4 class="title aos-init aos-animate" data-aos="zoom-out"
                                             data-aos-delay="1200">Đăng ký gói cước </h4>
                    <ul class="link-list aos-init aos-animate" data-aos="zoom-out" data-aos-delay="1200">
                        <ul class="link-list" vocab="https://schema.org/" typeof="BreadcrumbList">
                            <?= $nab ?>
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div>
        <section class="section-contacts">
            <div class="bs-container">
                <div class="bs-row">
                    <div class="bs-col">
                        <div class="module">
                            <div class="bs-row row-md-15">
                                <div class="bs-col md-60-15">
                                    <div class="module-form">
                                        <div class="newsletter">
                                            <div class="left_newletter backgroundwhite col-xs-12">
                                                <div class="content_desc">
                                                    <h4>Đăng ký gói cước</h4>
<!--                                                    <p>Vui lòng đừng ngần ngại để lại thông tin, chúng tôi sẽ liên hệ-->
<!--                                                        lại bạn trong thời gian sớm nhất.</p>-->
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <?php if (Yii::$app->user->isGuest): ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a data-toggle="modal"
                                                           data-target="#dangnhap"
                                                           class="Header__Icon Icon-Wrapper Icon-Wrapper--clickable btn btn-warning"
                                                           style="display: block">Vui lòng đăng nhập để đăng ký gói cước</a>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="row">
                                                    <div class="col-md-6 backgroundwhite" id="fafasfa">
                                                        <?php $form = ActiveForm::begin(); ?>
                                                        <?= $form->field($model, 'loaidangky')->dropDownList(
                                                            [
                                                                '1' => 'Gói 6 tháng',
                                                                '2' => 'Gói 12 tháng',
                                                            ],
                                                            ['prompt' => 'Chọn'])->label("Chọn loại đăng ký") ?>
                                                            <?php if (!Yii::$app->request->isAjax) { ?>
                                                                <?= \yii\helpers\Html::submitButton($model->isNewRecord ? Yii::t('app', 'Đăng ký') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                                            <?php } ?>
                                                    </div>
                                                        <?php ActiveForm::end(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--<div class="text-align-center">
            <?php /*$local = $config['local_position']*/ ?>
            <iframe src="https://www.google.com/maps/embed/v1/place?q=<? /*=urlencode($local)*/ ?>&key=AIzaSyAA-c42hhdywTFyWph-xe-yW45fi91ACTU"
                    width="100%" height="450px" frameborder="0" style="border:0;"
                    allowfullscreen=""></iframe>
        </div>-->
    </div>
    <section class="section-slogan">
        <div class="bs-container"><p style="color: orange" class="desc aos-init aos-animate" data-aos="zoom-out"
                                     data-aos-delay="0">Chúng tôi
                ở đây để làm mọi thứ tốt hơn!</p></div>
    </section>
</main>
<script>
    $(document).ready(function () {
        $(".diachiselect").select2();
        $("#lienhetuvan-city").on("change", function () {
            var self = $(this);
            $.ajax({
                url: "<?=Yii::$app->urlManager->createUrl(["site/getquanhuyenbytinhthanh"])?>",
                type: 'post',
                dataType: 'json',
                data: {
                    tinhthanh: self.val()
                },
                success: function (datas) {
                    dataDrop = [];
                    $.each(datas, function (index, value) {
                        dataDrop.push({
                            "id": value,
                            "text": value
                        });
                    });

                    $("#lienhetuvan-address").empty().select2({
                        data: dataDrop,
                    }).trigger('change');

                }
            })
        });
        $("#lienhetuvan-address").on("change", function () {
            var self = $(this);
            $.ajax({
                url: "<?=Yii::$app->urlManager->createUrl(["site/getphuongxabyquanhuyen"])?>",
                type: 'post',
                dataType: 'json',
                data: {
                    tinhthanh: self.val()
                },
                success: function (datas) {
                    dataDrop = [];
                    $.each(datas, function (index, value) {
                        dataDrop.push({
                            "id": value,
                            "text": value
                        });
                    });

                    $("#lienhetuvan-address2").empty().select2({
                        data: dataDrop,
                    }).trigger('change');

                }
            })
        });
    })
</script>

