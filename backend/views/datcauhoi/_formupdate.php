<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
date_default_timezone_set("Asia/Ho_Chi_Minh");
/* @var $this yii\web\View */
/* @var $model common\models\Datcauhoi */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="duan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Admin::getAllUserUnderManagedByCurrentUser(),'id','ten')) ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script>
    $("#duan-truongphongphutrach").select2();
</script>