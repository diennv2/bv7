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
        'attribute'=>'email',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'noidung',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'filedinhkem',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'user_id',
        'value' => function ($data) {
            $admin = \common\models\Admin::findOne($data->user_id);
            if(Yii::$app->user->identity->username=='Superadmin' || Yii::$app->user->identity->username=='admin'){
                return (is_null($admin) || is_null($data->user_id)) ? "Chưa giao <a href=\"/admin/datcauhoi/updatetuser?id=" . $data->id . "\" title=\"Update\" data-pjax=\"0\" role=\"modal-remote\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-pencil\"></span></a>" : $admin->ten."   "."<a href=\"/admin/datcauhoi/updateuser?id=" . $data->id . "\" title=\"Update\" data-pjax=\"0\" role=\"modal-remote\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-pencil\"></span></a>";
            }
            return (is_null($admin) || is_null($data->user_id)) ? "Chưa giao <a href=\"/admin/datcauhoi/updatetuser?id=" . $data->id . "\" title=\"Update\" data-pjax=\"0\" role=\"modal-remote\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-pencil\"></span></a>" : $admin->ten;
        },
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' => \yii\helpers\ArrayHelper::map(\common\models\Admin::find()->all(), 'id', 'ten'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['prompt' => 'Hiển thị tất cả'],
        'format' => 'raw'
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