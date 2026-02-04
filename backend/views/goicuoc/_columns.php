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
        'attribute'=>'user_id',
        'value'=>function($data){
            $admin = \common\models\User::findOne($data->user_id);
            return (is_null($admin)?"#N/A":$admin->username);
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ngaydangky',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ngayhethan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'loaidangky',
        'value'=>function($data){
            if($data->loaidangky==1){
                return "<span class='label label-success'>Gói 6 tháng</span>";
            }else {
                return "<span class='label label-warning'>Gói 12 tháng</span>";
            }
        },
        'format'=>'raw',
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' =>\yii\helpers\ArrayHelper::map([
            ['id'=>'1','username'=>'Gói 6 tháng'],
            ['id'=>'2','username'=>'Gói 12 tháng'],
        ], 'id', 'username'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'duyet',
        'value'=>function($data){
            if($data->duyet==1){
                return "<span class='label label-success'>Tài khoản còn hạn</span>";
            }else {
                return "<span class='label label-warning'>Tài khoản hết hạn</span>";
            }
        },
        'format'=>'raw',
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' =>\yii\helpers\ArrayHelper::map([
            ['id'=>'1','username'=>'Tài khoản còn hạn'],
            ['id'=>'2','username'=>'Tài khoản hết hạn'],
        ], 'id', 'username'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'value'=>function($data){
            if($data->status==-1){
                return "<span class='text-danger' style='color: red'>Chưa xác nhận cập nhập</span>";
            }else if($data->status==0){
                return "<span class='label label-warning' style='color: red'>Gói cước mới chưa xử lý</span>";
            }else if($data->status==1){
                return "<span class='label label-success'>Đã đăng ký gói cước</span>";
            }else if($data->status==2){
                return "<span class='label label-danger'>Đã hủy</span>";
            }else if($data->status==10){
                return "<span class='label label-danger'>Đã hết hạn</span>";
            }else {
                return "<span class='label label-warning'>Đang xử lý</span>";
            }
        },
        'format'=>'raw',
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' =>\yii\helpers\ArrayHelper::map([
            ['id'=>'-1','username'=>'Chưa xác nhận cập nhập'],
            ['id'=>'0','username'=>'Chưa xử lý'],
            ['id'=>'1','username'=>'Đã đăng ký gói cước'],
            ['id'=>'2','username'=>'Đã hủy'],
            ['id'=>'3','username'=>'Đang xử lý'],
            ['id'=>'10','username'=>'Đã hết hạn'],
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
                return "<button types='0' class='btn-update-status btn-update-statususer btn btn-warning' vals='".$data->id."' user='".$data->user_id."'>Cập nhật đã nhận đăng ký</button>";
            }
            else if($data->status!=1 && $data->status!=2 && $data->status!=10)
                return "<button types='3' class='btn-update-status btn-update-statususer btn btn-warning' vals='".$data->id."' user='".$data->user_id."'>Đang xử lý</button><button types='1' class='btn-update-status btn-update-statususer btn btn-success' vals='".$data->id."' user='".$data->user_id."'>Đã hoàn thành đăng ký</button><button types='2' class='btn-update-status btn-update-statususer btn btn-danger' vals='".$data->id."' user='".$data->user_id."'>Hủy đăng ký</button><button types='-1' class='btn-update-status btn-update-statususer btn btn-warning' vals='".$data->id."' user='".$data->user_id."'>Cập nhật chưa thanh toán</button>";
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
