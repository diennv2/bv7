<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Nhomsachtheoloai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nhomsachtheoloai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sachid')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Product::find()->where(['active'=>1,'hot'=>1])->all(),'id','name')) ?>



  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script>
    $("#nhomsachtheoloai-sachid").select2();
</script>