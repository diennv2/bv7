<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Configure */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cấu hình giao diện';
$this->params['breadcrumbs'][] = ['name' => $this->title, 'link' => 'javascript:void(0)'];
$configlist = \common\models\Configure::getConfig();
CrudAsset::register($this);
$listcat=\common\models\Catproduct::getListCat();
$listProduct=\yii\helpers\ArrayHelper::map(\common\models\Product::find()->all(),'id','name');
?>
<style>
    .frameContainer {
        border: 2px dashed #eeeeee;
        padding: 15px;
        margin: 5px 0;
        background: #dddddd;
    }

    table {
        background: white;
    }
</style>


<?php Pjax::begin(); ?>
<div class="catproduct-index col-xs-12">
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-comments"></i>Bố cục trang chủ
            </div>
            <div class="tools">
                <a href="javascript:;" class="reload">
                </a>
                <?php echo Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['role' => 'modal-remote', 'title' => 'Create new catproduct', 'style' => 'color:white']) ?>
            </div>
        </div>
        <div class="portlet-body ">

            <?php foreach ($data as $dataGiaodien):/** @var \common\models\Configure $dataGiaodien */ ?>
                <div class="frameContainer table-responsive">
                    <table class="table table-hover table-bordered">

                        <tr>
                            <th style="width: 150px">Đối tượng</th>
                            <td style="font-weight: bold">
                                <?php
                                if (explode("_", $dataGiaodien->name)[0] == "slide")
                                    echo "Slide";
                                else
                                    echo "List sản phẩm";
                                ?>
                                <a style="display: inline-flex; padding: 2px" class="glyphicon glyphicon-arrow-up text-info up-item-container" title="Lên trên" control="<?=$dataGiaodien->id?>" ></a>
                                <a style="display: inline-flex; padding: 2px" class="glyphicon glyphicon-arrow-down text-success down-item-container" title="Xuống dưới" control="<?=$dataGiaodien->id?>" ></a>
                                <a style="display: inline-flex; padding: 2px" class="glyphicon glyphicon-remove text-danger delete-item-container" title="Xóa" control="<?=$dataGiaodien->id?>" ></a>

                            </td>

                        </tr>
                        <tr>
                            <th>Nội dung</th>
                            <td>

                                <?php $dulieuhienthis = \yii\helpers\Json::decode($dataGiaodien->value);?>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <tr><th colspan="2" style="background: wheat;text-align: center">Thuộc tính</th></tr>
                                    <tr>
                                        <td style="width: 150px">
                                            Tên hiển thị
                                        </td>
                                        <td >
                                            <a href="javascript:;" class="editable" data-name="tenhienthi" data-type="text" data-pk="<?=$dataGiaodien->id?>"
                                               data-original-title="Enter username">
                                                <?= (isset($dulieuhienthis['tenhienthi']))?$dulieuhienthis['tenhienthi']:"Không có"?> </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 150px">
                                            Khung viền
                                        </td>
                                        <td>
                                                <?= (isset($dulieuhienthis['background']))?"<img style='width:100%' src='".Yii::$app->urlManagerFrontend->baseUrl.$dulieuhienthis['background']."'>":"Không có"?>
                                                <?=Html::beginForm(['configure/updateimage'],'post',['enctype'=>'multipart/form-data','id'=>'form-'.$dataGiaodien->id]);?>
                                                    <input type="file" name="fileupload" class="hidden fileupload"  data-target="<?=$dataGiaodien->id?>" id="file-<?=$dataGiaodien->id?>">
                                                    <input type="number" class="hidden" name="id" value="<?=$dataGiaodien->id?>">
                                                    <?=Html::endForm();?>
                                            <a class="btn btn-success btn-submitfile" data-target="<?=$dataGiaodien->id?>" style="margin-top: 10px">Thay ảnh</a>
                                            <a class="btn btn-success btn-deletefile" data-target="<?=$dataGiaodien->id?>" style="margin-top: 10px">Xóa ảnh</a>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 150px">
                                            Mã màu viền
                                        </td>
                                        <td >
                                            <a href="javascript:;" class="editable" data-name="mauvien" data-type="text" data-pk="<?=$dataGiaodien->id?>"
                                               data-original-title="Enter username">
                                                <?= (isset($dulieuhienthis['mauvien']))?$dulieuhienthis['mauvien']:"Không có"?> </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 150px">
                                            Độ dày viền (px)
                                        </td>
                                        <td >
                                            <a href="javascript:;" class="editable" data-name="dodayvien" data-type="number" data-pk="<?=$dataGiaodien->id?>"
                                               data-original-title="Enter username">
                                                <?= (isset($dulieuhienthis['dodayvien']))?$dulieuhienthis['dodayvien']:"0"?> </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 150px">
                                            Ảnh sản phẩm đầu tiên (nổi bật)
                                        </td>
                                        <td>
                                            <?= (isset($dulieuhienthis['backgroundnoibat']))?"<img style='max-height:150px' src='".Yii::$app->urlManagerFrontend->baseUrl.$dulieuhienthis['backgroundnoibat']."'>":"Không có"?>
                                            <?=Html::beginForm(['configure/updateimagebackgroundnoibat'],'post',['enctype'=>'multipart/form-data','id'=>'formbackgroundnoibat-'.$dataGiaodien->id]);?>
                                            <input type="file" name="fileuploadbackgroundnoibat" class="hidden fileuploadbackgroundnoibat"  data-target="<?=$dataGiaodien->id?>" id="filebackgroundnoibat-<?=$dataGiaodien->id?>">
                                            <input type="number" class="hidden" name="id" value="<?=$dataGiaodien->id?>">
                                            <?=Html::endForm();?>
                                            <a class="btn btn-success btn-submitfilebackgroundnoibat" data-target="<?=$dataGiaodien->id?>" style="margin-top: 10px">Thay ảnh</a>
                                            <a class="btn btn-success btn-deletefilebackgroundnoibat" data-target="<?=$dataGiaodien->id?>" style="margin-top: 10px">Xóa ảnh</a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Số sản phẩm hiển thị
                                        </td>
                                        <td >
                                            <a href="javascript:;" class="editable" data-name="sosanphamhienthi"  data-type="number" data-pk="<?=$dataGiaodien->id?>"
                                               data-original-title="Enter username">
                                                <?= (isset($dulieuhienthis['sosanphamhienthi']))?$dulieuhienthis['sosanphamhienthi']:"Không có"?> </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Đường dẫn xem thêm
                                        </td>
                                        <td >
                                            <a href="javascript:;" class="editable" data-name="duongdanxemthem"  data-type="text" data-pk="<?=$dataGiaodien->id?>"
                                               data-original-title="Enter username">
                                                <?= (isset($dulieuhienthis['duongdanxemthem']))?$dulieuhienthis['duongdanxemthem']:"Không có"?> </a>
                                        </td>
                                    </tr>
                                    <?php if(isset($dulieuhienthis['nguondulieu'])):?>
                                        <tr>
                                            <td>
                                                Loại dữ liệu
                                            </td>
                                            <td>
                                                <?=[0=>'Danh mục sản phẩm',1=>'Danh mục sản phẩm tự định nghĩa'][$dulieuhienthis['nguondulieu']]?>
                                            </td>
                                        </tr>
                                    <tr>
                                        <td>
                                            Chi tiết sản phẩm
                                        </td>
                                        <td>
                                            <?php if($dulieuhienthis['nguondulieu']==0):?>
                                                 <?=
                                                    Html::dropDownList('listsanpham[danhmucsanpham]',(int)$dulieuhienthis['danhmucsanpham'],$listcat,['control'=>$dataGiaodien->id,'class'=>'drop-linkss form-control'])
                                                ?>
                                            <?php else:?>
                                                <?php if (isset($dulieuhienthis['danhmucsanphamtudinhnghia'])):?>

                                                    <table id="tabledanhmucsp-<?=$dataGiaodien->id?>" class="danhmucsps table table-hover table-bordered table-striped">
                                                        <tr><th colspan="2" style="background: #2ea8e5"> Danh mục sản phẩm:</th></tr>
                                                        <tr><th colspan="2"> <?=Html::dropDownList('sanphamlist','',\yii\helpers\ArrayHelper::map(func::getProductsByCat(),'value','text','group'),['prompt'=>'Chọn','class'=>'form-control drop-product-view',"control"=>$dataGiaodien->id,'vals'=>$dataGiaodien->id])?></th></tr>
                                                    <?php foreach ($dulieuhienthis['danhmucsanphamtudinhnghia'] as $value):?>
                                                            <tr id='tr-<?=$value?>'>
                                                            <td><?=(isset($listProduct[$value]))?$listProduct[$value]:"<span class='label label-danger'>Sản phẩm không tồn tại hoặc đã bị xóa bỏ</span>"?></td>
                                                            <td><a style='display: inline-flex; padding: 2px' class='glyphicon glyphicon-arrow-up text-info up-item' title='Lên trên' control="<?=$dataGiaodien->id?>" vals='<?=$value?>'></a>
                                                                <a style='display: inline-flex; padding: 2px' class='glyphicon glyphicon-arrow-down text-success down-item' title='Xuống dưới' control="<?=$dataGiaodien->id?>" vals='<?=$value?>'></a>
                                                                <a style='display: inline-flex; padding: 2px' class='glyphicon glyphicon-remove text-danger delete-item' title='Xóa' control="<?=$dataGiaodien->id?>" vals='<?=$value?>'></a>
                                                            </td></tr>

                                                    <?php endforeach;?>
                                                    </table>
                                                <?php endif;?>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    <?php else:?>
                                        <tr><th colspan="2">Có lỗi trong cấu hình. vui lòng xóa phần này</th></tr>
                                    <?php endif;?>
                                    </tbody>
                                </table>

                            </td>
                        </tr>

                    </table>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php Pjax::end(); ?>

<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
    "size" => 'modal-lg',
    'options' => [
        "data-backdrop" => "static",
        "data-keyboard" => "false",
        'tab-index' => -1
    ]
]) ?>
<?php Modal::end(); ?>

<script>
    $(document).ready(function () {
        $.fn.editable.defaults.mode = 'inline';
        $('.editable').editable({
            url: '<?=Yii::$app->urlManager->createUrl(['configure/updatethemeconfigure'])?>',
        });

        $(document).on('change', '#kieuselect', function () {
            var self = $(this);
            var doituong = $("#doituong");
            if (self.val() == "") {
                doituong.html("");
            } else {
                $.ajax({
                    url: '/admin/configure/gettype?type=' + self.val(),
                    beforeSend: function () {
                        block({target: "#doituong"});
                    },
                    success: function (data) {
                        doituong.html(data);
                        unblock("#doituong");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        doituong.html("Có lỗi xảy ra. Error code: " + jqXHR.status + ". Message: " + errorThrown);

                        unblock("#doituong");
                    }
                })
            }
        });
        $(document).on('change', '#dulieu', function () {
            var self = $(this);
            var dmsp = $("#divdanhmucsanpham");
            var smsptnd = $("#divdanhmucsanphamtudinhnghia");
            if (self.val() == 0) {
                dmsp.attr('class', 'form-group');
                smsptnd.attr('class', 'form-group hidden');
            } else {
                smsptnd.attr('class', 'form-group');
                dmsp.attr('class', 'form-group hidden');
            }
        });
        $(document).on('change', '#dulieu', function () {
            var self = $(this);
            var dmsp = $("#divdanhmucsanpham");
            var smsptnd = $("#divdanhmucsanphamtudinhnghia");
            if (self.val() == 0) {
                dmsp.attr('class', 'form-group');
                smsptnd.attr('class', 'form-group hidden');
            } else {
                smsptnd.attr('class', 'form-group');
                dmsp.attr('class', 'form-group hidden');
            }
        });
        $(document).on('change', '#drop-product', function () {
            var data = $('#drop-product').select2('data')

            if (data[0].id != "") {
                if ($("#dulieutudinhnghia").find("#tr-" + data[0].id).length == 0) {
                    $("#dulieutudinhnghia tr:last").after("<tr id='tr-" + data[0].id + "'><td><input name='listsanpham[danhmucsanphamtudinhnghia][]' class='hidden' value='" + data[0].id + "'>" + data[0].text + "</td><td>" +
                        "<a style='display: inline-flex; padding: 2px' class='glyphicon glyphicon-arrow-up text-info up-item' title='Lên trên' vals='" + data[0].id + "'></a>" +
                        "<a style='display: inline-flex; padding: 2px' class='glyphicon glyphicon-arrow-down text-success down-item' title='Xuống dưới' vals='" + data[0].id + "'></a>" +
                        "<a style='display: inline-flex; padding: 2px' class='glyphicon glyphicon-remove text-danger delete-item' title='Xóa' vals='" + data[0].id + "'></a>" +

                        "</td></tr>");
                }
            }
        });
        $(".drop-product-view").select2({
            closeOnSelect: false
        });
        $(document).on('change', '.drop-product-view', function () {
            var self = $(this);
            var data = $(this).select2('data')
            var table = $("#tabledanhmucsp-"+self.attr('vals'));
            var control = self.attr('control');
            if (data[0].id != "") {
                if (table.find("#tr-" + data[0].id).length == 0) {
                    $.ajax({
                        url:"<?=Yii::$app->urlManager->createUrl(['configure/additem'])?>",
                        type:'post',
                        data:{
                            id:control,
                            item:data[0].id,
                        },
                        success: function () {
                            $("#tabledanhmucsp-"+self.attr('vals')+" tr:last").after("<tr id='tr-" + data[0].id + "'><td>" + data[0].text.split("|--")[1] + "</td><td>" +
                                "<a style='display: inline-flex; padding: 2px' class='glyphicon glyphicon-arrow-up text-info up-item' title='Lên trên' control='"+control+"' vals='" + data[0].id + "'></a>" +
                                "<a style='display: inline-flex; padding: 2px' class='glyphicon glyphicon-arrow-down text-success down-item' title='Xuống dưới' control='"+control+"' vals='" + data[0].id + "'></a>" +
                                "<a style='display: inline-flex; padding: 2px' class='glyphicon glyphicon-remove text-danger delete-item' title='Xóa' control='"+control+"' vals='" + data[0].id + "'></a>" +

                                "</td></tr>");
                        },
                        error:function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: 'Đã có lỗi xảy ra, vui lòng liên hệ quản trị viên'
                            })
                        }
                    });
                   
                }
            }
        });
        $(document).on('click', '.delete-item', function () {
            var self = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "Bạn muốn xóa mục này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa!'
            }).then((result) => {
                if (result.value) {
                    self.parent().parent().remove();
                    Swal.fire(
                        'Đã xóa!',
                        'Đã xóa khỏi danh sách.',
                        'success'
                    )
                }
            })
        });
        $(document).on('click', '#doituong .up-item', function () {
            var self = $(this);
            var row_index = self.parent().parent().index();
            if(row_index===1){
                return false
            }else{
                self.parent().parent().insertBefore(self.parent().parent().prev());
            }
        });
        $(document).on('click', '#doituong .down-item', function () {
            var self = $(this);
            self.parent().parent().insertAfter(self.parent().parent().next());
        });

        $(document).on('click', '.danhmucsps .up-item', function () {
            var self = $(this);
            var row_index = self.parent().parent().index();
            if(row_index===2){
                return false
            }else{
                self.parent().parent().insertBefore(self.parent().parent().prev());
                var control = self.attr('control');
                var item = self.attr('vals');
                $.ajax({
                    url:"<?=Yii::$app->urlManager->createUrl(['configure/updateposition'])?>",
                    type:'post',
                    data:{
                        id:control,
                        item:item,
                        type:"up"
                    }
                })
            }
        });
        $(document).on('click', '.danhmucsps .down-item', function () {
            var self = $(this);
            if(!self.parent().parent().is(":last-child"))
            {
                self.parent().parent().insertAfter(self.parent().parent().next());
                var control = self.attr('control');
                var item = self.attr('vals');

                $.ajax({
                    url:"<?=Yii::$app->urlManager->createUrl(['configure/updateposition'])?>",
                    type:'post',
                    data:{
                        id:control,
                        item:item,
                        type:"down"
                    }
                })
            }
        });
        $(document).on('click', '.danhmucsps .delete-item', function () {
            var self = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "Bạn muốn xóa mục này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa!'
            }).then((result) => {
                if (result.value) {
                    self.parent().parent().remove();
                    var control = self.attr('control');
                    var item = self.attr('vals');
                    $.ajax({
                        url:"<?=Yii::$app->urlManager->createUrl(['configure/updateposition'])?>",
                        type:'post',
                        data:{
                            id:control,
                            item:item,
                            type:"delete"
                        }
                    });
                    Swal.fire(
                        'Đã xóa!',
                        'Đã xóa khỏi danh sách.',
                        'success'
                    )
                }
            })

        });
        $(document).on('change', '.drop-linkss', function () {
            var self = $(this);

            var control = self.attr('control');
            var item = self.val();
            $.ajax({
                url:"<?=Yii::$app->urlManager->createUrl(['configure/changecatproduct'])?>",
                type:'post',
                data:{
                    id:control,
                    item:item
                }
            })
        });
        $(document).on('click', '.up-item-container', function () {
            var self = $(this);
            var element=self.closest('.frameContainer ');
            var row_index = element.index();
            if(row_index===0){
                return false
            }else{
                var swap =$(element.prev().find(".up-item-container")[0]).attr('control');
                element.insertBefore(element.prev());
                var control = self.attr('control');

                $.ajax({
                    url:"<?=Yii::$app->urlManager->createUrl(['configure/updateorder'])?>",
                    type:'post',
                    data:{
                        id:control,
                        swap:swap,
                        type:"up"
                    }
                })
            }
        });

        $(document).on('click', '.down-item-container', function () {
            var self = $(this);
            var element=self.closest('.frameContainer ');
            var row_index = element.index();
            var swap =$(element.next().find(".up-item-container")[0]).attr('control');
            element.insertAfter(element.next());
            var control = self.attr('control');

            if (swap!=undefined)
            {
                $.ajax({
                    url:"<?=Yii::$app->urlManager->createUrl(['configure/updateorder'])?>",
                    type:'post',
                    data:{
                        id:control,
                        swap:swap,
                        type:"down"
                    }
                })
            }
        });
        $(document).on('click', '.delete-item-container', function () {
            var self = $(this);
            var element=self.closest('.frameContainer ');
            Swal.fire({
                title: 'Are you sure?',
                text: "Bạn muốn xóa mục này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa!'
            }).then((result) => {
                if (result.value) {
                    element.remove();
                    var control = self.attr('control');

                    $.ajax({
                        url:"<?=Yii::$app->urlManager->createUrl(['configure/updateorder'])?>",
                        type:'post',
                        data:{
                            id:control,
                            type:"delete"
                        }
                    });
                    Swal.fire(
                        'Đã xóa!',
                        'Đã xóa khỏi danh sách.',
                        'success'
                    )
                }
            })
        });
        $(document).on('click','.btn-submitfile',function () {
           var self=$(this);
           var target = self.attr('data-target');
           $("#file-"+target).click();
        });

        $(document).on('click','.btn-submitfilebackgroundnoibat',function () {
           var self=$(this);
           var target = self.attr('data-target');
           $("#filebackgroundnoibat-"+target).click();
        });
        $(document).on('click','.btn-deletefile',function () {
           var self=$(this);
           var target = self.attr('data-target');
            $.ajax({
                url:"<?=Yii::$app->urlManager->createUrl(['configure/deleteimage'])?>",
                type:'post',
                data:{
                    id:target,
                },
                success:function () {
                    location.reload();
                }
            })
        });
        $(document).on('click','.btn-deletefilebackgroundnoibat',function () {
           var self=$(this);
           var target = self.attr('data-target');
            $.ajax({
                url:"<?=Yii::$app->urlManager->createUrl(['configure/deleteimagebackgroundnoibat'])?>",
                type:'post',
                data:{
                    id:target,
                },
                success:function () {
                    location.reload();
                }
            })
        });
        $(document).on('change','.fileupload',function () {
            var self=$(this);
            console.log(self.val());
            var target = self.attr('data-target');
            if(self.val()!=null && self.val()!=""){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Cập nhật ảnh này!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK!'
                }).then((result) => {
                    if (result.value) {
                        $("#form-"+target).submit();
                    }
                })
            }
        });
        $(document).on('change','.fileuploadbackgroundnoibat',function () {
            var self=$(this);
            console.log(self.val());
            var target = self.attr('data-target');
            if(self.val()!=null && self.val()!=""){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Cập nhật ảnh này!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK!'
                }).then((result) => {
                    if (result.value) {
                        $("#formbackgroundnoibat-"+target).submit();
                    }
                })
            }
        })

    })
</script>