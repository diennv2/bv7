<?php
/**
 * Created by PhpStorm.
 * User: ihdes
 * Date: 8/24/2017
 * Time: 3:32 PM
 */

use yii\helpers\Html;

$this->title = 'Account Profile';
$nab = Yii::$app->controller->navbar;
?>
<style>
    .ver-inline-menu li.active i {
        background: #e33135 !important;
    }

    .imgnew {
        width: 100% !important;
    }

    .product-grid-item .owl-prev:after {
        content: "\e605" !important;
        font-size: 36px !important;
        line-height: 40px !important;
        font-weight: 100 !important;
        font-family: simple-line-icons;

    }

    .product-grid-item .owl-next:after {
        content: "\e606";
        font-size: 36px !important;
        line-height: 40px !important;
        font-weight: 100 !important;
        font-family: simple-line-icons;
    }

    .product-grid-item .owl-prev {
        font-size: 0 !important;

    }

    .product-grid-item .owl-next {
        font-size: 0 !important;
    }

    .cart-link:hover .cart-view {
        display: block !important;
    }

    .imgnew {
        width: 100% !important;
    }

    #menu-mobile:not( .mm-menu ) {
        display: none;
    }

    .bg-gray-rga {
        background-color: rgba(0, 0, 0, 0.79);
    }

    .promotion-filter {
        margin-top: -163px;
        position: relative;
        z-index: 1;
    }

    .slider.slider-horizontal .slider-track {
        height: 5px;
    }

    .slider-tick, .slider-handle {
        height: 13px;
        width: 13px;
    }

    .promotion-select-search {
        padding: 40px 0 10px;
    }

    .promotion-select-search .price-filter-group {
        color: #FFF;
        font-family: 'UTM Avo';
    }

    .promotion-select-search .price-filter-group.form-group {
        margin-bottom: 0;
    }

    .promotion-select-search .price-filter-group > label {
        font-size: 16px;
        font-weight: 200;
        padding-left: 0;
    }

    .promotion-select-search .options-selected.form-group {
        margin-bottom: 0;
    }

    .promotion-select-search .slider-tick-label-container {
        margin-top: -30px !important;
    }

    .promotion-select-search .slider-handle {
        background-color: #F639A5;
        background-image: -webkit-linear-gradient(top, #F639A5 0, #F639A5 100%);
        background-image: -o-linear-gradient(top, #F639A5 0, #F639A5 100%);
        background-image: linear-gradient(to bottom, #F639A5 0, #F639A5 100%);
    }

    .promotion-select-search .slider-selection.tick-slider-selection {
        background-image: -webkit-linear-gradient(top, #F639A5 0, #F639A5 100%);
        background-image: -o-linear-gradient(top, #F264BC 0, #F639A5 100%);
        background-image: linear-gradient(to bottom, #F264BC 0, #F639A5 100%);
    }

    .promotion-select-search .slider-tick.in-selection {
        background-image: -webkit-linear-gradient(top, #F639A5 0, #F639A5 100%);
        background-image: -o-linear-gradient(top, #F264BC 0, #F639A5 100%);
        background-image: linear-gradient(to bottom, #F264BC 0, #F639A5 100%);
    }

    .promotion-select-search .slider-tick.in-selection.round {
        border-radius: 50%;
        width: 13px;
    }

    .promotion-select-search .slider-tick.round {
        border-radius: 0;
        width: 3px;
    }

    .promotion-select-search .slider.slider-horizontal .slider-tick, .promotion-select-search .slider.slider-horizontal .slider-handle {
        margin-left: -5px;
    }

    .promotion-select-search .styled-selected {
        float: left;
        margin-right: 20px;
        width: 16%;
    }

    .promotion-select-search .styled-selected select {
        padding-left: 15px;
        border-radius: 10px;
        background: transparent url(bg-select.svg) no-repeat right center;
        background-color: #fff;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        outline: none;
        width: 100%;
        height: 37px;
        border: 0;
        padding-right: 43px;
    }

    .promotion-select-search form {
        width: 90%;
        margin: auto;
    }

    .promotion-select-search .wrapper-price label {
        display: block;
    }

    .promotion-select-search .slider.slider-horizontal {
        width: 100%;
        margin-bottom: 18px !important;
    }

    .checkout-sep {
        padding: 15px;
        font-size: 16px;
    }

    .payment-container {
        padding: 0;
    }

    .payment-container .overflow-cart {
        padding: 15px;
    }

    .payment-container .overflow-cart .blue {
        margin-top: 15px;
    }

    .wrapper-quickview {
        max-height: 50vh;
        overflow-y: scroll;
    }

    .header-navigate {
        border-top: 1px solid #dddddd;
    }

    .blog-r-image-feature {
        width: 100%;
    }

    .anh-blog {
        max-height: 400px;
        overflow: hidden;
    }

    .site-contact h1 {
        font-weight: 400;
        margin-bottom: 15px;
    }

    .site-contact p {
        color: #b0b0b0;
    }

    .site-contact div.mytitle {
        margin-bottom: 15px;
        font-style: italic;
    }

    .site-contact textarea {
        resize: none;
    }

    .contact-office {
        padding: 1px 15px;
        background: #FAFEFF;
        margin-bottom: 15px;
        border: 1px solid #f0f0f0;
        font-size: 12px;
    }

    .contact-office h3 {
        font-size: 16px;
        margin: 5px 0 !important;
        font-weight: normal;
        line-height: 24px;
        text-transform: uppercase;
        color: #062D57;
    }

    .contact-office p {
        line-height: 24px;
        text-align: justify;
        color: #888;
        margin: 0 0 10px 0;
    }

    .contact-office p strong {
        display: inline-block;
        width: 90px;
        margin-right: 10px;
        padding-left: 24px;
    }

    .contact-office a {
        color: #888;
    }

    .form-group.form-md-line-input.has-mystyle .form-control.edited:not([readonly]) ~ label:after,
    .form-group.form-md-line-input.has-mystyle .form-control.edited:not([readonly]) ~ .form-control-focus:after, .form-group.form-md-line-input.has-mystyle .form-control.form-control-static ~ label:after,
    .form-group.form-md-line-input.has-mystyle .form-control.form-control-static ~ .form-control-focus:after, .form-group.form-md-line-input.has-mystyle .form-control:focus:not([readonly]) ~ label:after,
    .form-group.form-md-line-input.has-mystyle .form-control:focus:not([readonly]) ~ .form-control-focus:after, .form-group.form-md-line-input.has-mystyle .form-control.focus:not([readonly]) ~ label:after,
    .form-group.form-md-line-input.has-mystyle .form-control.focus:not([readonly]) ~ .form-control-focus:after {
        background: #4285f4;
    }

    .form-group.form-md-line-input.has-mystyle .form-control.edited:not([readonly]) ~ label, .form-group.form-md-line-input.has-mystyle .form-control.form-control-static ~ label, .form-group.form-md-line-input.has-mystyle .form-control:focus:not([readonly]) ~ label, .form-group.form-md-line-input.has-mystyle .form-control.focus:not([readonly]) ~ label {
        color: #4285f4;
    }

    .form-group.form-md-line-input.has-mystyle .form-control.edited:not([readonly]) ~ i, .form-group.form-md-line-input.has-mystyle .form-control.form-control-static ~ i, .form-group.form-md-line-input.has-mystyle .form-control:focus:not([readonly]) ~ i, .form-group.form-md-line-input.has-mystyle .form-control.focus:not([readonly]) ~ i {
        color: #4285f4;
    }

    .form-group.form-md-line-input.has-mystyle .form-control.edited:not([readonly]) ~ .help-block, .form-group.form-md-line-input.has-mystyle .form-control.form-control-static ~ .help-block, .form-group.form-md-line-input.has-mystyle .form-control:focus:not([readonly]) ~ .help-block, .form-group.form-md-line-input.has-mystyle .form-control.focus:not([readonly]) ~ .help-block {
        color: #4285f4;
    }

    .form-group.form-md-line-input.has-mystyle .input-group-addon {
        color: #4285f4;
    }

    .form-horizontal .form-group.form-md-line-input.has-mystyle > label {
        color: #4285f4;
    }

    form div.required label.control-label:before {
        content: " * ";
        color: red;
    }

    .form-header {
        color: #ffffff;
        font-size: 15px;
        line-height: 17px;
        border-bottom: 3px solid #2a73d8;
        margin: 0;
    }

    .form-header .form-txt {
        background-color: #2a73d8;
        display: inline-block;
        padding: 6px 14px;
    }

    .account-detail {
        padding-top: 20px;
        padding-bottom: 10px;
        background-color: #f6f6f6;
        margin-bottom: 25px;
    }

    .account-detail {
        padding-right: 45px;
    }

    .account-detail .control-label {
        display: inline-block;
        vertical-align: middle;
    }

    .bg-warning {
        width: 100%;
        float: right;
        padding: 7px;
        border: 1px solid #e6ce79;
        margin-top: 5px;
        background-color: #fcf8e3;
    }

    .account-field-content {
        width: 100%;
        display: inline-block;
        line-height: 34px;
        padding-left: 10px;
        border: 1px solid #e5e5e5;
    }

    .user-profile-content {
        margin-bottom: 20px;
    }

    .profile-account {
        min-height: 600px;
        padding: 25px 40px 10px 0;
        background-color: #f7f7f7;
    }

    .backgroundwhite {
        background: white !important;

    }

    .padding15 {
        padding: 15px;
    }

    .col-xs-6.white-contain {
        padding: 5px !important;
    }

    .backgroundwhite p {
        margin: 0 !important;
    }

    .hh #main-menu {
        margin-bottom: 0 !important;
    }

    .checkbox > label {
        padding-left: 20px !important;
    }
</style>
<link href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/component.css" rel="stylesheet">

<div class="header-navigate">
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

<div class="container">
    <div class="row profile-account">
        <div class="col-md-3">
            <ul class="ver-inline-menu tabbable margin-bottom-10">
                <li class="<?= $activetab == 1 ? 'active' : '' ?>">
                    <a data-toggle="tab" href="#tab_1-1">
                        <i class="fa fa-cog"></i>Thông tin tài khoản</a>
                    <span class="after">
                    </span>
                </li>
                <li class="<?= $activetab == 2 ? 'active' : '' ?>">
                    <a data-toggle="tab" href="#tab_2-2">
                        <i class="fa fa-money"></i>Biến động số dư</a>
                </li>
                <li class="<">
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/history']) ?>">
                        <i class="fa fa-shopping-cart"></i>Lịch sử gửi yêu cầu</a>
                </li>
                <li class="<">
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/goicuoc']) ?>">
                        <i class="fa fa-shopping-cart"></i>Đăng ký gói cước</a>
                </li>
                <li class="<?= $activetab == 3 ? 'active' : '' ?>">
                    <a data-toggle="tab" href="#tab_3-3">
                        <i class="fa fa-lock"></i>Thay đổi mật khẩu</a>
                </li>
            </ul>
            <?php
            foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
            }
            ?>
        </div>
        <script>
            $(document).ready(function () {
                $(document).on("click",'.nhapgioithieu',function () {
                    var sdt = $("#sdtgioithieu").val();
                    Swal.fire({
                        title: 'Bạn có chăc chắn không?',
                        text: "Bạn ghi nhận số điện thoại "+sdt+" làm người giới thiệu của mình chứ?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Xác nhận!'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url:"<?=Yii::$app->urlManager->createUrl(['site/sdtgioithieu'])?>",
                                type:'post',
                                dataType:'json',
                                data:{
                                    sdt: sdt
                                },
                                complete:function () {
                                    location.reload();
                                }
                            });
                        }
                    })
                })
            })
        </script>
        <div class="col-md-9">
            <div class="tab-content">
                <div id="tab_1-1" class="tab-pane <?= $activetab == 1 ? 'active' : '' ?>">

                    <div class="col-xs-12 backgroundwhite" style="padding-top: 15px">


                        <?php $title = [
                            1 => 'Ms',
                            2 => 'Mrs',
                            3 => 'Mr',
                        ] ?>



                        <?php /** @var \common\models\User $account */ ?>
                        <div class="col-md-5 col-xs-12" style="text-align: center">
                            <?php if (is_file(dirname(dirname(dirname(__DIR__))) . $account->shop_picture)): ?>
                                <img src="<?= $account->shop_picture; ?>" style="width: 100%;background: #ddd">
                            <?php else: ?>
                                <?php if ($account->title == 3): ?>
                                    <img onclick="$('#file-avatar').click()" src="/images/nousermale.jpg"
                                         style="width: 100%;background: #ddd">
                                <?php else: ?>
                                    <img onclick="$('#file-avatar').click()" src="/images/nouserfemale.jpg.jpg"
                                         style="width: 100%;background: #ddd">
                                <?php endif; ?>

                            <?php endif; ?>
                            <div><?php if (isset($_GET['thongbao'])) {
                                    echo "<span class='text-danger'>" . $_GET['thongbao'] . "</span>";
                                } ?></div>
                            <button onclick="$('#file-avatar').click()" class="btn btn-default"
                                    style="margin-top: 10px">Cập nhật ảnh đại diện <br>(Định dạng JPEG|JPG, Max 3Mb)
                            </button>
                            <?= Html::beginForm(['site/updateavatar'], 'post', ['id' => 'form-avatar', 'enctype' => 'multipart/form-data']); ?>
                            <input id="file-avatar" type="file" name="fileinput" class="hidden">
                            <?= Html::endForm() ?>
                        </div>
                        <script>
                            $(document).ready(function () {
                                $(document).on('change', '#file-avatar', function () {
                                    console.log($(this).val());
                                    $("#form-avatar").submit();
                                })
                            })
                        </script>
                        <div class="col-md-7 col-xs-12">
                            <!--<h2><?/*= $title[$account->title] . ". " . $account->firstname */?></h2>-->
                            <p class="alert alert-success"><a
                                        href="<?= Yii::$app->urlManager->createUrl(['site/profile', 'user' => Yii::$app->user->id]) ?>">Trang
                                    cá
                                    nhân: <?= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . Yii::$app->urlManager->createUrl(['site/profile', 'user' => Yii::$app->user->id]) ?></a>
                            </p>
                            <?php if ($account->phone != ''): ?>
                            <div class="col-xs-12 user-profile-content">
                                <label class="control-label">Phone Number</label>
                                <span class="account-field-content"><?= $account->phone ?></span class="account-field-content">
                            </div>
                            <?php endif; ?>

                            <?php if ($account->city != ''): ?>
                            <div class="col-xs-12 user-profile-content">
                                <label class="control-label">Thành phố</label>
                                <span class="account-field-content"><?= $account->city ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if ($account->address != ''): ?>
                            <div class="col-xs-12 user-profile-content">
                                <label class="control-label">Quận</label>
                                <span class="account-field-content"><?= $account->address ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if ($account->address2 != ''): ?>
                            <div class="col-xs-12 user-profile-content">
                                <label class="control-label">Phường xã</label>
                                <span class="account-field-content"><?= $account->address2 ?></span>
                            </div>
                            <?php endif; ?>


                            <?php if ($account->street != ''): ?>
                                <div class="col-xs-12 user-profile-content">
                                    <label class="control-label">Địa chỉ chi tiết</label>
                                    <span class="account-field-content"><?= $account->street ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>


                </div>

                <div id="tab_2-2" class="tab-pane <?= $activetab == 2 ? 'active' : '' ?>">

                    <div class="row">
                        <div class="col-xs-12 white-contain clearfix">
                            <div class='backgroundwhite padding15 table-responsive'>
                                <table class="table table-bordered table-hover table-striped">
                                    <tr>
                                        <th colspan="2">Tài khoản</th>
                                        <th><?= Yii::$app->user->identity->getMoneyText() ?></th>
                                    </tr>
                                    <tr>
                                        <th>Tiêu đề</th>
                                        <th>Nội dung</th>
                                        <th>Thời gian</th>
                                        <th>Số điểm</th>
                                    </tr>
                                    <?php foreach (\common\models\Lichsutaikhoan::find()->where(['userid' => Yii::$app->user->id])->orderBy("id desc")->all() as $index => $value): ?>
                                        <tr>
                                            <td><?= $value->tieude ?></td>
                                            <td><?= $value->noidung ?></td>
                                            <td><?= $value->indatetime ?></td>
                                            <th style="color: <?= ($value->amount > 0) ? "green" : "red"; ?>"><?= ($value->amount > 0) ? "+" : "-"; ?> <?= number_format(abs($value->amount), 0, "", ".") ?></th>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


                <div id="tab_3-3" class="tab-pane <?= $activetab == 3 ? 'active' : '' ?>">
                    <div class="col-xs-6">

                        <?php $form = \yii\bootstrap\ActiveForm::begin(['id' => 'changepassword-form', 'action' => Yii::$app->urlManager->createUrl(['site/overview']), 'method' => 'post']); ?>

                        <?= $form->field($doimatkhau, 'old_password')->passwordInput(['autofocus' => true]) ?>

                        <?= $form->field($doimatkhau, 'password')->passwordInput() ?>

                        <?= $form->field($doimatkhau, 'password_repeat')->passwordInput() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Save', ['id' => 'thaypass-btn', 'class' => 'btn btn-primary', 'name' => 'thay-pass']) ?>
                        </div>

                        <?php \yii\bootstrap\ActiveForm::end(); ?>
                    </div>
                </div>
                <div id="tab_4-4" class="tab-pane <?= $activetab == 4 ? 'active' : '' ?>">

                    <div class="row">
                        <div class="col-xs-12 white-contain clearfix">
                            <div class='backgroundwhite padding15 table-responsive'>
                                <table class="table">
                                    <?php $bill = \common\models\Billmobile::find()->where(['chuyendanhba' => Yii::$app->user->id, 'nhanquastatus' => 1])->orderBy("id asc")->all();
                                    $temp = [];
                                    foreach ($bill as $value):

                                        $listquas = \common\models\Listnhanqua::findAll(['billid' => $value->id]);
                                        foreach ($listquas as $listqua):
                                            if (!is_null($listqua)):

                                                if (!in_array($listqua->productid, $temp)):
                                                    $temp[] = $listqua->productid;
                                                    ?>
                                                    <tr>
                                                        <th style="width: 150px"><?php
                                                            $product = \common\models\Product::findOne(['id' => $listqua->productid]);
                                                            echo (!is_null($product)) ? "<img src='" . $product->getDefaultImage() . "' style='width:150px'/>" : "<img src='/images/noimg.jpg' style='width:150px'/>";
                                                            ?></th>
                                                        <td><a style="color: #0c0e1a"
                                                               href="<?=  ((!is_null($product)) ?$product->getTopic():''); ?>"><?= (!is_null($product)) ? "<h3 style='color: #00AF64'>" . $product->name . "</h3><p>Click để tham gia trao đổi thảo luận về topic " . $product->name . "</p>" : "Không tìm thấy sách"; ?></a>
                                                        </td>
                                                    </tr>
                                                <?php endif;
                                            endif;
                                        endforeach;
                                    endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab_5-5" class="tab-pane <?= $activetab == 5 ? 'active' : '' ?>">

                    <div class="row">
                        <div class="col-xs-12 white-contain clearfix">
                            <div class='backgroundwhite padding15 table-responsive'>
                                <h2>Đổi quà</h2>
                                <div class="alert alert-success">
                                    Bạn đang có : <?= Yii::$app->user->identity->getMoneyText() ?>
                                </div>
                                <div>Bạn có thể đổi điểm thưởng thành số dư nạp cho thuê bao di động trả trước / trả
                                    sau, tỷ lệ 1<img src='/images/coin.png' style='width: 20px;display: inline-block'> =
                                    1.000 VNĐ
                                </div>
                                <div class="text-danger"></div>
                                <div class="form-group">
                                    <label class="control-label" style="font-weight: bold">Chọn mệnh giá</label>
                                    <select class="form-control" id="topup">
                                        <!--                                        <option value="10000">10.000 VNĐ</option>-->
                                        <option value="20000">20.000 VNĐ</option>
                                        <option value="30000">30.000 VNĐ</option>
                                        <option value="50000">50.000 VNĐ</option>
                                        <option value="100000">100.000 VNĐ</option>
                                        <option value="200000">200.000 VNĐ</option>
                                        <option value="500000">500.000 VNĐ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" style="font-weight: bold">Chọn Nhà mạng</label>
                                    <select class="form-control" id="brand">
                                        <!--                                        <option value="VMS">Mobifone</option>-->
                                        <option value="VNP">Vinaphone</option>
                                        <option value="VTT">Viettel</option>
                                        <!--                                        <option value="VNM">Vietnammobile</option>-->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" style="font-weight: bold">Chọn phương thức</label>
                                    <select class="form-control" id="type">
                                        <option value="PRE_PAID">Trả trước</option>
                                        <option value="POST_PAID">Trả sau</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" style="font-weight: bold">Nhập số điện thoại (0xxx...)</label>
                                    <input class="form-control" type="text" id="phone">
                                </div>
                                <div class="form-group">
                                    <button class="doi btn btn-success" style="margin-top: 10px">Đổi quà</button>
                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/lichsudoiqua']) ?>"
                                       class="xemlichsu btn btn-success"
                                       style="margin-top: 10px;background: #e33135bf !important">Xem lịch sử đổi quà</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    var dem = 0
    $(document).ready(function () {
        $(document).on('click', '#btn-add-da', function () {
            dem++
            $('#divdelivery').append('<div class="col-xs-6 white-contain clearfix" id=\'div-dad-' + dem + '\'><div class=\'backgroundwhite padding15\'>\n' +
                '                        <h2>Add New Adrress #' + dem + '</h2><a style=\'position: absolute;right: 30px; top: 15px;font-size: 28px\' data-toggle="collapse" data-target="#collap-' + dem + '">-</a><a style=\'position: absolute;right: 15px; top: 15px;font-size: 18px\' class=\'deldil\' vals=\'' + dem + '\'>x</a>\n' +
                '                        <div id=\'collap-' + dem + '\' class="collapse in"><div class="form-group">\n' +
                '                            <label class="control-label">First name</label>\n' +
                '                            <input required=\'required\' type="text" class="form-control" name="delivery[' + dem + '][firstname]" value="">                        </div>\n' +
                '                        <div class="form-group">\n' +
                '                            <label class="control-label">Surname</label>\n' +
                '                            <input required=\'required\' type="text" class="form-control" name="delivery[' + dem + '][surname]" value="">                        </div>\n' +
                '                        <div class="form-group">\n' +
                '                            <label class="control-label">Address</label>\n' +
                '                            <input required=\'required\' type="text" class="form-control" name="delivery[' + dem + '][address]" value="">                            <label class="control-label"> </label>\n' +
                '                            <input type="text" class="form-control" name="delivery[' + dem + '][address2]" value="">                        </div>\n' +
                '                        <div class="form-group">\n' +
                '                            <label class="control-label">Street</label>\n' +
                '                            <input  type="text" class="form-control" name="delivery[' + dem + '][street]" value="">                        </div>\n' +
                '                        <div class="form-group">\n' +
                '                            <label class="control-label">City</label>\n' +
                '                            <input required=\'required\' type="text" class="form-control" name="delivery[' + dem + '][city]" value="">                        </div>\n' +
                '                        <div class="form-group">\n' +
                '                            <label class="control-label">Postcode</label>\n' +
                '                            <input required=\'required\' type="text" class="form-control" name="delivery[' + dem + '][postcode]" value="">                        </div>\n' +
                '                        <div class="form-group">\n' +
                '                            <label class="control-label">Country</label>\n' +
                '                            <span class="account-field-content" style="background-color: #f7f7f7;">United Kingdom</span>\n' +
                '                        </div>\n' +
                '                        <div class="form-group">\n' +
                '                            <label class="control-label">Phone</label>\n' +
                '                            <input type="text" class="form-control" name="delivery[' + dem + '][phone]" value="">                        </div>\n' +
                '                        <div class="form-group">\n' +
                '                            <input type="radio" name="check" id=\'checkss-' + dem + '\' value=\'' + dem + '\'><label class="control-label" for=\'checkss-' + dem + '\'>Set as default delivery address</label>\n' +
                '                        </div>\n' +
                '                    </div></div></div>')
        })
        $(document).on('click', '.deldil', function () {
            var t = $('#div-dad-' + $(this).attr('vals'))
            t.fadeOut('slow', function () {
                t.remove()
            })
        })
        $(document).on('click', '.radiodefault', function () {
            var t = $(this)

            if (confirm('Set this as default?')) {
                $.ajax({
                    url: '<?=Yii::$app->urlManager->createUrl(['site/updatedef']);?>',
                    type: 'post',
                    data: {
                        id: t.val()
                    },
                    success: function (data) {
                        alert('Success!')
                        window.location.reload()
                    }
                })
            }

        })
        $(document).on('click', '.doi', function () {
            $.ajax({
                type: 'post',
                url: '<?php echo Yii::$app->urlManager->createUrl('site/doithuong') ?>',
                data: {topup: $("#topup").val(),phone: $("#phone").val(),brand: $("#brand").val(),type: $("#type").val()},
                dataType: 'json',
                beforeSend: function () {

                },
                success: function (output) {

                    if (output.responseStatus) {
                        window.location.href = '<?=Yii::$app->urlManager->createUrl(['site/lichsudoiqua'])?>';
                    } else {
                        Swal.fire({
                            title: 'Thao tác lỗi!',
                            text: output.responseMessage,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                }
            })
        });
    })
</script>