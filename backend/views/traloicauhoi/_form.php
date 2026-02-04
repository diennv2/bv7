<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Traloicauhoi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="traloicauhoi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'listnhanquaid')->textInput() ?>

    <?= $form->field($model, 'cauhoi')->textInput() ?>

    <?= $form->field($model, 'cautraloi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dapancuakhach')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
