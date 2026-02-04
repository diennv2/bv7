<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Nhansu */
?>
<div class="nhansu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'capbac',
            'image:ntext',
            'job',
            'content:ntext',
            'ord',
            'phone:ntext',
            'active',
            'lang_id',
        ],
    ]) ?>

</div>
