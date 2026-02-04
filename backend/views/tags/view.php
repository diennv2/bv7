<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tags */
?>
<div class="tags-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tag',
            'url:url',
            'seo_title',
            'seo_keyword:ntext',
            'seo_desc:ntext',
            'tagscol',
        ],
    ]) ?>

</div>
