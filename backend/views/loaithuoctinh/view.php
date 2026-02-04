<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Loaithuoctinh */
?>
<div class="loaithuoctinh-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tenloai',
        ],
    ]) ?>

</div>
