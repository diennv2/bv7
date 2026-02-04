<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Topic */
?>
<div class="topic-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'userid',
            'sachid',
            'image:ntext',
            'luotxem',
            'luotbinhluan',
            'ngaytao',
            'noidung:ntext',
        ],
    ]) ?>

</div>
