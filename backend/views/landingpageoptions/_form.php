<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Landingpageoptions */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="landingpageoptions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList([
            'image'=>'Image',
            'product'=>'Product',
            'listvideo'=>'List Video',
            'new'=>'Tin tức'
    ]) ?>
    <div id="for-image" class="inputhidden">
        <?= $form->field($model, 'value')->textInput(['maxlength' => true])->label("Đường dẫn ảnh") ?>
        <?=func::generateFileButton('Chọn ảnh','btn-success','landingpageoptions-value')?>
        <?= $form->field($model, 'valuemobile')->textInput(['maxlength' => true])->label("Đường dẫn ảnh trên mobile") ?>
        <?=func::generateFileButton('Chọn ảnh','btn-success','landingpageoptions-valuemobile')?>
    </div>
    <div id="for-product" class="inputhidden">
        <div class="form-group required has-error">
            <label class="control-label" for="listsanpham">List Sản phẩm</label>
            <?=Html::dropDownList('listproduct',((!$model->isNewRecord && $model->type=='product')?\yii\helpers\Json::decode($model->value):""),\yii\helpers\ArrayHelper::map(\common\models\Product::find()->all(),'id','name'),['id'=>'listsanpham','multiple'=>true])?>
        </div>
    </div>
    <div id="for-listvideo" class="inputhidden">
        <label class="control-label" for="listvideo">List Video</label>
        <?php $valuevideo = ((!$model->isNewRecord  && $model->type=='listvideo')?\yii\helpers\Json::decode($model->value):"")?>
        <input type="text" id="listvideo-1" value="<?=((!$model->isNewRecord && isset($valuevideo[0]))?$valuevideo[0]:"")?>" class="form-control" name="listlistvideo[]" placeholder="Youtube Video Code" aria-required="true" aria-invalid="true">
        <input type="text" id="listvideo-2" value="<?=((!$model->isNewRecord && isset($valuevideo[1]))?$valuevideo[1]:"")?>" class="form-control" name="listlistvideo[]" placeholder="Youtube Video Code" aria-required="true" aria-invalid="true">
        <input type="text" id="listvideo-3" value="<?=((!$model->isNewRecord && isset($valuevideo[2]))?$valuevideo[2]:"")?>" class="form-control" name="listlistvideo[]" placeholder="Youtube Video Code" aria-required="true" aria-invalid="true">
    </div>
    <div id="for-new" class="inputhidden">
        <div class="form-group required has-error">
            <label class="control-label" for="listtintuc">List Tin tức</label>
            <?=Html::dropDownList('listnew',((!$model->isNewRecord && $model->type=='new')?\yii\helpers\Json::decode($model->value):""),\yii\helpers\ArrayHelper::map(\common\models\News::find()->all(),'id','title'),['id'=>'listtintuc','multiple'=>true])?>

        </div>
    </div>
    <div style="margin-bottom: 15px" class="clearfix"></div>
    <?= $form->field($model, 'target')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'backgroundimage')->textInput(['rows' => 6]) ?>
    <?=func::generateFileButton('Chọn ảnh background','btn-success','landingpageoptions-backgroundimage')?>
    <div class="hidden">
    <?= $form->field($model, 'landing_id')->textInput() ?>
    </div>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script>
    $(document).ready(function ($) {
        $("#listsanpham, #listtintuc").select2({
            closeOnSelect: false
        });
        $('.inputhidden').fadeOut(0);
        <?php if(!$model->isNewRecord):?>
            $("#for-<?=$model->type?>").fadeIn(0);
        <?php elseif($model->type!="image" && $model->type!=""):?>
            $("#for-<?=$model->type?>").fadeIn(0);
        <?php else:?>
            $("#for-image").fadeIn(0);
        <?php endif;?>
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



    });
</script>