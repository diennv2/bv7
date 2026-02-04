<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Lienket */
?>
<div class="lienket-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ten',
            'lienket:ntext',
            'hinhanh:ntext',
            'active',
        ],
    ]) ?>

</div>
