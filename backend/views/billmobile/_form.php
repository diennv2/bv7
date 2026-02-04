<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Billmobile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="billmobile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ngaylap')->textInput() ?>

    <?= $form->field($model, 'gioitinh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sdt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yeucaukhac')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tinhthanh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quanhuyen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phuongxa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nguoinhanhang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nguoinhanhangsdt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chuyendanhba')->textInput() ?>

    <?= $form->field($model, 'mangdtkhac')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'xuathoadontencty')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'xuathoadondiachi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'xuathoadonmst')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'product')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'typethanhtoan')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
