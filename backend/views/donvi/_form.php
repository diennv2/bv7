<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Donvi */
/* @var $form yii\widgets\ActiveForm */
\johnitvn\ajaxcrud\CrudAsset::register($this);
?>
<h4 class="modal-title" style="padding: 15px 0;font-size: 22px"><?php echo($model->isNewRecord)?"Thêm mới":"Cập nhật";?> đơn vị</h4>
<div class="donvi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'companyname')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'aboutcompany')->textarea(['rows' => 6,'id'=>'noidung']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$now = getdate();
$nowfullstring = $now["mday"]."/".$now["mon"]."/".$now["year"];
?>
<script>

    $(document).ready(function () {

        CKEDITOR.replace('noidung',{
            language: 'vi',
            filebrowserBrowseUrl:'/2595fcc932fcbc933591f65b0927f6ad/responsive_filemanager/filemanager/dialog.php?type=2&akey=<?=sha1("Karion3e0d56c94e15c78d3fe012bc33aba5252020".sha1($nowfullstring))?>&editor=ckeditor&fldr=',
            filebrowserUploadUrl:'/2595fcc932fcbc933591f65b0927f6ad/responsive_filemanager/filemanager/dialog.php?type=2&akey=<?=sha1("Karion3e0d56c94e15c78d3fe012bc33aba5252020" . sha1($nowfullstring))?>&editor=ckeditor&fldr=',
            filebrowserImageBrowseUrl :'/2595fcc932fcbc933591f65b0927f6ad/responsive_filemanager/filemanager/dialog.php?type=1&akey=<?=sha1("Karion3e0d56c94e15c78d3fe012bc33aba5252020" . sha1($nowfullstring))?>&editor=ckeditor&fldr='
        });

    })
</script>
