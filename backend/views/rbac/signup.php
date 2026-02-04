<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\auth\models\Search\RbacSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Đăng ký user';
$this->params['breadcrumbs'][] = ['name' => $this->title, 'link' => 'javascript:void(0)'];

CrudAsset::register($this);

?>

<div class="site-signup">
    <p>Hãy nhập thông tin tài khoản cần tạo!</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = \kartik\form\ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'ten')->textInput(['autofocus' => true])->label('Họ và tên') ?>


            <?= $form->field($model, 'username')->textInput() ?>

            <?= $form->field($model, 'email')->textInput(['type'=>'email']) ?>


            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'password_repeat')->passwordInput()->label("Nhập lại password") ?>
            

            <?= $form->field($model, 'role')->dropDownList($roles)->label('Vai trò') ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php \kartik\form\ActiveForm::end(); ?>
        </div>
    </div>
</div>


