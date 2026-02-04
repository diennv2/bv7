<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

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

    <?= $form->field($model, 'ord')->numberInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>
    <?= $form->field($model, 'job')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6, 'maxlength' => 200]) ?>
    <?= $form->field($model, 'address')->textarea(['rows' => 2, 'maxlength' => 500]) ?>



    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

<!--    <?php /*$form = ActiveForm::begin(); */?>

    <?/*= $form->field($model, 'name')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'image')->textarea(['rows' => 6]) */?>

    <?/*= $form->field($model, 'job')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'content')->textarea(['rows' => 6]) */?>

    <?/*= $form->field($model, 'ord')->textInput() */?>

    <?/*= $form->field($model, 'active')->textInput() */?>

    <?/*= $form->field($model, 'lang_id')->textInput() */?>

  
	<?php /*if (!Yii::$app->request->isAjax){ */?>
	  	<div class="form-group">
	        <?/*= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) */?>
	    </div>
	<?php /*} */?>

    <?php /*ActiveForm::end(); */?>
    -->
</div>
