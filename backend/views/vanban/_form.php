<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Vanban */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #fancybox-wrap{
        z-index: 10050;
    }
</style>
<div class="vanban-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mavanban')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'ngayvanban')->input("date") ?>

    <?= $form->field($model, 'trichyeu')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'filedinhkem')->textInput(['rows' => 6]) ?>

    <?=func::generateFileButton('Chọn File','btn-success','vanban-filedinhkem')?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'home')->textInput() ?>

    <?= $form->field($model, 'danhmuc')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Danhmucvanban::find()->all(),'id','loaivanban'),['id'=>'dropx']) ?>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    <script>
        $(document).ready(function (){
            $("#dropx").select2();
        })
        $('.iframe-btn').fancybox({
            'width'	: 880,
            'height'	: 570,
            'type'	: 'iframe',
            'autoScale'   : false
        });
        //
        // Handles message from ResponsiveFilemanager
        //
        function OnMessage(e){
            var event = e.originalEvent;
            // Make sure the sender of the event is trusted
            if(event.data.sender === 'responsivefilemanager'){
                if(event.data.field_id){
                    var fieldID=event.data.field_id;
                    var url=event.data.url;
                    $('#'+fieldID).val(url).trigger('change');
                    $.fancybox.close();

                    // Delete handler of the message from ResponsiveFilemanager
                    $(window).off('message', OnMessage);
                }
            }
        }

        // Handler for a message from ResponsiveFilemanager
        $('.iframe-btn').on('click',function(){
            $(window).on('message', OnMessage);
        });
    </script>
</div>

