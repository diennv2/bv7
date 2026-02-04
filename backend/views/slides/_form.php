<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Slides */
/* @var $form yii\widgets\ActiveForm */ ?>
<div class="slides-form">
    <?php $form = ActiveForm::begin(); ?>    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'url')->dropDownList(\yii\helpers\ArrayHelper::map(func::getMenu(),'value','text','group'),['id'=>'drop-link']) ?>
    <div class="form-group field-lienkettinh" id="divtinh">
        <label class="control-label" for="lienkettinh">Đường dẫn ngoài</label>
        <input type="text" id="lienkettinh" class="form-control" name="Slides[url]" value="<?php echo $model->url?>">
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'ord')->numberInput() ?>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-3">                    <?= Html::label('Chọn ảnh:') ?>                </div>
                <div class="col-md-9">                    <?php if (!$model->isNewRecord) { ?>
                        <div class="D-imageboxform">                            <?php echo Html::img(Yii::$app->urlManagerFrontend->baseUrl . $model->image, ['class' => 'D-imageform']); ?>                        </div>                        <?php }
                    echo $form->field($model, 'image')->fileInput()->label(false); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">            <?= $form->field($model, 'active')->checkbox()->label(false) ?>        </div>
    </div> <?= $form->field($model, 'position')->dropDownList(common\models\Slides::getPosition(), ['class' => 'form-control']) ?>    <?= $form->field($model, 'brief')->textarea() ?>    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>        </div>    <?php } ?>    <?php ActiveForm::end(); ?>
</div>
<script>    $(document).ready(function () {
        setTimeout(function () {
            $('#<?=Yii::$app->controller->id?>-name').focus()
        }, 700)
    })</script>


<script>
    if ($("#drop-link").val() != "link")
        $("#divtinh").html("");
    $(document).ready(function () {
        $(document).on('change', '#drop-link', function () {
            if ($(this).val() != "link") {
                $("#divtinh").html("");
            } else {
                $("#divtinh").html('<label class="control-label" for="lienkettinh">Đường dẫn ngoài</label>' +
                    '<input type="text" id="lienkettinh" class="form-control" name="Slides[url]" value="<?php echo $model->url?>">' +
                    '<div class="help-block">' +
                    '</div>');
                $("#lienkettinh").focus();
            }
        })
    })
</script>