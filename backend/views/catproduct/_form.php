<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Catproduct */

/* @var $form yii\widgets\ActiveForm */
/** @var $property \common\models\Detailproperties */


?>

<div class="catproduct-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="catnew-form row">

        <div class="col-xs-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-xs-6">
            <?= $form->field($model, 'parent')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Catproduct::getAllCatproduct($model->id), 'id', 'name'), ['class' => 'form-control', 'prompt' => 'chon...']) ?>
        </div>


        <div class="col-xs-6">
            <?= $form->field($model, 'small_icon')->textInput() ?>
        </div>

        <div class="col-xs-12">
            <?php if(!$model->isNewRecord): ?>
                <div class="D-imageboxform">
                    <?php
                    echo Html::img(Yii::$app->urlManagerFrontend->baseUrl . $model->image, ['class' => 'D-imageform']);
                    ?>
                </div>
            <?php endif; ?>
            <?= $form->field($model, 'image')->fileInput()->label(false) ?>
        </div>

        <div class="col-xs-12">
            <?= $form->field($model, 'menustyle')->dropDownList([
                    0=>"Công khai",
                    1=>"Chỉ dành cho thành viên",
                    2=>"Đồng giá"
            ]) ?>
        </div>
        <div class="col-xs-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>  <div class="col-xs-12">
            <?= $form->field($model, 'home2')->checkbox() ?>
        </div>





        <?php if (!Yii::$app->request->isAjax) { ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        <?php } ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('#<?=Yii::$app->controller->id?>-name').focus()
        },700)
        $("#catproduct-parent").select2();
    })
</script>