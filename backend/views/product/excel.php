<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Giaykhaisinh */
/* @var $form yii\widgets\ActiveForm */
\kartik\select2\Select2Asset::register($this);
?><script>unblock('.modal-content')</script>

<div class="giaykhaisinh-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
       <div class="form-group col-md-6 col-xs-12">
           <?=Html::label('File input','');?>
           <?=Html::fileInput('upload')?>
       </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $(document).ready(function () {
        $("#user").select2();
        $(document).on('click','#nhaplieu',function () {
            block({target: ".modal-content"});
            setTimeout(function () {
                $("#sub").click();
            },500);
        })
    })
</script>