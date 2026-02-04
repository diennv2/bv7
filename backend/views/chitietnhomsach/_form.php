<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Chitietnhomsach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chitietnhomsach-form">
    <h3>Nhóm: <?=\common\models\Nhomsach::findOne($model->nhomid)->tennhom?></h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Product::findAll(['hot'=>1]),'id','name')) ?>
    <div class="hidden">
        <?= $form->field($model, 'nhomid')->textInput() ?>
    </div>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script>
    $("#chitietnhomsach-product_id").select2();
</script>