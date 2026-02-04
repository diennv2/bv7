<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Coinexchange */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coinexchange-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList(\yii\helpers\ArrayHelper::map(
        [
            ['id'=>0,'text'=>'Đang chờ duyệt'],
            ['id'=>4,'text'=>'Duyệt'],
            ['id'=>3,'text'=>'Từ chối'],
            ['id'=>2,'text'=>'Từ chối không hoàn tiền']
        ],'id','text'
    )) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
