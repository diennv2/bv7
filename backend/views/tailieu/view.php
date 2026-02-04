<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaiLieu */
?>
<div class="tai-lieu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'benh_id',
            'dinh_nghia_bang_id',
            'tieu_de',
            'duong_dan',
            'loai',
            'nguoi_tai',
            'tai_luc',
        ],
    ]) ?>

</div>
