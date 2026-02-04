<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Cauhoi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cauhoi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cauhoi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cautraloia')->textarea(['rows' => 6]) ?>
    <div class="hidden">
        <?= $form->field($model, 'product_id')->textInput() ?>
    </div>
    <?= $form->field($model, 'cautraloib')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cautraloic')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dokho')->numberInput() ?>

    <?= $form->field($model, 'dapan')->dropDownList(["A"=>"A","B"=>"B","C"=>"C"]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
