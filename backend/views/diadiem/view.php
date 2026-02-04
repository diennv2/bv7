<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Diadiem */
?>
<div class="diadiem-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ten',
        ],
    ]) ?>

</div>
