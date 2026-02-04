<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Dichvu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dichvu-form">

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

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>



    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
