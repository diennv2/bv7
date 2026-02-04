<?php
use yii\helpers\Url;
$order = \common\models\Detailorder::find()->all();
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
        'attribute'=>'khachhang',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'diachi',
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
        'header'=>'Thông tin đơn hàng',
        'value'=>function($data) use ($order){
            $dem =1;
            $stringResult = "<div class='table-responsive'>
                    <table class='table table-striped table-bordered table-hover'><tr>
                        <th>STT</th>
                        <th>Ten Hang</th>
                        <th>So Luong</th>
                        <th>Don Gia</th>
                        <th>Thanh Tien</th>
                        <th>Ghi Chu</th></tr>";

            foreach ($order as $index => $value){ /** @var \common\models\Detailorder $value */
                if($value->orderid == $data->id){
                    $stringResult.="<tr>
                            <td>".$dem."</td>
                            <td><a target='_blank' href='".$value->link."'>".$value->tenhang."</a></td>
                            <td>".$value->soluong."</td>
                            <td>".$value->dongia."</td>
                            <td>".$value->thanhtien."</td>
                            <td>".$value->ghichu."</td>
</tr>";
                }
            }
            $stringResult.="</table></div>";
            return$stringResult;
        },
        'format'=>'raw'
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