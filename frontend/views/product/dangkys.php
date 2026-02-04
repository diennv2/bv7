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


$this->title = 'Sản phẩm chỉ dành cho thành viên';
$this->params['breadcrumbs'][] = $this->title;
$config = \common\models\Configure::getConfig();
\johnitvn\ajaxcrud\CrudAsset::register($this);
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$model = \common\models\Billmobile::findOne(Yii::$app->session["iddathang"]);

?>
<style>
    body {
        background: #f0f0f0;
    }

    p {
        margin-bottom: 10px
    }

    .wrap_cart {
        margin: auto;
        margin-top: 15px;
    }
</style>
<link href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/components.css" rel="stylesheet">
<div class="site-signup" style="margin-buttom:100px;">
    <div class="container">
        <div class="row  wrap_cart">
            <div class="col-md-12 ">
                <div class="display-table-cell">

                </div>
                <div class="display-table-cell">
                    <h1 class="text-success"><i class="fa fa-info-circle"></i> Sản phẩm chỉ dành cho thành viên</h1>
                    <p class="font-15">
                        <span>Chào mừng các bạn đến với <strong><?= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" ?></strong>
                    </p>
                </div>
                <div class="alert alert-success padding15 margin-top-bot-10">
                    <div class="">
                        <p>Xin cám ơn.</p>
                        <p>Sản phẩm bạn quan tâm hiện chỉ cho phép thành viên đặt hàng, bạn vui lòng <a data-toggle="modal" data-target="#dangnhap" class="Header__Icon Icon-Wrapper Icon-Wrapper--clickable ">
                                <b>Đăng nhập</b>
                            </a> hoặc <a href="/dang-ky.html" style="font-weight:bold">Đăng ký thành viên</a> nếu chưa có tài khoản</p>
                        <p>Chúc bạn một ngày vui vẻ.</p>

                        <p><a href="/" class="btn btn-warning">Go Home</a></p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>

                </div>


            </div>
        </div>
    </div>
</div>

<?php \yii\bootstrap\Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
    "size" => "modal-full"
]) ?>
<?php \yii\bootstrap\Modal::end(); ?>

<style>
    * {
        transition: 0.3s all;
    }

    .findoptions {
        width: 100%;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-position: center center;
        display: block;
    }

    .textkm {
        color: black !important;
        text-align: justify;
    }

    .resulttim {
        /*border: 2px solid #ddd;*/
        border-radius: 4px;
        padding: 10px;

    }

    h3 {
        color: black !important !important;
        font-weight: bold !important;
        font-size: 1.5em !important;
    }

    .choosesached {
        border: 4px solid #e33135 !important;
        position: relative;
    }

    .choosesached:before {
        background-image: url("/images/choose.png");
        content: "";
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        display: inline-block;
        width: 50px;
        height: 50px;
        position: absolute;
        top: 0;
        right: 0;
    }

    .choosesached:after {

        content: "";
        background: #e33135;
        opacity: 10%;
        display: inline-block;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        right: 0;
    }

    .hotro {
        cursor: pointer;
    }

    .hotro2 {
        cursor: pointer;
    }

    .robot {
        position: fixed;
        bottom: 10px;
        left: 10px;
        z-index: 999
    }

    .robot2 {
        position: relative !important;
        display: inline-block;
        float: left;
        height: 100%;
    }

    .hotro2 {
        position: absolute;
        bottom: 0;
        left: 0;
    }

    .hoi {
        display: inline-block;
        float: left;
        margin-top: 20px;
    }

    @media screen and (min-width: 0px) {
        .robot {
            width: 40%;
        }

        .hoi {
            width: 55%;
            padding: 0 2.5%;
        }
    }

    @media screen and (min-width: 990px) {
        .robot {
            width: 30%;
        }

        .hoi {
            width: 65%;
            padding: 0 2.5%;
        }
    }

    @media screen and (min-width: 1280px) {
        .robot {
            width: 15%;
        }

        .hoi {
            width: 80%;
            padding: 0 2.5%;
        }
    }

    @media screen and (max-width: 768px) {
        .robot2 {
            width: 20% !important;
        }

        .hoi {
            width: 75%;
            padding: 0 2.5%;
        }
    }
</style>