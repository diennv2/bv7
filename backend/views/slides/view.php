<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Slides */
?>
<div class="slides-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'brief',
            'thumb',
            'image',
            'url:url',
            'ord',
            'active',
        ],
    ]) ?>

</div>
