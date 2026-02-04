<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Phongsu */
?>
<div class="phongsu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'url:ntext',
            'image:ntext',
            'description:ntext',
            'ngaytao',
            'active',
            'ord',
            
        ],
    ]) ?>

</div>
