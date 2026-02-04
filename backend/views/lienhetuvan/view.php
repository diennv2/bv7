<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Lienhetuvan */
?>
<div class="lienhetuvan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'donvi:ntext',
            'hoten:ntext',
            'dienthoai',
            'noidung:ntext',
            'email:email',
        ],
    ]) ?>

</div>
