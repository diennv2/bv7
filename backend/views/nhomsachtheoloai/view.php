<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Nhomsachtheoloai */
?>
<div class="nhomsachtheoloai-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nhomid',
            'sachid',
        ],
    ]) ?>

</div>
