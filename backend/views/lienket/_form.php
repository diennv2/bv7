<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lienket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lienket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lienket')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'active')->checkbox() ?>
    <?php
    echo Html::label('Hình ảnh:', null, ['style' => 'display: block']);
    if (!$model->isNewRecord) {
        ?>
        <div class="D-imageboxform">
            <?php
            echo Html::img('../images/album/' . $model->hinhanh, ['class' => 'D-imageform']);
            ?>
        </div>
        <?php
    }
    echo $form->field($model, 'hinhanh')->fileInput()->label(false);

    ?>
    <p style="font-style: italic;font-size: 12px;color: black">* Kích thước hình ảnh 150px x 60px</p>
    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
