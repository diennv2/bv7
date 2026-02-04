<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DinhNghiaBang */
?>
<div class="dinh-nghia-bang-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'benh_id',
            'tieu_de',
            'mo_ta:ntext',
            'nguoi_tao',
            'tao_luc',
        ],
    ]) ?>

</div>
