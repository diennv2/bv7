<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Configure */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configure-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->dropDownList(['slide'=>'Slide','listsanpham'=>'List sản phẩm'],['maxlength' => true,'prompt'=>'Chọn kiểu....','id'=>'kieuselect'])->label("Kiểu") ?>
    <label class="">Ảnh background</label>
    <?= yii\helpers\Html::fileInput("fileupload") ?>
    <label class="">Ảnh nổi bật</label>
    <?= yii\helpers\Html::fileInput("fileuploadbackgroundnoibat") ?>
    <div id="doituong">

    </div>


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
