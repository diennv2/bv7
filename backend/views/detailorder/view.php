<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Detailorder */
?>
<div class="detailorder-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tenhang',
            'link:ntext',
            'soluong',
            'dongia',
            'thanhtien',
            'ghichu:ntext',
        ],
    ]) ?>

</div>
