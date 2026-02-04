<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Filedinhkem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="filedinhkem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tenfile')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'thumb')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ord')->textInput() ?>

    <?= $form->field($model, 'default')->textInput() ?>

    <?= $form->field($model, 'lienhe_id')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
