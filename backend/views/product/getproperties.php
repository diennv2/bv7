<?php
/** @var \common\models\Product $model */
$thuoctinhsanpham = \common\models\Thuoctinhproduct::find()->where(['product_id' => $model->id])->all();
if (empty($thuoctinhsanpham)):?>
    <label class="label label-danger">Chưa cập nhật phiên bản</label>
<?php else: ?>
    <?=\yii\helpers\Html::a('<i class="glyphicon glyphicon-eye-open"></i> Xem chi tiết '.count($thuoctinhsanpham)." phiên bản", ['getviewthuoctinh','id'=>$model->id],
        ['role'=>'modal-remote','title'=> 'Xem phiên bản','class'=>'btn btn-default']);?>
<?php endif; ?>

<div>
   <?=\yii\helpers\Html::a('<i class="glyphicon glyphicon-plus"></i>', ['addproperties','id'=>$model->id],
       ['role'=>'modal-remote','title'=> 'Cập nhật phiên bản','class'=>'btn btn-default']);?>
</div>