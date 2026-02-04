<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DongDuLieu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dong-du-lieu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dinh_nghia_bang_id')->textInput() ?>

    <?= $form->field($model, 'du_lieu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

    <?= $form->field($model, 'tao_luc')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
