<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\LandingpageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Landingpages';
$this->params['breadcrumbs'][] = ['name'=>$this->title,'link'=>'javascript:void(0)'];

CrudAsset::register($this);

?>
<style>
    #fancybox-wrap {
        z-index: 11000;
    }
</style>
<div class="row">
    <div class="landingpage-index col-md-6">
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
                        ['role'=>'modal-remote','title'=> 'Create new Landingpages','class'=>'btn btn-default']).
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
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Landingpages',
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
    <div class="landingpage-index col-md-6">
        <div id="ajaxCrudDatatable2">
            <?=GridView::widget([
                'id'=>'crud-datatable2',
                'dataProvider' => $dataProvider2,
                'filterModel' => $searchModel2,
                'pjax'=>true,
                'columns' => require(__DIR__.'/../landingpageoptions/_columns.php'),
                'toolbar'=> [
                    ['content'=>
                        (isset($landingid)? Html::a('<i class="glyphicon glyphicon-plus"></i>', ['landingpageoptions/create','landing'=>$landingid],
                            ['role'=>'modal-remote','title'=> 'Create new Landingpages','class'=>'btn btn-default']):"").
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
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Thành phần landing page',
                    'before'=>'<em>* Chọn một landing page để thao tác. </em><p>Landing đã chọn:<b> '.((isset($landingobject))?$landingobject->name:"").'</b></p>',
                    'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                ["landingpageoptions/bulkdelete"] ,
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
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
    'options' => [
        "data-backdrop" => "static",
        "data-keyboard" => "false",
        'tab-index' => -1
    ]
])?>
<?php Modal::end(); ?>
<script>
    function responsive_filemanager_callback(field_id){
        if(field_id){
            console.log(field_id);
            var url=jQuery('#'+field_id).val();
            //alert('update '+field_id+" with "+url);
            //your code
        }
    }
    function open_popup(url)
    {
        var w = 880;
        var h = 570;
        var l = Math.floor((screen.width-w)/2);
        var t = Math.floor((screen.height-h)/2);
        var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
    }
</script>
<script>
    $(document).ready(function () {
        $(document).on('click','.select-landing',function () {
           
        });
        $(document).on('change','#landingpageoptions-type',function (e) {
            e.preventDefault();
            $('.inputhidden').fadeOut(100);
            $("#for-"+$(this).val()).fadeIn(100);
        })
    })
</script>
