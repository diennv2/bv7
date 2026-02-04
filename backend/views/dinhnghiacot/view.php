<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DinhNghiaCot */
?>
<div class="dinh-nghia-cot-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dinh_nghia_bang_id',
            'ten_cot',
            'khoa',
            'loai',
            'cong_thuc:ntext',
            'thu_tu',
            'tao_luc',
        ],
    ]) ?>

</div>
