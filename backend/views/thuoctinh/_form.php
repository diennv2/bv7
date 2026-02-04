<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Thuoctinh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thuoctinh-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tenthuoctinh')->textInput(['maxlength' => true]) ?>

    Thêm loại thuộc tính <?=Html::a('<i class="glyphicon glyphicon-plus"></i>', ['loaithuoctinh/create'],
        ['role'=>'modal-remote','title'=> 'Create new Loaithuoctinhs','class'=>'btn btn-default']);?>
    <?= $form->field($model, 'loaithuoctinh_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Loaithuoctinh::find()->all(),'id','tenloai'),['id'=>'dropx']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script>
    $(document).ready(function () {
        $("#dropx").select2();
    })
</script>