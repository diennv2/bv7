<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Thuoctinh */
?>
<div class="thuoctinh-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tenthuoctinh',
            'loaithuoctinh_id',
        ],
    ]) ?>

</div>
