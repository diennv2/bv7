<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = ['name'=>$this->title,'link'=>'javascript:void(0)'];

CrudAsset::register($this);

?>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$now = getdate();
$nowfullstring = $now["mday"]."/".$now["mon"]."/".$now["year"];
?>
<script>
    $(document).ready(function () {
        $('.iframe-btn2').fancybox({
            'width'	: "100%",
            'height'	: "100%",
            'type'	: 'iframe',
            'autoScale'   : true
        });
    })
</script>
<i>** Lưu ý. Với các sản phẩm không cập nhật phiên bản thì mặc định sản phẩm đó tương đương một phiên bản, khách hàng đặt hàng sẽ đặt với giá hiển thị chung của sản phẩm</i>
<div class="product-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjaxSettings' => ['options' => ['enablePushState' => false]],
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="fa fa-file-excel-o"></i> Export danh sách Sách', ['exporttoexcel'],
                        ['title'=> 'Export to excel','data-pjax'=>0,'class'=>'btn btn-default']).
                    Html::a('<i class="fa fa-file-excel-o"></i> Nhập dữ liệu câu hỏi', ['excel'],
                        ['role' => 'modal-remote', 'title' => 'Nhập câu hỏi excel', 'class' => 'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['newform'],
                    ['title'=> 'Create new Products','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Products listing',
                'before' => "",//Html::beginForm(Yii::$app->urlManager->createUrl(['product/import']), 'post', ['enctype' => 'multipart/form-data']) .
//                    Html::submitButton('Nhập dữ liệu', ['class' => 'btn btn-dark pull-left']) .
//                    Html::fileInput('fileSanpham','',['class'=>'pull-left form-control btn btn-default','style'=>'width:250px']) .
//                    Html::endForm(),
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Are you sure?',
                                    'data-confirm-message'=>'Are you sure want to delete this item'
                                ]),
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
    "size"=>"modal-full",
    'options' => ["data-backdrop" => "static", "data-keyboard" => "false", 'tabindex' => false],
])?>
<?php Modal::end(); ?>
<?php Modal::begin([
    "id"=>"ajaxCrudModal2",
    "footer"=>"",// always need it for jquery plugin
    "size"=>"modal-full",
    'options' => ["data-backdrop" => "static", "data-keyboard" => "false", 'tabindex' => false],
])?>
<?php Modal::end(); ?>
<script>
    let dem=1;
    $(document).ready(function () {
        $(document).on('click','#themthuoctinh',function () {
            $.ajax({
               url:"/admin/product/addsingleproperties?numpost="+dem,
               type:'get',
               success:function (data) {
                   $("#ketqua #sstbody").append(data);
                   dem++;
               }
            });

        });
        $(document).on('click','.updatephienbanineditmode',function () {
            var self=$(this);
            var modal = self.attr("data-target");
            $.ajax({
               url:self.attr('data-href'),
               type:'post',
                dataType:'json',
               success:function (data) {
                   $(modal+" .modal-header").html(data.title);
                   $(modal+" .modal-body").html(data.content);
                   $(modal+" .modal-footer").html(data.footer);
               }
            });

        });
        $(document).on('click','#ajaxCrudModal2 button[type="submit"]',function () {
            var self=$('#ajaxCrudModal2 #w0');
            var modal = self.attr("data-target");
            $.ajax({
                url:self.attr('action'),
                type:'post',
                dataType:'json',
                data:self.serialize(),
                success:function (data) {
                    $("#ajaxCrudModal2 .modal-header").html(data.title);
                    $("#ajaxCrudModal2 .modal-body").html(data.content);
                    $("#ajaxCrudModal2 .modal-footer").html(data.footer);
                }
            });

        });
        $(document).on('click','.btn-luu-thuoctinh',function () {
            var selfbtn=$(this);
            var listtr = $(".tr-data-container");
            if(listtr.length===0){
                Swal.fire({
                    icon: 'info',
                    title: 'Oops...',
                    text: 'Không có gì thay đổi!',
                    footer: '<a>Bạn quên gì đó?(chưa thay đổi các thuộc tính)</a>'
                })
            }else{
                var checks=true;
                $.each(listtr,function (index,value) {
                    var self = $(this);
                    var giatien =$("#gia"+self.attr('data-target')).val();
                    var giagoc =$("#giagoc"+self.attr('data-target')).val();

                    if(giatien===null||giatien===undefined || giatien===""||giagoc===null||giagoc===undefined || giagoc===""){
                        checks=false;
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Có thuộc tính chưa chọn giá tiền hoặc giá gốc!',
                            footer: '<a>Bạn quên gì đó?(chưa nhập giá tiền)</a>'
                        })
                    }
                });
                if(checks===true){
                    var dulieuguidi = [];
                    $.each(listtr,function (index,value) {
                        var self = $(this);
                        var target = self.attr('data-target');
                        var giatien =$("#gia"+target).val();
                        var giagoc =$("#giagoc"+target).val();
                        var conhang =$("#conhang"+target).val();
                        var listthuoctinh=[];

                        $.each($(".thuoctinh"+target),function (index2,value2) {
                            var self2=$(this);
                            if(self2.val()!=="" && self2.val()!==null &&self2.val()!==undefined)
                                listthuoctinh.push(self2.val());
                        });
                        dulieuguidi.push({
                            gia:giatien,
                            giagoc:giagoc,
                            conhang:conhang,
                            listthuoctinh:listthuoctinh
                        });
                    });
                    block({target:"body"});
                    $.ajax({
                        url:"<?=Yii::$app->urlManager->createUrl(['product/savethuoctinh'])?>",
                        type:"post",
                        dataType:"json",
                        data:{
                            id: selfbtn.attr("data-target"),
                            data: dulieuguidi
                        },
                        complete:function () {
                            unblock("body");
                        },
                        success:function (data) {
                            if(data.status==="success"){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Cập nhật thành công!',
                                    footer: '',
                                    //onClose: closemodal
                                })
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Có lỗi xảy ra!',
                                    footer: '<a>'+data.errors+'</a>',
                                })
                            }
                        }
                    })
                }
            }
        });
        $(document).on('click','.deletecurrentrow',function () {
            var self=$(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "Gỡ bỏ dòng này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa!'
            }).then((result) => {
                if (result.value) {
                    self.closest('tr').remove();
                    Swal.fire(
                        'Deleted!',
                        'Đã xóa.',
                        'success'
                    )
                }
            })
        });
        $(document).on('click','.deletethuoctinh',function () {
            var self=$(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "Gỡ bỏ dòng này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa!'
            }).then((result) => {
                if (result.value) {
                    self.closest('tr').remove();
                    $.ajax({
                        url:"<?=Yii::$app->urlManager->createUrl(['product/deletethuoctinh'])?>",
                        type:"post",
                        dataType:"json",
                        data:{
                            id: self.attr("data-target")
                        },
                        complete:function () {
                            unblock("body");
                        },
                        success:function (data) {
                            if(data.status==="success"){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Xóa thành công!',
                                    footer: '',
                                    //onClose: closemodal
                                })
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Có lỗi xảy ra!',
                                    footer: '<a>'+data.errors+'</a>',
                                    //onClose: closemodal
                                })
                            }
                        }
                    });

                }
            })
        })
    });
    function  closemodal() {
        $('#ajaxCrudModal').modal('toggle');
        $.pjax.reload({container: '#crud-datatable-pjax'});
    }
</script>