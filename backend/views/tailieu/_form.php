<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaiLieu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tai-lieu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'benh_id')->textInput() ?>

    <?= $form->field($model, 'dinh_nghia_bang_id')->textInput() ?>

    <?= $form->field($model, 'tieu_de')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duong_dan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nguoi_tai')->textInput() ?>

    <?= $form->field($model, 'tai_luc')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
