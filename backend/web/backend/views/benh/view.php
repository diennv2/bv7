<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Benh */
?>
<div class="benh-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'duong_dan',
            'tieu_de',
            'mo_ta:ntext',
            'nguoi_tao',
            'tao_luc',
            'cap_nhat_luc',
        ],
    ]) ?>

</div>
