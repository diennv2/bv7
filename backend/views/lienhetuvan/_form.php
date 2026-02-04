<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lienhetuvan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lienhetuvan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'donvi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hoten')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dienthoai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noidung')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
