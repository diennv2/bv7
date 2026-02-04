<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Traloicauhoi */
?>
<div class="traloicauhoi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'listnhanquaid',
            'cauhoi',
            'cautraloi:ntext',
            'dapancuakhach:ntext',
            'status',
        ],
    ]) ?>

</div>
