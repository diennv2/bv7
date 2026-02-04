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


$this->title = 'Đăng ký gói cước';
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
<div class="site-signup">
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
                    <p>Bạn vui lòng chuyển khoản với nội
                        dung chính xác "<strong>TECHBER <?= Yii::$app->user->id ?>U</strong>" để việc
                        xác minh
                        được nhanh chóng và thuận tiện nhất!</p>
                    <p>Tài khoản nhận thanh toán:</p>
                    <div class="row" style="padding-top: 15px">
                        <?php foreach (\common\models\Thongtinchuyenkhoan::find()->all() as $index => $value): ?>
                            <div class="col-xs-4">
                                <div class="well">
                                    <address>
                                        <strong>Chủ tài khoản: <?= $value->chutaikhoan ?></strong><br>
                                        <abbr title="bank">Ngân hàng:</abbr> <?= $value->nganhang ?><br>
                                        <abbr title="stk">Số tài khoản:</abbr> <?= $value->sotaikhoan ?><br>
                                    </address>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
</div>