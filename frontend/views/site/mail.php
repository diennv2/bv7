<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 30-Aug-17
 * Time: 4:00 PM
 */
?>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


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
<div class="site-signup">
    <div class="container">
        <div class="row  wrap_cart">
            <div class="col-md-12 ">
                <div class="display-table-cell">
                    <img src="<?=$config['contact_logo']?>" class="imgdangky">
                </div>
                <div class="display-table-cell">
                    <h1> Xác thực tài khoản</h1>
                    <p class="font-15"><span>Chào mừng các bạn đến với <strong><?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]"?></strong></p>
                </div>
                <div class="alert alert-success padding15 margin-top-bot-10">
                    <div class="container">
                        <p>Cảm ơn bạn đã đăng ký. / Thanks you for registering</p>
                        <p>Vui lòng xác thực tài khoản của bạn bằng cách click vào đường dẫn sau. <a href="<?=\yii\helpers\Url::base("http").Yii::$app->urlManager->createUrl(['site/userverify','id'=>$data->auth_key])?>">Nhấn vào đây để xác thực</a></p>
                        <p>To complete your registration, please click on this link below to verify you account <a href="<?=\yii\helpers\Url::base("http").Yii::$app->urlManager->createUrl(['site/userverify','id'=>$data->auth_key])?>">Verification link</a></p>

                        <p><i>Chú ý, đây là thư trả lời tự động, vui lòng không trả lời lại thư này!</i></p>
                        <p><i>Warning, this is an automated message - please do not reply directly to this email!</i></p>
                    </div>

                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
</div>