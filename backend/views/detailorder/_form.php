<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Detailorder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detailorder-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tenhang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'soluong')->textInput() ?>

    <?= $form->field($model, 'dongia')->textInput() ?>

    <?= $form->field($model, 'thanhtien')->textInput() ?>

    <?= $form->field($model, 'ghichu')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
