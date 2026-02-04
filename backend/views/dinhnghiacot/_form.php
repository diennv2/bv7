<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DinhNghiaCot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dinh-nghia-cot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dinh_nghia_bang_id')->textInput() ?>

    <?= $form->field($model, 'ten_cot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'khoa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cong_thuc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'thu_tu')->textInput() ?>

    <?= $form->field($model, 'tao_luc')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
