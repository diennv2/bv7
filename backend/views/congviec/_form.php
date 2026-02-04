<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Congviec */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="congviec-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'donvi')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Donvi::find()->all(), 'id', 'companyname'), ['class' => 'form-control selectdon']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ten')->textInput(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'nganhnghe')->
            dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Nganhnghe::find()->all(), 'id', 'ten'), ['multiple' => true, 'class' => 'form-control selectdon']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'noilamviec')->
            dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Diadiem::find()->all(), 'id', 'ten'), ['multiple' => true, 'class' => 'form-control selectdon']) ?>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6">
            <div class="col-md-3" style="padding: 0">
                <?= $form->field($model, 'hot')->
                checkbox() ?>
            </div>
            <div class="col-md-9" style="padding: 0">
                <?= $form->field($model, 'douutien')->
                numberInput() ?>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'vitriungtuyen')->textInput(['rows' => 6]) ?>

            <?= $form->field($model, 'capbac')->textInput(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'thoigianlamviec')->textInput(['rows' => 6]) ?>

            <?= $form->field($model, 'mucluong')->textInput(['rows' => 6]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'mota')->textarea(['rows' => 6, "style" => 'resize:none!important']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'yeucauchung')->textarea(['rows' => 6, "style" => 'resize:none!important']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'chinhsachphucloi')->textarea(['rows' => 6, "style" => 'resize:none!important']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'lienhe')->textarea(['rows' => 6, "style" => 'resize:none!important']) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'tuvanvien')->textarea(['rows' => 6, "style" => 'resize:none!important']) ?>
        </div>
    </div>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $(document).ready(function () {
        $(".selectdon").select2({
            placeholder: "Chọn",
            allowClear: true,
            closeOnSelect: false
        });
    })
</script>
