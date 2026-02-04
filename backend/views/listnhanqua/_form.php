<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Listnhanqua */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="listnhanqua-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'billid')->textInput() ?>

    <?= $form->field($model, 'productid')->textInput() ?>

    <?= $form->field($model, 'ngaynhan')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
