<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Thongtinchuyenkhoan */
?>
<div class="thongtinchuyenkhoan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'chutaikhoan:ntext',
            'nganhang:ntext',
            'sotaikhoan:ntext',
        ],
    ]) ?>

</div>
