<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cauhoi */
?>
<div class="cauhoi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cauhoi:ntext',
            'cautraloia:ntext',
            'product_id',
            'cautraloib:ntext',
            'cautraloic:ntext',
            'dokho',
            'dapan',
        ],
    ]) ?>

</div>
