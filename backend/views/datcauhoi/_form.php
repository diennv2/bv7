<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Datcauhoi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="datcauhoi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hoten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'noidung')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'noidungtraloi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'filedinhkem')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Admin::getAllUserUnderManagedByCurrentUser(),'id','ten')) ?>

    <?= $form->field($model, 'active')->checkbox() ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
