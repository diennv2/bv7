<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ListnhanquaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách nhận quà';
$this->params['breadcrumbs'][] = ['name'=>$this->title,'link'=>'javascript:void(0)'];

CrudAsset::register($this);

?>
<div class="listnhanqua-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>

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
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách nhận quà listing',
                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Bạn có chắc chắn không?',
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
    'size'=>'modal-full'
])?>
<?php Modal::end(); ?>
<script>
    $(document).ready(function () {
        $(document).on('click',".btn-change-stt",function () {
            var self=$(this);
            $.ajax({
               url:"<?=Yii::$app->urlManager->createUrl(['listnhanqua/sttchange'])?>",
               type:'post',
               dataType:'json',
               data:{
                   id: self.attr('data-target')
               },
               success:function () {
                   $.pjax.reload({container: '#crud-datatable-pjax'});
               } 
            });
        });
        $(document).on('click','.btn-traothuong',function () {
            var self=$(this);
            Swal.fire({
                title: 'Bạn có chăc chắn không?',
                text: "Sau khi trao thưởng sẽ không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:"<?=Yii::$app->urlManager->createUrl(['listnhanqua/traothuong'])?>",
                        type:'post',
                        dataType:'json',
                        data:{
                            id: self.attr('data-target')
                        },
                        success:function () {
                            $.pjax.reload({container: '#crud-datatable-pjax'});
                        }
                    });
                }
            })
        })
    })
</script>