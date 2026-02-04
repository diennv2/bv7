<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tin tức';
$this->params['breadcrumbs'][] = ['name'=>$this->title,'link'=>'javascript:void(0)'];

CrudAsset::register($this);
?>
<?php if(isset($_GET[1])):?>
<div class="alert alert-success" id="thongbao">
    Đăng bài viết thành công!
</div>
<script>
    setTimeout(function () {
        $("#thongbao").remove();
    },4000)
</script>
<?php endif?>
<div class="news-index">
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
                    'attribute'=>'image',
                    'value'=>function($data){
                        return Html::img(Yii::$app->urlManagerFrontend->baseUrl.$data->image,['style'=>'width:50px']);
                    },
                    'headerOptions'=>['style'=>'text-align:center','class'=>'img-grid'],
                    'filter'=>false,
                    'format'=>'raw'
                ],
                [
                    'class'=>'\kartik\grid\DataColumn',
                    'attribute'=>'title',
                    'headerOptions'=>['style'=>'text-align:center;'],
                ],

                [
                    'class'=>'\kartik\grid\DataColumn',
                    'attribute'=>'posted_date',
                    'headerOptions'=>['style'=>'text-align:center;'],
                    'filter'=>false
                ],
                [
                    'class'=>'\kartik\grid\DataColumn',
                    'attribute'=>'lang_id',
                    'value'=>function($data){
                        if(is_numeric((int)$data->lang_id) && (int)$data->lang_id>0){
                            $user = \common\models\Admin::findOne(['id'=>$data->lang_id]);
                            if(!is_null($user))
                                return $user->username;
                            else{
                                return "#N/A";
                            }
                        }
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' =>\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
                    'format'=>'raw'
                ],
                [
                    'class'=>'\kartik\grid\DataColumn',
                    'attribute'=>'cat_new_id',
                    'value'=>function($data){
                        return \kartik\select2\Select2::widget([
                            'name' => 'cat_new_id',
                            'value' => $data->cat_new_id,
                            'data' => \yii\helpers\ArrayHelper::map(\common\models\Catnew::find()->all(), 'id', 'name'),
                            'options' => ['multiple' => false, 'placeholder' => 'Update parent ...','class'=>'update-foreign','vals'=>$data->id,'control'=>'news','foreign'=>'cat_new_id']
                        ]);
                    },
                    'headerOptions'=>['style'=>'text-align:center; width:200px'],
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' =>\yii\helpers\ArrayHelper::map(\common\models\Catnew::find()->all(), 'id', 'name'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
                    'format'=>'raw'
                ],
                [
                    'class'=>'\kartik\grid\DataColumn',
                    'attribute'=>'pheduyet',
                    'value'=>function($data){
                        if($data->pheduyet==-1){
                            return "<span class='text-danger' style='color: red'>Chưa phê duyệt</span>";
                        }else if($data->pheduyet==0){
                            return "<span class='label label-warning' style='color: red'>Đang phê duyệt</span>";
                        }else if($data->pheduyet==1){
                            return "<span class='label label-success'>Đã phê duyệt</span>";
                        }else if($data->pheduyet==2){
                            return "<span class='label label-danger'>Đã hủy</span>";
                        }
                    },
                    'format'=>'raw',
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'filter' =>\yii\helpers\ArrayHelper::map([
                        ['id'=>'-1','username'=>'Chưa phê duyệt'],
                        ['id'=>'0','username'=>'Đang phê duyệt'],
                        ['id'=>'1','username'=>'Đã phê duyệt'],
                        ['id'=>'2','username'=>'Đã hủy'],
                    ], 'id', 'username'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
                ],
                [
                    'class'=>'\kartik\grid\DataColumn',
                    'label'=>'',
                    'value'=>function($data){
                        if (Yii::$app->user->identity->username=='Superadmin' || Yii::$app->user->identity->username=='admin' || Yii::$app->user->can('news/updatepheduyet')){
                            if($data->pheduyet==-1){
                                return "<button types='0' class='btn-update-status btn btn-warning' vals='".$data->id."'>Phê duyệt</button>";
                            }
                            else if($data->pheduyet!=1 && $data->pheduyet!=2)
                                return "<button types='1' class='btn-update-status btn btn-success' vals='".$data->id."'>Đã Phê duyệt</button><button types='2' class='btn-update-status btn btn-danger' vals='".$data->id."'>Hủy bài viết</button>";
                            else
                                return "Close";
                        } else {
                            return "Bạn không có quyền phê duyệt bài viết";

                        }
                    },
                    'format'=>'raw',

                ],
                [

                    'class'=>'\kartik\grid\DataColumn',
                    'attribute'=>'cat_new_id',
                    'value'=>function ($model, $key, $index, $widget) {
                        return $model->catNew->name;
                    },
                    'group'=>true,
                    'groupedRow'=>true,                    // move grouped column to a single grouped row
                    'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                    'groupEvenCssClass'=>'kv-grouped-row',
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'dropdown' => false,
                    'vAlign'=>'middle',
                    'urlCreator' => function($action, $model, $key, $index) {
                        return Url::to([$action,'id'=>$key]);
                    },
                    'viewOptions'=>['class'=>'hidden'],
                    'updateOptions'=>['target'=>'_blank'],
                    'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
                        'data-confirm'=>false, 'data-method'=>false,
                        'data-request-method'=>'post',
                        'data-toggle'=>'tooltip',
                        'data-confirm-title'=>'Are you sure?',
                        'data-confirm-message'=>'Are you sure want to delete this item'],
                ],

            ),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['news/newpost'],
                        ['title'=> 'Tạo mới News','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'responsiveWrap'=>false,
            'hover'=>true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách tin tức',
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
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<?php Modal::begin([
    "id"=>"modal-anh",
    'header'=>'Ảnh tin tức',
    "footer"=> Html::button('Đóng lại', ['class' => 'btn blue','data-dismiss'=>'modal']),// always need it for jquery plugin
])?>
<img src="" id="anh-img">
<?php Modal::end(); ?>
<script>
    $(document).ready(function () {
        $(document).on('click','.btn-update-status',function(){
            var self = $(this);
            $.ajax({
                url:"<?=Yii::$app->urlManager->createUrl(['news/updatepheduyet'])?>",
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
    })
</script>
