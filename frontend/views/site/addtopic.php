<?php

$config = \common\models\Configure::getConfig();


use common\models\Configure;
use yii\widgets\ActiveForm;

\johnitvn\ajaxcrud\CrudAsset::register($this);

?>
<div class="col-xs-12"
     style="background-image: url(<?= $product->getDefaultImage() ?>);position: absolute;left: 0;padding-top: 10vh;padding-bottom: 10vh;">
    <div class="ttxxx">
        <h1 class="thaoluantitle">Thêm bài viết topic: <span><?= $product->name ?></span></h1>
    </div>
</div>
<style>
    .ttxxx:after {
        content: "";
        position: absolute;
        left: 0;
        width: 100%;
        height: 100%;
        top: 0;
        background: #00000085;
        z-index: 98;
    }

    .thaoluantitle {
        text-transform: uppercase;
        font-size: 2em;
        font-weight: bold;
        color: #f0f0f0;
        z-index: 99;
        position: absolute;
        left: 0;
        width: 100%;
        margin: 15px 0;
        text-align: center;
    }
</style>
<div class="backgroundwhite" style="min-height: 100vh;margin-top: 20vh">
    <div class="container" style="padding: 3vh 0;clear: both">

        <div class="col-xs-12" style="padding-top: 10px">
            <?php

            use yii\helpers\Html;


            /* @var $this yii\web\View */
            /* @var $model common\models\Topic */
            /* @var $form yii\widgets\ActiveForm */
            ?>

            <div class="topic-form">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <div class="hidden">
                    <?= $form->field($model, 'userid')->textInput() ?>

                    <?= $form->field($model, 'sachid')->textInput() ?>

                </div>

                <?= $form->field($model, 'imageUpload')->fileInput() ?>

                <?= $form->field($model, 'brief')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'noidung')->textarea(['rows' => 6]) ?>

                <?php if (!Yii::$app->request->isAjax) { ?>
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Đăng topic này' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                <?php } ?>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('topic-noidung', {
            language: 'vi',
            });
    })
</script>