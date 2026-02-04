<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="col-xs-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'type')->dropDownList(\yii\helpers\ArrayHelper::map([['id' => 'top', 'value' => 'Menu header'], ['id' => 'bottom', 'value' => 'Menu footer']], 'id', 'value')) ?>

            <?= $form->field($model, 'link')->dropDownList(\yii\helpers\ArrayHelper::map(func::getMenu(),'value','text','group'),['id'=>'drop-link']) ?>
            <div class="form-group field-lienkettinh" id="divtinh">
                <label class="control-label" for="lienkettinh">Đường dẫn ngoài</label>
                <input type="text" id="lienkettinh" class="form-control" name="Menu[link]" value="<?php echo $model->link?>">
                <div class="help-block"></div>
            </div>

            <?= $form->field($model, 'parent')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Menu::find()->all(), 'id', 'name'),['prompt'=>'Không']) ?>
        </div>
        <div class="col-sm-3 col-xs-6">
            <?= $form->field($model, 'ord')->numberInput() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'new_tab')->checkbox() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'active')->checkbox() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'position')->checkbox() ?>
        </div>
        <div class="col-xs-12">
            <?php if(!$model->isNewRecord): ?>
                <div class="D-imageboxform">
                    <?php
                    echo Html::img(Yii::$app->urlManagerFrontend->baseUrl . $model->background, ['class' => 'D-imageform']);
                    ?>
                </div>
            <?php endif; ?>
            <?= $form->field($model, 'background')->fileInput()?>
        </div>

    <?php if (!Yii::$app->request->isAjax) { ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        <?php } ?>

    <?php ActiveForm::end(); ?>
    <div class="clearfix"></div>
</div>
<script>
    if($("#drop-link").val()!="link")
        $("#divtinh").html("");
    $(document).ready(function () {
        $(document).on('change','#drop-link',function () {
            if($(this).val() !="link"){
                $("#divtinh").html("");
            }else{
                $("#divtinh").html('<label class="control-label" for="lienkettinh">Đường dẫn ngoài</label>'+
                    '<input type="text" id="lienkettinh" class="form-control" name="Menu[link]" value="<?php echo $model->link?>">'+
                    '<div class="help-block">'+
                    '</div>');
            $("#lienkettinh").focus();}
        })
    })
</script>

<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('#<?=Yii::$app->controller->id?>-name').focus()
        },700)
    })
</script>