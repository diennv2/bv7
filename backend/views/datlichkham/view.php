<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Datlichkham */
?>
<div class="datlichkham-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hoten:ntext',
            'dienthoai',
            'noidung:ntext',
            'email:email',
            'diachi:ntext',
            'status',
            'time',
            'tieude',
        ],
    ]) ?>

</div>
