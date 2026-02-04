<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Datcauhoi */
?>
<div class="datcauhoi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hoten',
            'email:ntext',
            'noidung:ntext',
            'filedinhkem:ntext',
            'user_id',
        ],
    ]) ?>

</div>
