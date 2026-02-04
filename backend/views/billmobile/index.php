<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\BillmobileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Billmobiles';
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
<div class="billmobile-index">
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
                'heading' => '<i class="glyphicon glyphicon-list"></i> Billmobiles listing',
                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    'size'=>'modal-full',
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
<script>
    $(document).ready(function () {
        $(document).on('click','.btn-update-status',function(){
            var self = $(this);
            $.ajax({
                url:"<?=Yii::$app->urlManager->createUrl(['billmobile/updatestatus'])?>",
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
        })
        $(document).on('click','.inbill',function(){
            var self = $(this);
            var id = self.attr("target-id");
            var customWindow = window.open("<?= Yii::$app->urlManager->createUrl(['site/inbill'])?>?id="+id,'_blank',"");
            setTimeout(function () {
                customWindow.close(reloadscreen());
            },1000);
        })
    })
</script>