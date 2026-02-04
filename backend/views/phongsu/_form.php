<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Phongsu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phongsu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textInput(['rows' => 6])->label('Link nhúng youtube theo định dạng<br><pre>https://www.youtube.com/watch?v=lQItmtUJq-s</pre>') ?>
    <div class="form-group">
        <?=Html::label('Ảnh đại diện video','images');?>
        <?= Html::fileInput('images','',['id'=>'images']); ?>
    </div>
    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'resize' => false]) ?>

    <div class="col-xs-6" style="padding-left: 0;padding-right: 5px ">
        <?= $form->field($model, 'active')->checkbox() ?>
    </div>
    <div class="col-xs-6" style="padding-right: 0;padding-left: 5px ">
        <?= $form->field($model, 'luotxem')->numberInput() ?>
    </div>

    <div class="col-xs-6" style="padding-left: 0;padding-right: 5px ">
        <?= $form->field($model, 'ord')->numberInput() ?>
    </div>
   
    <div class="clearfix"></div>
    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
