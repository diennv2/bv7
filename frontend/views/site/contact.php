<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$config = \common\models\Configure::getConfig();
\johnitvn\ajaxcrud\CrudAsset::register($this);
$this->title = 'Liên hệ';
?>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper">
                    <div class="row no-gutters mb-5">
                        <div class="col-md-12">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Liên hệ với chúng tôi</h3>
                                <div id="form-message-warning" class="mb-4"></div>
                                <div id="form-message-success" class="mb-4">
                                </div>
                                <?php if(!empty(Yii::$app->session->getFlash('gcaptcha'))):?><script>$(document).ready(function () {
                                        $('#fafasfa #lienhetuvan-donvi').focus();
                                    })</script><?php endif;?>
                                <div class="col-md-6 backgroundwhite" id="fafasfa">
                                    <?php $form = ActiveForm::begin(); ?>
                                    <?php Yii::$app->language='vi-VN';$model->donvi="Khách Hàng";?>
                                    <div class="hidden">
                                        <?= $form->field($model, 'donvi')->textInput(['rows' => 6,'placeholder'=>$model->attributeLabels()["donvi"]])->label($model->attributeLabels()["donvi"],['style'=>"float:left"]) ?>
                                    </div>
                                    <?= $form->field($model, 'hoten')->textInput(['rows' => 6,'placeholder'=>$model->attributeLabels()["hoten"]])->label($model->attributeLabels()["hoten"],['style'=>"float:left"]) ?>

                                    <?= $form->field($model, 'dienthoai')->numberInput(['maxlength' => true,'placeholder'=>$model->attributeLabels()["dienthoai"]])->label($model->attributeLabels()["dienthoai"],['style'=>"float:left"]) ?>
                                    <?= $form->field($model, 'email')->textInput(['type'=>'email','maxlength' => true,'placeholder'=>$model->attributeLabels()["email"]])->label($model->attributeLabels()["email"],['style'=>"float:left"]) ?>

                                    <?= $form->field($model, 'noidung')->textInput(['rows' => 6,'placeholder'=>$model->attributeLabels()["noidung"]])->label($model->attributeLabels()["noidung"],['style'=>"float:left"]) ?>

                                    <?php if (!Yii::$app->request->isAjax){ ?>
                                        <div class="form-group">
                                            <div <?php if(!empty(Yii::$app->session->getFlash('gcaptcha'))):?><?php endif;?>>
                                                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                                <div class="g-recaptcha" data-sitekey="6LdzaIgfAAAAAFc7EDF6pjMsrVqE3Xpu3u8_vPNa"></div>
                                                <div style="padding: 15px;color: red ;text-shadow: 2px 2px 15px red;margin-bottom: 15px">
                                                    <?=Yii::$app->session->getFlash('gcaptcha');?>
                                                </div>
                                            </div>

                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <?php if (!Yii::$app->request->isAjax){ ?>
                                        <?= \yii\helpers\Html::submitButton($model->isNewRecord ? Yii::t('app', 'Gửi') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                    <?php } ?>



                                    <?php ActiveForm::end(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-map-marker"></span>
                                </div>
                                <div class="text">
                                    <p><span>Địa chỉ:</span> <?php echo $config['contact_address'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-phone"></span>
                                </div>
                                <div class="text">
                                    <p><span>Số điện thoại:</span> <a href="tel:/<?= $config['contact_phone'] ?>"><?= $config['contact_phone'] ?></a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-paper-plane"></span>
                                </div>
                                <div class="text">
                                    <p><span>Email:</span> <a href="mailto:<?= $config['contact_email'] ?>"><?= $config['contact_email'] ?></a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-globe"></span>
                                </div>
                                <div class="text">
                                    <p><span>Website</span> <a href="<?= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" ?>">
                                            <?= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" ?></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>