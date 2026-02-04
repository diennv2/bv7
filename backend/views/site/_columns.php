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
        'attribute'=>'ngaylap',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'mangdtkhac',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'gioitinh',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten',
        'value'=>function($data){
            return $data->gioitinh.". ".$data->ten;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'sdt',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'yeucaukhac',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'type',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'address',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'tinhthanh',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'quanhuyen',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'phuongxa',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'nguoinhanhang',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'nguoinhanhangsdt',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'chuyendanhba',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'mangdtkhac',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'xuathoadontencty',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'xuathoadondiachi',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tongsauvat',
        'value'=>function($model){
            return number_format($model->tongsauvat,0,"",".");
        }
    ],
     [
     'class'=>'\kartik\grid\DataColumn',
     'attribute'=>'dathanhtoan',
         'value'=>function($model){
            return number_format($model->dathanhtoan,0,"",".");
         }
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label'=>'Nhận qùa',
        'value'=>function($model){
            $listnhanqua = \common\models\Listnhanqua::findAll(['billid'=>$model->id]);
            if(empty($listnhanqua)){
                return "Chưa nhận quà";
            }
            $result="";
            foreach ($listnhanqua as $value){
                $qua = \common\models\Product::findOne(['id'=>$value->productid]);
                if(is_null($qua)){
                    $result.= "- Quà đã bị xóa hoặc không tìm thấy</br>";
                }
                else{
                    $result.="- ".$qua->name."</br>";
                }
            }
            return $result;
        },
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'value'=>function($data){
            if($data->status==-1){
                return "<span class='text-danger' style='color: red'>Chưa thanh toán</span>";
            }else if($data->status==0){
                return "<span class='label label-warning' style='color: red'>Đơn hàng mới chưa xử lý</span>";
            }else if($data->status==1){
                return "<span class='label label-success'>Đã hoàn thành</span>";
            }else if($data->status==2){
                return "<span class='label label-danger'>Đã hủy</span>";
            }else if($data->status==3){
                return "<span class='label label-warning'>Đang chuẩn bị</span>";
            }else{
                return "<span class='label label-info'>Đang vận chuyển</span>";
            }
        },
        'format'=>'raw',
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' =>\yii\helpers\ArrayHelper::map([
            ['id'=>'-1','username'=>'Chưa thanh toán'],
            ['id'=>'0','username'=>'Chưa xử lý'],
            ['id'=>'1','username'=>'Đã hoàn thành đơn hàng'],
            ['id'=>'2','username'=>'Đã hủy'],
            ['id'=>'3','username'=>'Đang chuẩn bị'],
            ['id'=>'4','username'=>'Đang vận chuyển'],
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
                return "<button types='0' class='btn-update-status btn btn-warning' vals='".$data->id."'>Cập nhật đã thanh toán</button>";
            }
            else if($data->status!=1 && $data->status!=2)
                return "<button types='3' class='btn-update-status btn btn-warning' vals='".$data->id."'>Đang chuẩn bị</button><button types='4' class='btn-update-status btn btn-info' vals='".$data->id."'>Đang vận chuyển</button><button types='1' class='btn-update-status btn btn-success' vals='".$data->id."'>Đã hoàn thành đơn hàng</button><button types='2' class='btn-update-status btn btn-danger' vals='".$data->id."'>Hủy đơn hàng</button><button types='-1' class='btn-update-status btn btn-warning' vals='".$data->id."'>Cập nhật chưa thanh toán</button>";
            else
                return "Close";
        },
        'format'=>'raw',

    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'product',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'typethanhtoan',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label'=>'In',
        'value'=>function($model){
            return \yii\helpers\Html::a("<i class='fa fa-print'></i>","javascript:void(0)",['class'=>'inbill','target-id'=>$model->id]);
        },
        'format'=>'raw'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
            return Yii::$app->urlManager->createUrl(['billmobile/'.$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
            'data-request-method'=>'post',
            'data-toggle'=>'tooltip',
            'data-confirm-title'=>'Are you sure?',
            'data-confirm-message'=>'Are you sure want to delete this item'],
        'visibleButtons'=>[
            'update'=>false,
            'delete'=>false,
        ]
    ],

];   