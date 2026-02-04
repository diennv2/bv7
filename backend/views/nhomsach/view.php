<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Nhomsach */
?>
<div class="nhomsach-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tennhom:ntext',
            'douutien',
        ],
    ]) ?>

</div>
