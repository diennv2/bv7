<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Landingpage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="landingpage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'active')->dropDownList([0=>'Inactive',1=>'Active']) ?>

    <?= $form->field($model, 'name')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'templatefile')->fileInput(['rows' => 6]) ?>

    <?= $form->field($model, 'customcss')->textarea(['rows' => 6]) ?>





  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
