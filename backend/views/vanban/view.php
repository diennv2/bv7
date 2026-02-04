<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Vanban */
?>
<div class="vanban-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'mavanban:ntext',
            'ngayvanban',
            'trichyeu:ntext',
            'filedinhkem:ntext',
            'active',
            'home',
            'danhmuc',
        ],
    ]) ?>

</div>
