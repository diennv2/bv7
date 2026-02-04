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
        'attribute'=>'donvi',
    ],
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

];   