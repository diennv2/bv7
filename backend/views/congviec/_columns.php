<?php
use yii\helpers\Url;
$donvi = \common\models\Donvi::find()->all();
$nganhnghe = \common\models\Nganhnghe::find()->all();
$diadiem = \common\models\Diadiem::find()->all();
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
        'value'=>function($data) use ($donvi){
            foreach ($donvi as $value){
                if($value->id==$data->donvi){
                    return $value->companyname;
                }
            }
        },
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' =>\yii\helpers\ArrayHelper::map($donvi, 'id', 'companyname'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nganhnghe',
        'value'=> function($data) use ($nganhnghe){
            $listnganhnghe = \yii\helpers\Json::decode($data->nganhnghe);
            $result = "";
            foreach ($listnganhnghe as $value){
               foreach ($nganhnghe as $valuenganh){
                   if($value==$valuenganh->id){
                       $result.="<span class='label label-success'>".$valuenganh->ten."</span>  ";
                       break;
                   }
               }
            }
            return $result;
        },
        'format'=>'raw',
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' =>\yii\helpers\ArrayHelper::map($nganhnghe, 'id', 'ten'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true,'multiple'=>true],
        ],
        'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'noilamviec',
        'value'=> function($data) use ($diadiem){
            $listnganhnghe = \yii\helpers\Json::decode($data->noilamviec);
            $result = "";
            foreach ($listnganhnghe as $value){
                foreach ($diadiem as $valuenganh){
                    if($value==$valuenganh->id){
                        $result.="<span class='label label-success'>".$valuenganh->ten."</span>  ";
                        break;
                    }
                }
            }
            return $result;
        },
        'format'=>'raw',
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' =>\yii\helpers\ArrayHelper::map($diadiem, 'id', 'ten'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true,'multiple'=>true],
        ],
        'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hot',
        'value'=>function($data){
            return ($data->hot==1)?"<a control='congviec' vals=".$data->id." class=\"active-change glyphicon glyphicon-ok text-success\"></a>":"<a control='congviec' vals=".$data->id." class=\"active-change glyphicon glyphicon-remove text-danger\"></a>";
        },
        'format' => 'raw',
        'headerOptions'=>['style'=>'text-align:center; width:100px'],
        'contentOptions'=>['style'=>'text-align:center'],
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' =>[0=>'Không',1=>'Có'],
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'douutien',
        'value'=>function($data){
            return \yii\helpers\Html::numberInput('',$data->douutien,['control'=>'congviec', 'vals'=>$data->id,'class'=>"hots-change form-control",'min'=>0]);
        },
        'format' => 'raw',
        'headerOptions'=>['style'=>'text-align:center; width:100px'],
        'contentOptions'=>['style'=>'text-align:center'],
        'filter'=>false
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'chinhsachphucloi',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'lienhe',
//    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'vitriungtuyen',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'capbac',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'thoigianlamviec',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'mucluong',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'noilamviec',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tuvanvien',
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