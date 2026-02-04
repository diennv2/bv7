<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Goicuoc */
?>
<div class="goicuoc-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'loaidangky',
            'status',
        ],
    ]) ?>

</div>
