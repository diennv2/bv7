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
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'image',

        'contentOptions' => ['class' => 'text-center'],
        'headerOptions' => ['style' => 'width:100px', 'class' => 'text-center'],
        'value' => function ($data) {
            return \yii\helpers\Html::img(Yii::$app->urlManagerFrontend->baseUrl . $data->image, ['width' => '60px','height'=>'40px']);
        },
        'format' => 'raw',
        'filter' => false,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name_vi',
    ],
    [
        'header'=>'Quản lý ảnh',
        'value'=>function($data){
            return \yii\helpers\Html::a("Kho ảnh",Yii::$app->urlManager->createUrl(['picture/redirects','catid'=>$data->id]));
        },
        'format'=>'raw'
    ],
    [
        'header'=>'Số ảnh trong album',
        'value'=>function($data){
            return count($data->pictures);
        }
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'name_en',
//    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'decription',
    // ],
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