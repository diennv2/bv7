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


$this->title = 'Gói cước hết hạn';
$this->params['breadcrumbs'][] = $this->title;
$config=\common\models\Configure::getConfig();
\johnitvn\ajaxcrud\CrudAsset::register($this);
?>
<style>
    body{
        background: #f0f0f0;
    }
</style>
<link href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/components.css" rel="stylesheet">
<div class="site-signup" style="margin-bottom: 80px">
    <div class="container">
        <div class="row  wrap_cart">
            <div class="col-md-12 ">
                <div class="display-table-cell">
                    <img src="<?=$config['contact_logo']?>" class="imgdangky">
                </div>
                <div class="display-table-cell">
                    <h1> Đăng ký gói cước</h1>
                    <p class="font-15"><span>Chào mừng các bạn đến với <strong><?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]"?></strong></p>
                </div>
                <div class="alert alert-success padding15 margin-top-bot-10">
                    <p>Gói cước của bạn đã hết hạn.</p>
                    <p>Để quay lại website Techber  <a href="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]"?>">vào đây</a></p>
                    <p>Để gia hạn gói cước chọn theo đường dẫn này  <a href="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]"."/site/goicuoc.html"?>">vào đây</a></p>

                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
</div>
