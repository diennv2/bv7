<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Landingpage */
?>
<div class="landingpage-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'active',
            'templatefile:ntext',
            'customcss:ntext',
            'name:ntext',
            'url:ntext',
        ],
    ]) ?>

</div>
