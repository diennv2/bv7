<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Filedinhkem */
?>
<div class="filedinhkem-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tenfile:ntext',
            'thumb:ntext',
            'ord',
            'default',
            'lienhe_id',
        ],
    ]) ?>

</div>
