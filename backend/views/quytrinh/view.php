<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Quytrinh */
?>
<div class="quytrinh-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'title',
            'decription:ntext',
            'active',
            'ord',
        ],
    ]) ?>

</div>
