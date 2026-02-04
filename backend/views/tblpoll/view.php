<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tblpoll */
?>
<div class="tblpoll-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'poll_id',
            'php_framework',
        ],
    ]) ?>

</div>
