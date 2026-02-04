<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trang';
$this->params['breadcrumbs'][] = ['name' => $this->title, 'link' => 'javascript:void(0)'];

CrudAsset::register($this);

?>
<div class="page-index">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'pjaxSettings' => ['options' => ['enablePushState' => false]],
            'summary' => 'Từ {begin} đến {end}/ Tổng {totalCount} bản ghi',
            'columns' => [
                [
                    'class' => 'kartik\grid\CheckboxColumn',
                    'width' => '20px',
                ],
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'width' => '30px',
                    'header' => 'STT',
                ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'id',
                // ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'title',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'url',
                ],
//                [
//                    'class'=>'\kartik\grid\DataColumn',
//                    'attribute'=>'content',
//                ],
                [
        'header'=>'SEO Google',
        'value'=>function($data){
            return "<a class='seohead' href='javascript:void(0);'>".$data->seo_title."</a><br><a class='seolink'>".(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]".$data->url."</a><br><span class='seodec'>".$data->seo_desc."</span> ";
        },
        'format'=>'raw',
        'contentOptions'=>['style'=>'max-width:300px; overflow-x: scroll']
    ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'seo_keyword',
                // ],

                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'brief',
                // ],

                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'lang_id',
                // ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'dropdown' => false,
                    'vAlign' => 'middle',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        return Url::to([$action, 'id' => $key]);
                    },
                    'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
                    'updateOptions' => [ 'title' => 'Update', 'data-toggle' => 'tooltip'],
                    'deleteOptions' => ['role' => 'modal-remote', 'title' => 'Delete',
                        'data-confirm' => false, 'data-method' => false,// for overide yii data api
                        'data-request-method' => 'post',
                        'data-toggle' => 'tooltip',
                        'data-confirm-title' => 'Bạn có chắc không?',
                        'data-confirm-message' => 'Bạn có chắc chắn muốn xóa mục này không'],
                ],

            ],
            'toolbar' => [
                ['content' =>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['page/newform'],
                        ['title' => 'Tạo mới Pages', 'class' => 'btn btn-default']) .
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                        ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => 'Reset Grid']) .
                    '{toggleData}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách trang',
                'before' => '<em>* Thay đổi kích thước các cột trong bảng giống như một bảng tính bằng cách kéo các cạnh cột.</em>',
                'after' => BulkButtonWidget::widget([
                        'buttons' => Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Xóa tất cả',
                            ["bulkdelete"],
                            [
                                "class" => "btn btn-danger btn-xs",
                                'role' => 'modal-remote-bulk',
                                'data-confirm' => false, 'data-method' => false,// for overide yii data api
                                'data-request-method' => 'post',
                                'data-confirm-title' => 'Bạn có chắc không?',
                                'data-confirm-message' => 'Bạn có chắc chắn muốn xóa mục này không'
                            ]),
                    ]) .
                    '<div class="clearfix"></div>',
            ]
        ]) ?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>
