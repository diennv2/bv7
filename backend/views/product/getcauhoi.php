<?php
/** @var \common\models\Product $model */
$cauhoi = \common\models\Cauhoi::find()->where(['product_id' => $model->id])->all();
if (empty($cauhoi)):?>
    <label class="label label-danger">Chưa cập nhật câu hỏi</label>
<?php else: ?>
    <?=\yii\helpers\Html::a('<i class="glyphicon glyphicon-eye-open"></i> Xem chi tiết '.count($cauhoi)." câu hỏi", ['getviewcauhoi','id'=>$model->id],
        ['role'=>'modal-remote','title'=> 'Xem câu hỏi','class'=>'btn btn-default']);?>
<?php endif; ?>

<div>
   <?=\yii\helpers\Html::a('<i class="glyphicon glyphicon-plus"></i>', ['cauhoi/create','ids'=>$model->id],
       ['role'=>'modal-remote','title'=> 'Cập nhậtcâu hỏi','class'=>'btn btn-default']);?>
</div>