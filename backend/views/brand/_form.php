<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'description')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Catproduct::find()->where(['parent'=>-1])->all(),'id','name'),['multiple'=>true]) ?>
    <?= $form->field($model, 'ord')->numberInput() ?>

    <?php
    if (!$model->isNewRecord) {
        ?>
        <div class="D-imageboxform">
            <?php
            echo Html::img('../images/brand/' . $model->image, ['class' => 'D-imageform']);
            ?>
        </div>
        <?php
    }
    echo $form->field($model, 'image')->fileInput()->label(false);

    ?>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'home')->checkbox() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'active')->checkbox() ?>
        </div>
    </div>




    <? /*= $form->field($model, 'url')->textarea(['rows' => 6]) */ ?>



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
        }, 700)
    })
</script>