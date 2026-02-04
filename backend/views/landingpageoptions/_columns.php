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
        'attribute'=>'type',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'value',
        'value'=>function($data){
            if($data->type=='image'){
                return "<table class='table table-bordered'><tr><th>Ảnh Desktop/Tablet</th><th>Ảnh Mobile</th></tr><tr><td><img src='$data->value' style='max-width: 150px'></td><td><img src='$data->valuemobile' style='max-width: 150px'></td></tr></table>";
            }else if($data->type=='new'){
                $return = "";
                foreach (\yii\helpers\Json::decode($data->value) as $value){
                    $new = \common\models\News::findOne(['id'=>$value]);
                    if(is_null($new))
                        $return.="<p>Đã bị xóa</p>";
                    else
                        $return.="<p>".$new->title."</p>";
                }
                return $return;
            }else if($data->type=='product'){
                $return = "";

                foreach (\yii\helpers\Json::decode($data->value) as $value){
                    $new = \common\models\Product::findOne(['id'=>$value]);
                    if(is_null($new))
                        $return.="<p>Đã bị xóa</p>";
                    else
                        $return.="<p><a data-pjax='0' target='_blank' href='".Yii::$app->urlManagerFrontend->createUrl(['product/detailproduct', 'path' => $new->url, 'id' => $new->id])."'>".$new->name."</a></p>";
                }
                return $return;
            }
            else if($data->type=='listvideo'){
                $return = "";
                foreach (\yii\helpers\Json::decode($data->value) as $value){
                    $return.="<p>".$value."</p>";
                }
                return $return;
            }
        },
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'target',
    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Yii::$app->urlManager->createUrl(['landingpageoptions/'.$action,'id'=>$key]);
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