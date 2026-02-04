<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hoten',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'dienthoai',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'noidung',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'time',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'value'=>function($data){
            if($data->status==-1){
                return "<span class='text-danger' style='color: red'>Chưa xác nhận cập nhập</span>";
            }else if($data->status==0){
                return "<span class='label label-warning' style='color: red'>Đơn chưa xử lý</span>";
            }else if($data->status==1){
                return "<span class='label label-success'>Đã hoàn thành</span>";
            }else if($data->status==2){
                return "<span class='label label-danger'>Đã hủy lịch</span>";
            }else {
                return "<span class='label label-warning'>Đang khám</span>";
            }
        },
        'format'=>'raw',
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' =>\yii\helpers\ArrayHelper::map([
            ['id'=>'-1','username'=>'Chưa xác nhận cập nhập'],
            ['id'=>'0','username'=>'Chưa xử lý'],
            ['id'=>'1','username'=>'Đã hoàn thành khám'],
            ['id'=>'2','username'=>'Đã hủy'],
            ['id'=>'3','username'=>'Đang xử lý'],
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
            if($data->status==-1){
                return "<button types='0' class='btn-update-status btn btn-warning' vals='".$data->id."'>Cập nhật đã nhận yêu cầu</button>";
            }
            else if($data->status!=1 && $data->status!=2)
                return "<button types='3' class='btn-update-status btn btn-warning' vals='".$data->id."'>Đang xử lý</button><button types='1' class='btn-update-status btn btn-success' vals='".$data->id."'>Đã hoàn thành yêu cầu</button><button types='2' class='btn-update-status btn btn-danger' vals='".$data->id."'>Hủy yêu cầu</button><button types='-1' class='btn-update-status btn btn-warning' vals='".$data->id."'>Cập nhật chưa chấp nhận yêu cầu</button>";
            else
                return "Close";
        },
        'format'=>'raw',

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
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   