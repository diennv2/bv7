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

        'attribute'=>'image',

        'contentOptions' => ['class' => 'text-center'],

        'headerOptions' => ['style' => 'width:100px', 'class' => 'text-center'],

        'value' => function ($data) {

            return \yii\bootstrap\Html::img(Yii::$app->urlManagerFrontend->baseUrl.$data->image, ['width' => '40px']);

        },

        'format' => 'raw',

        'filter' => false,

    ],

    [

        'class'=>'\kartik\grid\DataColumn',

        'attribute'=>'name',
        'value'=>function ($model, $key, $index, $widget) {
            return $model->name;
        },

    ],

    [

        'class'=>'\kartik\grid\DataColumn',

        'attribute'=>'brief',

    ],
    [

        'class'=>'\kartik\grid\DataColumn',

        'attribute'=>'position',
        'value'=>function ($model, $key, $index, $widget) {

            return \common\models\Slides::getPosition()[$model->position];
        },
        'group'=>true,
        'groupedRow'=>true,                    // move grouped column to a single grouped row
        'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
        'groupEvenCssClass'=>'kv-grouped-row',
    ],
    [

        'class'=>'\kartik\grid\DataColumn',

        'attribute'=>'position',
        'value'=>function ($model, $key, $index, $widget) {
            return \yii\helpers\Html::dropDownList('',$model->position,common\models\Slides::getPosition(),['class'=>'form-control update-position','control'=>'slides','vals'=>$model->id ]);
        },
        'filter' => \yii\helpers\Html::activeDropDownList(
            $searchModel, 'active',
            ['1' => 'Có', '0' => 'Không'],
            ['prompt' => 'All', 'class' => 'form-control']
        ),
        'format' => 'raw',
        'format'=>'raw',
    ],

    /*    [

            'class'=>'\kartik\grid\DataColumn',

            'attribute'=>'thumb',

        ],*/

    /*  [

          'class'=>'\kartik\grid\DataColumn',

          'attribute'=>'url',

      ],*/
    
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