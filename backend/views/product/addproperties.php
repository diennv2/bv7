<?php yii\widgets\Pjax::begin(['id' => 'countries']) ?>
<?=\yii\helpers\Html::a('<i class="glyphicon glyphicon-plus"></i>', "javascript:void(0)",
    ['title'=> 'Thêm mới thuộc tính','id'=>'themthuoctinh','data-target'=>$model->id,'class'=>'btn btn-default']);?>
<div class="table-responsive" id="ketquaaddproperties">
    <?=$dataketqua?>
</div>
<?php yii\widgets\Pjax::end() ?>