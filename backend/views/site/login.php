<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Blacklist;

$ip=\func::get_client_ip();
$bl = Blacklist::findOne(['ip'=>$ip]);
if($bl!=null){
    if($bl->isblock==1){
        echo "You are Blocked";
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        exit;
    }

}
$this->title = 'Login';
$this->params['breadcrumbs'][] = ['name'=>$this->title,'link'=>'javascript:void(0)'];
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="vi" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="vi" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="vi">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Admin Location</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/css/font.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/css/style.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="<?php echo Yii::$app->urlManager->baseUrl?>/themes/favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="<?php echo Yii::$app->urlManager->createUrl('site/index') ?>">

    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <h3 class="form-title">Trang quản trị</h3>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <div class="form-group" style="text-align: right">
        <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
    <div class="forget-password" >
        <h4>Forgot your password ?</h4>
        <p>
            no worries, click <a href="javascript:;" id="forget-password">here </a>
            to reset your password.
        </p>
    </div>
    <?php ActiveForm::end(); ?>

    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="" method="post">
        <h3>Forget Password ?</h3>
        <p>
            Enter your e-mail address below to reset your password.
        </p>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn"><i class="m-icon-swapleft"></i> Back </button>
<!--            --><?//= Html::submitButton('Gửi <i class="m-icon-swapright m-icon-white"></i>', ['class' => 'btn blue pull-right', 'name' => 'login-button']) ?>
            <span id="quen-matkhau" class="btn blue pull-right">Gửi <i class="m-icon-swapright m-icon-white"></i></span>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
</div>
<!-- END LOGIN -->

<div id="ketqua">
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    Develope by <a href="http://AnPham" rel="nofollow" title="AnPham">AnPham</a>
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/respond.min.js"></script>
<script src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::$app->urlManager->baseUrl?>/themes/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script>
  jQuery(document).ready(function() {

    $('#forget-password').click(function() {
      $('#login-form').hide();
      $('.forget-form').show();
    });

    $('#back-btn').click(function() {
      $('#login-form').show();
      $('.forget-form').hide();
    });

    $(document).on('click','#quen-matkhau', function () {
      $.ajax({
        type: 'post',
        url: '<?php echo Yii::$app->urlManager->createUrl('site/request-password-reset') ?>',
        data: {email: $('input[name="email"]').val()},
        success: function (data) {
            $('#ketqua .modal-body>p').html(data)
            $('#myModal').modal('show')
        }
      });
    })

    // init background slide images
    $.backstretch([
        "<?php echo Yii::$app->urlManager->baseUrl?>/themes/admin/pages/media/bg/1.jpg"
      ], {
        fade: 1000,
        duration: 8000
      }
    );
  });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>