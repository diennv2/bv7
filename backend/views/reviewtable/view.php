<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Reviewtable */
?>
<div class="reviewtable-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'review_id',
            'user_name',
            'user_rating',
            'user_review:ntext',
            'datetime:datetime',
        ],
    ]) ?>

</div>
