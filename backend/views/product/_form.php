<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
\johnitvn\ajaxcrud\CrudAsset::register($this);
$this->title = 'Update sản phẩm';
$this->params['breadcrumbs'][] = ['name' => 'Sản phẩm', 'link' => 'javascript:void(0)'];
$a = \common\models\Catproduct::getListCat();
$escape = new \yii\web\JsExpression("function(m){ return m;}");

$thongsos = \common\models\Properties::getThongso($model->catProduct->id);
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-group">

        <?php if (!Yii::$app->request->isAjax) { ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Lưu lại' : 'Cập nhật', ['id' => 'btn-luu', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        <?php } ?>
    </div>
    <div style="padding-bottom: 20px">
        <ul class="nav nav-tabs">
            <li style="padding-left: 12px" class="active"><a href="#tab1" data-toggle="tab">Thông tin cơ bản</a></li>
            <!--<li><a href="#tab2" data-toggle="tab">Thông số sản phẩm</a></li>-->
        </ul>
    </div>

    <div class="tab-content">
        <div class="content-form tab-pane fade in active" id="tab1">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-6">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(func::generate_sup_script($model,'name',"Tên hiển thị của sản phẩm")) ?>
                        </div>

                        <div class="col-xs-2">
                            <?= $form->field($model, 'sale')->textInput()->label(func::generate_sup_script($model,'sale',"Giá bán hiển thị của sản phẩm")) ?>
                        </div>

                        <div class="col-xs-2">
                            <?= $form->field($model, 'retail')->textInput()->label(func::generate_sup_script($model,'retail',"Giá gốc hiển thị của sản phẩm, nếu giá bán thấp hơn giá gốc sẽ được biểu diễn dưới dạng giảm giá")) ?>
                        </div>

                        <div class="col-xs-2">
                            <?= $form->field($model, 'code')->numberInput() ?>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $("#product-sale").inputmask("decimal",{
                                    radixPoint:".",
                                    groupSeparator: ",",
                                    digits: 0,
                                    autoGroup: true,
                                    suffix: ' VNĐ'
                                });
                                $("#product-retail").inputmask("decimal",{
                                    radixPoint:".",
                                    groupSeparator: ",",
                                    digits: 0,
                                    autoGroup: true,
                                    suffix: ' VNĐ'
                                });
                            });
                        </script>
                    </div>




                    <div class="row">
                        <div class="col-xs-6">
                            <?= $form->field($model, 'cat_product_id')->widget(\kartik\select2\Select2::className(), [
                                'data' => $a,
                                'language' => 'vi',
                                'options' => ['placeholder' => 'Chọn loại sản phẩm ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?= $form->field($model, 'brand_id')->widget(\kartik\select2\Select2::className(), [
                                'data' => \yii\helpers\ArrayHelper::map(\common\models\Brand::find()->all(), 'id', 'name'),
                                'language' => 'vi',
                                'options' => ['placeholder' => 'Chọn thương hiệu ...'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <?= $form->field($model, 'status')->dropDownList([0=>'Còn hàng',1=>'Hết hàng']) ?>
                        </div>
                        <div class="col-xs-3">
                            <?= $form->field($model, 'active')->checkbox() ?>
                        </div>
                        <div class="col-xs-3">
                            <?= $form->field($model, 'home')->checkbox() ?>
                        </div>
                        <div class="col-xs-3">
                            <?= $form->field($model, 'hot')->checkbox() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $now = getdate();
                            $nowfullstring = $now["mday"]."/".$now["mon"]."/".$now["year"];
                            ?>
                            <a href="/2595fcc932fcbc933591f65b0927f6ad/responsive_filemanager/filemanager/dialog.php?type=2&akey=<?=sha1("Karion3e0d56c94e15c78d3fe012bc33aba5252020".sha1($nowfullstring))?>&field_id=product-ebook&multiple=1&&relative_url=1fldr=" class="btn btn-success iframe-btn" type="button">Chọn Ebook</a>
                            <?= $form->field($model, 'ebook')->textInput(); ?>
                            <script>
                                $(document).ready(function () {
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



                                    $('#download-button').on('click', function() {
                                        ga('send', 'event', 'button', 'click', 'download-buttons');
                                    });
                                    $('.toggle').click(function(){
                                        var _this=$(this);
                                        $('#'+_this.data('ref')).toggle(200);
                                        var i=_this.find('i');
                                        if (i.hasClass('icon-plus')) {
                                            i.removeClass('icon-plus');
                                            i.addClass('icon-minus');
                                        }else{
                                            i.removeClass('icon-minus');
                                            i.addClass('icon-plus');
                                        }
                                    });
                                });
                            </script>
                        </div>
                        <div class="col-xs-12">
                            <?= $form->field($model, 'seo_title')->textInput(); ?>
                        </div>
                        <div class="col-xs-12">
                            <?= $form->field($model, 'seo_desc')->textInput(); ?>
                        </div>
                        <div class="col-xs-12">
                            <?= $form->field($model, 'seo_keyword')->textInput() ?>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xs-6">
                            <?= $form->field($model, 'tag')->textInput()->label(func::generate_sup_script($model,'tag',"Note ngắn hiển thị trên sản phẩm")) ?>
                        </div>
                        <div class="col-xs-6">
                            <?= $form->field($model, 'tags')->textInput() ?>
                        </div>
                    </div>

                    <div class="row">


                        <div class="col-xs-12">
                            <?= $form->field($model, 'brief')->textarea(['id' => 'brief']) ?>
                        </div>
                        <div class="col-xs-12">
                            <?= $form->field($model, 'decription')->textarea(['id' => 'noidung']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <?= Html::label('Ảnh sản phẩm', 'upload-anh') ?>
                            <?= FileInput::widget([
                                'name' => 'images[]',
                                'pluginOptions' =>
                                    [
                                        'allowedFileExtensions' => ['jpg', 'png'],
                                        'showUpload' => false,
                                        'removeOptions' => ['label' => true],
                                    ],

                                'options' => ['multiple' => true, 'id' => 'upload']
                            ]);
                            ?>
                            <?php if (!$model->isNewRecord): ?>
                                <?php
                                foreach ($model->anhsanphams as $hinhanh) {
                                    ?>
                                    <div class="product-img" id="hinhanh-<?=$hinhanh->id?>">
                                        <div class="image-dele">
                                            <a href="javascript:void(0)"
                                               class="close-img-dele" id="<?=$hinhanh->id?>">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </a>
                                            <img src="<?= Yii::$app->urlManagerFrontend->baseUrl. $hinhanh->image ?>">
                                        </div>
                                        <label class="label-default-img">
                                            <?= Html::radio('default',$hinhanh->default,['id'=>$hinhanh->id,'class'=>'radio-img']) ?>
                                            <strong>Mặc định</strong>
                                        </label>
                                    </div>
                                    <?php
                                }
                            endif;
                            ?>
                        </div>
                    </div>

                </div>


            </div>
        </div>

    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$now = getdate();
$nowfullstring = $now["mday"]."/".$now["mon"]."/".$now["year"];
?>
<script>
    $(document).ready(function () {
        $('#product-tags').tagsInput({
            width: '100%',
            'onAddTag': function () {
                //alert(1);
            }
        });
        CKEDITOR.replace('noidung', {
            language: 'vi',
            filebrowserBrowseUrl:'/2595fcc932fcbc933591f65b0927f6ad/responsive_filemanager/filemanager/dialog.php?type=2&akey=<?=sha1("Karion3e0d56c94e15c78d3fe012bc33aba5252020".sha1($nowfullstring))?>&editor=ckeditor&fldr=',
            filebrowserUploadUrl:'/2595fcc932fcbc933591f65b0927f6ad/responsive_filemanager/filemanager/dialog.php?type=2&akey=<?=sha1("Karion3e0d56c94e15c78d3fe012bc33aba5252020" . sha1($nowfullstring))?>&editor=ckeditor&fldr=',
            filebrowserImageBrowseUrl :'/2595fcc932fcbc933591f65b0927f6ad/responsive_filemanager/filemanager/dialog.php?type=1&akey=<?=sha1("Karion3e0d56c94e15c78d3fe012bc33aba5252020" . sha1($nowfullstring))?>&editor=ckeditor&fldr='
        });

        CKEDITOR.replace('brief', {
            language: 'vi',
            filebrowserBrowseUrl:'/2595fcc932fcbc933591f65b0927f6ad/responsive_filemanager/filemanager/dialog.php?type=2&akey=<?=sha1("Karion3e0d56c94e15c78d3fe012bc33aba5252020".sha1($nowfullstring))?>&editor=ckeditor&fldr=',
            filebrowserUploadUrl:'/2595fcc932fcbc933591f65b0927f6ad/responsive_filemanager/filemanager/dialog.php?type=2&akey=<?=sha1("Karion3e0d56c94e15c78d3fe012bc33aba5252020" . sha1($nowfullstring))?>&editor=ckeditor&fldr=',
            filebrowserImageBrowseUrl :'/2595fcc932fcbc933591f65b0927f6ad/responsive_filemanager/filemanager/dialog.php?type=1&akey=<?=sha1("Karion3e0d56c94e15c78d3fe012bc33aba5252020" . sha1($nowfullstring))?>&editor=ckeditor&fldr='

        });

        $(document).on('click',".close-img-dele",function () {
            var self=$(this);
            $.ajax({
                url:"/admin/product/deleteanh?id="+self.attr("id"),
                type:"get",
                complete:function () {
                    self.closest(".product-img").remove();
                }
            })
        })
    })

</script>