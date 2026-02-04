<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Danhmucvanban */
?>
<div class="danhmucvanban-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'loaivanban:ntext',
        ],
    ]) ?>

</div>
