<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Danhmucvanban */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catnew-form row">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-xs-12">
        <?= $form->field($model, 'loaivanban')->textInput(['maxlength' => true, 'placeholder' => $model->attributeLabels()['name']]) ?>
    </div>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('#<?=Yii::$app->controller->id?>-name').focus()
        },700)
    })
</script>