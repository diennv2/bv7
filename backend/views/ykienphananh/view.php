<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Ykienphananh */
?>
<div class="ykienphananh-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ngaylap',
            'ten',
            'sdt',
            'noidung:ntext',
            'address:ntext',
            'status',
            'email:email',
            'dathanhtoan',
        ],
    ]) ?>

</div>
