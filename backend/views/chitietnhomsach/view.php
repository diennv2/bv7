<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Chitietnhomsach */
?>
<div class="chitietnhomsach-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_id',
            'nhomid',
        ],
    ]) ?>

</div>
