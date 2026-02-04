<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Quytrinh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quytrinh-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'decription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'ord')->numberInput() ?>
    <?php
    echo Html::label('Hình ảnh', null, ['style' => 'display: block']);
    if (!$model->isNewRecord) {
        ?>
        <div class="D-imageboxform">
            <?php
            echo Html::img('../images/quytrinh/' . $model->image, ['class' => 'D-imageform']);
            ?>
        </div>
        <?php
    }
    echo $form->field($model, 'image')->fileInput()->label(false);

    ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
