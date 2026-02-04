<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Orderrequest */
?>
<div class="orderrequest-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'khachhang',
            'diachi:ntext',
            'sdt',
            'email:email',
        ],
    ]) ?>

</div>
