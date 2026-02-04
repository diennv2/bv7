<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Chuyenkhoa */
?>
<div class="chuyenkhoa-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'image:ntext',
            'job',
            'content:ntext',
            'ord',
            'active',
            'lang_id',
            'noidung:ntext',
            'url:text',
        ],
    ]) ?>

</div>
