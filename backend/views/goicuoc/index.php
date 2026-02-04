<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\GoicuocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goicuocs';
$this->params['breadcrumbs'][] = ['name'=>$this->title,'link'=>'javascript:void(0)'];

CrudAsset::register($this);

?>
<style>
    .btn-update-status {
        display: block;
        width: 200px;
        margin: 5px;
    }
</style>
<div class="goicuoc-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> 'Create new Goicuocs','class'=>'btn btn-default']).
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
                'heading' => '<i class="glyphicon glyphicon-list"></i> Goicuocs listing',
                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
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
])?>
<?php Modal::end(); ?>
<script>
    $(document).ready(function () {
        $(document).on('click','.btn-update-status',function(){
            var self = $(this);
            $.ajax({
                url:"<?=Yii::$app->urlManager->createUrl(['goicuoc/updatestatus'])?>",
                type:'post',
                dataType:'json',
                data:{
                    id:self.attr('vals'),
                    type: self.attr('types')
                },
                complete: function () {
                    $.pjax.reload({container: '#crud-datatable-pjax'});
                }
            })
        }),
        $(document).on('click','.btn-update-statususer',function(){
            var self = $(this);
            $.ajax({
                url:"<?=Yii::$app->urlManager->createUrl(['goicuoc/updatestatususer'])?>",
                type:'post',
                dataType:'json',
                data:{
                    user_id:self.attr('user'),
                    type: self.attr('types')
                },
                complete: function () {
                    $.pjax.reload({container: '#crud-datatable-pjax'});
                }
            })
        })
    })
</script>