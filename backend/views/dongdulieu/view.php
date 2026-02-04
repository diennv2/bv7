<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DongDuLieu */
?>
<div class="dong-du-lieu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dinh_nghia_bang_id',
            'du_lieu:ntext',
            'nguoi_tao',
            'tao_luc',
        ],
    ]) ?>

</div>
