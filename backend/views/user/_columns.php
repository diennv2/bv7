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
//    [
//        'class'=>'kartik\grid\ExpandRowColumn',
//        'width'=>'50px',
//        'value'=>function ($model, $key, $index, $column) {
//            return \kartik\grid\GridView::ROW_COLLAPSED;
//        },
//        'detail'=>function ($model, $key, $index, $column) {
//            return Yii::$app->controller->renderPartial('_expand-row-details', ['model'=>$model]);
//        },
//        'headerOptions'=>['class'=>'kartik-sheet-style'],
//        'expandOneOnly'=>true
//    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'username',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'auth_key',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'password_hash',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'password_reset_token',
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'email',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'phone',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'address',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
        'value' => function ($data) {
            return ($data->status === 10)?'Hoạt động':'Bị khóa';
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Ví diện tử',
        'value' => function ($data) {
            $wl = \common\models\Excalibur::findOne(['userid'=>$data->id]);
            return "<p style='text-align: right'>".(is_null($wl)?0:number_format($wl->amount,0,"","."))."<img src='/images/coin.png' style='width: 30px'></p>";
        },
        'format'=>'raw'
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'created_at',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'updated_at',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['role' => 'modal-remote', 'title' => 'Delete',
            'data-confirm' => false, 'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Are you sure?',
            'data-confirm-message' => 'Are you sure want to delete this item'],
    ],

];   