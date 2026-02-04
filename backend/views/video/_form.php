<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class="col-xs-12">
        <?php if(!$model->isNewRecord): ?>
            <div class="D-imageboxform">
                <?php
                echo Html::img(Yii::$app->urlManagerFrontend->baseUrl . $model->image, ['class' => 'D-imageform']);
                ?>
            </div>
        <?php endif; ?>
        <?= $form->field($model, 'image')->fileInput()?>
    </div>


    <?= $form->field($model, 'code')->textInput(['maxlength' => true])->label("Mã nhúng youtube, ví dụ: <pre style='font-weight: normal'>https://www.youtube.com/watch?v=<b>YsM5CPYSpoY <= Code = 'YsM5CPYSpoY'</b></pre>") ?>


    <?= $form->field($model, 'ord')->numberInput()->label("Sắp xếp, số bé hơn hiện trước") ?>

    <?= $form->field($model, 'hot')->checkbox()->label(false) ?>
    <?= $form->field($model, 'active')->checkbox()->label(false) ?>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
