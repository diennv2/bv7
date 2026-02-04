<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\BillmobileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="billmobile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ngaylap') ?>

    <?= $form->field($model, 'gioitinh') ?>

    <?= $form->field($model, 'ten') ?>

    <?= $form->field($model, 'sdt') ?>

    <?php // echo $form->field($model, 'yeucaukhac') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'tinhthanh') ?>

    <?php // echo $form->field($model, 'quanhuyen') ?>

    <?php // echo $form->field($model, 'phuongxa') ?>

    <?php // echo $form->field($model, 'nguoinhanhang') ?>

    <?php // echo $form->field($model, 'nguoinhanhangsdt') ?>

    <?php // echo $form->field($model, 'chuyendanhba') ?>

    <?php // echo $form->field($model, 'mangdtkhac') ?>

    <?php // echo $form->field($model, 'xuathoadontencty') ?>

    <?php // echo $form->field($model, 'xuathoadondiachi') ?>

    <?php // echo $form->field($model, 'xuathoadonmst') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'product') ?>

    <?php // echo $form->field($model, 'typethanhtoan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
