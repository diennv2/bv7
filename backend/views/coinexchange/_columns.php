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
        'attribute'=>'userid',
        'value'=>function($data){
            $user = \common\models\User::findOne($data->userid);
            return (is_null($user))?"#N/A":$user->username;
        },
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' =>\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'sodiem',
        'value'=>function($data){
            return number_format($data->sodiem,0,"",'.'). "VNĐ";
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phonenumber',

    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'brand',
        'value'=>function($data){
            return $data->getBrand();
        },
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' =>(new \common\models\Coinexchange())->arrayBrand,
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'type',
        'value'=>function($data){
            return $data->getType();
        },
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' =>(new \common\models\Coinexchange())->arrayType,
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
        'format'=>'raw'
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'transaction_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'service',
    // ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'status',
         'value'=>function($data){
            return $data->getStatusText();
         },
         'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
         'filter' =>(new \common\models\Coinexchange())->statusArray,
         'filterWidgetOptions' => [
             'pluginOptions' => ['allowClear' => true],
         ],
         'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
         'format'=>'raw'

     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'sotienthanhcong',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'mess',
    // ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'time',
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
        'visibleButtons'=>[
            'view' => function ($model, $key, $index) {
                return $model->status == 0 ? true : false;
            },
            'update' => function ($model, $key, $index) {
                return $model->status == 0 ? true : false;
            },
            'delete' => function ($model, $key, $index) {
                return false;
            }
        ]
    ],


];   