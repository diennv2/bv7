<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Landingpageoptions */
?>
<div class="landingpageoptions-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'value',
            'target:ntext',
            'landing_id',
        ],
    ]) ?>

</div>
