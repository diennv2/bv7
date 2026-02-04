<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use \kartik\export\ExportMenu;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DanhmucvanbanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danhmucvanbans';
$this->params['breadcrumbs'][] = ['name'=>$this->title,'link'=>'javascript:void(0)'];

CrudAsset::register($this);
$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'id',
    'name',
];
$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => \common\models\Danhmucvanban::getExportColumn(),
    'target' => ExportMenu::TARGET_BLANK,
    'fontAwesome' => true,
    'asDropdown' => false, // this is important for this case so we just need to get a HTML list
    'dropdownOptions' => [
        'label' => '<i class="glyphicon glyphicon-export"></i> Full'
    ],
]);
?>
?>
<div class="danhmucvanban-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'pjaxSettings' => ['options' => ['enablePushState' => false]],
            'summary' => 'Từ {begin} đến {end}/ Tổng {totalCount} bản ghi',
            'columns' => array(
                [
                    'class' => 'kartik\grid\CheckboxColumn',
                    'width' => '20px',
                ],
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'width' => '30px',
                ],
                [
                    'class'=>'\kartik\grid\DataColumn',
                    'attribute'=>'loaivanban',
                    'headerOptions'=>['style'=>'text-align:center;'],
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'dropdown' => false,
                    'vAlign'=>'middle',
                    'urlCreator' => function($action, $model, $key, $index) {

                        return Url::to([$action,'id'=>$key]);
                    },
                    'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
                    'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
                    'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
                        'data-confirm'=>false, 'data-method'=>false,
                        'data-request-method'=>'post',
                        'data-toggle'=>'tooltip',
                        'data-confirm-title'=>'Are you sure?',
                        'data-confirm-message'=>'Are you sure want to delete this item'
                    ],
                    'visibleButtons' => [

                        'update' => function ($model) {
                            if($model->id==3||$model->id==4) return false;
                            return true;
                        },
                        'prints' => function ($model) {
                            if($model->id==3||$model->id==4) return false;
                            return true;
                        },
                        'delete'=>function($model){
                            if($model->id==3||$model->id==4) return false;
                            return true;
                        }

                    ]
                ],

            ),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                        ['role'=>'modal-remote','title'=> 'Tạo mới danh muc van ban','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],
            'export' => [
                'fontAwesome' => true,
                'itemsAfter'=> [
                    '<li role="presentation" class="divider"></li>',
                    '<li class="dropdown-header">Xuất toàn bộ dữ liệu</li>',
                    $fullExportMenu
                ]
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'responsiveWrap'=>false,
            'hover'=>true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách chuyện mục',
                'before'=>'<em>* Thay đổi kích thước các cột của bảng giống như bảng tính bằng cách kéo các cạnh cột.</em>',
                'after'=>BulkButtonWidget::widget([
                        'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                            ["bulkdelete"] ,
                            [
                                "class"=>"btn btn-danger btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,
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
    "footer"=>"",// always need it for jquery
    "size"=>Modal::SIZE_LARGE
])?>
<?php Modal::end(); ?>
