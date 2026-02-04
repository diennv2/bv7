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
        'attribute'=>'billid',
        'value'=>function($data){
            return '<a href="/admin/billmobile/view?id='.$data->billid.'" title="View" data-pjax="0" role="modal-remote" data-toggle="tooltip">Bill #'.$data->billid.'</a>';
        },
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'productid',
        'value'=>function($data){
            $sach = \common\models\Product::findOne($data->productid);
            if(is_null($sach)){
                return "Không tìm thấy";
            }
            return $sach->name;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ngaynhan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label'=>'Danh sách câu hỏi',
        'value'=>function($data){
           $bill = \common\models\Billmobile::findOne($data->billid);
           if(is_null($bill)||$bill->status==2){
                return "Không tìm thấy đơn hàng hoặc đơn hàng bị hủy, không đủ điều kiện trao thưởng";
           }
           else if($bill->status==-1){
               return "Đơn hàng chưa thanh toán";
           }
           else{
               $ketqua= "<table class='table table-hover table-bordered table-striped'><tr><th>STT</th><th>Câu hỏi</th><th>Đáp án đúng</th><th>Đáp án khách chọn</th><th></th></tr>";
               $listcauhoi = \common\models\Traloicauhoi::findAll(['listnhanquaid'=>$data->id]);
               $dem=0;
               foreach ($listcauhoi as $index=> $value){
                   if($value->cauhoi!=-1){
                       $cauhoi = \common\models\Cauhoi::findOne($value->cauhoi);
                       $ketqua.="<tr><td>".($index+1)."</td><td style='font-weight: bold'>".(is_null($cauhoi)?"Không tìm thây câu hỏi":$cauhoi->cauhoi)."</td><td>".$value->cautraloi."</td><td>".$value->dapancuakhach."</td><td>".($value->status==0?"<i class='text-danger fa fa-remove'></i>":"<i class='text-success fa fa-check'></i>")."</td></tr>";
                   }else{
                       $ketqua.="<tr><td>".($index+1)."</td><td style='font-weight: bold'>Câu số 5</td><td>".$value->cautraloi."</td><td><textarea rows='10' class='form-control'>".$value->dapancuakhach."</textarea></td><td>".($value->status==0?("<i class='text-danger fa fa-remove'></i>".($data->isdanhanqua==0?"<button style='display: block' class='btn btn-success btn-change-stt' data-target='".$value->id."'>Chấp nhận câu trả lời này</button>":"")):"<i class='text-success fa fa-check'></i>".($data->isdanhanqua==0?"<button style='display: block' class='btn btn-danger btn-change-stt' data-target='".$value->id."'>Không chấp nhận câu trả lời này</button>":""))."</td></tr>";
                   }
                   if($value->status==1){
                       $dem++;
                   }
               }
               $ketqua.="<tr><th colspan='4' style='text-align: right'>Tổng đáp án đúng</th><td>".$dem."/5</td></tr>";
               $ketqua.="<tr><th colspan='4' style='text-align: right'>Tổng thưởng</th><td>".number_format($dem*20000,0,"",".")."</td></tr>";
               $ketqua.="<tr><th colspan='4' style='text-align: right'>Trạng thái</th><td><p>".(($data->isdanhanqua==0)?"<span class='label label-danger'>Chưa trao thưởng</span><button class='btn btn-success btn-traothuong' data-target='".$data->id. "' style='display: block;margin-top: 5px'><i class='fa fa-coffee'></i> Trao thưởng</button>" :"<span class='label label-success'>Đã trao thưởng</span>")."</p></td></tr>";
               $ketqua.="</table>";
               return $ketqua;
           }
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
                          'data-confirm-title'=>'Bạn có chắc không?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   