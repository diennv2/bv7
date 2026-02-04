<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Coinexchange */
?>
<div class="coinexchange-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'userid',
            'sodiem',
            'phonenumber',
            'brand',
            'type',
            'transaction_id',
            'service',
            'status',
            'sotienthanhcong',
            'mess:ntext',
            'time',
        ],
    ]) ?>

</div>
